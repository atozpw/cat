<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\QuestionDetail;

class Question extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'question_category_id',
        'aspect_id',
        'number',
        'content',
        'group_number',
    ];

    public function question_details()
    {
        return $this->hasMany(QuestionDetail::class);
    }
}
