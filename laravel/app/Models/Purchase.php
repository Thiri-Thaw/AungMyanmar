<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    use HasFactory;
    protected $fillable  = [
        'company_id',
        'tax',
        'discount',
        'date',
        'remark',
        'enable',
        'created_by',
        'edited_by',
    ];
    public function purchase_items()
    {
        return $this->hasMany(PurchaseItem::class);
    }
    public function company()
    {
        return $this->belongsTo(Company::class);
    }
}
