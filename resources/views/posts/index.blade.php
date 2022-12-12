@extends('layouts.panel')

@section('title')
    @lang('titles.posts')
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
                                        <th  class="sort" data-name="title">@lang('labels.title')</th>
                                        <th class="sort filter-relation" data-name="project_id">@lang('labels.project')</th>
                                        <th class="sort filter-relation" data-name="branch_id">@lang('labels.branch')</th>
                                        <th class="sort filter-relation" data-name="user_id">@lang('labels.user')</th>
                                        <th  class="sort" data-name="created_at">@lang('labels.date')</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>

                            <div class="m-t-20"></div>
                            @foreach ($posts as $post)
                            <div class="row justify-content-center">
                                <div class="col-7">
                                    <div class="card">
                                        <div class="card-header user-header alt bg-white">

                                            <div>
                                                {{ $post->branch->name }} : {{ $post->project->name }}
                                            </div>

                                            <hr>

                                            <div class="media">
                                                <a href="#">
                                                    <img class="align-self-center rounded-circle mr-3" style="width:55px; height:55px;" alt="" src="{{ asset("storage/photos") . "/" . $post->user->photo }}"
                                                    onerror="this.src='{{ asset('assets/common/img/user.png') }}'">
                                                </a>
                                                <div class="media-body">
                                                    <h4 class="text-dark display-6"><a href="{{route('users.show',$post->user)}}">{{$post->user->name}}</a></h4>
                                                    <p>{{$post->created_at->diffForHumans()}} @if($post->created_at != $post->updated_at  ) - @lang("labels.updated_at") {{$post->updated_at->diffForHumans()}} @endif</p>
                                                </div>

                                                <div class="m-r-0 noti__item js-item-menu">
                                                    <button class="item m-l-5" data-toggle="tooltip"
                                                        data-placement="top" title="@lang('buttons.more')">
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
                                        <img class="" src="{{asset("storage/photos/$post->branch_id/$post->project_id/$post->photo")}}" alt="">
                                        <div class="card-body">
                                            <h4 class="card-title mb-3">{{$post->title}}</h4>
                                            <p class="card-text">
                                                {{ $post->info }}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach

                        </div>
                    </div>

            </div>
        </div>
    </section>
@endsection



@push('scripts')
     <!-- table library -->
    @include('includes.larafy-table' , ['items' => $posts  , 'enableAddRoute' => true])

    <script>
            larafy('.table-responsive' , {});
    </script>
@endpush
