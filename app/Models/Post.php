<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'title',
        'info',
        'photo',
        'user_id',
        'project_id',
        'branch_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function project()
    {
        return $this->belongsTo(Project::class);
    }
    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }

    // function getCreatedAtAttribute($date){
    //     return Carbon::createFromTimeString($date)->format('Y-m-d');
    // }
}
