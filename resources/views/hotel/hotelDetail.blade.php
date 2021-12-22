@extends('layout.layout')

@section('sidebar')
@parent

<!-- <p>這邊會附加在主要的側邊欄。</p> -->
@endsection

@section('contents')
<div class="hotel">
    <div class="hotel_info">
        <span class="hotelImg">
            <img src="https://media-cdn.tripadvisor.com/media/photo-s/16/1a/ea/54/hotel-presidente-4s.jpg" alt="">
        </span>
        <span class="introduction">
            <ul>
                <li><img src="{{ asset ('icons/hotel.png')}}" width="25" alt="">&nbsp;&nbsp;{{ $hotel->name }}</li>
                <li><img src="{{ asset ('icons/phone.png')}}" width="25" alt="">&nbsp;&nbsp;{{ $hotel->phone }}</li>
                <li><img src="{{ asset ('icons/locate.png')}}" width="25" alt="">&nbsp;&nbsp;{{ $hotel->address }}</li>
                <li id="info">{{ $hotel->intro }}</li>
            </ul>
        </span>
        <div class="clear"></div>
    </div>
    <div class="clear"></div>
    <div class="hotel_comments">
        <h2 class="comment">住客評論</h2>
        @if($user_logged_in)
        <div class="leaveComment">
            <span><i class="fas fa-user"></i><br>{{$user->name}}</span>
            <form action="/create-hotel-comment" id="create_hotel_comment" method="POST">
                @csrf
                <div class="text-danger">@error('comment'){{$message}}@enderror</div><br />
                <input type="text" style="display: none;" name="user_id" value="{{$user->id}}">
                <input type="text" style="display: none;" name="hotel_id" value="{{$hotel->id}}">
                <textarea style="resize: none;" type="text" name="comment" placeholder="留下評論吧！" require></textarea>
                <input type="submit" id="submit">
            </form>
            <div class="clear"></div>  
            <div class="clear"></div>
        </div>
        <ul>
            @foreach($comments as $comment)
            <li> <span><i class="fas fa-user"></i><br></span>{{ $comment->user_id }}</li>
            <li class="commentDetail" id="commentDetail">{{ $comment->comment }}</li>
            @if($isAdmin)
            <li><button form="delete_hotel_comment_{{$comment->id}}" class="crud-btn"><i class="fas fa-trash"></i></button></li>
            <form action="/delete-hotel-comment/{{$comment->id}}" method="POST" id="delete_hotel_comment_{{$comment->id}}" style="display: none;">
                @csrf
                @method('delete')
            </form>
            @endif
            <div class="clear"></div>
            @endforeach

            <div class="clear"></div>
        </ul>
        <div class="clear"></div>
        @else
        <h2>您需要登入來觀看留言</h2>
        @endif
    </div>
</div>

@endsection

<style>
    .hotel {
        width: 90%
    }

    .hotelImg {
        float: left;
    }

    .introduction {
        margin-left: 30px;
        float: left;
    }

    .hotelImg img {
        width: 500px;
    }

    .introduction li {
        width: 400px;
        font-size: 20px;
        margin: 15px;

    }

    .hotel_comments {
        padding-bottom: 40px;
        border-radius: 7px;
        margin-top: 40px;
        border: #a9d08d solid 2px;
        margin-bottom: 100px;
    }

    .hotel_comments ul {
        margin-left: 30px;
    }

    .hotel_comments li {

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

    #info {
        width: 400px;
        margin-top: 30px;
    }
</style>