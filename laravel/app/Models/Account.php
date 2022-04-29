<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    use HasFactory;
    protected $fillable = [
        'reason', 'amount', 'type_id', 'enroll_date', 'remark', 'enable', 'created_by', 'edited_by'
    ];
    public function type()
    {
        return $this->belongsTo('App\Models\Type', 'type_id');
    }
}
