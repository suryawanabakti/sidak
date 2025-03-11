<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pangkat extends Model
{
    protected $guarded = ['id'];
    public $table = 'pangkat';

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
