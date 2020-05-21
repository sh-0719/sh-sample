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
}
//$memo = new Memo();
//$memo->create([
//    'user_id' => \Auth::user()->id,
//    'content' => 'てすと'
//]);