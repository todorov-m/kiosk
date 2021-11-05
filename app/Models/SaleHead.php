<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SaleHead extends Model
{
    protected $guarded = [];
    use HasFactory;

    public function users()
    {
        return $this->belongsTo(User::class);
    }

    public function content()
    {
        return $this->hasMany(SaleContent::class);
    }
}
