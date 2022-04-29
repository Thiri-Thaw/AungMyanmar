<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Category;

class Item extends Model
{
    use HasFactory;
    protected $fillable = [
        'category_id', 'name', 'code', 'purchase_price', 'retail_price',
        'wholesale_price', 'unit', 'remark', 'description', 'available', 'enable',
        'created_by', 'edited_by'
    ];
    public function category()
    {
        return $this->belongsTo('App\Models\Category', 'category_id');
    }
    public function purchase_items()
    {
        return $this->hasMany('App\Models\PurchaseItem');
    }
    public function sale_details()
    {
        return $this->hasMany('App\Models\Sale_Detail');
    }
}