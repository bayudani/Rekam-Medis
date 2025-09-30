<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class poli extends Model
{
    protected $table = 'polis';
    protected $fillable = ['nama_poli'];

    public function users()
    {
        return $this->hasMany(User::class, 'poli_id');
    }
}
