@extends('layouts.panel')

@section('title')
    {{ $user->name }} : @lang('buttons.ratings')
@endsection

@push('actions')
    <button data-toggle="modal" data-target="#rateModal" class="btn btn-success">
        <i class="fa fa-star"></i>
        @lang('buttons.rate')
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

                                    <th class="sort" data-name="rate">@lang('labels.rate')</th>
                                    <th class="">@lang('labels.info')</th>
                                    <th class="sort" data-name="created_at">@lang('labels.date')</th>
                                    <th class="sort" data-name="rated_by_user_id">@lang('labels.by')</th>

                                    <th>@lang('labels.actions')</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($ratings as $rate)
                                    <tr class="tr-shadow">
                                        {{-- <td>
                                            <label class="au-checkbox">
                                                <input type="checkbox">
                                                <span class="au-checkmark"></span>
                                            </label>
                                        </td> --}}

                                        <td>

                                            <div class="d-flex" data-toggle="tooltip" data-placement="top"
                                                title="{{ $rate->rate }}">
                                                @for ($i = 1; $i <= 5; $i++)
                                                    @if ($i <= round($rate->rate))
                                                        <span class="fa fa-star text-warning"></span>
                                                    @else
                                                        <span class="fa fa-star"></span>
                                                    @endif
                                                @endfor
                                            </div>

                                        </td>

                                        <td>{{ $rate->info }}</td>


                                        <td class="desc" data-toggle="tooltip" data-placement="top"
                                            title="{{ $rate->created_at->diffForHumans() }}">
                                            {{ $rate->created_at->format('Y-m') }}</td>

                                        <td><a
                                                href="{{ route('users.show', $rate->ratedByUser) }}">{{ $rate->ratedByUser->name }}</a>
                                        </td>

                                        <td>
                                            <div class="table-data-feature">

                                                <form action="{{ route('users.destroy', $user) }}" method="POST">
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
    <div class="modal fade" id="rateModal" tabindex="-1" role="dialog" aria-labelledby="smallmodalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="smallmodalLabel">@lang('buttons.rate')</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    @include('user-ratings.create')
                </div>
            </div>
        </div>
    </div>
    <!-- end modal small -->
@endsection



@push('scripts')
    <!-- table library -->
    @include('includes.larafy-table', ['items' => $ratings])

    <script>
        larafy('table', {
            filter: false
        });
    </script>
@endpush
