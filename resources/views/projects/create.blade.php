@extends('layouts.panel')

@section('title')
@lang('titles.add_project')
@endsection


@section('content')
    <section>
        <div class="container">
            <div class="row">
                <div class="col-12 p-t-30">
                    <form action="{{ route('projects.store') }}" method="post" class="">

                        @csrf
                        @method('post')

                        <div class="card">
                            <div class="card-body card-block">

                                <div class="form-group">
                                    <label for="name" class=" form-control-label">@lang('labels.name')</label>
                                    <input type="text" value="{{old('name')}}" id="name" name="name" class=" form-control" placeholder="@lang('placeholders.name')">
                                </div>


                                <div class="form-group">
                                    <label for="branch_id" class=" form-control-label">@lang('labels.branch')</label>
                                    <select name="branch_id" class="js-select2" id="branch_id">
                                        @foreach ($branches as $branch)
                                        <option value="{{$branch->id}}" {{ old('branch_id') == $branch->id ? 'selected' : '' }}>{{$branch->name}}</option>
                                        @endforeach
                                    </select>

                                    <div class="dropDownSelect2"></div>                                </div>

                                <div class="form-group">
                                    <label for="info" class=" form-control-label">@lang('labels.info')</label>
                                    <textarea name="info" id="info" rows="9" placeholder="@lang('placeholders.info')" class="form-control">{{old('info')}}</textarea>
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
