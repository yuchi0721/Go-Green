@extends('layout')

@section('sidebar')
    @parent

    <!-- <p>這邊會附加在主要的側邊欄。</p> -->
@endsection

@section('contents')
    <div class="search"></div>
    <div class="clear"></div>
    <div class="hotel">
        @foreach ($hotels as $hotel)
        <div class="hotelInfo">
            <img src="https://media-cdn.tripadvisor.com/media/photo-s/16/1a/ea/54/hotel-presidente-4s.jpg" alt="">
            <div>
                <label>旅店名稱：{{ $hotel->name }}</label>
            </div>
            <div class="detail">
                <button><a href="/hotels/{{ $hotel->id }}">旅店詳細資訊</a></button>
            </div>
        </div>
        @endforeach
    </div>
    <div class="clear"></div>
    
@endsection


<style>
.search{
    float: right;
    margin-right:80px;
    width: 400px;
    height: 40px;
    border:#a9d08d solid 3px;
    border-radius:10px;
}
.hotel{
    float: left;
    margin-left:50px;
}
.hotelInfo{
    margin-left:50px;
    margin-top:20px;
    padding:20px;
    float: left;
    border: #a9d08d solid 2px;
}
.hotelInfo img{
    width: 200px;
}
.hotelInfo .detail{
    padding-top:10px;
}
.hotelInfo button{
    padding:5px 7px;
    float: right;
    margin-right: 5px;
    font-size: 18px;
    background-color: #a9d08d;
    border-radius:4px;
    color:white;
    border:#007500 solid 2px;
}
</style>