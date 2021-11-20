<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset ('css/home.css')}}" type="text/css">
    <link rel="shortcut icon" href="https://digitalsprout.co/wp-content/uploads/2019/07/plant.png" type="image/x-icon">
    <title>Go Green</title>
    <style>
        .hotel_comments {
            margin: 5%;
            border-color: greenyellow;
            border-style: solid;
        }
    </style>




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
                <div class="hotel_info">
                    <span>
                        <img src="https://media-cdn.tripadvisor.com/media/photo-s/16/1a/ea/54/hotel-presidente-4s.jpg" alt="">
                    </span>
                    <span>
                        <ul>
                            <li>旅店名稱：{{ $hotel->name }}</li>
                            <li>旅店簡介：{{ $hotel->intro }}</li>
                            <li>旅店電話 : {{ $hotel->phone }}</li>
                            <li>旅店地址：{{ $hotel->address }}</li>
                        </ul>
                    </span>
                </div>
                <div class="hotel_comments">
                    <ul>
                        @foreach($comments as $comment)
                        <li>會員：{{ $comment->user_id }}</li>
                        <li>評論：{{ $comment->comment }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <div class="footer"></div>
        </div>
</body>

</html>