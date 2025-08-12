<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JenisAntrian extends Model
{
    protected $table = 'jenis_antrian';
    protected $guarded = [];

    /**
     * Get the Loket associated with the JenisAntrian.
     */
    public function loket()
    {
        return $this->belongsTo(Loket::class, 'loket_id', 'id');
    }

    /**
     * Get the User who created the JenisAntrian.
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
