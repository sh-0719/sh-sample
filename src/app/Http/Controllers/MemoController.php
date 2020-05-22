<?php

namespace App\Http\Controllers;

use App\Eloquents\Memo;
use Illuminate\Http\Request;
use Carbon\Carbon;

class MemoController extends Controller
{
    public function index()
    {
        $user = \Auth::user();
        $visitorMemos =$user->memos()->get();
        return view('memo.index', ['memos' => $visitorMemos]);
    }

    // フォームを受け取るクラスを追加
    public function store(Request $request)
    {
        $user = \Auth::user();
        $user->memos()->create([
            'content' => $request->input('content'),
            // mysql5.5対応。複数カラムのdefaultにCURRENT_TIMESTAMPが使えない
            'created_at' => Carbon::now(),
        ]);
        return redirect()->route('memo.index');
    }

    public function destroy(int $id, Request $request)
    {
        $user = \Auth::user();
        // TODO: findではなく、findOrFailにして、Failの場合は誤った操作〜等の例外対応
        $user->memos()->find($id)->delete();

        // TODO: 操作内容のメッセージをリダイレクト後の画面に表示

        return redirect()->route('memo.index');
    }
}
