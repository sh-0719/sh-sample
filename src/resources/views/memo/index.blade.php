<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>
<div id="app">
    <div>{{ $userName }}さんのメモページです。</div>

    <!-- //TODO:モデルベースのフォームに修正する -->
    {{ Form::open(['route' => 'memo.store']) }}
    @if($errors->has('content'))
        <ul>
            @foreach($errors->get('content') as $message)
                <li>{{ $message }}</li>
            @endforeach
        </ul>
    @endif
    {{ Form::text('content') }}
    {{ Form::submit('追加') }}
    {{ Form::close() }}

<!-- todo: ヘッダー項目名を3つ渡してヘッダーを作るコンポーネント -->
<!-- todo: ヘッダー項目名を配列で渡して、値の数だけ列があるヘッダーを作るコンポーネント -->
    <memo-table :memos="{{ $memos }}" :appurl="'{{ env('APP_URL') }}'"></memo-table>
</div>
{{ Html::script(mix('js/app.js')) }}

</body>
</html>
