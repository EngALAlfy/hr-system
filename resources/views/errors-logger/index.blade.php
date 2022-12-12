@extends('layouts.panel')

@section('title')
    @lang('titles.errors')
@endsection

{{-- @push('actions')
    <a href="{{ route('branches.create') }}" class="btn btn-success">
        <i class="fa fa-plus"></i>
        @lang('buttons.add')
    </a>
@endpush --}}

@section('content')
    <section>
        <div class="container p-l-30 p-r-30">
            <div class="row">
                    <div class="col-md-12">
                <div class="table-responsive table-responsive-data2">
                            <table class="table table-data2">
                                <thead>
                                    <tr>
                                        {{-- <th>
                                        <label class="au-checkbox">
                                            <input type="checkbox">
                                            <span class="au-checkmark"></span>
                                        </label>
                                    </th> --}}
                                        <th width="20%">@lang('labels.time')</th>
                                        <th width="50%">@lang('labels.info')</th>
                                        <th width="20%">@lang('labels.type')</th>
                                        <th width="10%">@lang('labels.actions')</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($logs as $log)
                                        <tr class="tr-shadow">
                                            {{-- <td>
                                            <label class="au-checkbox">
                                                <input type="checkbox">
                                                <span class="au-checkmark"></span>
                                            </label>
                                        </td> --}}
                                            <td>{{ $log['time'] }}</td>
                                            <td class="desc">{{ $log['message'] }}</td>
                                            <td>
                                                <span class="block-email">{{ $log['type'] }}</span>
                                            </td>

                                            <td>

                                            </td>
                                        </tr>
                                        <tr class="spacer"></tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

            </div>
        </div>
    </section>
@endsection

@push('scripts')
    <script>
    </script>
@endpush
