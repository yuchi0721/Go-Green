@extends('layout.layout')

@section('sidebar')
@parent

<!-- <p>這邊會附加在主要的側邊欄。</p> -->
@endsection

@section('contents')
<div class="logining">
    <h1>登入</h1>
    <form method="POST" action="{{route('auth.check')}}">
        @csrf
        <div class="results">
            @if(Session::get('fail'))
            <div class="alert alert-danger">
                {{Session::get('fail')}}
            </div>
            @endif
        </div>
        <label for="account">帳號</label><br />
        <input type="text" name="account" placeholder="請輸入帳號" value="{{old('account')}}"><br />
        <span class="text-danger">@error('account'){{$message}}@enderror</span><br />
        <label for="password">密碼</label><br />
        <input type="text" name="password" placeholder="請輸入密碼 " value="{{old('password')}}"><br />
        <span class="text-danger">@error('password'){{$message}}@enderror</span><br />
        <label for="password">驗證碼</label><br />
        <div class="g-recaptcha" data-sitekey="{{config('services.recaptcha.key')}}"></div>
        @if(Session::has('g-recaptcha-response'))
        <p class="alert{{Session::get('alert-class','alert-info')}}">
        {{Session::get('g-recaptcha-response')}}
        </p>
        @endif
        <input type="submit" id="submit" value="登入"></br>
        <a href="/signup">用戶註冊</a>
    </form>

</div>
<script src="https://www.google.com/recaptcha/api.js" async defer></script>
@endsection

<style>
    .logining {
        width: 50%;
        margin: 0px auto;
        margin-bottom: 100px;
    }

    .logining h1 {
        font-size: 24px;
        color: #007500;
        padding-left: 150px;
        margin-bottom: 20px;
    }

    .logining label {
        font-size: 18px;
    }

    .logining input {
        width: 400px;
        padding: 10px;
        font-size: 18px;
        border-radius: 8px;
        border: #a9d08d solid 2px;
        margin-top: 10px;
        margin-bottom: 25px;
    }

    #submit {
        width: 200px;
        color: #007500;
        background-color: #a9d08d;
        cursor: pointer;
        margin-left: 100px;
    }

    .logining a {
        border-radius: 8px;
        text-align: center;
        font-size: 18px;
        text-decoration: none;
        display: block;
        width: 200px;
        color: #007500;
        background-color: #a9d08d;
        cursor: pointer;
        margin-left: 100px;
        padding: 15px 0px;
    }
</style>