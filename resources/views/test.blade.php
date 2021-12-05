@extends('layout')

@section('sidebar')
    @parent

    <p>這邊會附加在主要的側邊欄。</p>
@endsection

@section('contents')
    <p>這是我的主要內容。</p>
@endsection