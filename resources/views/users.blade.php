@extends('layout')

@section('sidebar')
@parent

<!-- <p>這邊會附加在主要的側邊欄。</p> -->
@endsection

@section('contents')
<table>
    <thead>
        <tr>
            <td>使用者名稱</td>
            <td>帳號</td>
            <td>信箱</td>
            <td>修改</td>
        </tr>
    </thead>

    <tbody>
        @foreach ($users as $user)
        <tr>
            <td>{{ $user->name }}</td>
            <td>{{ $user->account }}</td>
            <td>{{$user->email}}</td>
            <td><a>修改</a></td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection