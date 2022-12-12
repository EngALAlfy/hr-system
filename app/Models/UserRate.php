<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserRate extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'info',
        'rate',
        'rated_by_user_id',
    ];


    public function ratedByUser(){
        return $this->belongsTo(User::class , 'rated_by_user_id');
    }

}
