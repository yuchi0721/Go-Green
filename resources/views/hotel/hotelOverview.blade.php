@extends('layout.layout')

@section('sidebar')
@parent

<!-- <p>這邊會附加在主要的側邊欄。</p> -->
@endsection

@section('contents')
<div class="search">
    <form action="/hotels/search" method="POST">@csrf<input type="text" name="name_query"><button class="crud-btn"><i class="fas fa-search"></i></button></form>

</div>
<div class="clear"></div>
<div class="hotel">
    @foreach ($hotels as $hotel)
    <div class="hotelInfo">
        <img src="https://media-cdn.tripadvisor.com/media/photo-s/16/1a/ea/54/hotel-presidente-4s.jpg" alt="">
        <div class="clear"></div>
        <div>
            <label>{{ $hotel->name }}</label>
        </div>
        <div class="detail">
            <button><a href="/hotels/{{ $hotel->id }}">more...</a></button>
        </div>
    </div>
    @endforeach
</div>
<div class="clear"></div>

@endsection


<style>
    .search {
        float: right;
        margin-right: 80px;
        width: 400px;
        height: 40px;
        border: #a9d08d solid 3px;
        border-radius: 10px;
    }

    .hotel {
        float: left;
        margin-left: 50px;
    }

    .hotelInfo {
        border-radius: 10px;
        width: 220px;
        margin-left: 50px;
        margin-top: 20px;
        padding: 20px;
        float: left;
        background-color: rgb(245, 245, 245);
        /* border: #a9d08d solid 2px; */
        box-shadow: 0 1px 2px rgba(0, 0, 0, 0.15);
        transition: box-shadow 0.3s ease-in-out;
    }

    .hotelInfo:hover {
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);

    }

    .hotelInfo img {
        width: 200px;
        margin-bottom: 15px;
    }

    .hotelInfo button {
        margin-top: 5px;
        padding: 5px 7px;
        float: right;
        margin-right: 10px;
        font-size: 18px;
        background-color: #a9d08d;
        border-radius: 4px;
        color: white;
        border: none;
        box-shadow: 3px 3px 5px rgba(0, 0, 0, 0.3);
    }

    .hotelInfo button a {
        text-decoration: none;
        color: white;
        font-size: 18px;
    }
</style>