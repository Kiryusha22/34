<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShiftWorker extends Model
{
    protected $fillable = ['id','work_shift_id','user_id','created_at','updated_at'];

    public function User() {
        return $this->belongsTo(User::class);
    }
    public function WorkShift() {
        return $this->belongsTo(WorkShift::class);
    }
    public function Order() {
        return $this->hasMany(User::class);
    }

}
