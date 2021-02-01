@extends('layouts.main')
@section('title','ورود')

@section('head')
    @parent
    <link rel="stylesheet" href="{{ asset('css/auth.css') }}">
@endsection


@section('content')
    <div class="wrapper">
        {{-- Form --}}
        <form action="{{ url('login')}} " method="POST" class="login">
            @csrf
            <!-- Title -->
            <p class="title">ورود</p>
            <!-- Form -->
            <div class="form-group">
                <input class="text-right" type="email" name="email" placeholder="آدرس ایمیل">
                <i class="fa fa-user"></i>
            </div>
            <div class="fomr-group">
                <input class="text-right" type="password" name="password" placeholder="رمز عبور" />
                <i class="fa fa-key"></i>
            </div>
            <!-- remember token  -->
            <label class="form-remember">
                <input type="checkbox" name="remember_me"/>
                <span>
                    مرا به خاطر بسپارید     
                </span>
            </label>

            <button>
                <span class="state">ورود</span>
            </button>
        </form>
        <br>
        @if($message = Session::get('faliure'))
            <div class="alert alert-danger">
                <footer><a target="blank">{{ $message }}</a></footer>
            </div>
        @elseif($errors->has('email'))
            <div class="alert alert-danger">
                <span class="error">{{ $errors->first('email') }}</span>
            </div>
        @elseif($errors->has('password'))
            <div class="alert alert-danger">
                <span class="error">{{ $errors->first('password') }}</span>
            </div>
        @endif 
    </div>

@endsection