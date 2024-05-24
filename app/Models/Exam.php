<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\ExamDetail;

class Exam extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'schedule_detail_id',
        'expired_time',
        'is_finished',
    ];

    public function exam_details()
    {
        return $this->hasMany(ExamDetail::class, 'exam_id', 'id');
    }
}
