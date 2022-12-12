@extends('layouts.panel')

@section('title')
    @lang('titles.add_user')
@endsection


@section('content')
    <section>
        <div class="container">
            <div class="row">
                <div class="col-12 p-t-30">
                    <form action="{{ route('users.store') }}" enctype="multipart/form-data" method="post" class="">

                        @csrf
                        @method('post')

                        <div class="card">
                            <div class="card-body card-block">

                                <div class="form-group">
                                    <label for="name" class=" form-control-label">@lang('labels.name')</label>
                                    <input type="text" value="{{ old('name') }}" id="name" name="name"
                                        class=" form-control" placeholder="@lang('placeholders.name')">
                                </div>
                                <div class="form-group">
                                    <label for="job_title" class=" form-control-label">@lang('labels.job_title')</label>
                                    <input type="text" value="{{ old('job_title') }}" id="job_title" name="job_title"
                                        class=" form-control" placeholder="@lang('placeholders.job_title')">
                                </div>
                                <div class="form-group">
                                    <label for="email" class=" form-control-label">@lang('labels.email')</label>
                                    <input type="email" value="{{ old('email') }}" id="email" name="email"
                                        class=" form-control" placeholder="@lang('placeholders.email')">
                                </div>
                                <div class="form-group">
                                    <label for="password" class=" form-control-label">@lang('labels.password')</label>
                                    <input type="text" value="{{ old('password') ?? '123456' }}" id="password"
                                        name="password" class=" form-control" placeholder="@lang('placeholders.password')">
                                </div>
                                <div class="form-group">
                                    <label for="salary" class=" form-control-label">@lang('labels.salary')</label>
                                    <input type="number" value="{{ old('salary') }}" id="salary" name="salary"
                                        class=" form-control" placeholder="@lang('placeholders.salary')">
                                </div>

                                @include('includes.image-copper', ['hight' => 200, 'width' => 200])

                                <div class="form-group">
                                    <label for="project_id" class=" form-control-label">@lang('labels.project')</label>
                                    <select name="project_id" class="js-select2" id="project_id">
                                        @foreach ($projects as $project)
                                            <option value="{{ $project->id }}"
                                                {{ old('project_id') == $project->id ? 'selected' : '' }}>
                                                {{ $project->name }}</option>
                                        @endforeach
                                    </select>

                                    <div class="dropDownSelect2"></div>
                                </div>

                            </div>

                            @php

                                $roles_main = ['users', 'projects', 'branches', 'files', 'posts', 'reports'];
                                $roles_sub = ['users' => ['wallet', 'ratings', 'projects', 'attendance']];
                                $actions = ['create', 'view', 'delete'];
                            @endphp

                            <div class="card mb-0">
                                <div class="card-header">
                                    <h4>@lang('titles.roles')</h4>
                                </div>
                                <div class="card-body">
                                    <div class="default-tab">
                                        <nav>
                                            <div class="nav nav-tabs nav-justified" id="nav-tab" role="tablist">

                                                @foreach ($roles_main as $i => $role)
                                                    <a class="nav-item {{ $i == 0 ? 'active' : '' }} nav-link"
                                                        id="nav-{{ $role }}-tab" data-toggle="tab"
                                                        href="#nav-{{ $role }}" role="tab"
                                                        aria-controls="nav-{{ $role }}"
                                                        aria-selected="true">@lang('roles.' . $role)</a>
                                                @endforeach

                                            </div>
                                        </nav>
                                        <div class="tab-content pl-3 pt-2" id="nav-tabContent">
                                            @foreach ($roles_main as $i => $role)
                                                <div class="tab-pane {{ $i == 0 ? 'show active' : '' }} fade"
                                                    id="nav-{{ $role }}" role="tabpanel"
                                                    aria-labelledby="nav-{{ $role }}-tab">

                                                    <div class="m-t-30">
                                                        @foreach ($actions as $action)
                                                            <label class="m-r-20">
                                                                <input type="checkbox"
                                                                    name="roles[]" value="{{ $action }}_{{ $role }}">@lang('roles.' . $action)
                                                            </label>
                                                        @endforeach
                                                    </div>

                                                    @if (array_key_exists($role, $roles_sub))

                                                    <hr>
                                                    @foreach ($roles_sub[$role] as $sub)
                                                            <div class="border-bottom m-t-20">
                                                                <h5 class="m-b-10">@lang('roles.' . $role . '_' . $sub)</h5>
                                                                @foreach ($actions as $action)
                                                                    <label class="m-r-20">
                                                                        <input type="checkbox"
                                                                        name="roles[]" value="{{ $action }}_{{ $role }}_{{ $sub }}">@lang('roles.' . $action)
                                                                    </label>
                                                                @endforeach

                                                            </div>
                                                        @endforeach
                                                    @endif



                                                </div>
                                            @endforeach
                                        </div>

                                    </div>
                                </div>
                            </div>

                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary btn-sm">
                                    <i class="fa fa-dot-circle-o"></i> @lang('buttons.save')
                                </button>
                                <button type="reset" class="btn btn-danger btn-sm">
                                    <i class="fa fa-ban"></i> @lang('buttons.reset')
                                </button>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
