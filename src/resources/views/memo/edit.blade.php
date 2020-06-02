<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    {{ Html::style(mix('/css/app.css')) }}
</head>
<body>
<div id="app" class="p-5">
    <div>{{ $userName }}さんのメモページです。</div>
    <h2>メモ修正</h2>
    <!-- //TODO:モデルベースのフォームに修正する -->
    {{ Form::open(['route' => ['memo.update', $memo->id], 'method' => 'PUT']) }}
    {{ Form::hidden('id', $memo->id) }}
    <!-- todo: エラーメッセージの一括出力をパーシャルブレードでincludeにする -->
    @if($errors->has('content'))
        <ul>
            @foreach($errors->get('content') as $message)
                <li>{{ $message }}</li>
            @endforeach
        </ul>
@endif
{{ Form::text('content', $memo->content) }}
{{ Form::submit('保存') }}
{{ Form::close() }}

</div>
</body>
</html>
