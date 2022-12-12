{{-- <div class="custom-file d-none">
    <label for="photo" class="custom-file-label text-left">صورة البوست</label>
    <input type="file" class="custom-file-input" name="photo" id="photo" accept="image/*">
</div> --}}


<link rel="stylesheet" href="{{asset('assets/adminpanel/custom/css/cropper.css')}}">

<div title="@lang('labels.choose_photo')" class="form-group">

    <label>@lang('labels.photo')</label>

    <input type="file" class="d-none" name="photo" id="photo" accept="image/*">


    <div class="row justify-content-center m-0" style="border: 1px dashed black;border-radius: 10px;">
        <div class="col-md-7 text-center">
            <div id="removePhotoBtn" style="z-index:100;position: absolute!important;top:25px;left:25px;cursor: pointer;"
                class="d-none p-1 bg-dark rounded shadow"><i style="    font-size: 25px;                " class="fa fa-trash text-danger"></i></div>
            <img style="cursor: pointer;width:35%" id="image"
                src="{{ asset('assets/common/img/file-input-placeholder.png') }}" class="img-fluid">
        </div>
        <button id="cropBtn" class="btn btn-outline-success col-md-7 d-none  text-center"><i class="fa fa-crop"></i>
            قص </button>
    </div>

    <small class="form-text text-muted">@lang('labels.photo_allow_dim' , ['hight' => $hight , 'width' => $width])</small>
    <small class="form-text text-muted">@lang('labels.photo_allow_size')</small>
    <small class="form-text text-muted">@lang('labels.photo_allow_mimes')</small>


</div>


<style>
    /* Limit image width to avoid overflow the container */
    img {
        max-width: 100% !important;
        /* This rule is very important, please do not ignore this! */
    }

    .cropper-container * {
        direction: ltr !important;
    }

</style>



@push('scripts')

<!-- cropperJS -->
<script src="{{ asset('assets/adminpanel/custom/js/cropper.js') }}"></script>
<script src="{{ asset('assets/adminpanel/custom/js/jquery-cropper.js') }}"></script>

<script>
    $(function() {

        initPhotoEdit();

        $('#removePhotoBtn').click(function() {

            clearPhotoEdit();
        });

        $('#image').click(function() {
            $('#photo').click();
        });

    });



    function clearPhotoEdit() {
        $('#removePhotoBtn').addClass('d-none');
        var $image = $('#image');

        $image.attr('src', "{{ asset('assets/common/img/file-input-placeholder.png') }}");

        // temporary remove event listener, change and restore
        $photo = document.getElementById('photo');
        var currentOnChange = $photo.onchange;

        $photo.onchange = null;
        $photo.files = null;
        $photo.onchange = currentOnChange;

        $('#image').cropper('destroy');


            $('#cropBtn').addClass('d-none');
    }

    function initPhotoEdit() {
        $('#photo').on('change', function() {
            const originalFile = this.files[0];
            $('#removePhotoBtn').removeClass('d-none');

            var reader = new FileReader();

            reader.onload = function(e) {
                getPhotoDimentions(e, originalFile);
            }

            reader.readAsDataURL(originalFile);
        });
    }


    function getPhotoDimentions(e, originalFile) {
        var img = document.createElement('img');

        img.src = e.target.result

        $('#image').attr('src', e.target.result);

        img.onload = function() {
            if (img.width / img.height != 1) {

                $('#image').cropper({
                    aspectRatio: {{ $width }} / {{$hight }},
                    viewMode: 0,
                    minContainerHeight: {{$hight}},
                    minContainerwidth: {{$width}},
                });


                showCropBtn(originalFile);

            }


        }
    }

    function showCropBtn(originalFile) {

        $('#cropBtn').removeClass('d-none');
        $('#cropBtn').unbind();
        $('#cropBtn').click(function(e) {
            e.preventDefault();
            //var cropper = $('#image').data('cropper');

            var canvas = $('#image').cropper('getCroppedCanvas', {
                width: {{$width}},
                height: {{$hight}},
            });

            canvas.toBlob(function(blob) {
                var resizedFile = new File([blob], 'resized_' + originalFile.name, originalFile);



                var url = URL.createObjectURL(blob);
                var $image = $('#image');

                $image.attr('src', url);

                var dataTransfer = new DataTransfer();
                dataTransfer.items.add(resizedFile);

                // temporary remove event listener, change and restore
                $photo = document.getElementById('photo');
                var currentOnChange = $photo.onchange;

                $photo.onchange = null;
                $photo.files = dataTransfer.files;
                $photo.onchange = currentOnChange;
            });


            $('#image').cropper('destroy');


            $('#cropBtn').addClass('d-none');
            $('#cancelCropBtn').addClass('d-none');
            toastr.success("تم القص بنجاح");
        });

    }
</script>


@endpush
