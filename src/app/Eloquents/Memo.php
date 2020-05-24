<?php

namespace App\Eloquents;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Memo
 * @package App\Eloquents
 *
 * @property $id
 * @property $user_id
 * @property $content
 */
class Memo extends Model
{
    use SoftDeletes;

    // mysql5.5対応。複数カラムのdefaultにCURRENT_TIMESTAMPが使えない
    /**
     * 変更可能領域
     * @var array
     */
    protected $fillable = [
        'user_id', 'content', 'created_at'
    ];
}
