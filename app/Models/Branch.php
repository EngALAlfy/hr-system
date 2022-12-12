<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
    use HasFactory;

    // protected $dateFormat = 'U';

    public $fillable = [
        'name',
        'info',
        'user_id'
    ];

    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function projects()
    {
        return $this->hasMany(Project::class);
    }


    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    // function getCreatedAtAttribute($date){
    //     return Carbon::createFromTimeString($date)->format('Y-m-d');
    // }
}
