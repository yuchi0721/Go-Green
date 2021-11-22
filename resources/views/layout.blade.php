<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset ('css/home.css')}}" type="text/css">
    <link rel="shortcut icon" href="https://digitalsprout.co/wp-content/uploads/2019/07/plant.png" type="image/x-icon">
    <title>Go Green</title>
</head>

<body>
    <div class="wrap">
        <div class="header">
            <img class="icon" src="https://digitalsprout.co/wp-content/uploads/2019/07/plant.png" alt="">
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
                    <li>綠色商店</li>
                    <li><a href="/hotels">綠色旅店</a></li>
                    <li id="lastLi">會員專區</li>
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