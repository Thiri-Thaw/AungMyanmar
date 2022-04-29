<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Item;
class Sale_Detail extends Model
{
    use HasFactory;
    protected $fillable = [
        'sale_id','item_id','category_id','sale_price','quantity','enable','created_by','created_by'
    ];
    public function item(){
        return $this->belongsTo('App\Models\Item','item_id');
    }
    public function sale(){
        return $this->belongsTo('App\Models\Sale','sale_id');
    }
    public function category(){
        return $this->belongsTo('App\Models\Category','category_id');
    }
}
