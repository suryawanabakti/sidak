<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Organisasi extends Model
{
    protected $guarded = ['id'];
    public $table = 'organisasi';

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
