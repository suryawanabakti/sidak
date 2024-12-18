<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bkd extends Model
{
    protected $guarded = ['id'];
    public $table = 'bkd';

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
