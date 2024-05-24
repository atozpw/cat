<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\QuestionCategory;
use App\Models\Schedule;
use App\Models\Exam;

class ScheduleDetail extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'schedule_id',
        'question_category_id',
    ];

    public function question_category()
    {
        return $this->hasOne(QuestionCategory::class, 'id', 'question_category_id');
    }

    public function schedule()
    {
        return $this->hasOne(Schedule::class, 'id', 'schedule_id');
    }

    public function exam()
    {
        return $this->hasOne(Exam::class, 'schedule_detail_id', 'id');
    }

    public function getCorrectAnswerAttribute()
    {
        $count = 0;

        foreach ($this->question_category->questions as $question) {
            foreach ($question->question_details as $question_detail) {
                if ($this->exam) {
                    $exam_detail = $this->exam->exam_details->where('question_id', $question_detail->question_id)->first();
                    if ($exam_detail) {
                        if ($exam_detail->question_detail_id == $question_detail->id && $question_detail->is_answer == 1) {
                            $count++;
                        }
                    }
                }
            }
        }

        return $count;
    }

    public function getWrongAnswerAttribute()
    {
        $count = 0;

        foreach ($this->question_category->questions as $question) {
            foreach ($question->question_details as $question_detail) {
                if ($this->exam) {
                    $exam_detail = $this->exam->exam_details->where('question_id', $question_detail->question_id)->first();
                    if ($exam_detail) {
                        if ($exam_detail->question_detail_id == $question_detail->id && $question_detail->is_answer == 0) {
                            $count++;
                        }
                    }
                }
            }
        }

        return $count;
    }

    public function getNoAnswerAttribute()
    {
        $count = 0;

        $count_question = $this->question_category->questions->count();
        $correct_answer = $this->getCorrectAnswerAttribute();
        $wrong_answer = $this->getWrongAnswerAttribute();

        $count = $count_question - ($correct_answer + $wrong_answer);

        return $count;
    }

    public function getTestScoreAttribute()
    {
        $count = 0;

        $count_question = $this->question_category->questions->count();
        $correct_answer = $this->getCorrectAnswerAttribute();

        $count = ($correct_answer * 100) / $count_question;

        return $count;
    }
}
