<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurchaseItem extends Model
{
    use HasFactory;
    protected $fillable  = [
        'purchase_id',
        'item_id',
        'category_id',
        'price',
        'quantity',
        'enable',
        'created_by',
        'edited_by',
    ];
    public function purchases()
    {
        return $this->belongsTo(Purchase::class, 'purchase_id');
    }
    public function items()
    {
        return $this->belongsTo(Item::class, 'item_id');
    }
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
}
