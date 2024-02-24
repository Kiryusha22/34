<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = ['id', 'number_of_person','table_id','shift_worker_id','status_order_id','created_at','updated_at'];

    public function Table(){
        return $this->belongsTo(Table::class);
    }
    public function ShiftWorker() {
        return $this->belongsTo(ShiftWorker::class);
    }
    public function StatusOrder(){
        return $this->belongsTo(StatusOrder::class);
    }
    public function OrderMenu(){
        return $this->hasMany(OrderMenu::class);
    }

}
