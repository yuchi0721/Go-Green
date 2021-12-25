@extends('layout/layout')

@section('sidebar')
@parent

<!-- <p>這邊會附加在主要的側邊欄。</p> -->
@endsection
<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css"/>
<script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script> -->


@section('contents')
<div class="region">
  <div class="swiper mySwiper">
    <div class="swiper-wrapper">
    <div class="swiper-slide" onclick="reDirect('澎湖')">
        <img src="https://zh-tw.skyticket.com/guide/wp-content/uploads/2020/12/shutterstock_1086233933.jpg" alt="">
        <div class="regionInfo">澎湖</div>
        <div class="clear"></div>
      </div>
      <div class="swiper-slide" onclick="reDirect('台北')">
        <img src="https://a.cdn-hotels.com/gdcs/production57/d1344/58e63eaa-73ec-48f3-828a-c287ee898ac3.jpg" alt="">
        <div class="regionInfo">台北</div>
        <div class="clear"></div>
      </div>
      <div class="swiper-slide" onclick="reDirect('花蓮')">
        <img src="https://www.hotelscombined.com.tw/news/wp-content/uploads/sites/316/2019/02/f2.jpg" alt="">
        <div class="regionInfo">花蓮</div>
        <div class="clear"></div>
      </div>
      <div class="swiper-slide" onclick="reDirect('台中')">
        <img src="https://s.yimg.com/ny/api/res/1.2/zME_O0J7RjbxuPcOFweMZw--/YXBwaWQ9aGlnaGxhbmRlcjt3PTY0MDtoPTQyNw--/https://s.yimg.com/uu/api/res/1.2/tmQ_VfTvfCkrJGwoZCIpOA--~B/aD04MDA7dz0xMjAwO2FwcGlkPXl0YWNoeW9u/https://media.zenfs.com/ko/nownews.com/be50a3c9d8b903ea7734ccdc64f83f90" alt="">
        <div class="regionInfo">台中</div>
        <div class="clear"></div>
      </div>
      <div class="swiper-slide" onclick="reDirect('台南')">
        <img src="https://cc.tvbs.com.tw/img/program/upload/2021/11/08/20211108152948-98b983f6.jpg" alt="">
        <div class="regionInfo">台南</div>
        <div class="clear"></div>
      </div>
      <div class="swiper-slide" onclick="reDirect('高雄')">
        <img src="https://tenjo.tw/wp-content/uploads/20210220184733_68.jpg" alt="">
        <div class="regionInfo">高雄</div>
        <div class="clear"></div>
      </div>
    </div>
    <div id="swiper-button-next" class="swiper-button-next"><img src="{{ asset ('icons/rightArrow.png')}}" alt=""></div>
    <div id="swiper-button-prev" class="swiper-button-prev"><img src="{{ asset ('icons/leftArrow.png')}}" alt=""></div>
    <div class="swiper-pagination"></div>
  </div>
</div>

<script>
  function reDirect(area){
    let link_address = `/store-areaview/${area}`
    location.replace(link_address)
  }
  var swiper = new Swiper(".mySwiper", {
    slidesPerView: 3,
    spaceBetween: 30,
    slidesPerGroup: 3,
    loop: true,
    loopFillGroupWithBlank: true,
    pagination: {
      el: ".swiper-pagination",
      clickable: true,
    },
    navigation: {
      nextEl: ".swiper-button-next",
      prevEl: ".swiper-button-prev",
    },
  });
</script>
@endsection

<style>
  html,
  body {
    position: relative;
    height: 100%;
  }

  body {

    font-family: Helvetica Neue, Helvetica, Arial, sans-serif;
    font-size: 14px;
    color: #000;
    margin: 0;
    padding: 0;
  }

  .swiper {
    width: 100%;
    height: 90%;
  }

  .swiper-slide {
    text-align: center;
    font-size: 18px;
    background: #fff;

    /* Center slide text vertically */
    display: -webkit-box;
    display: -ms-flexbox;
    /* display: -webkit-flex; */
    /* display: flex; */
    -webkit-box-pack: center;
    -ms-flex-pack: center;
    -webkit-justify-content: center;
    justify-content: center;
    -webkit-box-align: center;
    -ms-flex-align: center;
    -webkit-align-items: center;
    align-items: center;
    cursor: pointer;
  }

  .swiper-slide img {
    display: block;
    width: 100%;
    height: 100%;
    object-fit: cover;
  }
</style>
<style>
  .region {
    padding-top: 40px;
    width: 90%;
    height: 300px;
    margin: auto;
  }

  .swiper-slide {
    margin-left: 4px;
    border: #a9d08d solid 3px;
    border-radius: 20px;
  }

  .swiper-slide img {
    border-radius: 18px;
    float: left;

    left: 9;
  }

  #swiper-button-prev {
    left: -15;
    opacity: 0.6;
  }

  .swiper-button-prev img {
    position: relative;
    left: 40;

  }

  #swiper-button-next {
    right: 42;
    opacity: 0.6;
  }

  .swiper-button-next img {
    position: relative;
    left: 40;
  }

  .swiper-slide span {
    position: relative;
    width: 300px;
    background-color: #a9d08d;
    color: #ffffff;
    left: -200;
  }

  .regionInfo {
    bottom: -101;
    padding: 20px;
    left: -304;
    position: relative;
    width: 260px;
    background-color: #a9d08d;
    color: #ffffff;
    border: #a9d08d solid 2px;
    border-radius: 10px;
    cursor: pointer;
  }
</style>

<!-- <script>
      var swiper = new Swiper(".mySwiper", {
        slidesPerView: 3,
        spaceBetween: 30,
        slidesPerGroup: 3,
        loop: true,
        loopFillGroupWithBlank: true,
        pagination: {
          el: ".swiper-pagination",
          clickable: true,
        },
        navigation: {
          nextEl: ".swiper-button-next",
          prevEl: ".swiper-button-prev",
        },
      });
</script> -->