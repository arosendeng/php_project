<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Commodity extends Model
{
    protected $table = 'commodity';


    public function merchant()
    {
        return $this->belongsTo(Merchant::class,'m_id');
    }
}
