<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Serdos extends Model
{
    protected $guarded = ['id'];
    public $table = 'serdos';

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
