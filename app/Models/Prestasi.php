<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Prestasi extends Model
{
    protected $guarded = ['id'];
    public $table = 'prestasi';

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}