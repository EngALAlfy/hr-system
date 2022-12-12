<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserWallet extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'amount',
        'added_by_user_id',
        'info',
    ];

    public function addedByUser(){
        return $this->belongsTo(User::class , 'added_by_user_id');
    }
}
