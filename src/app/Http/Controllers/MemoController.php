<?php

namespace App\Http\Controllers;

use App\Eloquents\Memo;
use Illuminate\Http\Request;

class MemoController extends Controller
{
    public function index()
    {
        $visitorId = \Auth::user()->id;
        $visitorMemos = Memo::where('user_id', $visitorId)->get();
        return view('memo.index', ['memos' => $visitorMemos]);
    }

    // フォームを受け取るクラスを追加
    public function store(Request $request)
    {
        $user = \Auth::user();
        $memo = new Memo();
        $memo->create([
            'user_id' => $user->id,
            'content' => $request->input('content'),
        ]);
        return redirect()->route('memo.index');
    }
}
