@extends('layouts.panel')

@section('title')
    @lang('routes.users.projects')
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
                                        <th class="sort filter" data-name="name">@lang('labels.name')</th>
                                        <th>@lang('labels.project')</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($users as $user)
                                        <tr class="tr-shadow">

                                            <td> <a href="{{route('users.show' , $user)}}">{{ $user->name }}</a></td>

                                            <td>

                                                <form class="project-form" action="{{route('users.projects.store' , $user)}}" method="post">
                                                    @csrf
                                                    @method('post')

                                                    <div class="form-group">
                                                        <select name="project_id" class="js-select2 project_id" id="project_id_{{$user->id}}">
                                                            <option value="null">@lang('labels.choose_project')</option>
                                                            @foreach ($projects as $project)
                                                            <option value="{{$project->id}}" {{ $user->project_id == $project->id ? 'selected' : '' }}>{{$project->name}} {{ $user->project_id == $project->id ? '('.__('labels.current').')' : '' }} </option>
                                                            @endforeach
                                                        </select>

                                                        <div class="dropDownSelect2"></div>
                                                    </div>
                                                </form>


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
    @include('includes.larafy-table' , ['items' => $users])

    <script>
            larafy('table' , {filter:false});

            $('.project_id').change(function() {
                $(this).closest('.project-form').submit();
        });
    </script>
@endpush
