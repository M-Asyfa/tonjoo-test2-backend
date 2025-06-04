<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TransactionDetail extends Model
{
    protected $fillable = ['category_id', 'name', 'amount'];

    public function header()
    {
        return $this->belongsTo(TransactionHeader::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}