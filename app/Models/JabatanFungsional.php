<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JabatanFungsional extends Model
{
    protected $guarded = ['id'];
    public $table = 'jabatan_fungsional';

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
