@section('title') Register @endsection
@extends('layouts.login_register')

@section('content')

<div class="limiter">
    <div class="container-login100" style="background-image: url('img/bjb.png');">
        <div class="wrap-login100">
            <form class="login100-form validate-form" method="POST" action="{{ route('register') }}">
                @csrf

                <span class="login100-form-logo">
                    <img src="{{ ('img/bjb.png ') }}" style="width: 60px; height:65px;">
                </span>

                <span class="login100-form-title p-b-34 p-t-27">
                    Register
                </span>

                <div class="wrap-input100 validate-input" data-validate="Enter name">
                    <input id="name" class="input100 @error('name') is-invalid @enderror" type="name" name="name" placeholder="Nama">
                    <span class="focus-input100" data-placeholder="&#xf207;"></span>
                </div>

                <div class="wrap-input100 validate-input" data-validate="Enter email">
                    <input id="email" class="input100 @error('email') is-invalid @enderror" type="email" name="email" placeholder="Email">
                    <span class="focus-input100" data-placeholder="@"></span>
                </div>

                <div class="wrap-input100 validate-input" data-validate="Enter password">
                    <input id="password" class="input100  @error('password') is-invalid @enderror" type="password" name="password" placeholder="Password" required autocomplete="new-password">
                    <span class="focus-input100" data-placeholder="&#xf191;"></span>
                </div>

                <div class="wrap-input100 validate-input" data-validate="Enter Confirm password">
                    <input id="password-confirm" class="input100  @error('password-confirm') is-invalid @enderror" type="password" name="password_confirmation" placeholder="Confirm Password" required autocomplete="new-password">
                    <span class="focus-input100" data-placeholder="&#xf191;"></span>
                </div>

                <div class="container-login100-form-btn">
                    <button class="login100-form-btn">
                        Register
                    </button>
                </div>
            </form>
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
            <!--End menampilkan error validasi-->
            <div class="text-center p-t-90">
                @if (Route::has('login'))
                <a class="txt1" href="{{ route('login') }}">Already have an account? Log in!</a>
                @endif
            </div>

        </div>
    </div>
</div>
@endsection