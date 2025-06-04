<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ['name'];

    public function transactionDetails()
    {
        return $this->hasMany(TransactionDetail::class);
    }
}