<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Customers;
use App\Models\Sale_Detail;
class Sale extends Model
{
    use HasFactory;
    protected $fillable = [
        'customer_id','sub_total','tax','discount','paid_amount','left_amount','enable','created_by','edited_by'
    ];

    public function customer(){
        return $this->belongsTo('App\Models\Customer','customer_id');
    }
    public function saledetail(){
        return $this->hasMany('App\Models\Sale_Detail','sale_id');
    }
}
