@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-6">
            <h2>Ujian</h2>
        </div>
        <div class="col-md-12">
            <div class="card mt-2">
                <div class="card-body p-0">
                    <table class="table mb-0">
                        <thead class="table-secondary">
                            <tr>
                                <th>Tanggal Ujian</th>
                                <th>Soal</th>
                                <th>Durasi Pengerjaan</th>
                                <th>Nilai</th>
                                <th>Status</th>
                                <th width="150px">Opsi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($schedules as $schedule)
                            <tr>
                                <td>{{ date('d/m/Y', strtotime($schedule->schedule->date)) }}</td>
                                <td>{{ $schedule->question_category->name }}</td>
                                <td>{{ $schedule->question_category->duration }}</td>
                                <td>-</td>
                                <td>-</td>
                                <td>
                                    @if ($schedule->schedule->date == date('Y-m-d'))
                                    @if (!$schedule->exam)
                                    <a href="{{ route('exams.show', [Crypt::encrypt($schedule->id)]) }}" class="btn btn-primary btn-sm">Kerjakan</a>
                                    @elseif ($schedule->exam->expired_time > date('Y-m-d H:i:s') && $schedule->exam->is_finished == 0)
                                    <a href="{{ route('exams.show', [Crypt::encrypt($schedule->id)]) }}" class="btn btn-primary btn-sm">Kerjakan</a>
                                    @endif
                                    @endif
                                    @if ($schedule->exam)
                                    @if ($schedule->exam->is_finished == 1)
                                    <a href="{{ route('exams.result', [Crypt::encrypt($schedule->id)]) }}" class="btn btn-success btn-sm">Hasil</a>
                                    @endif
                                    @endif
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" class="text-center">Tidak ada data</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            {{ $schedules->onEachSide(2)->links() }}
        </div>
    </div>
</div>
@endsection
