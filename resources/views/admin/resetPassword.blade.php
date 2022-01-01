@extends('layout.layout')

@section('sidebar')
@parent

<!-- <p>這邊會附加在主要的側邊欄。</p> -->
@endsection

@section('contents')
<div class="reset">
    <h1>重設密碼</h1>
    <form method="POST" action="/reset-password/{{$user->id}}">
        @csrf
        <div class="results">
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
        <label for="password">重設密碼</label><br />
        <input type="password" name="password" placeholder="設定密碼"><br />
        <span class="text-danger">@error('password'){{$message}}@enderror</span><br />
        <label for="password">密碼確認</label><br />
        <input type="password" name="passwordcheck" placeholder="請再輸入一次密碼"><br />
        <span class="text-danger">@error('passwordcheck'){{$message}}@enderror</span><br />
        <input type="submit" id="submit" value="儲存">
    </form>
</div>

@endsection

<style>
    .reset {
        width: 50%;
        margin: 0px auto;
    }

    .reset h1 {
        font-size: 24px;
        color: #007500;
        padding-left: 150px;
        margin-bottom: 20px;
    }

    .reset label {
        font-size: 18px;
        display: block;
        padding-top: 12px;
    }

    .reset input {
        width: 400px;
        padding: 10px;
        font-size: 18px;
        border-radius: 8px;
        border: #a9d08d solid 2px;
        margin-top: 10px;
        margin-bottom: 5px;
    }

    #submit {
        margin-top:15px;
        width: 200px;
        color: #007500;
        background-color: #a9d08d;
        cursor: pointer;
        margin-left: 100px;
    }

    .text-danger {
        color: red;
    }
</style>