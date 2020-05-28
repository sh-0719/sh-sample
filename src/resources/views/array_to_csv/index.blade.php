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
    <h2>連想配列のキー連結機能</h2>
    <p>
        laravelの多言語対応リソースファイルなど、<br>
        連想配列を返却するphpファイルをアップロードしてください。<br>
        入れ子になっている連想配列のキーを連結し、<br>
        有効なキーの一覧をcsvファイルとして出力します。<br>
        （アップロードしたファイル名が全てのキーの先頭として扱われます）
    </p>

    {{ Form::open(['route' => 'array_to_csv.convert_and_download', 'files' => true]) }}
    <div>{{ Form::file('file') }}</div>
    <div class="mt-3">{{ Form::submit('Convert & DL') }}</div>
    {{ Form::close() }}


</div>
{{ Html::script(mix('js/memo/index.js')) }}
</body>
</html>
