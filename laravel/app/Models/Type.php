<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
    use HasFactory;
    protected $fillable = [
        'name', 'status', 'remark', 'enable', 'created_by', 'edited_by'
    ];
    public function account()
    {
        return $this->hasMany('App\Models\Account');
    }
}
