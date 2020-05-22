<?php

namespace App\Eloquents;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Memo extends Model
{
    use SoftDeletes;

    // mysql5.5対応。複数カラムのdefaultにCURRENT_TIMESTAMPが使えない
    protected $fillable = [
        'user_id', 'content', 'created_at'
    ];
}
