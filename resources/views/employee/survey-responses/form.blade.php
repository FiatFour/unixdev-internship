@extends('manager.layouts.app')

@push('custom_styles')
    <style>
        .btn-custom-size {
            min-width: 10rem;
        }
    </style>
@endpush

@section('content')
    <!-- Main Container -->

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
        <!-- New Post -->
        <form id="save-form">
            <div class="block">
                <div class="block-header block-header-default">
                    <a class="btn btn-alt-secondary" href="be_pages_blog_post_manage.html">
                        <i class="fa fa-arrow-left me-1"></i> แบบสอบถาม
                    </a>
                    {{--                        <div class="block-options">--}}
                    {{--                            <div class="form-check form-switch">--}}
                    {{--                                <input class="form-check-input" type="checkbox" value="" id="dm-post-edit-active" name="dm-post-edit-active" checked>--}}
                    {{--                                <label class="form-check-label" for="dm-post-edit-active">Set active</label>--}}
                    {{--                            </div>--}}
                    {{--                        </div>--}}
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
                                                           name="oneChoiceAnswers[{{$questionIndex}}]" value="{{$answer->id}}"/>
                                                    <label class="form-check-label">{{$answer->name}} ({{$answer->score}})</label>
                                                </div>
                                            @elseif($question->type == \App\Enums\SurveyFormEnum::MANY_CHOICE)
                                                <div class="form-check form-check-inline mt-1">
                                                    <input class="form-check-input col-sm-4" type="checkbox"
                                                           name="manyChoiceAnswers[{{$questionIndex}}][]" value="{{$answer->id}}"/>
                                                    <label class="form-check-label">{{$answer->name}} ({{$answer->score}})</label>
                                                </div>
                                            @endif
                                            <br>
                                    @endforeach
                                    @if($question->type == \App\Enums\SurveyFormEnum::TEXT_CHOICE)
                                        <textarea name="textAnswers[{{$questionIndex}}]" class="form-control"></textarea>
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
{{--                <div class="block-content bg-body-light">--}}
{{--                    <div class="row justify-content-center push">--}}
{{--                        <div class="col-md-10">--}}
{{--                            <a href="{{ route('employee.survey-responses.store', ['surveyForm' => $d]) }}" type="button" class="btn btn-alt-danger my-2">--}}
{{--                                <i class="fa fa-fw fa-check me-1"></i> {{__('lang.add')}}--}}
{{--                            </a>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div> --}}
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
        }
    </script>
@endpush
