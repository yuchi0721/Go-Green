<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset ('css/home.css')}}" type="text/css">
    <link rel="shortcut icon" href="{{ asset ('icons/logo.png')}}" type="image/x-icon">
    <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css"> -->
    <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css"> -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script> -->
    <title>Go Green</title>
</head>

<body>
    <div class="wrap">
        <div class="header">
            <img class="icon" src="{{ asset ('icons/logo.png')}}" alt="">
            <h1 class="title">Go Green</h1>
            <button class="login"><a href="/login">Log out</a></button>
            <p class="slogan">Hello！ Customer</p>
            <div class="clear"></div>
        </div>
        <div class="clear"></div>
        <div class="content">
        @section('sidebar')
            <div class="list">
                <ul>
                    <li>關於我們</li>
                    <li class="greenShop">綠色商店 <img id="greenShopArrow" src="{{ asset ('icons/arrow.png')}}" alt=""></li>
                    <div class="reviewShop subList">
                        <li><a>商店總覽</a></li>
                        <li><a>區域瀏覽</a></li>
                        <li><a>編輯商店</a></li>
                    </div>
                    <li class="greenHotel">綠色旅店 <img id="greenHotelArrow" src="{{ asset ('icons/arrow.png')}}" alt=""></a></li>
                    <div class="reviewHotel subList">
                        <li><a href="/hotels">旅店總覽</a></li>
                        <li><a>區域瀏覽</a></li>
                        <li><a>編輯旅店</a></li>
                    </div>
                    <li id="lastLi" class="memberOnly ">會員專區 <img id="memberOnlyArrow" src="{{ asset ('icons/arrow.png')}}" alt=""></li>
                    <div class="member sublist">
                        <li id="memberInfoModify"><a>會員資料修改</a></li>
                        <li><a>會員管理</a></li>
                    </div>
                </ul>
                <div class="clear"></div>
            </div>
            
        @show
        <div class="mainContent">
            @yield('contents')
            <div class="clear"></div>
        </div>
            <div class="footer"></div>
            <div class="clear"></div>
        </div>
</body>

</html>
<script>
    $(document).ready(function(){
        $(".memberOnly").click(function(){
            $(".sublist").not(".member").slideUp(400);
            $(".member").slideToggle();
            });
    });

    $(document).ready(function(){
    $(".greenShop").click(function(){
        $(".sublist").not(".reviewShop").slideUp(400);
        $(".reviewShop").slideToggle();
        

        });
    });

    $(document).ready(function(){
    $(".greenHotel").click(function(){
        $(".sublist").not(".reviewHotel").slideUp(400);
        $(".reviewHotel").slideToggle();
     
        });
    });


    // if($(".reviewShop").css('display') == 'none'){
    //     print(1);
    //     $("#greenShopArrow").css({
    //             "transform": "rotate(0deg)",
    //             "-ms-transform": "rotate(0deg)",
    //             "-moz-transform": "rotate(0deg)",
    //             "-webkit-transform": "rotate(0deg)",
    //             "-o-transform": "rotate(0deg)"
    //     }); 
    // }else{
    //     $("#greenShopArrow").css({
    //             "transform": "rotate(180deg)",
    //             "-ms-transform": "rotate(180deg)",
    //             "-moz-transform": "rotate(180deg)",
    //             "-webkit-transform": "rotate(180deg)",
    //             "-o-transform": "rotate(180deg)"
    //     }); 
    // }

  
</script>