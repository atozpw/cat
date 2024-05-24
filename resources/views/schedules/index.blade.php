@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-6">
            <h2>Jadwal</h2>
        </div>
        <div class="col-md-6">
            <button type="button" class="btn btn-primary float-end" data-bs-toggle="modal" data-bs-target="#modalAddNew">
                Tambah Baru
            </button>
        </div>
        <div class="col-md-12">
            <div class="card mt-2">
                <div class="card-body p-0">
                    <table class="table mb-0">
                        <thead class="table-secondary">
                            <tr>
                                <th>Peserta</th>
                                <th>Tanggal Pengerjaan</th>
                                <th>Soal</th>
                                <th width="100px">Opsi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($schedules as $schedule)
                            <tr>
                                <td>{{ $schedule->participant->name }}</td>
                                <td>{{ date('d/m/Y', strtotime($schedule->date)) }}</td>
                                <td>
                                    @foreach ($schedule->schedule_details as $schedule_detail)
                                    <div>{{ $schedule_detail->question_category->name }}</div>
                                    @endforeach    
                                </td>
                                <td>
                                    {{-- <a class="btn btn-warning btn-sm" id="editSchedule" data-bs-toggle="modal" data-bs-target="#modalEdit" data-id="{{ $schedule->id }}">Edit</a> --}}
                                    <a onclick="confirmDelete({{ $schedule->id }})" class="btn btn-danger btn-sm">Hapus</a>
                                    <form id="form-delete{{ $schedule->id }}" action="{{ route('schedules.destroy', [$schedule->id]) }}" method="POST" style="display: none;">
                                        @method('DELETE')
                                        @csrf
                                    </form>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="3" class="text-center">Tidak ada data</td>
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
<div class="modal fade" id="modalAddNew" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Jadwal Baru</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('schedules.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="form-group mb-3">
                        <label>Peserta</label>
                        <select name="user_id" class="select-participant">
                            <option value="">Pilih Peserta</option>
                            @foreach ($participants as $participant)
                            <option value="{{ $participant->id }}">{{ $participant->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group mb-3">
                        <label>Tanggal Pengerjaan</label>
                        <input type="date" name="date" class="form-control">
                    </div>
                    <hr>
                    <div class="form-group mb-3">
                        <label class="h5">Soal</label>
                        <div>
                            <div id="rowAddQuestion">
                                <div id="rowAddQuestionItem0" class="row mb-2">
                                    <div class="col-md-10">
                                        <select name="question_category_id[]" class="select-question">
                                            <option value="">Pilih Soal</option>
                                            @foreach ($questioncategories as $questioncategory)
                                            <option value="{{ $questioncategory->id }}">{{ $questioncategory->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-2">
                                        <button type="button" onclick="deleteRow(0)" class="btn btn-danger">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-dash-circle" viewBox="0 0 16 16">
                                                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                                                <path d="M4 8a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7A.5.5 0 0 1 4 8z"/>
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <button type="button" onclick="addRow()" class="btn btn-success mt-2">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-circle" viewBox="0 0 16 16">
                                    <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                                    <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade" id="modalEdit" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Peserta</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="formEditPeserta" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="form-group mb-3">
                        <label>Nomor Peserta</label>
                        <input id="participant_number" name="number" type="text" class="form-control" readonly>
                    </div>
                    <div class="form-group mb-3">
                        <label>Nama Lengkap</label>
                        <input id="participant_name" name="name" type="text" class="form-control">
                    </div>
                    <div class="form-group mb-3">
                        <label>Jenis Kelamin</label>
                        <div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="gender" id="editGenderLakiLaki" value="Laki-laki">
                                <label class="form-check-label" for="editGenderLakiLaki">Laki-laki</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="gender" id="editGenderPerempuan" value="Perempuan">
                                <label class="form-check-label" for="editGenderPerempuan">Perempuan</label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group mb-3">
                        <label>Tempat Lahir</label>
                        <input id="participant_birth_place" name="birth_place" type="text" class="form-control">
                    </div>
                    <div class="form-group mb-3">
                        <label>Tanggal Lahir</label>
                        <input id="participant_birth_date" name="birth_date" type="date" class="form-control">
                    </div>
                    <div class="form-group mb-3">
                        <label for="">Alamat</label>
                        <textarea id="participant_address" name="address" class="form-control" rows="3"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('stylesheet')
<link href="{{ asset('vendor/select2-4.0.13/dist/css/select2.min.css') }}" rel="stylesheet" />
<link href="{{ asset('css/select2-custom.css') }}" rel="stylesheet" />
@endpush

@push('script')
<script src="{{ asset('vendor/select2-4.0.13/dist/js/select2.min.js') }}"></script>
<script>
var rowIndex = 99

$(document).ready(function () {
    $('.select-participant').select2({
        placeholder: 'Pilih Peserta',
        dropdownParent: $('#modalAddNew'),
        width: '100%'
    });

    $('.select-question').select2({
        placeholder: 'Pilih Soal',
        dropdownParent: $('#modalAddNew'),
        width: '100%'
    });

    $('body').on('click', '#editParticipant', function (event) {
        event.preventDefault();
        var id = $(this).data('id');
        document.getElementById('formEditPeserta').action = '/participants/' + id;
        $.get('/participants/' + id, function (data) {
            $('#participant_number').val(data.number);
            $('#participant_name').val(data.name);
            $('#participant_birth_place').val(data.birth_place);
            $('#participant_birth_date').val(data.birth_date);
            $('#participant_address').val(data.address);

            if (data.gender == 'Laki-laki') $('#editGenderLakiLaki').prop('checked', true);
            if (data.gender == 'Perempuan') $('#editGenderPerempuan').prop('checked', true);
        })
    });
})

function confirmDelete(value){
    var alert = window.confirm("Yakin ingin dihapus?")
    if(alert) {
        event.preventDefault();
        document.getElementById('form-delete' + value).submit();
    }
    else {
        return true
    }
}

function deleteRow(i) {
    $('#rowAddQuestionItem' + i).remove()
    return false
}

function addRow() {
    $('#rowAddQuestion').append(
        '<div id="rowAddQuestionItem' + rowIndex + '" class="row mb-2">' +
            '<div class="col-md-10">' +
                '<select name="question_category_id[]" class="select-question">' +
                    '<option value="">Pilih Soal</option>' +
                    '@foreach ($questioncategories as $questioncategory)' +
                    '<option value="{{ $questioncategory->id }}">{{ $questioncategory->name }}</option>' +
                    '@endforeach' +
                '</select>' +
            '</div>' +
            '<div class="col-md-2">' +
                '<button type="button" onclick="deleteRow(' + rowIndex + ')" class="btn btn-danger">' +
                    '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-dash-circle" viewBox="0 0 16 16">' +
                        '<path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>' +
                        '<path d="M4 8a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7A.5.5 0 0 1 4 8z"/>' +
                    '</svg>' +
                '</button>' +
            '</div>' +
        '</div>'
    );
    rowIndex++;

    $('.select-question').select2({
        placeholder: 'Pilih Soal',
        dropdownParent: $('#modalAddNew'),
        width: '100%'
    });
        
    return false;
}
</script>    
@endpush
