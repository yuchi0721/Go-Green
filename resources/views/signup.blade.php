
<head>
    <link rel="stylesheet" href="{{ asset('css/test.css') }}">
</head>
<h1>用戶註冊</h1>
<form method="POST" action="/">
    @csrf
    <label for="name">Name</label><br/>
    <input type="text" name="name"><br/>
    <label for="account">Account</label><br/>
    <input type="text" name="account"><br/>
    <label for="email">Email</label><br/>
    <input type="text" name="email"><br/>
    <label for="password">password</label><br/>
    <input type="text" name="password"><br/>
    <input type="submit">
</form>
<script>
