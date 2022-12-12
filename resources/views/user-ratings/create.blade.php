<form action="{{ route('users.ratings.store', $user) }}" enctype="multipart/form-data" method="post">

    @csrf
    @method('post')

    <style>
        .rating {
            display: inline-block;
            position: relative;
            height: 32px;
            line-height: 32px;
        }

        .rating label{
            position: absolute;
            top: 0;
            left: 0;
            height: 100%;
            cursor: pointer;
        }

        .rating label:last-child{
            position: static;
        }


        .rating label:nth-child(1){
            z-index: 5;
        }.rating label:nth-child(2){
            z-index: 4;
        }.rating label:nth-child(3){
            z-index: 3;
        }.rating label:nth-child(4){
            z-index: 2;
        }.rating label:nth-child(5){
            z-index: 1;
        }

        .rating label input{
            position: absolute;
            top: 0;
            left: 0;
            opacity: 0;
        }

        .rating label span{
            float: left;
            color: transparent;
        }

        .rating label:last-child span{
            color: #6c757d ;
        }

        .rating:not(:hover) label input:checked ~ span ,
        .rating:hover label:hover input ~ span{
            color: #ffc107 ;
        }

        .rating label input:focus:not(:checked) ~ span:last-child {
            color: #6c757d ;
            text-shadow: 0 0 5px #ffc107 ;
        }


    </style>

    <div class="card">
        <div class="card-body card-block text-center">

            <div class="form-group rating ">

                <label>
                    <input type="radio" name="rate" value="1">
                    <span class="fa fa-2x fa-star"></span>
                </label>
                <label>
                    <input type="radio" name="rate" value="2">
                    <span class="fa fa-2x fa-star"></span>
                    <span class="fa fa-2x fa-star"></span>
                </label>
                <label>
                    <input type="radio" name="rate" value="3">
                    <span class="fa fa-2x fa-star"></span>
                    <span class="fa fa-2x fa-star"></span>
                    <span class="fa fa-2x fa-star"></span>
                </label>
                <label>
                    <input type="radio" name="rate" value="4">
                    <span class="fa  fa-2x fa-star"></span>
                    <span class="fa fa-2x fa-star"></span>
                    <span class="fa fa-2x fa-star"></span>
                    <span class="fa fa-2x fa-star"></span>
                </label>
                <label>
                    <input type="radio" name="rate" value="5">
                    <span class="fa fa-2x fa-star"></span>
                    <span class="fa fa-2x fa-star"></span>
                    <span class="fa fa-2x fa-star"></span>
                    <span class="fa fa-2x fa-star"></span>
                    <span class="fa fa-2x fa-star"></span>
                </label>

            </div>

            <div >
                <span id="rateResult">0</span> @lang('labels.from') 5
            </div>

            <hr>

                <div class="form-group">
                    <textarea name="info"  id="info" rows="3" placeholder="@lang('placeholders.info')" class="form-control"></textarea>
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

@push('scripts')
<script>

$(':radio').change(function () {
    $('#rateResult').html(this.value);
});

</script>
@endpush
