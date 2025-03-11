<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kompetensi extends Model
{
    protected $guarded = ['id'];
    public $table = 'kompetensi';

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
