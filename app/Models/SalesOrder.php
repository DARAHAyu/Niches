<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalesOrder extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'sales_abstract'];

    /**
     * この発注を所有するユーザ（Userモデルとの関係を定義
     */

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
