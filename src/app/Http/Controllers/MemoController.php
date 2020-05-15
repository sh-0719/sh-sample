<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MemoController extends Controller
{
    public function show()
    {
        return view('memo.index', []);
    }
}
