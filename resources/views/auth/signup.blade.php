@extends('layout/layout')

@section('sidebar')
    @parent

    <!-- <p>這邊會附加在主要的側邊欄。</p> -->
@endsection

@section('contents')
    <div class="signup">
        <h1>用戶註冊</h1>
        <form method="POST" action="{{route('auth.create')}}">
            @csrf
            <div class ="results">
                @if(Session::get('success'))
                <div class="alert alert-success">
                    {{Session::get('success')}}
                </div>
                @endif
                @if(Session::get('fail'))
                <div class="alert alert-danger">
                    {{Session::get('fail')}}
                </div>
                @endif
            </div>
            <label for="name">姓名</label><br/>
            <input type="text" name="name" placeholder="暱稱（之後可以修改）" value="{{old('name')}}"><br/>
            <span class="text-danger">@error('name'){{$message}}@enderror</span><br/>
            <label for="account" >帳號</label><br/>
            <input type="text" name="account" placeholder="請輸入帳號" value="{{old('account')}}"><br/>
            <span class="text-danger">@error('account'){{$message}}@enderror</span><br/>
            <label for="email">Email</label><br/>
            <input type="text" name="email" placeholder="請輸入電子郵件" value="{{old('email')}}"><br/>
            <span class="text-danger">@error('email'){{$message}}@enderror</span><br/>
            <label for="password">密碼</label><br/>
            <input type="password" name="password" placeholder="設定密碼" ><br/>
            <span class="text-danger">@error('password'){{$message}}@enderror</span><br/>
            <label for="password">密碼確認</label><br/>
            <input type="password" name="passwordcheck" placeholder="請再輸入一次密碼"><br/>
            <span class="text-danger">@error('passwordcheck'){{$message}}@enderror</span><br/>
            <input type="submit" id="submit">
        </form>
     
    </div>
    
@endsection
<!-- <head>
    <link rel="stylesheet" href="{{ asset('css/test.css') }}">
</head> -->


<style>
    .signup{
        width: 50%;
        margin: 0px auto;
    }
    .signup h1{
        font-size:24px;
        color: #007500 ;
        padding-left:150px;
        margin-bottom:20px;
    }
    .signup label{
        font-size:18px;
    }
    .signup input{
        width: 400px;
        padding: 10px;
        font-size: 18px;
        border-radius: 8px;
        border: #a9d08d solid 2px;
        margin-top:10px;
        margin-bottom:25px;
    }
    #submit{
        width:200px;
        color:#007500;
        background-color:#a9d08d;
        cursor: pointer;
        margin-left:100px;
    }
    .text-danger{
        color: red;
    }
</style>


