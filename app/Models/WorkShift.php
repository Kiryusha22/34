<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WorkShift extends Model
{
    protected $fillable = ['id','start','end','active','created_at','update_at'];

    public function ShiftWorker(){
        return $this->hasMany(ShiftWorker::class);
    }
}
