
                    <form action="{{ route('users.wallet.store' , $user) }}" enctype="multipart/form-data" method="post" class="">

                        @csrf
                        @method('post')

                        <div class="card">
                            <div class="card-body card-block">

                                <div class="form-group">
                                    <label for="amount" class=" form-control-label">@lang('labels.amount')</label>
                                    <input type="number" value="{{ old('amount') }}" id="amount" name="amount"
                                        class=" form-control" placeholder="@lang('placeholders.amount')">
                                </div>

                                <div class="form-group">
                                    <label for="info" class=" form-control-label">@lang('labels.info')</label>

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

