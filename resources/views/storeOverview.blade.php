@extends('layout')

@section('sidebar')
    @parent

    <!-- <p>這邊會附加在主要的側邊欄。</p> -->
@endsection

@section('contents')
    <div class="search"></div>
    <div class="clear"></div>
    <div class="store">
        @foreach ($stores as $store)
        <div class="storeInfo">
            <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/4/40/7-eleven_logo.svg/255px-7-eleven_logo.svg.png" alt="">
            <div>
                <label>商店名稱：{{ $store->name }}</label>
            </div>
            <div class="detail">
                <button><a href="/stores/{{ $store->id }}">商店詳細資訊</a></button>
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
.store{
    float: left;
    margin-left:50px;
}
.storeInfo{
    margin-left:50px;
    margin-top:20px;
    padding:20px;
    float: left;
    border: #a9d08d solid 2px;
}
.storeInfo img{
    width: 200px;
}
.storeInfo .detail{
    padding-top:10px;
}
.storeInfo button{
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