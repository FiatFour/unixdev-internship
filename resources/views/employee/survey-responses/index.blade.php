@extends('manager.layouts.app')

@section('content')
    <div class="content">
        <!-- Search -->
        <h5>

        </h5>
        <h1 class="flex-grow-1 fs-3 fw-semibold my-2 my-sm-3" style="border: solid 1px red;">{{ __('manage.manage') . __('survey_forms.page_title') }}</h1>
        <div class="p-3 bg-body-extra-light rounded push">
            <form action="" method="GET">
                @include('components.btns.search')
            </form>
        </div>


        <div class="block block-rounded">
            <div class="block-content">
                <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
                    <h1 class="flex-grow-1 fs-3 fw-semibold my-2 my-sm-3"></h1>
                    <a href="{{ route('manager.survey-forms.create') }}" type="button" class="btn btn-alt-primary my-2">
                        <i class="fa fa-fw fa-plus me-1"></i> {{ __('manage.btn_add') }}
                    </a>
                </div>
                <div class="table-responsive">
                    <table class="table table-striped table-borderless table-vcenter">
                        <thead>
                        <tr class="bg-body-dark">
                            <th class="d-none d-sm-table-cell text-center">#</th>
                            <th>{{ __('survey_forms.name') }}</th>
                            <th>{{ __('lang.created_at') }}</th>
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
                                        <td class="d-none d-sm-table-cell">
                                            {{ get_thai_date_format($d->created_at, 'd/m/Y') }}
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
                {!! $lists->appends(\Request::except('page'))->render() !!}
            </div>
        </div>
    </div>
@endsection

@include('components.sweetalert')
@include('components.list-delete')

