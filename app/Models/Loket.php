<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Loket extends Model
{
    protected $guarded = [];
    protected $table = 'loket';

    public function antrian()
    {
        return $this->hasMany(Antrian::class, 'loket_id');
    }

    public function userAktif()
    {
        return $this->belongsTo(User::class, 'user_aktif'); // Define the relationship
    }
}
