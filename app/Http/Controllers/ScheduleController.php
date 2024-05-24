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
        $questioncategories = QuestionCategory::all();

        return view('schedules.index', compact('schedules', 'participants', 'questioncategories'));
    }

    public function store(Request $request)
    {
        DB::beginTransaction();

        try {
            $schedule = Schedule::create($request->all());

            if ($request->has('question_category_id')) {
                for ($i = 0; $i < count($request->question_category_id); $i++) {
                    ScheduleDetail::create([
                        'schedule_id' => $schedule->id,
                        'question_category_id' => $request->question_category_id[$i],
                    ]);
                }
            }
        }
        catch (\Exception $e) {
            DB::rollBack();
            toastr()->error('Terjadi kesalahan pada sistem.');

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
