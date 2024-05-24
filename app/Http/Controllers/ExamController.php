<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ScheduleDetail;
use App\Models\Question;
use App\Models\QuestionCategory;
use App\Models\Exam;
use App\Models\ExamDetail;
use Carbon\Carbon;
use Auth;
use Crypt;

class ExamController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $schedules = ScheduleDetail::whereHas('schedule', function ($query) use ($user) {
            $query->where('user_id', $user->id);
        })
        ->latest()
        ->paginate(15);

        return view('exams.index', compact('schedules'));
    }

    public function store(Request $request)
    {
        $exam_id = $request->exam_id;
        $question_id = $request->question_id;
        $question_detail_id = $request->question_detail_id;

        $exam_detail = ExamDetail::where('exam_id', $exam_id)->where('question_id', $question_id)->first();

        if ($exam_detail) {
            $exam_detail->update(['question_detail_id' => $question_detail_id]);
        }
        else {
            $exam_detail = ExamDetail::create($request->all());
        }

        return response($exam_detail);
    }

    public function show($id)
    {
        $id = Crypt::decrypt($id);
        $user = Auth::user();
        $carbon = Carbon::now();
        $date = $carbon->toDateString();

        $schedule_detail = ScheduleDetail::find($id);

        // $question_category = QuestionCategory::find($schedule_detail->question_category_id);

        // $questions = Question::where('question_category_id', $id)->orderBy('number')->get();

        $exam = Exam::where('schedule_detail_id', $id)
            ->whereDate('created_at', $date)
            ->first();

        if (!$exam) {
            $str_time = $schedule_detail->question_category->duration;
            sscanf($str_time, "%d:%d:%d", $hours, $minutes, $seconds);
            $time_seconds = isset($seconds) ? $hours * 3600 + $minutes * 60 + $seconds : $hours * 60 + $minutes;
            $expired_time = $carbon->addSeconds($time_seconds)->toDateTimeString();
            
            $exam = Exam::create([
                'schedule_detail_id' => $id,
                'expired_time' => $expired_time,
            ]);
        }

        $categ = $schedule_detail->question_category->name;
        $ada ="";
        if (strpos($categ, "TELITI") !== false) {

                $ada = $categ;

        }
        

        return view('exams.show', compact('schedule_detail', 'exam','ada'));
    }

    public function update(Request $request)
    {
        $exam = Exam::find($request->exam_id);
        $exam->update(['is_finished' => 1]);

        return response($exam);
    }

    public function result($id)
    {
        $id = Crypt::decrypt($id);
        $schedule_detail = ScheduleDetail::find($id);

        return view('exams.result', compact('schedule_detail'));
    }
}
