<?php

namespace App\Http\Controllers;

use App\Eloquents\Memo;
use Illuminate\Http\Request;
use Carbon\Carbon;

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
        // TODO: UserクラスにHasManyでMemoクラスと繋いで、$user->Memos()->create([ に修正する
        $user = \Auth::user();
        $memo = new Memo();
        $memo->create([
            'user_id' => $user->id,
            'content' => $request->input('content'),
            // mysql5.5対応。複数カラムのdefaultにCURRENT_TIMESTAMPが使えない
            'created_at' => Carbon::now(),
        ]);
        return redirect()->route('memo.index');
    }

    public function destroy(int $id, Request $request)
    {
        // TODO: UserクラスをHasManyでMemoと繋いで、 $user->Memos()->findOrFail($id) でMemoを取得するように修正する
        $user = \Auth::user();
        $memo = Memo::where('id', $id)->where('user_id',$user->id)->get();
        $memo[0]->delete();

        // TODO: 操作内容のメッセージをリダイレクト後の画面に表示

        return redirect()->route('memo.index');
    }
}
