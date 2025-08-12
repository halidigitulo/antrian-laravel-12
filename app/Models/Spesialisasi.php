<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Spesialisasi extends Model
{
    protected $table = 'spesialisasi';
    protected $guarded = ['id'];

    public function dokter()
    {
        return $this->hasMany(Dokter::class, 'spesialisasi_id');
    }
}
