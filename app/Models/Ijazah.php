<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ijazah extends Model
{
    protected $guarded = ['id'];
    public $table = 'ijazah';

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
