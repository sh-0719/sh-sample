<html>
<head>
    <meta charset="utf-8">
</head>
<body>
<div>{{ \Auth::user()->name }}さんのメモページです。</div>

<!-- //TODO:モデルベースのフォームに修正する -->
{{ Form::open(['route' => 'memo.store']) }}
{{ Form::text('content') }}
{{ Form::submit('追加') }}
{{ Form::close() }}

<table>
    <tr>
        <th>内容</th>
        <th>作成日時</th>
    </tr>
    @foreach($memos as $memo)
        <tr>
            <td>{{ $memo->content }}</td>
            <td>{{ $memo->created_at }}</td>
        </tr>
    @endforeach
</table>

</body>
</html>