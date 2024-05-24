@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-6">
            <h2>Ujian</h2>
        </div>
        <div class="col-md-8">
            <div class="card mt-2">
                <div class="card-body p-4">
                    <table class="table table-borderless">
                        <tbody>
                            @foreach ($schedule_detail->question_category->questions as $question)
                            <tr id="exam{{ $question->id }}">
                                <td width="10px" rowspan="2">{{ $question->number }}.</td>
                                @if($ada !== "")

                                        <table>
                                            <tr>
                                                @foreach ($question->question_details as $question_detail)
                                                @php
                                                    $answer = '';
                                                    if ($schedule_detail->exam) {
                                                        $exam_detail = $schedule_detail->exam->exam_details->where('question_id', $question_detail->question_id)->first();
                                                        if ($exam_detail) {
                                                            if ($exam_detail->question_detail_id == $question_detail->id) {
                                                                $answer = 'checked';
                                                            }
                                                        }
                                                    }
                                                @endphp

                                                    <td width="55px" style="border: 1px solid black; text-align: center;">{!! $question_detail->choice !!} <hr> {{$question_detail->sequence}}</td>
                                                
                                                
                                                
                                                @endforeach
                                            </tr>
                                        </table>
                                        <br><br>
                                <td>{!! $question->content !!}</td>
                                @else
                                <td>{!! $question->content !!}</td>
                                @endif

                            </tr>
                            <tr>
                                <td></td><td><br></td>
                            </tr>
                            <tr>
                                <td class="p-0">
                                    <table class="table table-borderless table-sm">
                                        <tbody>
                                            
                                            @if($ada !== "")
                                                <tr>
                                                    
                                                
                                                @foreach ($question->question_details as $question_detail)
                                                @php
                                                    $answer = '';
                                                    if ($schedule_detail->exam) {
                                                        $exam_detail = $schedule_detail->exam->exam_details->where('question_id', $question_detail->question_id)->first();
                                                        if ($exam_detail) {
                                                            if ($exam_detail->question_detail_id == $question_detail->id) {
                                                                $answer = 'checked';
                                                            }
                                                        }
                                                    }
                                                @endphp

                                               
                                                    <td width="25px">
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="radio" name="question_{{ $question->id }}" id="questionChoice{{ $question->id }}{{ $question_detail->id }}" onclick="postChoice({{ $question->id }}, {{ $question_detail->id }})" {{ $answer }}>
                                                        </div>
                                                    </td>
                                                    
                                                    
                                                    
                                                    <td width="10px"><label class="form-check-label" for="questionChoice{{ $question->id }}{{ $question_detail->id }}">{{ $question_detail->sequence }}.</label></td>
                                                    <td></td>
                                                    <!-- <td><label class="form-check-label" for="questionChoice{{ $question->id }}{{ $question_detail->id }}">{!! $question_detail->choice !!}</label></td> -->
                                                   
                                                
                                                @endforeach
                                                </tr>

                                            @else
                                            @foreach ($question->question_details as $question_detail)
                                            @php
                                                $answer = '';
                                                if ($schedule_detail->exam) {
                                                    $exam_detail = $schedule_detail->exam->exam_details->where('question_id', $question_detail->question_id)->first();
                                                    if ($exam_detail) {
                                                        if ($exam_detail->question_detail_id == $question_detail->id) {
                                                            $answer = 'checked';
                                                        }
                                                    }
                                                }
                                            @endphp

                                            <tr>
                                                <td width="25px">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio" name="question_{{ $question->id }}" id="questionChoice{{ $question->id }}{{ $question_detail->id }}" onclick="postChoice({{ $question->id }}, {{ $question_detail->id }})" {{ $answer }}>
                                                    </div>
                                                </td>
                                                
                                                
                                                
                                                <td width="10px"><label class="form-check-label" for="questionChoice{{ $question->id }}{{ $question_detail->id }}">{{ $question_detail->sequence }}.</label></td>
                                                <td><label class="form-check-label" for="questionChoice{{ $question->id }}{{ $question_detail->id }}">{!! $question_detail->choice !!}</label></td> 
                                               
                                            </tr>
                                            @endforeach
                                            @endif
                                            
                                            
                                        </tbody>
                                    </table>
                                    <!-- <hr> -->
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="d-grid">
                        <button class="btn btn-primary btn-lg" type="button" onclick="finished()">Selesai</button>
                        <input id="exam_id" type="hidden" value="{{ $exam->id }}">
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card mt-2 sticky-top">
                <div class="card-body p-4">
                    <h3 id="timer" class="text-center mb-3">-</h3>
                    @foreach ($schedule_detail->question_category->questions as $question)
                    <a href="#exam{{ $question->id }}" id="pointer{{ $question->id }}" class="btn btn-danger mb-1">{{ $question->number }}</a>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('stylesheet')
<style>p{margin-bottom:0}</style>
@endpush

@push('script')
<script>
    var countDownDate = new Date("{{ $exam->expired_time }}").getTime();
    // var countDownDate = new Date("2022-03-07 23:00:00").getTime();
    
    var x = setInterval(function() {
        var now = new Date().getTime();
        var distance = countDownDate - now;

        var textHours = "";
        var textMinutes = "";
        var textSeconds = "";

        var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
        var seconds = Math.floor((distance % (1000 * 60)) / 1000);

        if (hours > 0) textHours = hours + " jam ";
        if (minutes > 0) textMinutes = minutes + " menit ";
        if (seconds > 0) textSeconds = seconds + " detik";

        document.getElementById("timer").innerHTML = textHours + textMinutes + textSeconds;

        if (distance < 0) {
            clearInterval(x);
            document.getElementById("timer").innerHTML = "-";
            finished();
        }
    }, 1000);

    function postChoice(questionId, questionDetailId) {
        var csrf_token = $('meta[name=csrf-token]').attr('content');
        var exam_id = $('#exam_id').val();

        $.post("{{ route('exams.store') }}", { 
            _token: csrf_token,
            exam_id: exam_id,
            question_id: questionId,
            question_detail_id: questionDetailId
        }, function (response) {
            $('#pointer' + questionId).addClass('btn-success');
            $('#pointer' + questionId).removeClass('btn-danger');
        });
    }

    function finished() {
        var csrf_token = $('meta[name=csrf-token]').attr('content');
        var exam_id = $('#exam_id').val();

        $.post("{{ route('exams.update') }}", { 
            _token: csrf_token,
            exam_id: exam_id
        }, function (response) {
            window.location.href = "/exams";
        });
    }
</script>
@endpush