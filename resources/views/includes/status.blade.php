<div class="p-l-20 p-r-20">

    @if (session('success'))
    @push('scripts')
        <script>
            toastr.success("{{ session('success') }}");
        </script>
    @endpush

    <div class="m-t-10 sufee-alert alert with-close alert-success alert-dismissible fade show">
        <span class="badge badge-pill badge-success">@lang('labels.success')</span>
        {{ session('success') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">×</span>
        </button>
    </div>
@endif

@if (session('error'))
    @push('scripts')
        <script>
            toastr.error("{{ session('error') }}");
        </script>
    @endpush

    <div class="m-t-10 sufee-alert alert with-close alert-danger alert-dismissible fade show">
        <span class="badge badge-pill badge-danger">@lang('labels.error')</span>
        {{ session('error') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">×</span>
        </button>
    </div>

@endif

@if ($errors->any())
<div class="m-t-10 sufee-alert alert with-close alert-danger alert-dismissible fade show">
    <span class="badge badge-pill badge-danger">@lang('labels.error')</span>
        <ul class="list-unstyled">
            @foreach ($errors->all() as $error)
               <li>{{ $error }}</li>
            @endforeach
        </ul>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">×</span>
        </button>
    </div>
@endif


</div>
