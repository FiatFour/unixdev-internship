@extends('manager.layouts.app')

@section('content')
    <div class="content">
        <!-- Search -->
        <h5>

        </h5>
        <h1 class="flex-grow-1 fs-3 fw-semibold my-2 my-sm-3">{{ __('manage.manage') . __('survey_forms.page_title') }}</h1>
        <div class="p-3 bg-body-extra-light rounded push">
            <form action="" method="GET">
                                <div class="row mb-4">
                                    <div class="col-3">
                                        <x-forms.input id="s" :value="$s" :label="__('lang.search_label')"
                                                       :optionals="['placeholder' => __('lang.input_search')]"/>
                                    </div>
                                    <div class="col-3">
                                        <x-forms.select-option id="name" :value="$name" :list="$departments"
                                                               :label="__('departments.name')"/>
                                    </div>
                                </div>
                @include('components.btns.search')
            </form>
        </div>


        <div class="block block-rounded">
            <div class="block-content">
                <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
                    <h1 class="flex-grow-1 fs-3 fw-semibold my-2 my-sm-3"></h1>
                    <a href="{{ route('manager.survey-forms.create') }}" type="button" data-test="createSurveyForm" class="btn btn-alt-primary my-2">
                        <i class="fa fa-fw fa-plus me-1"></i> {{ __('manage.btn_add') }}
                    </a>
                </div>
                <div class="table-responsive">
                    <table class="table table-striped table-borderless table-vcenter">
                        <thead>
                        <tr class="bg-body-dark">
                            <th class="d-none d-sm-table-cell text-center">#</th>
                            <th>{{ __('survey_forms.name') }}</th>
                            <th>{{ __('departments.name') }}</th>
                            <th>{{ __('lang.created_at') }}</th>
                            <th>{{ __('lang.tools') }}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if(sizeof($lists) > 0)
                                @foreach ($lists as $index => $d)
                                    <tr>
                                        <td class="d-none d-sm-table-cell text-center">
                                            {{ $lists->firstItem() + $index }}</td>
                                        <td class="fw-semibold">
                                            <a href="javascript:void(0)">{{ $d->name }}</a>
                                        </td>
                                        <td>
                                            {{ $d->department_name }}
                                        </td>
                                        <td class="d-none d-sm-table-cell">
                                            {{ get_thai_date_format($d->created_at, 'd/m/Y') }}
                                        </td>
                                        <td>
                                            <div class="btn-group">
                                                <div class="col-sm-12">
                                                    <div class="dropdown dropleft">
                                                        <button type="button" class="btn-block-option"
                                                                data-bs-toggle="dropdown" aria-haspopup="true"
                                                                aria-expanded="false">
                                                            <i class="fa fa-ellipsis-v"></i>
                                                        </button>
                                                        <div class="dropdown-menu" aria-labelledby="dropdown-dropleft-dark">
                                                                <a class="dropdown-item" href="{{ route('manager.survey-reports.data-only', ['survey_form' => $d]) }}"><i class="fa fa-eye me-1"></i> ข้อมูลดิบ</a>
                                                                <a class="dropdown-item" href="#"><i class="far fa-eye me-1"></i> ข้อมูลประมวลผล</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
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
{{--                {!! $lists->appends(\Request::except('page'))->render() !!}--}}
            </div>
        </div>
    </div>
@endsection

@include('components.select2-default')
@include('components.sweetalert')
@include('components.list-delete')

