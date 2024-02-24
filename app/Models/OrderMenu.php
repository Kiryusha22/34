<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderMenu extends Model
{
    protected $fillable = ['id','menu_id','order_id','count','created_at',"updated_at"];

    public function Order() {
        return $this->belongsTo(Order::class);
    }
    public function Menu() {
        return $this->belongsTo(Menu::class);
    }
}
