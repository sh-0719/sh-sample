<?php

namespace App\Http\Controllers;

use App\Eloquents\Memo;
use App\Exceptions\AppException;
use App\Http\Requests\Memo\StorePost;
use App\Http\Requests\Memo\UpdatePost;
use App\User;
use Illuminate\Http\Request;
use Carbon\Carbon;

class MemoController extends Controller
{
    public function index()
    {
        /** @var User|null $user */
        $user = \Auth::user();
        $visitorMemos =$user->memos()->get();
        return view('memo.index', ['userName' => $user->name, 'memos' => $visitorMemos]);
    }

    // フォームを受け取るクラスを追加
    public function store(StorePost $request)
    {
        /** @var User|null $user */
        $user = \Auth::user();
        $user->memos()->create([
            'content' => $request->input('content'),
            // mysql5.5対応。複数カラムのdefaultにCURRENT_TIMESTAMPが使えない
            'created_at' => Carbon::now(),
        ]);
        return redirect()->route('memo.index');
    }

    public function edit($id)
    {
        /** @var User|null $user */
        $user = \Auth::user();
        $memo =$user->memos()->findOrFail($id);
        return view(
            'memo.edit',
            [
                'userName' => $user->name,
                'memo' => $memo
            ]
        );
    }

    public function update(int $id, UpdatePost $request)
    {
        // todo: 排他制御
        /** @var User|null $user */
        $user = \Auth::user();
        $memo = $user->memos()->findOrFail($id)->fill(['content' => $request->input('content')]);

        \DB::transaction(function () use ($memo) {
            if (!$memo->update()) {
                throw new AppException('Failed to update memo. It is an unexpected fatal situation.');
            }
        });

        return redirect()->route('memo.index');
    }

    public function destroy(int $id, Request $request)
    {
        /** @var User|null $user */
        $user = \Auth::user();
        // TODO: findではなく、findOrFailにして、Failの場合は誤った操作〜等の例外対応
        $user->memos()->find($id)->delete();

        // TODO: 操作内容のメッセージをリダイレクト後の画面に表示

        return redirect()->route('memo.index');
    }
}
