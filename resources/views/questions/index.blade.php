@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-6">
            <h2>Soal</h2>
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
                                <th>Kategori Soal</th>
                                <th>Waktu Pengerjaan</th>
                                <th>Jumlah Soal</th>
                                <th width="220px">Opsi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($questioncategories as $questioncategory)
                            <tr>
                                <td>{{ $questioncategory->name }}</td>
                                <td>{{ $questioncategory->duration }}</td>
                                <td>{{ $questioncategory->question_count }}</td>
                                <td>
                                    <a href="{{ route('questioncategories.show', [$questioncategory->id]) }}" class="btn btn-info btn-sm">Mata Soal</a>
                                    <a class="btn btn-warning btn-sm" id="editCategory" data-bs-toggle="modal" data-bs-target="#modalEdit" data-id="{{ $questioncategory->id }}">Edit</a>
                                    <a onclick="confirmDelete({{ $questioncategory->id }})" class="btn btn-danger btn-sm">Hapus</a>
                                    <form id="form-delete{{ $questioncategory->id }}" action="{{ route('questioncategories.destroy', [$questioncategory->id]) }}" method="POST" style="display: none;">
                                        @method('DELETE')
                                        @csrf
                                    </form>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="text-center">Tidak ada data</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            {{ $questioncategories->onEachSide(2)->links() }}
        </div>
    </div>
</div>
<div class="modal fade" id="modalAddNew" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Kategori Baru</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('questioncategories.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="form-group mb-3">
                        <label>Nama Kategori</label>
                        <input type="text" name="name" class="form-control">
                    </div>
                    <div class="form-group mb-3">
                        <label>Waktu Pengerjaan</label>
                        <input type="time" name="duration" class="form-control">
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
                <h5 class="modal-title">Edit Kategori</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="formEditCategory" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="form-group mb-3">
                        <label>Nama Kategori</label>
                        <input id="category_name" type="text" name="name" class="form-control">
                    </div>
                    <div class="form-group mb-3">
                        <label>Waktu Pengerjaan</label>
                        <input id="category_duration" type="time" name="duration" class="form-control">
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
    $('body').on('click', '#editCategory', function (event) {
        event.preventDefault();
        var id = $(this).data('id');
        document.getElementById('formEditCategory').action = '/questioncategories/' + id;
        $.get('/questioncategories/' + id, function (data) {
            $('#category_name').val(data.name);
            $('#category_duration').val(data.duration);
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
