@extends('manager.layouts.app')

@push('custom_styles')
    <style>
        .btn-custom-size {
            min-width: 10rem;
        }
    </style>
@endpush

@section('content')

    <!-- Hero -->
    <div class="bg-body-light">
        <div class="content content-full">
            <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
                <h1 class="flex-grow-1 fs-3 fw-semibold my-2 my-sm-3">{{$surveyForm->name}}</h1>
                <nav class="flex-shrink-0 my-2 my-sm-0 ms-sm-3" aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">Pages</li>
                        <li class="breadcrumb-item">Blog</li>
                        <li class="breadcrumb-item active" aria-current="page">Edit</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <!-- END Hero -->

    <!-- Page Content -->
    <div class="content content-full content-boxed">
        <!-- Main Container -->
        <h1 class="flex-grow-1 fs-3 fw-semibold my-2 my-sm-3">{{ __('manage.manage') . __('survey_forms.page_title') }}</h1>
        <div class="p-3 bg-body-extra-light rounded push">
            <form action="" method="GET">
                <div class="row mb-4">
                    <div class="col-3">
                        <x-forms.select-option id="employeeId" :value="$employeeId" :list="$employees"
                                               :label="__('departments.employee')"/>

                        {{--                        <label for="cars">Choose a car:</label>--}}
                        {{--                        <select name="employeeId" id="employeeId">--}}
                        {{--                        @foreach($employees as $employee)--}}
                        {{--                                <option value="{{$employee->id}}">{{$employee->name}}</option>--}}
                        {{--                        @endforeach--}}
                        {{--                        </select>--}}

                    </div>
                </div>
                {{--                @include('components.btns.search')--}}
                <div class="row">
                    <div class="col-sm-12 text-end">
                        <a href="{{ URL::current() }}"
                           class="btn btn-outline-secondary btn-clear-search btn-custom-size me-2"><i
                                class="fa fa-rotate-left"></i> {{ __('lang.clear_search') }}</a>
                        <a onclick="getData()"
                           class="btn btn-outline-secondary btn-clear-search btn-custom-size me-2"><i
                                class="fa fa-rotate-left"></i> zz</a>
                        {{--                        <button type="submit" class="btn btn-primary btn-custom-size" onclick="getData()"><i class="fa fa-magnifying-glass"></i> {{ __('lang.search') }}</button>--}}
                    </div>
                </div>

            </form>
        </div>
        <!-- New Post -->
        <form id="save-form">
            <div class="block">
                <div class="block-header block-header-default">
                    <a class="btn btn-alt-secondary" href="be_pages_blog_post_manage.html">
                        <i class="fa fa-arrow-left me-1"></i> แบบสอบถาม
                    </a>
                </div>
                <div class="block-content">
                    <div class="row justify-content-center push">
                        <div class="col-md-10">
                            @if(sizeof($questions) > 0)
                                @foreach ($questions as $questionIndex => $question)
                                    <h3>{{$question->name}}</h3>
                                    @foreach ($question->answers as $answerIndex => $answer)
                                        @if($question->type == \App\Enums\SurveyFormEnum::ONE_CHOICE)
                                            <div class="form-check form-check-inline mt-1">
                                                <input class="form-check-input col-sm-4" type="radio"
                                                       name="oneChoiceAnswers[{{$questionIndex}}]"
                                                       value="{{$answer->id}}" disabled
                                                       @if(in_array($answer->id, $surveyResponses))
                                                           checked
                                                       @endif
                                                />
                                                <label class="form-check-label">{{$answer->name}} ({{$answer->score}}
                                                    )</label>
                                            </div>
                                        @elseif($question->type == \App\Enums\SurveyFormEnum::MANY_CHOICE)
                                            <div class="form-check form-check-inline mt-1">
                                                <input class="form-check-input col-sm-4" type="checkbox" disabled
                                                       name="manyChoiceAnswers[{{$questionIndex}}][]"
                                                       value="{{$answer->id}}"
                                                       @if(in_array($answer->id, $surveyResponses))
                                                           checked
                                                    @endif
                                                    {{--                                                    {{$answer->id == $question->answer_id ? 'checked' : ''}}--}}
                                                />
                                                <label class="form-check-label">{{$answer->name}} ({{$answer->score}}
                                                    )</label>
                                            </div>
                                        @endif
                                        <br>
                                    @endforeach
                                    @if($question->type == \App\Enums\SurveyFormEnum::TEXT_CHOICE)
                                        <textarea name="textAnswers[{{$questionIndex}}]" class="form-control text-start"
                                                  disabled>@foreach($surveyResponseText as $item){{$item->question_id == $question->id ? $item->text_answer : ''}}@endforeach
                                        </textarea>
                                        <br>
                                    @endif
                                @endforeach
                            @else
                                <tr class="table-empty">
                                    <td class="text-center" colspan="8">“
                                        {{ __('manage.no_list') }} “
                                    </td>
                                </tr>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="block-content bg-body-light">
                    <div class="row justify-content-center push">
                        <input type="hidden" name="surveyFormId" id="surveyFormId" value="{{ $surveyForm->id }}">
                        {{--                        <input type="hidden" name="id" id="id" value="">--}}
                        <x-forms.submit-group
                            :optionals="['url' => 'employee.survey-responses.index', 'view' => empty($view) ? null : $view]"/>
                    </div>
                </div>
            </div>
        </form>
        <!-- END New Post -->
    </div>
    <!-- END Page Content -->
    <!-- END Main Container -->
@endsection

@include('components.select2-default')
@include('components.sweetalert')
@include('components.form-save', [
    'store_uri' => route('employee.survey-responses.store'),
])

@push('scripts')
    <script>
        $view = '{{ isset($view) }}';
        if ($view) {
            $('#name').prop('disabled', true);
            $('#password').prop('disabled', true);
            $('#email').prop('disabled', true);
            $('#role').prop('disabled', true);
            $('.checkbox2').prop('disabled', true);
        }

        function getData() {
            var employeeId = document.getElementById('employeeId').value;
            var surveyFormId = document.getElementById('surveyFormId').value;
            var data = {
                employeeId: employeeId,
                surveyFormId: surveyFormId
            };
            console.log(data);

            axios.post("{{ route('manager.survey-reports.get-data') }}", data).then(response => {
                if (response.data.success) {
                    if (response.data.redirect) {
                        window.location.href = response.data.redirect;
                    } else {
                        window.location.reload();
                    }
                } else {
                    window.location.reload();
                }
            });
        }
    </script>
@endpush
