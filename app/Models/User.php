<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $fillable = ['id','name','surname','patronymic','login','password','photo_file','api_token','status','role_id','created_at','update_at'];

    public function Role() {
        return $this->belongsTo(Role::class);
    }
    public function ShiftWorker() {
        return $this->hasMany(ShiftWorker::class);
    }
}
