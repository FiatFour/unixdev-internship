@extends('admin.layouts.app')

@push('custom_styles')
    <style>
        .btn-custom-size {
            min-width: 10rem;
        }
    </style>
@endpush

@section('content')
    <section class="content">
        <h1 class="flex-grow-1 fs-3 fw-semibold my-2 my-sm-3">{{ $page_title ?? '' }}</h1>
        <div class="p-3 bg-body-extra-light rounded push">
            <form id="save-form">
                <div class="row mb-4">
                    <div class="col-6">
                        <x-forms.input id="name" :value="$department->name" :label="__('departments.name')"
                                       :optionals="['placeholder' => __('departments.input_name')]"/>

                    </div>
                    <div class="col-6">
                        <x-forms.select-option id="managerId" :value="$department->manager_id" :list="$managers"
                                               :label="__('departments.select_manager')"/>
                    </div>
                </div>
                <div class="row mb-4">
                    <div class="col-12">
                        @if (isset($view))
                            <x-forms.select-option id="employeeId" :value="$employeeId" :list="$employees"
                                                   :label="__('departments.select_employee')"
                                                   :optionals="['multiple' => true, 'disabled' => true]"
                            />
                        @else
                            <x-forms.select-option id="employeeId[]" :value="$employeeId" :list="$employees"
                                                   :label="__('departments.select_employee')"
                                                   :optionals="['multiple' => true]"
                            />
                        @endif

                    </div>
                </div>
                <div class="row">
                    <input type="hidden" name="id" id="id" value="{{ $department->id }}">
                    <x-forms.submit-group
                        :optionals="['url' => 'admin.departments.index', 'view' => empty($view) ? null : $view]"/>
                </div>
            </form>
        </div>
    </section>
@endsection

@include('components.select2-default')
@include('components.sweetalert')
@include('components.form-save', [
    'store_uri' => route('admin.departments.store'),
])

@push('scripts')
    <script>
        $view = '{{ isset($view) }}';
        if ($view) {
            $('#name').prop('disabled', true);
            $('#managerId').prop('disabled', true);
            $('#employeeId').prop('disabled', true);
        }
    </script>
@endpush
