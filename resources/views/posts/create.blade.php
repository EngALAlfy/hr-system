@extends('layouts.panel')

@section('title')
    @lang('titles.add_post')
@endsection


@section('content')
    <section>
        <div class="container">
            <div class="row">
                <div class="col-12 p-t-30">
                    <form action="{{ route('posts.store') }}" method="post" class="" enctype="multipart/form-data">

                        @csrf
                        @method('post')

                        <div class="card">
                            <div class="card-body card-block">

                                <div class="form-group">
                                    <label for="title" class=" form-control-label">@lang('labels.title')</label>
                                    <input type="text" value="{{ old('title') }}" id="title" name="title"
                                        class=" form-control" placeholder="@lang('placeholders.title')">
                                </div>


                                <div class="form-group">
                                    <label for="branch_id" class=" form-control-label">@lang('labels.branch')</label>
                                    <select name="branch_id" class="js-select2" id="branch_id">
                                        @foreach ($branches as $key => $branch)
                                            <option value="{{ $branch->id }}"
                                                {{ old('branch_id') == $branch->id ? 'selected' : '' }}>{{ $branch->name }}
                                            </option>
                                        @endforeach
                                    </select>

                                    <div class="dropDownSelect2"></div>
                                </div>


                                <div class="form-group">
                                    <label for="project_id" class=" form-control-label">@lang('labels.project')</label>
                                    <select name="project_id" class="js-select2" id="project_id">
                                        <option >@lang('labels.choose_branch_first')</option>
                                    </select>

                                    <div class="dropDownSelect2"></div>
                                </div>

                                @include('includes.image-copper' , ['hight' => 300 , 'width' => 300])

                                <div class="form-group">
                                    <label for="info" class=" form-control-label">@lang('labels.info')</label>
                                    <textarea name="info" id="info" rows="9" placeholder="@lang('placeholders.info')" class="form-control">{{ old('info') }}</textarea>
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

@push('scripts')
    <script>
        var branches = JSON.parse('{!! json_encode($branches) !!}');

        $('#branch_id').change(function() {
            var branch = branches[$(this).find('option:selected').val()];

            $('#project_id').empty();
            branch.projects.forEach(element => {
                $('#project_id').append(`<option value="${element.id}">${element.name}</option>`);
            });
        });
    </script>
@endpush
