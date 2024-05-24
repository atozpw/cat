<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\QuestionCategory;
use App\Models\Question;
use App\Models\QuestionDetail;

class QuestionCategoryController extends Controller
{
    public function index()
    {
        $questioncategories = QuestionCategory::orderBy('created_at', 'desc')->paginate(20);

        return view('questions.index', compact('questioncategories'));
    }

    public function store(Request $request)
    {
        QuestionCategory::create($request->all());

        toastr()->success('Kategori Soal baru berhasil ditambah.');

        return redirect(route('questioncategories.index'));
    }

    public function show(Request $request, $id)
    {
        $sequence = null;
        $questions = null;
        $question = null;

        $question_category_id = $id;
        $question_category = QuestionCategory::find($question_category_id);

        $page = isset($request->page) ? $request->page : 'create';

        if ($page == 'list') {
            $questions = Question::where('question_category_id', $question_category_id)->orderBy('number')->get();
        }
        elseif ($page == 'edit') {
            $question_id = $request->id;
            $question = Question::find($question_id);
            $sequence = $question->number;
        }
        else {
            $number = Question::where('question_category_id', $question_category_id)->max('number');
            $sequence = empty($number) ? 1 : $number + 1;
        }
        
        return view('questions.show', compact('sequence', 'question_category_id', 'questions', 'page', 'question_category', 'question'));
    }

    public function edit($id)
    {
        $questioncategories = QuestionCategory::find($id);

        return response($questioncategories);
    }

    public function update(Request $request, $id)
    {
        $questioncategories = QuestionCategory::find($id);

        $questioncategories->update($request->all());

        toastr()->success('Kategori Soal berhasil diperbaharui.');

        return redirect(route('questioncategories.index'));
    }

    public function destroy($id)
    {
        QuestionCategory::destroy($id);

        toastr()->success('Kategori Soal berhasil dihapus.');

        return redirect(route('questioncategories.index'));
    }

    public function get_answer_previous_question(Request $request)
    {
        $question_category_id = $request->question_category_id;

        $question = Question::where('question_category_id', $question_category_id)->latest()->first();

        $question_details = QuestionDetail::where('question_id', $question->id)->get();

        return response($question_details);
    }
}
