<?php

namespace App\Eloquents;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Memo
 * @package App\Eloquents
 *
 * @property int         $id
 * @property int         $user_id
 * @property string|null $content
 *
 * @property-read User $user
 */
class Memo extends Model
{
    use SoftDeletes;

    // mysql5.5対応（created_ad）
    // 複数カラムのdefaultにCURRENT_TIMESTAMPが使えない
    /**
     * 変更可能領域
     * @var array
     */
    protected $fillable = [
        'user_id', 'content', 'created_at'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     * relation: users
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
