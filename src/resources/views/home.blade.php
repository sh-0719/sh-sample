<html>
<head>
    <meta charset="utf-8">
</head>
<body>
こんにちは！
@if(Auth::check())
    {{ \Auth::user()->name }}さん<br>
    <div><a href="/memo">メモ機能</a></div>
    <div><a href="/auth/logout">ログアウト</a></div>
@else
    ゲストさん<br>
    <a href="/auth/login">ログイン</a><br>
    <a href="/auth/register">会員登録</a>
@endif
</body>
</html>