<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MessageRoom extends Model
{
    use HasFactory;

    protected $fillable = ['id'];

    public function messages()
    {
        return $this->hasMany(Message::class);
    }
}
