<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Antrian extends Model
{
    protected $table = 'antrian';
    protected $fillable = [
        'prefix',
        'number',
        'date',
    ];
    
    public function loket()
    {
        return $this->belongsTo(Loket::class, 'loket_id', 'id');
    }
    /**
     * Get the formatted queue number.
     *
     * @return string
     */
    public function getFormattedQueueNumberAttribute()
    {
        return sprintf('%s-%03d', $this->prefix, $this->number);
    }
}
