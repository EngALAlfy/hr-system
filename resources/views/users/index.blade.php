@extends('layouts.panel')

@section('title')
    @lang('titles.users')
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
                                    {{-- <th>
                                        <label class="au-checkbox">
                                            <input type="checkbox">
                                            <span class="au-checkmark"></span>
                                        </label>
                                    </th> --}}
                                    <th width=100 class="">@lang('labels.photo')</th>

                                    <th class="sort" data-name="name">@lang('labels.name')
                                    </th>
                                    {{-- <th>@lang('labels.email')</th> --}}
                                    {{-- <th class="sort" data-name="job_title">@lang('labels.job_title')</th> --}}
                                    {{-- <th class="sort" data-name="salary">@lang('labels.salary')</th> --}}
                                    <th class="sort" data-name="wallet_sum_amount">@lang('labels.wallet')</th>
                                    <th class="sort" data-name="rate">@lang('labels.rate')</th>
                                    <th>@lang('labels.actions')</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $user)
                                    <tr class="tr-shadow">
                                        {{-- <td>
                                            <label class="au-checkbox">
                                                <input type="checkbox">
                                                <span class="au-checkmark"></span>
                                            </label>
                                        </td> --}}
                                        <td>
                                            <a href="{{ route('users.show', $user) }}"> <img
                                                    src="{{ asset("storage/photos/users/$user->photo") }}"
                                                    onerror="this.src='{{ asset('assets/common/img/user.png') }}'"
                                                    alt="@lang('labels.photo') : {{ $user->name }}">
                                            </a>
                                        </td>
                                        <td> <a href="{{ route('users.show', $user) }}">
                                            <div class="table-data__info">
                                                <h6>{{ $user->name }}</h6>
                                                <span>
                                                    {{ $user->job_title }}
                                                </span>
                                            </div>
                                        </a></td>
                                        {{-- <td>
                                            <span class="block-email">{{ $user->email }}</span>
                                        </td> --}}
                                        {{-- <td class="desc">{{ $user->job_title }}</td> --}}

                                        {{-- <td>
                                            <span class="block-email">{{ $user->salary }}</span>
                                        </td> --}}

                                        <td>
                                            <a
                                                href="{{ route('users.wallet', $user) }}">{{ $user->wallet_sum_amount ?? 0 }}</a>
                                        </td>

                                        <td>
                                            <a href="{{ route('users.ratings', $user) }}">
                                                <div class="d-flex" data-toggle="tooltip" data-placement="top"
                                                    title="{{ $user->rate() }}">
                                                    @for ($i = 1; $i <= 5; $i++)
                                                        @if ($i <= round($user->rate()))
                                                            <span class="fa fa-star text-warning"></span>
                                                        @else
                                                            <span class="fa fa-star text-muted"></span>
                                                        @endif
                                                    @endfor
                                                </div>
                                            </a>

                                        </td>

                                        <td>
                                            <div class="table-data-feature">

                                                <a href="" class="item" data-toggle="modal" data-target="#walletModal_{{$user->id}}"
                                                    title="@lang('buttons.wallet')">
                                                    <i class="zmdi zmdi-money"></i>
                                                </a>

                                                <!-- modal wallet -->
                                                <div class="modal fade" id="walletModal_{{$user->id}}" tabindex="-1" role="dialog"
                                                    aria-labelledby="smallmodalLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-sm" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="smallmodalLabel">
                                                                    @lang('buttons.wallet')</h5>
                                                                <button type="button" class="close" data-dismiss="modal"
                                                                    aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                @include('user-wallet.create')
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- end modal wallet -->

                                                <a href="" class="item" data-toggle="modal"
                                                    data-target="#rateModal_{{ $user->id }}"
                                                    title="@lang('buttons.rate')">
                                                    <i class="zmdi zmdi-star"></i>
                                                </a>

                                                <!-- rate modal -->
                                                <div class="modal fade" id="rateModal_{{ $user->id }}" tabindex="-1"
                                                    role="dialog" aria-labelledby="smallmodalLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-sm" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="smallmodalLabel">
                                                                    @lang('buttons.rate')</h5>
                                                                <button type="button" class="close" data-dismiss="modal"
                                                                    aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                @include('user-ratings.create', $user)
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- end rate modal -->
                                                <a href="{{ route('users.roles', $user) }}" class="item"
                                                    data-toggle="tooltip" data-placement="top" title="@lang('titles.roles')">
                                                    <i class="zmdi zmdi-key"></i>
                                                </a>
                                                <a href="{{ route('users.edit', $user) }}" class="item"
                                                    data-toggle="tooltip" data-placement="top" title="@lang('buttons.edit')">
                                                    <i class="zmdi zmdi-edit"></i>
                                                </a>
                                                <form action="{{ route('users.destroy', $user) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="item" data-toggle="tooltip"
                                                        data-placement="top" title="@lang('buttons.delete')">
                                                        <i class="zmdi zmdi-delete"></i>
                                                    </button>
                                                </form>




                                                <div class="m-r-0 noti__item js-item-menu">
                                                    <button class="item m-l-5" data-toggle="tooltip" data-placement="top"
                                                        title="@lang('buttons.more')">
                                                        <i class="zmdi zmdi-more"></i>
                                                    </button>
                                                    <div class="more-dropdown js-dropdown">
                                                        <div class="notifi__item">
                                                            <a href="{{ route('users.ratings', $user) }}"
                                                                class="text-muted">
                                                                <i class="fa fa-star"></i>
                                                                @lang('buttons.ratings')
                                                            </a>
                                                        </div>
                                                        <div class="notifi__item">
                                                            <a href="{{ route('users.wallet', $user) }}"
                                                                class="text-muted">
                                                                <i class="fa fa-dollar"></i>
                                                                @lang('buttons.wallet')
                                                            </a>
                                                        </div>

                                                    </div>
                                                </div>
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
    @include('includes.larafy-table', ['items' => $users, 'enableAddRoute' => true])

    <script>
        larafy('table', {
            filter: false
        });
    </script>
@endpush
