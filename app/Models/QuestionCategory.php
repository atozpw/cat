<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Question;

class QuestionCategory extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'duration',
        'question_group_id',
    ];

    public function getQuestionCountAttribute($value)
    {
        return $this->questions->count();
    }

    public function questions()
    {
        return $this->hasMany(Question::class)->orderBy('number');
    }

    public function group()
    {
        return $this->belongsTo(QuestionGroup::class, 'question_group_id');
    }
}
