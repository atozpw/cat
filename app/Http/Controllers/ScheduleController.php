<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Schedule;
use App\Models\ScheduleDetail;
use App\Models\User;
use App\Models\QuestionCategory;
use DB;

class ScheduleController extends Controller
{
    public function index()
    {
        $schedules = Schedule::has('participant')->orderBy('created_at', 'desc')->paginate(20);
        $participants = User::where('is_member', 1)->orderBy('name')->get();
        $questions1 = QuestionCategory::where('question_group_id', 1)->get();
        $questions2 = QuestionCategory::where('question_group_id', 2)->get();
        $questions3 = QuestionCategory::where('question_group_id', 3)->get();

        return view('schedules.index', compact('schedules', 'participants', 'questions1', 'questions2', 'questions3'));
    }

    public function store(Request $request)
    {
        DB::beginTransaction();

        try {
            $schedule = Schedule::create($request->all());

            if ($request->question_category_id_1) {
                ScheduleDetail::create([
                    'schedule_id' => $schedule->id,
                    'question_category_id' => $request->question_category_id_1,
                    'question_group_id' => 1
                ]);
            }

            if ($request->question_category_id_2) {
                ScheduleDetail::create([
                    'schedule_id' => $schedule->id,
                    'question_category_id' => $request->question_category_id_2,
                    'question_group_id' => 2
                ]);
            }

            if ($request->question_category_id_3) {
                ScheduleDetail::create([
                    'schedule_id' => $schedule->id,
                    'question_category_id' => $request->question_category_id_3,
                    'question_group_id' => 3
                ]);
            }
        }
        catch (\Exception $e) {
            DB::rollBack();
            toastr()->error('Terjadi kesalahan pada sistem.');
dd($e);
            return redirect(route('schedules.index'));
        }

        DB::commit();
        toastr()->success('Jadwal baru berhasil ditambah.');

        return redirect(route('schedules.index'));
    }

    public function edit($id)
    {
        $participant = User::find($id);

        return response($participant);
    }

    public function update(Request $request, $id)
    {
        $participant = User::find($id);

        $participant->update($request->all());

        toastr()->success('Jadwal berhasil diperbaharui.');

        return redirect(route('schedules.index'));
    }

    public function destroy($id)
    {
        Schedule::destroy($id);

        toastr()->success('Jadwal berhasil dihapus.');

        return redirect(route('schedules.index'));
    }
}
