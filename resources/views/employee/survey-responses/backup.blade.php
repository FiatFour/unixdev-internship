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
                        <i class="fa fa-arrow-left me-1"></i> Manage Posts
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
                            <div class="mb-4">
                                <label class="form-label" for="dm-post-edit-id">ID</label>
                                <input type="text" class="form-control-plaintext" id="dm-post-edit-id"
                                       name="dm-post-edit-id" value="150" readonly>
                            </div>
                            <div class="mb-4">
                                <label class="form-label" for="dm-post-edit-title">Title</label>
                                <input type="text" class="form-control" id="dm-post-edit-title"
                                       name="dm-post-edit-title" placeholder="Enter a title.."
                                       value="An adventure of a lifetime">
                            </div>
                            <div class="mb-4">
                                <label class="form-label" for="dm-post-edit-slug">Slug (url)</label>
                                <input type="text" class="form-control" id="dm-post-edit-slug" name="dm-post-edit-slug"
                                       value="an-adventure-of-a-lifetime" disabled>
                            </div>
                            <div class="mb-4">
                                <label class="form-label" for="dm-post-edit-excerpt">Excerpt</label>
                                <textarea class="form-control" id="dm-post-edit-excerpt" name="dm-post-edit-excerpt"
                                          rows="3" placeholder="Enter an excerpt..">Etiam egestas fringilla enim, id convallis lectus laoreet at. Fusce purus nisi, gravida sed consectetur ut, interdum quis nisi. Quisque egestas nisl id lectus facilisis scelerisque? Proin rhoncus dui at ligula vestibulum ut facilisis ante sodales! Suspendisse potenti. Aliquam tincidunt sollicitudin sem nec ultrices.</textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="block-content bg-body-light">
                    <div class="row justify-content-center push">
                        <div class="col-md-10">
                            <button type="submit" class="btn btn-alt-primary">
                                <i class="fa fa-fw fa-check opacity-50 me-1"></i> Save Changes
                            </button>
                        </div>
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
