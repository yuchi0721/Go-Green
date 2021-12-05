@extends('layout')

@section('sidebar')
    @parent

    <!-- <p>這邊會附加在主要的側邊欄。</p> -->
@endsection

@section('contents')
    <div class="leftAbout">
        <span>ABOUT US</span>
        <div class="clear"></div>
        <h1 style="color:black; margin-right:25px;">About </h1><h1>Go Green</h1>
        <div class="clear"></div>
        <div class="introduction">
            <p>
            環保意識抬頭，不論店家或是消費者都對這個議題有所警覺，而也有許多的綠色旅店、商店出現在世界各地，成為另類的旅遊光觀選項。
            
            </p>
            <p>
            如同 google map 提供的服務，我們希望有一個系統讓大家可以直接瀏覽散布在各地的綠色旅店&商店，
            <br>以及可以觀看旅店&商店的評價以及撰寫自己的評論，透過這個網站希望可以讓更多的人認識到這個議題，
            <br>並且在出門旅遊時可以多一種旅店&商店的選擇，<br>從中獲得一種新穎的體驗。 
            </p>
        </div>
        <div class="clear"></div>
    </div>
    <div class="rightAbout">
        <img src="{{ asset ('icons/about_1.png')}}" alt="">
        <div class="clear"></div>
            <a href="/hotels">綠色旅店</a>
            <a href="">綠色商店</a>

        <div class="clear"></div>
    </div>
    
    
@endsection

<style>
.leftAbout{
    margin-left:10px;
    float: left;
    width:45%;   
} 
.leftAbout span{
    float:left;
    font-size:16px;
    color:#a9d08d;
    font-weight: 600;
}
.leftAbout h1{
    float:left;
    margin-top:15px;
    font-size:32px;
    color:#007500;
    font-weight: 600;
    margin-bottom:15px;
}
.leftAbout p{
    text-align:center;
    float:left;
    margin-top:15px;
    font-size:20px;
    line-height:35px;
}
.rightAbout{
    margin-left:30px;
    float:left;
    width:44%;
    padding-left:50px;
}
.rightAbout img{
    float:left;
    width:370px;
    margin-top:40px;
    margin-bottom:50px;
}
.rightAbout a{
    float:left;
    text-decoration:none;
    color:#ffffff;
    background-color: #a9d08d;
    cursor:pointer;
    padding: 10px 20px;
    border-radius:7px;
    margin-left:50px;
}
</style>