@extends('manager.layouts.app')

@section('content')
    <div class="block {{ __('block.styles') }}">
        @include('components.block-header', [
            'text' => __('lang.total_list'),
            'block_option_id' => '_list',
        ])
        <div class="block-content">
            <div class="table-wrap db-scroll">
                <table class="table table-striped table-vcenter">
                    <thead class="bg-body-dark">
                    <tr>
                        <th style="width: 5%;"></th>
                        <th style="width: 5%;">#</th>
                        <th style="width: 90%;">1</th>
                        <th class="sticky-col text-center">{{ __('lang.tools') }}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($questions as $key => $d)
                        <tr class="
                        {{ $loop->iteration % 2 == 0 ? 'table-active' : '' }}
                        ">
                            <td class="text-center toggle-table" style="width: 30px">
                                <i class="fa fa-angle-right text-muted"></i>
                            </td>
                            <td>{{ $d->name }}</td>
                            <td>{{ $d->type }}</td>
                        </tr>
                        <tr style="display: none;">
                            <td></td>
                            <td class="td-table" colspan="2">
                                <div class="row">
                                    <div class="col-md-9 text-left">
                                        <span>Hi</span>
                                    </div>
                                </div>
                                <table class="table table-striped">
                                    <thead class="bg-body-dark">
                                    <th style="width: 50px">#</th>
                                    <th style="width: 90%">Name</th>
                                    <tbody>
                                    @if (sizeof($d->answers) > 0)
                                        @foreach ($d->answers as $index => $item)
                                            <tr>
                                                <td style="width: 50px">{{$item->name}}
                                                </td>
                                                <td style="width: 90%">{{$item->score}}</td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td class="text-center" colspan="3">" {{ __('lang.no_list') }} "
                                            </td>
                                        </tr>
                                    @endif
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
{{--            {!! $list->appends(\Request::except('page'))->render() !!}--}}
        </div>
    </div>
@endsection

@include('components.select2-default')
@include('components.sweetalert')
@include('components.list-delete')

@push('scripts')
    <script>
        $('.toggle-table').click(function() {
            $(this).parent().next('tr').toggle();
            $(this).children().toggleClass('fa fa-angle-down text-muted').toggleClass(
                'fa fa-angle-right text-muted');
        });
    </script>
@endpush

