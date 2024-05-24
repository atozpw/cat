@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-6">
            <h2>Hasil - {{ $schedule_detail->question_category->name }}</h2>
        </div>
    </div>
    <div class="row">
        <div class="col-md-3">
            <div class="card mb-3 bg-success text-light">
                <div class="card-body">
                    <div class="fs-4">Benar <span class="fs-1 float-end">{{ $schedule_detail->correct_answer }}</span></div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card mb-3 bg-danger text-light">
                <div class="card-body">
                    <div class="fs-4">Salah <span class="fs-1 float-end">{{ $schedule_detail->wrong_answer }}</span></div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card mb-3 bg-warning text-light">
                <div class="card-body">
                    <div class="fs-4">Tidak Diisi <span class="fs-1 float-end">{{ $schedule_detail->no_answer }}</span></div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card mb-3 bg-primary text-light">
                <div class="card-body">
                    <div class="fs-4">Nilai Akhir <span class="fs-1 float-end">{{ number_format($schedule_detail->test_score, 2) }}</span></div>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="card">
                <div class="card-body p-4">
                    <style>p{margin-bottom:0}</style>
                    <table class="table table-borderless">
                        <tbody>
                            @foreach ($schedule_detail->question_category->questions as $question)
                            <tr>
                                <td width="10px" rowspan="2">{{ $question->number }}.</td>
                                <td>{!! $question->content !!}</td>
                            </tr>
                            <tr>
                                <td class="p-0">
                                    <table class="table table-borderless table-sm">
                                        <tbody>
                                            @foreach ($question->question_details as $question_detail)
                                            @php
                                                $answer_icon = '';
                                                if ($schedule_detail->exam) {
                                                    $exam_detail = $schedule_detail->exam->exam_details->where('question_id', $question_detail->question_id)->first();
                                                    if ($exam_detail) {
                                                        if ($exam_detail->question_detail_id == $question_detail->id && $question_detail->is_answer == 1) {
                                                            $answer_icon = '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check-circle-fill text-success" viewBox="0 0 16 16"><path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/></svg>';
                                                        }
                                                        elseif ($exam_detail->question_detail_id == $question_detail->id && $question_detail->is_answer == 0) {
                                                            $answer_icon = '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check-circle-fill text-danger" viewBox="0 0 16 16"><path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/></svg>';
                                                        }
                                                    }
                                                }
                                            @endphp
                                            <tr>
                                                <td width="25px">
                                                    {!! $answer_icon !!}
                                                </td>
                                                <td width="10px">{{ $question_detail->sequence }}.</td>
                                                <td>{!! $question_detail->choice !!}</td> 
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
