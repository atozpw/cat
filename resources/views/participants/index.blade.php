@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-6">
            <h2>Peserta</h2>
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
                                <th width="120px">Nomor</th>
                                <th>Nama Lengkap</th>
                                <th>Jenis Kelamin</th>
                                <th>Tempat, Tanggal Lahir</th>
                                <th>Alamat</th>
                                <th width="120px">Opsi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($participants as $participant)
                            <tr>
                                <td>{{ $participant->number }}</td>
                                <td>{{ $participant->name }}</td>
                                <td>{{ $participant->gender }}</td>
                                <td>{{ $participant->birth_place }}, {{ date('d/m/Y', strtotime($participant->birth_date)) }}</td>
                                <td>{{ $participant->address }}</td>
                                <td>
                                    <a class="btn btn-warning btn-sm" id="editParticipant" data-bs-toggle="modal" data-bs-target="#modalEdit" data-id="{{ $participant->id }}">Edit</a>
                                    <a onclick="confirmDelete({{ $participant->id }})" class="btn btn-danger btn-sm">Hapus</a>
                                    <form id="form-delete{{ $participant->id }}" action="{{ route('participants.destroy', [$participant->id]) }}" method="POST" style="display: none;">
                                        @method('DELETE')
                                        @csrf
                                    </form>
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
            {{ $participants->onEachSide(2)->links() }}
        </div>
    </div>
</div>
<div class="modal fade" id="modalAddNew" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Peserta Baru</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('participants.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="form-group mb-3">
                        <label>Nomor Peserta</label>
                        <input type="text" name="number" class="form-control" value="{{ $number }}" readonly>
                    </div>
                    <div class="form-group mb-3">
                        <label>Nama Lengkap</label>
                        <input type="text" name="name" class="form-control">
                    </div>
                    <div class="form-group mb-3">
                        <label for="">Jenis Kelamin</label>
                        <div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="gender" value="Laki-laki" id="genderLakiLaki">
                                <label class="form-check-label" for="genderLakiLaki">Laki-laki</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="gender" value="Perempuan" id="genderPerempuan">
                                <label class="form-check-label" for="genderPerempuan">Perempuan</label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group mb-3">
                        <label>Tempat Lahir</label>
                        <input type="text" name="birth_place" class="form-control">
                    </div>
                    <div class="form-group mb-3">
                        <label>Tanggal Lahir</label>
                        <input type="date" name="birth_date" class="form-control">
                    </div>
                    <div class="form-group mb-3">
                        <label>Alamat</label>
                        <textarea name="address" class="form-control" rows="3"></textarea>
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

@push('script')
<script>
$(document).ready(function () {
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
</script>    
@endpush
