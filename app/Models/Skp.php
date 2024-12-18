<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Skp extends Model
{
    protected $guarded = ['id'];
    public $table = 'skp';

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
