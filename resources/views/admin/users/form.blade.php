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
                        <x-forms.input id="email" :value="$user->email" :label="__('users.email')"
                                       :optionals="['placeholder' => __('users.input_email'), 'type' => 'email']"/>
                    </div>
                    <div class="col-6">
                        <x-forms.input id="password" :value="null" :label="__('users.password')"
                                       :optionals="['placeholder' => __('users.input_password'), 'type' => 'password']"/>
                    </div>
                </div>
                <div class="row mb-4">
                    <div class="col-6">
                        <x-forms.input id="name" :value="$user->name" :label="__('users.name')"
                                       :optionals="['placeholder' => __('users.input_name')]"/>
                    </div>
                    <div class="col-6">
                        <x-forms.select-option id="role" :value="$user->role" :list="$roles"
                                               :label="__('users.role')"/>
                        {{--                        <x-forms.radio id="role" :value="$user->role" :label="__('categories.status')"--}}
                        {{--                                       :optionals="['label_class' => 'form-label']"/>--}}
                    </div>
                    {{--                    <div class="col-6">--}}
                    {{--                        <x-forms.select-option id="departmentId[]" :value="$departmentId" :list="$departments" :label="__('users.select_department')" :optionals="['multiple' => true]" />--}}
                    {{--                    </div>--}}
                </div>
                <div class="row">
                    <input type="hidden" name="id" id="id" value="{{ $user->id }}">
                    <x-forms.submit-group
                        :optionals="['url' => 'admin.users.index', 'view' => empty($view) ? null : $view]"/>
                </div>
            </form>
        </div>
    </section>
@endsection

@include('components.select2-default')
@include('components.sweetalert')
@include('components.form-save', [
    'store_uri' => route('admin.users.store'),
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
