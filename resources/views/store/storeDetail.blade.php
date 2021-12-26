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
                <li><img src="{{ asset ('icons/hotel.png')}}" width="25" alt="">&nbsp;&nbsp;{{ $store->name }}</li>
                <li><img src="{{ asset ('icons/phone.png')}}" width="25" alt="">&nbsp;&nbsp;{{ $store->phone }}</li>
                <li><img src="{{ asset ('icons/locate.png')}}" width="25" alt="">&nbsp;&nbsp;{{ $store->address }}</li>
                <!-- <li>商店簡介：{{ $store->intro }}</li> -->
            </ul>
        </span>
        <div class="clear"></div>
    </div>
    <div class="clear"></div>
    <div class="store_comments">
        <h2 class="comment">顧客評論</h2>
        @if($user_logged_in)
        <div class="leaveComment">
            <span class="userIcon"><i class="fas fa-user"></i><br>{{$user->name}}</span>
            <form action="/create-store-comment" id="create_comment" method="POST">
                @csrf
                <div class="text-danger">@error('comment'){{$message}}@enderror</div><br />
                <input type="text" style="display: none;" name="user_id" value="{{$user->id}}">
                <input type="text" style="display: none;" name="store_id" value="{{$store->id}}">
                <textarea style="resize: none;" type="text" name="comment" placeholder="留下評論吧！" require></textarea>
                <input type="submit" id="submit">
                <div class="clear"></div>  
            </form>
            <div class="clear"></div>

            <div class="clear"></div>
        </div>

        <ul>
            @foreach($comments as $comment)
            <li class="userIcon"><span><i class="fas fa-user"></i><br></span>{{ $comment->user_id }}</li>
            <li class="commentDetail" ><textarea disabled>{{ $comment->comment }}</textarea></li>
            
            @if($isAdmin)
            <div id="check_delete_store_comment_{{$comment->id}}" class="modal">
                <div class="modal-content">
                    <span class="close" onclick="close_modal('check_delete_store_comment_{{$comment->id}}')">&times;</span>
                    
                        <div class="mb-3">
                            <label class="form-label">確定刪除嗎？</label>
                            
                        </div>
                        
                        <button id="cancel" onclick="close_modal('check_delete_store_comment_{{$comment->id}}')">取消</button>
                        <button id="delete" form="delete_store_comment_{{$comment->id}}" >刪除</button>
                        <form action="/delete-store-comment/{{$comment->id}}" method="POST" id="delete_store_comment_{{$comment->id}}" style="display: none;">
                            @csrf
                            @method('delete')
                        </form>
                        
                        <br/>
                        
                    </form>
                </div>
            </div>
            <li><button class="crud-btn" for="" onclick="open_modal('check_delete_store_comment_{{$comment->id}}')"><i class="fas fa-trash"></i></button></li>
            <!-- @if($isAdmin)
            <li><button class="crud-btn" for="" onclick="open_modal('delete_store_comment_{{$comment->id}}')"><i class="fas fa-trash"></i></button></li>
            <li><button form="delete_store_comment_{{$comment->id}}" class="crud-btn"><i class="fas fa-trash"></i></button></li>
            <form action="/delete-store-comment/{{$comment->id}}" method="POST" id="delete_store_comment_{{$comment->id}}" style="display: none;">
                @csrf
                @method('delete')
            </form>
            @endif -->
            @endif
            <div class="clear"></div>
            @endforeach

            <div class="clear"></div>
        </ul>

        
        <div class="clear"></div>
        @else
        <h2 class="warning"><img src="{{ asset ('icons/warning.png')}}" width="25" alt="">&nbsp;&nbsp;您需要登入來觀看留言</h2>
        @endif
    </div>
</div>

@endsection

<script src="https://kit.fontawesome.com/8c1847b6ed.js" crossorigin="anonymous"></script>
<script>
    function open_modal(id) {
        var modal = document.getElementById(id);
        modal.style.display = "block";

    }

    function close_modal(id) {
        var modal = document.getElementById(id);
        modal.style.display = "none";
    }
</script>
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
        width: 330px;
        margin-left:140px;
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

    .store_comments li button{
        margin-left:20px;
        margin-top:5px;
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
        padding: 4px;
        width: 80%;
        margin-left: 20px;
        margin-bottom: 15px;
        border: #a9d08d solid 2px;
    }
    .commentDetail textarea{
        border:none;
        resize:none;
        width: 100%;
        height:55px;
        font-size: 18px;
    }
    .userIcon{
        margin-top:10px;
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
    .warning{
        text-align:center;
        color:red;
        font-size:20px;
    }


    /* delete_check */
    .modal {
        display: none;
        /* Hidden by default */
        position: fixed;
        /* Stay in place */
        z-index: 1;
        /* Sit on top */
        left: 0;
        top: 0;
        width: 100%;
        /* Full width */
        height: 100%;
        /* Full height */
        overflow: auto;
        /* Enable scroll if needed */
        background-color: rgb(0, 0, 0);
        /* Fallback color */
        background-color: rgba(0, 0, 0, 0.4);
        /* Black w/ opacity */
    }

    /* Modal Content/Box */
    .modal-content {
        width: 400px;
        height: 250px;
        background-color: #fefefe;
        margin: 10% auto;
        /* 15% from the top and centered */
        padding: 20px;
        border: 1px solid #888;
        
        /* Could be more or less, depending on screen size */
        border-radius: 15px;
        
    }

    .close {
        text-align: left;
        font-size: 24px;
        cursor: pointer;
        display: block;
        width: 30px;
        margin-bottom:50px;
    }
    .form-label{
        font-size: 28px;
        margin-left: 120px;
    }
    #cancel{
        width: 100px;
        height: 37px;
        font-size:18px;
        color: #007500;
        background-color: #a9d08d;
        cursor: pointer;
        border:none;
        border-radius: 7px;
        margin-left:80px;
    }
    #delete{
        height: 37px;
        width: 100px;
        font-size:18px;
        color: white;
        background-color: #007500;
        cursor: pointer;
        border:none;
        border-radius: 7px;
        margin-left:30px;
    }
    .mb-3{
        margin-bottom:50px;
    }
</style>




