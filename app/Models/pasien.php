<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class pasien extends Model
{
    protected $table = 'pasien';
    protected $fillable = ['nama', 'tgl_lahir', 'no_rm', 'no_bpjs', 'alamat', 'jk'];
    
}
