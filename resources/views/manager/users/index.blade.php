@extends('admin.layouts.app')

@section('content')
    <div class="content">
        <!-- Search -->
        <h1 class="flex-grow-1 fs-3 fw-semibold my-2 my-sm-3">{{ __('manage.manage') . __('products.page_title') }}</h1>
        <div class="p-3 bg-body-extra-light rounded push">
            <form action="" method="GET">
                {{--                <div class="row mb-4">--}}
                {{--                    <div class="col-3">--}}
                {{--                        <x-forms.input id="s" :value="$s" :label="__('lang.search_label')"--}}
                {{--                                       :optionals="['placeholder' => __('lang.input_search')]"/>--}}
                {{--                    </div>--}}
                {{--                    <div class="col-3">--}}
                {{--                        <x-forms.select-option id="product_id" :value="$product_id" :list="$products2"--}}
                {{--                                               :label="__('products.page_title')"/>--}}
                {{--                    </div>--}}
                {{--                    <div class="col-3">--}}
                {{--                        <x-forms.select id="category_id" :name="'name'" :items="$categories" :selected="$category_id"--}}
                {{--                                        :label="__('categories.page_title')" :optionals="['placeholder' => 'เลือก..']"/>--}}
                {{--                    </div>--}}
                {{--                    <div class="col-3">--}}
                {{--                        <x-forms.input id="exp_date" :value="$exp_date" :label="__('products.exp_date')"--}}
                {{--                                       :optionals="['input_class' => 'js-flatpickr', 'placeholder' => 'Y-m-d',]"/>--}}
                {{--                    </div>--}}
                {{--                </div>--}}
                @include('components.btns.search')
            </form>
        </div>


        <div class="block block-rounded">
            <div class="block-content">
                <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
                    <h1 class="flex-grow-1 fs-3 fw-semibold my-2 my-sm-3"></h1>
{{--                    <a href="{{ route('admin.users.create') }}" type="button" class="btn btn-alt-primary my-2">--}}
{{--                        <i class="fa fa-fw fa-plus me-1"></i> {{ __('manage.btn_add') }}--}}
{{--                    </a>--}}
                </div>
                <div class="table-responsive">
                    <table class="table table-striped table-borderless table-vcenter">
                        <thead>
                        <tr class="bg-body-dark">
                            <th class="d-none d-sm-table-cell text-center" style="width: 40px;">#</th>
                            <th>{{ __('users.name') }}</th>
                            <th>{{ __('users.email') }}</th>
                            <th>{{ __('users.role') }}</th>
                            <th>{{ __('users.created_at') }}</th>
{{--                            <th class="text-center">{{ __('manage.tools') }}</th>--}}
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
                                            {{ $d->email }}
                                        </td>
                                        <td class="d-none d-sm-table-cell">
                                            {{ $d->role }}
                                        </td>
                                        <td class="d-none d-sm-table-cell">
{{--                                            {{ get_thai_date_format($d->created_at, 'd/m/Y') }}--}}
                                            zz
                                        </td>
                                        <td class="sticky-col text-center">
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
