<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'date',
        'branch_id',
        'situation' ,#الموقف
        'info',
        'user_id',
        'token_by_user_id',
    ];


    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function tokenBy()
    {
        return $this->belongsTo(User::class , 'token_by_user_id');
    }

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    // function getCreatedAtAttribute($date){
    //     return Carbon::createFromTimeString($date)->format('Y-m-d');
    // }

}
