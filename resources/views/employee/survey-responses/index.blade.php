@extends('employee.layouts.app')

@section('content')
    <div class="content">
        <!-- Search -->
        <h5>

        </h5>
        <h1 class="flex-grow-1 fs-3 fw-semibold my-2 my-sm-3">{{ __('survey_responses.page_title') }}</h1>
        <div class="p-3 bg-body-extra-light rounded push">
            <form action="" method="GET">
                <div class="row mb-4">
                    <div class="col-3">
                        <x-forms.input id="search" :value="$search" :label="__('lang.search_label')"
                                       :optionals="['placeholder' => __('lang.input_search')]"/>
                    </div>
                </div>
                @include('components.btns.search')
            </form>
        </div>


        <div class="block block-rounded">
            <div class="block-content">
                <div class="table-responsive">
                    <table class="table table-striped table-borderless table-vcenter">
                        <thead>
                        <tr class="bg-body-dark">
                            <th class="d-none d-sm-table-cell text-center">#</th>
                            <th>{{ __('survey_forms.name') }}</th>
                            <th>{{ __('departments.name') }}</th>
                            <th>{{ __('lang.created_at') }}</th>
                            <th style="text-align: center">{{ __('lang.tools') }}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if(sizeof($lists) > 0)
                                @foreach ($lists as $index => $d)
                                    <tr>
                                        <td class="d-none d-sm-table-cell text-center">
                                            {{ 1 + $index }}</td>
                                        <td class="fw-semibold">
                                            <a href="javascript:void(0)">{{ $d->name }}</a>
                                        </td>
                                        <td class="fw-semibold">
                                            <a href="javascript:void(0)" data-test="department">{{ $d->department_id == Auth::user()->department_id ? 'แผนกหลัก' : 'แผนกรอง'  }}</a>
                                        </td>
                                        <td class="d-none d-sm-table-cell">
                                            {{ get_thai_date_format($d->created_at, 'd/m/Y') }}
                                        </td>
                                        @if($d->responsed)
                                            <td class="d-none d-sm-table-cell">
                                                <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
                                                    <h1 class="flex-grow-1 fs-3 fw-semibold my-2 my-sm-3"></h1>
                                                    <a href="#" type="button" class="btn btn-alt-success my-2">
                                                        <i class="fa fa-fw fa-check me-1"></i> ตอบแบบสอบถามแล้ว
                                                    </a>
                                                </div>
                                            </td>
                                        @else
                                            <td class="d-none d-sm-table-cell">
                                                <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
                                                    <h1 class="flex-grow-1 fs-3 fw-semibold my-2 my-sm-3"></h1>
                                                    <a href="{{ route('employee.survey-responses.create', ['surveyForm' => $d]) }}" type="button" class="btn btn-alt-danger my-2">
                                                        <i class="fa fa-fw fa-pen me-1"></i> ตอบแบบสอบถาม
                                                    </a>
                                                </div>
                                            </td>
                                        @endif

                                    </tr>
                                @endforeach
                            @else
                                <tr class="table-empty">
                                    <td class="text-center" colspan="8">“
                                        {{ __('manage.no_list') }} “
                                    </td>
                                </tr>
                         @endif
                        </tbody>
                    </table>
                </div>
                <div class="d-flex flex-row d-flex justify-content-end">
                </div>
            </div>
        </div>
    </div>
@endsection

@include('components.sweetalert')

