@extends('layout')

@section('sidebar')
    @parent

    <!-- <p>這邊會附加在主要的側邊欄。</p> -->
@endsection

@section('contents')
<h1>Users</h1>
<a href="/">註冊用戶</a>
<p>目前註冊的使用者有：</p>
@foreach ($users as $user)
<h2>姓名：{{ $user->name }}</h2>
<h3>信箱：{{ $user->email }}</h3>
@endforeach
@endsection