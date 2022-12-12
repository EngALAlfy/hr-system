@extends('layouts.panel')

@section('title')
    {{ $user->name }} : @lang('buttons.wallet')
@endsection


@push('actions')
    <button data-toggle="modal" data-target="#walletModal" class="btn btn-success">
        <i class="fa fa-dollar"></i>
        @lang('buttons.add')
    </button>
@endpush


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

                                    <th class="sort" data-name="amount">@lang('labels.amount')</th>
                                    <th class="">@lang('labels.info')</th>
                                    <th class="">@lang('labels.type')</th>
                                    <th class="sort" data-name="created_at">@lang('labels.date')</th>
                                    <th class="sort" data-name="added_by_user_id">@lang('labels.by')</th>
                                    <th>@lang('labels.actions')</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($wallet as $record)
                                    <tr class="tr-shadow">
                                        {{-- <td>
                                            <label class="au-checkbox">
                                                <input type="checkbox">
                                                <span class="au-checkmark"></span>
                                            </label>
                                        </td> --}}

                                        <td>
                                            {{ $record->amount }}
                                        </td>

                                        <td>{{ $record->info }}</td>
                                        <td><span
                                                class="email-block {{ $record->amount > 0 ? 'bg-success' : 'bg-danger' }}  text-white px-3 py-1">{{ $record->amount > 0 ? __('labels.in') : __('labels.out') }}</span>
                                        </td>


                                        <td class="desc" data-toggle="tooltip" data-placement="top"
                                            title="{{ $record->created_at->diffForHumans() }}">
                                            {{ $record->created_at->format('Y-m') }}</td>

                                        <td><a
                                                href="{{ route('users.show', $record->addedByUser) }}">{{ $record->addedByUser->name }}</a>
                                        </td>

                                        <td>
                                            <div class="table-data-feature">

                                                <form action="{{ route('users.wallet.destroy', $record) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="item" data-toggle="tooltip"
                                                        data-placement="top" title="@lang('buttons.delete')">
                                                        <i class="zmdi zmdi-delete"></i>
                                                    </button>
                                                </form>

                                            </div>
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



    <!-- modal small -->
    <div class="modal fade" id="walletModal" tabindex="-1" role="dialog" aria-labelledby="smallmodalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="smallmodalLabel">@lang('buttons.wallet')</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    @include('user-wallet.create')
                </div>
            </div>
        </div>
    </div>
    <!-- end modal small -->
@endsection


@push('scripts')
    <!-- table library -->
    @include('includes.larafy-table', ['items' => $wallet])

    <script>
        larafy('table', {
            filter: false
        });
    </script>
@endpush
