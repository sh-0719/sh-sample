<html>
<head>
    <meta charset="utf-8">
</head>
<body>
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

<table>
    <tr>
        <th>内容</th>
        <th>作成日時</th>
    </tr>
    @php
        /** @var \App\Eloquents\Memo $memo */
    @endphp
    @foreach($memos as $memo)
        {{ Form::open(['url' => route('memo.destroy', $memo->id), 'method' => 'delete']) }}
        <tr>
            <td>{{ $memo->content }}</td>
            <!-- TODO: 作成日時の表記をyyyy年mm月dd日 hh:mm:ssにする -->
            <td>{{ $memo->created_at }}</td>
            <td>{{ Form::submit('削除') }}</td>
        </tr>
        {{ Form::close() }}
    @endforeach
</table>

</body>
</html>