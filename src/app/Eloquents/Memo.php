<?php

namespace App\Eloquents;

use Illuminate\Database\Eloquent\Model;

class Memo extends Model
{
    protected $fillable = [
        'user_id', 'content'
    ];
}
