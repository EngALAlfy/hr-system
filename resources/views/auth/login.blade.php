@extends("layouts.auth")

@section('title')
@lang('titles.login')
@endsection

@section('content')
<div class="login-wrap">
    <div class="login-content">
        <div class="login-logo">
            <a href="#">
                <img width="100" src="{{asset('assets/common/img/human-resources.png')}}" alt="">
            </a>
        </div>
        <div class="login-form">

            <form action="{{route('login')}}" method="POST">

                @csrf
                @method('POST')

                @include('includes.status')

                <div class="form-group">
                    <label>@lang('labels.email')</label>
                    <input class="au-input au-input--full"  value="{{ old('email') }}" type="email" name="email"
                        placeholder="@lang('placeholders.email')">
                </div>
                <div class="form-group">
                    <label>@lang('labels.password')</label>
                    <input class="au-input au-input--full" value="{{old('password')}}" type="password" name="password"
                        placeholder="@lang('placeholders.password')">
                </div>
                <div class="login-checkbox">
                    <label>
                        <input type="checkbox" {{ old('remember') ? 'checked' : ''}} name="remember">@lang('labels.remember')
                    </label>
                    <label>
                        <a href="#">@lang('labels.forget_password')</a>
                    </label>
                </div>
                <button class="au-btn au-btn--block au-btn--green m-b-20" type="submit">@lang('buttons.sign_in')</button>
            </form>
        </div>
    </div>
</div>
@endsection
