@extends('layout.layout')

@section('sidebar')
@parent

<!-- <p>這邊會附加在主要的側邊欄。</p> -->
@endsection

@section('contents')
<div class="store">
    <div class="store_info">
        <span class="storeImg">
            <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/4/40/7-eleven_logo.svg/255px-7-eleven_logo.svg.png" alt="">
        </span>
        <span class="introduction">
            <ul>
                <li>商店名稱：{{ $store->name }}</li>
                <li>商店電話 : {{ $store->phone }}</li>
                <li>商店地址：{{ $store->address }}</li>
                <li>商店簡介：{{ $store->intro }}</li>
            </ul>
        </span>
        <div class="clear"></div>
    </div>
    <div class="clear"></div>
    <div class="store_comments">
        <h2 class="comment">顧客評論</h2>
        @if($user_logged_in)
        <div class="leaveComment">
            <span><i class="fas fa-user"></i><br>{{$user->name}}</span>
            <form action="/create-store-comment" id="create_comment" method="POST">
            @csrf
                <input type="text" style="display: none;" name="user_id" value="{{$user->id}}">
                <input type="text" style="display: none;" name="store_id" value="{{$store->id}}">
                <textarea style="resize: none;" type="text" name="comment" placeholder="留下評論吧！" require></textarea>
                <input type="submit" id="submit">
            </form>
            <div class="clear"></div>
            
            <div class="clear"></div>
        </div>
        <ul>
            @foreach($comments as $comment)
            <li><span><i class="fas fa-user"></i><br></span>{{ $comment->user_id }}</li>
            <li class="commentDetail" id="commentDetail">{{ $comment->comment }}</li>
            <div class="clear"></div>
            @endforeach

            <div class="clear"></div>
        </ul>
        <div class="clear"></div>
        @else
        <h2>您必須登入來觀看留言</h2>
        @endif
    </div>
</div>

@endsection

<style>
    .store {
        width: 90%
    }

    .storeImg {
        float: left;
    }

    .introduction {
        margin-left: 30px;
        float: left;
    }

    .storeImg img {
        width: 500px;
    }

    .introduction li {
        font-size: 20px;
        margin: 15px;

    }

    .store_comments {
        padding-bottom: 40px;
        border-radius: 7px;
        margin-top: 40px;
        border: #a9d08d solid 2px;
        margin-bottom: 100px;
    }

    .store_comments ul {
        margin-left: 30px;
    }

    .store_comments li {
        float: left;
        text-align: center;
        font-size: 18px;
    }

    #commentDetail {
        text-align: left;
    }

    .comment {
        text-align: center;
        font-size: 24px;
        height: 55px;
        background-color: #a9d08d;
        color: white;
        border-radius: 5px;
        line-height: 50px;
        margin-bottom: 20px;
    }

    .commentDetail {
        border-radius: 5px;
        text-align: left;
        padding: 15px;
        width: 80%;
        margin-left: 20px;
        margin-bottom: 15px;
        border: #a9d08d solid 2px;
    }

    .leaveComment {
        text-align: center;
        margin-bottom: 20px;
        margin-right: 20px;
    }

    .leaveComment span {
        float: right;
    }

    .leaveComment textarea {
        border-radius: 5px;
        text-align: left;
        padding: 15px;
        width: 80%;
        float: right;
        margin-right: 20px;
        margin-bottom: 15px;
        border: #a9d08d solid 2px;
        height: 100px;
    }

    #submit {
        width: 150px;
        color: #007500;
        background-color: #a9d08d;
        cursor: pointer;
        float: right;
        margin-right: 100px;
        border: #a9d08d solid 2px;
        border-radius: 7px;
    }
</style>