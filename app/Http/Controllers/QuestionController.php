<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Question;
use App\Models\QuestionDetail;
use DB;
use Image;

class QuestionController extends Controller
{
    public function store(Request $request)
    {
        DB::beginTransaction();

        try {
            $question = Question::create($request->all());

            if ($request->has('choice')) {
                for ($i = 0; $i < count($request->choice); $i++) {
                    if ($request->choice[$i]) {
                        $is_answer = isset($request->is_answer[$i]) ? 1 : 0;
                        QuestionDetail::create([
                            'question_id' => $question->id,
                            'sequence' => $request->sequence[$i],
                            'choice' => $request->choice[$i],
                            'is_answer' => $is_answer,
                        ]);
                    }
                }
            }
        }
        catch (\Exception $e) {
            DB::rollBack();
            toastr()->error('Terjadi kesalahan pada sistem.');

            return redirect()->back();
        }

        DB::commit();
        toastr()->success('Mata Soal baru berhasil ditambah.');

        return redirect()->back();
    }

    public function edit($id)
    {
        $question = Question::find($id);

        return response($question);
    }

    public function update(Request $request, $id)
    {
        DB::beginTransaction();

        try {
            $question = Question::find($id);
            $question->update(['number' => $request->number, 'content' => $request->content]);

            QuestionDetail::where('question_id', $question->id)->delete();

            if ($request->has('choice')) {
                for ($i = 0; $i < count($request->choice); $i++) {
                    if ($request->choice[$i]) {
                        $is_answer = isset($request->is_answer[$i]) ? 1 : 0;
                        QuestionDetail::create([
                            'question_id' => $question->id,
                            'sequence' => $request->sequence[$i],
                            'choice' => $request->choice[$i],
                            'is_answer' => $is_answer,
                        ]);
                    }
                }
            }
        }
        catch (\Exception $e) {
            DB::rollBack();
            toastr()->error('Terjadi kesalahan pada sistem.');

            return redirect()->back();
        }

        DB::commit();
        toastr()->success('Mata Soal baru berhasil diperbaharui.');

        return redirect(route('questioncategories.show', ['id' => $question->question_category_id, 'page' => 'list']));
    }

    public function destroy($id)
    {
        Question::destroy($id);

        toastr()->success('Mata Soal berhasil dihapus.');

        return redirect()->back();
    }

    public function image_upload(Request $request)
    {
        if ($request->hasFile('upload')) {
            $filenamewithextension = $request->file('upload')->getClientOriginalName();
            $filename = pathinfo($filenamewithextension, PATHINFO_FILENAME);
            $extension = $request->file('upload')->getClientOriginalExtension();
            $filenametostore = $filename.'_'.time().'.'.$extension;

            $request->file('upload')->storeAs('public/uploads', $filenametostore);
            $request->file('upload')->storeAs('public/uploads/thumbnail', $filenametostore);

            $thumbnailpath = public_path('storage/uploads/thumbnail/' . $filenametostore);
            $img = Image::make($thumbnailpath)->resize(500, 150, function($constraint) {
                $constraint->aspectRatio();
            });
            $img->save($thumbnailpath);

            echo json_encode([
                'default' => asset('storage/uploads/'.$filenametostore),
                '500' => asset('storage/uploads/thumbnail/'.$filenametostore)
            ]);
        }
    }

    public function generate(Request $request)
    {
        DB::beginTransaction();

        try {
            Question::where('group_number', $request->group_number)->delete();

            $choice = $request->choice;
            $sequence = $request->sequence;

            for ($i = 1; $i <= 50; $i++) {
                $shuffled = $choice;
                shuffle($shuffled);

                $picked = array_slice($shuffled, 0, 4);

                $missingValue = array_values(array_diff($choice, $picked))[0];

                $missingIndex = array_search($missingValue, $choice);

                $question = Question::create([
                    'question_category_id' => $request->question_category_id,
                    'number' => $i,
                    'content' => '<p>' . strip_tags(implode(' ', $picked)) . '</p>',
                    'group_number' => $request->group_number,
                ]);

                for ($j = 0; $j < count($choice); $j++) {
                    $is_answer = ($j == $missingIndex) ? 1 : 0;
                    QuestionDetail::create([
                        'question_id' => $question->id,
                        'sequence' => $sequence[$j],
                        'choice' => $choice[$j],
                        'is_answer' => $is_answer,
                    ]);
                }
            }
        }
        catch (\Exception $e) {
            DB::rollBack();
            toastr()->error('Terjadi kesalahan pada sistem.');

            return redirect()->back();
        }

        DB::commit();
        toastr()->success('Mata Soal baru berhasil digenerate.');

        return redirect()->back();
    }
}
