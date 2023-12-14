<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurchaseOrder extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'purchase_abstract'];

    /**
     * この受注を所有するユーザ（Userモデルとの関係を定義
     */

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
