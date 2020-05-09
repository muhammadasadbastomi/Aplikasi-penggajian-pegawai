@section('title') Login @endsection
@extends('layouts.login_register')

@section('content')

<div class="limiter">
    <div class="container-login100" style="background-image: url('img/bjb.png');">
        <div class="wrap-login100">
            <form class="login100-form validate-form" method="POST" action="{{ route('login') }}">
                @csrf

                <span class="login100-form-logo">
                    <img src="{{ ('img/bjb.png ') }}" style="width: 60px; heigth:65px;">
                </span>

                <span class="login100-form-title p-b-34 p-t-27">
                    Log in
                </span>

                <div class="wrap-input100 validate-input" data-validate="Enter email">
                    <input id="email" class="input100 @error('email') is-invalid @enderror" type="email" name="email"
                        placeholder="Email">
                    <span class="focus-input100" data-placeholder="@"></span>
                </div>

                <div class="wrap-input100 validate-input" data-validate="Enter password">
                    <input id="password" class="input100  @error('password') is-invalid @enderror" type="password"
                        name="password" placeholder="Password" required autocomplete="current-password">
                    <span class="focus-input100" data-placeholder="&#xf191;"></span>
                </div>


                <div class="container-login100-form-btn">
                    <button class="login100-form-btn">
                        {{ __('Login') }}
                    </button>
                </div>
                <br>
                <!--menampilkan error validasi-->
                @if (count($errors) > 0)
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif

            </form>
        </div>
    </div>
</div>
@endsection
