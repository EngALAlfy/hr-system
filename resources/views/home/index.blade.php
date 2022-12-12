@extends('layouts.panel')

@section('title')
    @lang('routes.home')
@endsection

@push('actions')
    <style>
        .table-data {
            height: unset;
        }

        .statistic__item {
            min-height: unset;
        }

        .title-3,
        .display-6 {
            font-size: unset;
        }
    </style>
@endpush
@section('content')
    <section class="statistic statistic2">
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-lg-3">
                    <div class="statistic__item statistic__item--orange">
                        <a href="{{ route('users.index') }}">
                            <h2 class="number">{{ $users_count }}</h2>
                            <span class="desc">@lang('titles.users')</span>
                        </a>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="statistic__item statistic__item--blue">
                        <a href="{{ route('projects.index') }}">
                            <h2 class="number">{{ $projects_count }}</h2>
                            <span class="desc">@lang('titles.projects')</span>
                        </a>
                    </div>

                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="statistic__item statistic__item--red">
                        <a href="{{ route('branches.index') }}">
                            <h2 class="number">{{ $branches_count }}</h2>
                            <span class="desc">@lang('titles.branches')</span>
                        </a>
                    </div>

                </div>

                <div class="col-md-6 col-lg-3">
                    <div class="statistic__item statistic__item--green">
                        <a href="{{ route('users.attendance') }}">
                            <h2 class="number">{{ $yesterday_absent_count }}</h2>
                            <span class="desc">@lang('titles.yesterday_absent')</span>
                        </a>
                    </div>
                </div>

            </div>
        </div>
    </section>
    <section>
        <div class="container">

            <div class="row">
                <div class="col-md-5">
                    <div class="user-data m-b-20 m-t-20 p-t-20">
                        <h4 class="title-3 m-b-20">
                            <i class="zmdi zmdi-account-calendar"></i>@lang('titles.today_posts') :
                            {{ \Carbon\Carbon::today()->translatedFormat('l d M') }}
                        </h4>
                    </div>

                    @if (count($posts) <= 0)
                        <div class="d-flex justify-content-center p-b-10">@lang('messages.no_data')</div>
                    @else
                        @foreach ($posts as $post)
                            <div class="row justify-content-center">
                                <div class="col-12">
                                    <div class="card">
                                        <div class="card-header user-header alt bg-white">

                                            <div>
                                                <a
                                                    href="{{ route('branches.show', $post->branch) }}">{{ $post->branch->name }}</a>
                                                : <a
                                                    href="{{ route('projects.show', $post->project) }}">{{ $post->project->name }}</a>
                                            </div>

                                            <hr>

                                            <div class="media">
                                                <a href="{{ route('users.show', $post->user) }}">
                                                    <img class="align-self-center rounded-circle mr-3"
                                                        style="width:55px; height:55px;" alt=""
                                                        src="{{ asset('storage/photos/users') . '/' . $post->user->photo }}"
                                                        onerror="this.src='{{ asset('assets/common/img/user.png') }}'">
                                                </a>
                                                <div class="media-body">
                                                    <h4 class="text-dark display-6"><a
                                                            href="{{ route('users.show', $post->user) }}">{{ $post->user->name }}</a>
                                                    </h4>
                                                    <p>{{ $post->created_at->diffForHumans() }} @if ($post->created_at != $post->updated_at)
                                                            - @lang('labels.updated_at') {{ $post->updated_at->diffForHumans() }}
                                                        @endif
                                                    </p>
                                                </div>

                                                <div class="m-r-0 noti__item js-item-menu">
                                                    <button class="item m-l-5" data-toggle="tooltip" data-placement="top"
                                                        title="@lang('buttons.more')">
                                                        <i class="zmdi zmdi-more-vert"></i>
                                                    </button>
                                                    <div class="more-dropdown js-dropdown">
                                                        <div class="notifi__item">
                                                            <a href="#" class="text-muted">
                                                                <i class="fa fa-edit"></i>
                                                                @lang('buttons.edit')
                                                            </a>
                                                        </div>
                                                        <div class="notifi__item">
                                                            <a href="#" class="text-muted">
                                                                <i class="fa fa-trash"></i>
                                                                @lang('buttons.delete')
                                                            </a>
                                                        </div>


                                                    </div>

                                                </div>



                                            </div>
                                        </div>
                                        <img class=""
                                            src="{{ asset("storage/photos/$post->branch_id/$post->project_id/$post->photo") }}"
                                            alt="">
                                        <div class="card-body">
                                            <h4 class="card-title mb-3">{{ $post->title }}</h4>
                                            <p class="card-text">
                                                {{ $post->info }}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>

                <div class="col-md-7">
                    <div class="user-data m-b-20 m-t-20">
                        <h4 class="title-3 m-b-20">
                            <i class="zmdi zmdi-account-calendar"></i>@lang('titles.today_absent') :
                            {{ \Carbon\Carbon::today()->translatedFormat('l d M') }}
                        </h4>

                        @if (count($absentUsers) <= 0)
                            <div class="d-flex justify-content-center p-b-10">@lang('messages.no_data')</div>
                        @else
                            <div class="table-responsive table-data">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <td>@lang('labels.name')</td>
                                            <td>@lang('labels.project')</td>
                                            <td>@lang('labels.monthly_rate')</td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($absentUsers as $user)
                                            <tr>
                                                <td>
                                                    <a href="{{ route('users.show', $user) }}">
                                                        <div class="table-data__info">
                                                            <h6>{{ $user->name }}</h6>
                                                            <span>
                                                                {{ $user->job_title }}
                                                            </span>
                                                        </div>
                                                    </a>
                                                </td>

                                                <td>{{ $user->project->name ?? '--' }}</td>

                                                <td>
                                                    <div class="d-flex" style="width: fit-content" data-toggle="tooltip"
                                                        data-placement="top" title="{{ $user->rate() }}">
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
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @endif

                    </div>

                    <div class="user-data m-b-20 m-t-30">
                        <h4 class="title-3 m-b-20">
                            <i class="zmdi zmdi-star"></i>@lang('titles.top_rating')
                        </h4>

                        @if (count($topRatingUsers) <= 0)
                            <div class="d-flex justify-content-center p-b-10">@lang('messages.no_data')</div>
                        @else
                            <div class="table-responsive table-data">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <td>@lang('labels.name')</td>
                                            <td>@lang('labels.monthly_rate')</td>
                                            <td>@lang('labels.project')</td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($topRatingUsers as $user)
                                            <tr>
                                                <td>
                                                    <a href="{{ route('users.show', $user) }}">
                                                        <div class="table-data__info">
                                                            <h6>{{ $user->name }}</h6>
                                                            <span>
                                                                {{ $user->job_title }}
                                                            </span>
                                                        </div>
                                                    </a>
                                                </td>


                                                <td>
                                                    <div class="d-flex" style="width: fit-content" data-toggle="tooltip"
                                                        data-placement="top" title="{{ $user->rate() }}">
                                                        @for ($i = 1; $i <= 5; $i++)
                                                            @if ($i <= round($user->rate()))
                                                                <span class="fa fa-star text-warning"></span>
                                                            @else
                                                                <span class="fa fa-star text-muted"></span>
                                                            @endif
                                                        @endfor
                                                    </div>

                                                </td>

                                                <td>{{ $user->project->name ?? '--' }}</td>

                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @endif

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
