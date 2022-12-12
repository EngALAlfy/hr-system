@extends('layouts.panel')

@section('title')
    {{$user->name}}
@endsection

@section('content')
    <section class="m-t-20">
        <div class="container">
            <div class="row">
                <div class="col-md-5">
                    <div class="card">
                        <div class="card-body">
                            <div class="mx-auto d-block">
                                <img width="200" class="rounded-circle mx-auto d-block m-b-20" src="{{ asset("storage/photos/users/$user->photo") }}"
                                onerror="this.src='{{ asset('assets/common/img/user.png') }}'"
                                alt="@lang('labels.photo') : {{ $user->name }}">
                                <h5 class="text-sm-center mt-2 mb-1">{{$user->name}}</h5>
                                <div class="location text-sm-center">
                                    <i class="fa fa-map-marker"></i> {{$user->job_title}}</div>
                            </div>
                            <hr>
                            <div class="card-text text-sm-center">
                                <a href="#">
                                    <i class="fa fa-facebook pr-1"></i>
                                </a>
                                <a href="#">
                                    <i class="fa fa-twitter pr-1"></i>
                                </a>
                                <a href="#">
                                    <i class="fa fa-linkedin pr-1"></i>
                                </a>
                                <a href="#">
                                    <i class="fa fa-pinterest pr-1"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
