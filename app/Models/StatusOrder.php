<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StatusOrder extends Model
{
    protected $fillable = ['id','name','code'];

    public function Order() {
        return $this->hasMany(Order::class);
    }
}
