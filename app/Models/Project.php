<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'info',
        'user_id',
        'branch_id',
    ];


    public function users()
    {
        return $this->hasMany(User::class);
    }


    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }

    public function files()
    {
        return $this->hasMany(File::class);
    }


    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    // function getCreatedAtAttribute($date){
    //     return Carbon::createFromTimeString($date)->format('Y-m-d');
    // }

}
