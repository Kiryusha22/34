<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Table extends Model
{
    protected $fillable = ['id','name','capacity'];

    public function Order() {
        return $this->hasMany(Order::class);
    }
}
