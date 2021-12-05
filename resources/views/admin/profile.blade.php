@extends('layout')

@section('sidebar')
    @parent

    <!-- <p>這邊會附加在主要的側邊欄。</p> -->
@endsection

@section('contents')
    <div class="signup">
        <h1>用戶個人資料</h1>
        <form method="POST" action="/">
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
            <input type="text" name="name" placeholder="暱稱（之後可以修改）" value="{{$user->name}}"><br/>
            <!-- <span class="text-danger">@error('name'){{$message}}@enderror</span><br/> -->
            <label for="account" >帳號</label><br/>
            <input type="text" name="account" placeholder="帳號" value="{{$user->account}}"><br/>
            <!-- <span class="text-danger">@error('account'){{$message}}@enderror</span><br/> -->
            <label for="email">Email</label><br/>
            <input type="text" name="email" placeholder="電子郵件" value="{{$user->email}}"><br/>
            <!-- <span class="text-danger">@error('email'){{$message}}@enderror</span><br/> -->
            <label for="password">重設密碼</label><br/>
            <input type="submit" id="submit" value="儲存">
        </form>
        <label for=""><a href="logout">登出</a></label>
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


