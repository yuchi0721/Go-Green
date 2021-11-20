<h1>Users</h1>
<a href="/">註冊用戶</a>
<p>目前註冊的使用者有：</p>
@foreach ($users as $user)
<h2>姓名：{{ $user->name }}</h2>
<h3>信箱：{{ $user->email }}</h3>
@endforeach