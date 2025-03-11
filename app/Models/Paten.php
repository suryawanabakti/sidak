<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Paten extends Model
{
    protected $guarded = ['id'];
    public $table = 'paten';

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
