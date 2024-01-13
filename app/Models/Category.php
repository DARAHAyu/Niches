<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    public function sales_orders()
    {
        return $this->hasMany(SalesOrder::class);
    }

    public function purchase_orders()
    {
        return $this->hasMany(PurchaseOrder::class);
    }
}
