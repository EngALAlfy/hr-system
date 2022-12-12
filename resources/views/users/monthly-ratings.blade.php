@extends('layouts.panel')

@section('title')
    @lang('routes.users.ratings-monthly')
@endsection



@section('content')
    <section>
        <div class="container p-l-30 p-r-30">
            <div class="row">
                <div class="col-md-12">
                    <div class="table-responsive table-responsive-data2">
                        <table class="table table-data2">
                            <thead>
                                <tr>
                                    <th class="sort" data-name="name">@lang('labels.name')</th>
                                    <th class="sort" data-name="rate">@lang('labels.monthly_rate')</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $user)
                                    <tr class="tr-shadow">

                                        <td> <a href="{{ route('users.show', $user) }}">{{ $user->name }}</a></td>

                                        <td>
                                            <div class="d-flex" style="width: fit-content" data-toggle="tooltip" data-placement="top"
                                                    title="{{ $user->rate() }}">
                                                    @for ($i = 1; $i <= 5; $i++)
                                                        @if ($i <= round($user->rate()))
                                                            <span class="fa fa-star text-warning"></span>
                                                        @else
                                                            <span class="fa fa-star text-muted"></span>
                                                        @endif
                                                    @endfor
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
@endsection



@push('scripts')
    <!-- table library -->
    @include('includes.larafy-table', ['items' => $users])

    <script>
        larafy('table', {
            filter: false
        });
    </script>
@endpush
