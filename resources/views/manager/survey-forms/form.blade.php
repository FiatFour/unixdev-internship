@extends('manager.layouts.app')

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
                        <div class="col-13">
                            <x-forms.input id="survey_name" :value="$surveyForm->name"
                                           :label="__('survey_forms.name')"
                                           :optionals="['placeholder' => __('survey_forms.input_name')]"/>
                        </div>
                    </div>

                <x-blocks.block :title="__('')">
{{--                    @if (isset($view))--}}
{{--                        @include('orders.sections.views.order-detail')--}}
{{--                    @else--}}
{{--                        @include('orders.sections.order-detail')--}}
{{--                    @endif--}}

                     @include('manager.survey-forms.sections.one-choice')

{{--                    <x-slot name="options">--}}
{{--                        <button type="button" class="btn btn-primary" onclick="openExtraModal()"><i--}}
{{--                                class="icon-add-circle"></i>{{ __('lang.add') }}</button>--}}
{{--                    </x-slot>--}}
                </x-blocks.block>

                <div class="row">
{{--                    <input type="hidden" name="id" id="id" value="{{ $department->id }}">--}}
                    <x-forms.submit-group
                        :optionals="['url' => 'manager.survey-forms.index', 'view' => empty($view) ? null : $view]"/>
                </div>
            </form>
        </div>
    </section>
@endsection


{{--@include('manager.survey-forms.scripts.rental-line-script')--}}
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