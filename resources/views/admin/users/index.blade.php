@extends('admin.layouts.app')

@section('content')
    <div class="content">
        <!-- Search -->
        <h1 class="flex-grow-1 fs-3 fw-semibold my-2 my-sm-3">{{ __('manage.manage') . __('products.page_title') }}</h1>
        @if (session('message'))
            <div class="alert alert-success">{{ session('message') }} </div>
        @endif
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
                    <a href="{{ route('admin.users.create') }}" type="button" class="btn btn-alt-primary my-2">
                        <i class="fa fa-fw fa-plus me-1"></i> {{ __('manage.btn_add') }}
                    </a>
                </div>
                <div class="table-responsive">
                    <table class="table table-striped table-borderless table-vcenter">
                        <thead>
                        <tr class="bg-body-dark">
                            <th class="d-none d-sm-table-cell text-center" style="width: 40px;">#</th>
                            <th>{{ __('products.name') }}</th>
                            <th>{{ __('categories.page_title') }}</th>
                            <th>{{ __('products.price') }}</th>
                            <th>{{ __('products.exp_date') }}</th>
                            <th class="text-center">{{ __('manage.tools') }}</th>
                        </tr>
                        </thead>
                        <tbody>

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
@include('components.list-delete')

