<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    protected $fillable = ['name','description','price','menu_category_id'];

    public function OrderMenu() {
        return $this->hasMany(OrderMenu::class);
    }
    public function MenuCategory() {
        return $this->belongsTo(MenuCategory::class);
    }
}
