@extends('layouts.panel')

@section('title')
    @lang('titles.projects')
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
                                        <th width=150 class="sort filter" data-name="name">@lang('labels.name')</th>
                                        <th>@lang('labels.info')</th>
                                        <th class="sort filter-relation" data-name="branch_id">@lang('labels.branch')</th>
                                        <th class="filter-relation" data-name="user_id">@lang('labels.user')</th>
                                        <th width=100 class="sort" data-name="created_at">@lang('labels.date')</th>
                                        <th>@lang('labels.actions')</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($projects as $project)
                                        <tr class="tr-shadow">
                                            {{-- <td>
                                            <label class="au-checkbox">
                                                <input type="checkbox">
                                                <span class="au-checkmark"></span>
                                            </label>
                                        </td> --}}
                                            <td><a href="{{route('projects.show' , $project)}}">{{ $project->name }}</a></td>
                                            <td class="desc">{{ $project->info }}</td>
                                            <td>
                                                <span class="block-email">{{ $project->branch->name }}</span>
                                            </td>
                                            <td>
                                                <span class="block-email"><a href="{{route('users.show' , $project->user )}}">{{ $project->user->name }}</a></span>
                                            </td>
                                            <td class="desc" data-toggle="tooltip" data-placement="top"
                                                title="{{ $project->created_at->diffForHumans() }}">
                                                {{ $project->created_at->format('Y-m') }}</td>
                                            <td>
                                                <div class="table-data-feature">

                                                    <a href="{{ route('projects.edit', $project) }}" class="item"
                                                        data-toggle="tooltip" data-placement="top"
                                                        title="@lang('buttons.edit')">
                                                        <i class="zmdi zmdi-edit"></i>
                                                    </a>
                                                    <form action="{{ route('projects.destroy', $project) }}" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="item" data-toggle="tooltip"
                                                            data-placement="top" title="@lang('buttons.delete')">
                                                            <i class="zmdi zmdi-delete"></i>
                                                        </button>
                                                    </form>




                                                    <div class="m-r-0 noti__item js-item-menu">
                                                        <button class="item m-l-5" data-toggle="tooltip"
                                                            data-placement="top" title="@lang('buttons.more')">
                                                            <i class="zmdi zmdi-more"></i>
                                                        </button>
                                                        <div class="more-dropdown js-dropdown">
                                                            <div class="notifi__item">
                                                                <a href="{{route('projects.posts' , $project)}}" class="text-muted">
                                                                    <i class="fa fa-list"></i>
                                                                    @lang('buttons.view_posts')
                                                                </a>
                                                            </div>
                                                            <div class="notifi__item">
                                                                <a href="{{route('projects.users' , $project)}}" class="text-muted">
                                                                    <i class="fa fa-users"></i>
                                                                    @lang('buttons.view_users')
                                                                </a>
                                                            </div>
                                                            <div class="notifi__item">
                                                                <a href="{{route('projects.users.attendance' , $project)}}" class="text-muted">
                                                                    <i class="fa fa-thumbs-o-up"></i>
                                                                    @lang('buttons.view_users_attendance')
                                                                </a>
                                                            </div>
                                                            <div class="notifi__item">
                                                                <a href="{{route('projects.users.ratings' , $project)}}" class="text-muted">
                                                                    <i class="fa fa-star-half-o"></i>
                                                                    @lang('buttons.view_users_ratings')
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
    @include('includes.larafy-table' , ['items' => $projects  , 'enableAddRoute' => true])

    <script>
            larafy('table' , {});
    </script>
@endpush
