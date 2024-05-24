<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\ScheduleDetail;
use App\Models\User;

class Schedule extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id',
        'date',
    ];

    public function schedule_details()
    {
        return $this->hasMany(ScheduleDetail::class);
    }

    public function participant()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }
}
