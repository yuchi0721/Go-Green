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
            <button class="login">Log out</button>
            <p class="slogan">Hello！ Customer</p>
            <div class="clear"></div>
        </div>
        <div class="clear"></div>
        <div class="content">
            <div class="search"></div>
            <div class="clear"></div>
            <div class="list">
                <ul>
                    <li>關於我們</li>
                    <li>綠色商店</li>
                    <li>綠色旅店</li>
                    <li id="lastLi">會員專區</li>
                </ul>
            </div>

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
        </div>
        <div class="footer"></div>
    </div>
</body>
</html>