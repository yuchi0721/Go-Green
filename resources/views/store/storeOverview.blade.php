@extends('layout/layout')

@section('sidebar')
@parent

<!-- <p>這邊會附加在主要的側邊欄。</p> -->
@endsection

@section('contents')
<div class="search">
    <form action="/stores/search" method="GET" role="search">
        <input id="searchInput" type="text" name="name_query">
        <button class="crud-btn" type="submit"><i class="fas fa-search"></i></button>
    </form>
</div>
<div class="clear"></div>
<div class="store">
    @foreach ($stores as $store)
    <div class="storeInfo">
        <img src="https://upload.cc/i1/2021/12/25/cePUns.png
" alt="">
        <div>
            <label>{{ $store->name }}</label>
        </div>
        <div class="detail">
            <button><a href="/stores/{{ $store->id }}">more...</a></button>
        </div>
    </div>
    @endforeach
</div>
<div class="clear"></div>
<?php echo $stores->render(); ?>
@endsection


<style>
    .search {
        float: right;
        margin-right: 80px;
        width: 300px;
        height: 40px;

    }

    #searchInput {
        width: 250px;
        padding: 7px;
        font-size: 18px;
        border-radius: 10px;
        border: #a9d08d solid 3px;
    }

    .search button {
        position: relative;
        right: 43;
    }

    .store {
        float: left;
        margin-left: 50px;
    }

    .storeInfo {
        border-radius: 10px;
        width: 200px;
        margin-left: 50px;
        margin-top: 20px;
        padding: 20px;
        float: left;
        background-color: rgb(245, 245, 245);
        /* border: #a9d08d solid 2px; */
        box-shadow: 0 1px 2px rgba(0, 0, 0, 0.15);
        transition: box-shadow 0.3s ease-in-out;
        height: 225px;
    }

    .storeInfo img {
        margin-left:30px;
        width: 140px;
        margin-bottom: 10px;
    }

    .storeInfo .detail {
        padding-top: 10px;
    }

    .storeInfo button {
        margin-top: 5px;
        padding: 5px 7px;
        float: right;
        margin-right: 5px;
        font-size: 18px;
        background-color: #a9d08d;
        border-radius: 4px;
        color: white;
        border: none;
        box-shadow: 3px 3px 5px rgba(0, 0, 0, 0.3);
    }

    .storeInfo:hover {
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);

    }

    .storeInfo button a {
        text-decoration: none;
        color: white;
        font-size: 18px;
    }
</style>