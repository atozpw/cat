@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-6">
            <h2>Soal - {{ $question_category->name }}</h2>
        </div>
        <div class="col-md-6">
            <a href="{{ route('questioncategories.index') }}" class="btn btn-secondary float-end">
                Batal
            </a>
        </div>
        <div class="col-md-12">
            <div class="card mt-2">
                <div class="card-body">
                    <nav>
                        <div class="nav nav-tabs mb-3">
                            <a href="?page=create" class="nav-link btn @if($page == 'create' || $page == 'edit') active @endif">
                                @if ($page == 'edit') 
                                Edit Mata Soal
                                @else
                                Buat Mata Soal Baru
                                @endif
                            </a>
                            <a href="?page=list" class="nav-link btn @if($page == 'list') active @endif">Daftar Mata Soal</a>
                        </div>
                    </nav>
                    <div class="tab-content">
                        @if ($page == 'create' || $page == 'edit')
                        <div class="tab-pane active">
                            @if ($page == 'edit')
                            <form action="{{ route('questions.update', [$question->id]) }}" method="POST">
                                @method('PUT')
                            @else
                            <form action="{{ route('questions.store') }}" method="POST">
                            @endif
                                @csrf
                                <div class="row">
                                    <div class="col-md-2 form-group mb-2">
                                        <label>Nomor Soal</label>
                                        <input type="text" name="number" class="form-control" value="{{ $sequence }}">
                                        <input type="hidden" name="question_category_id" value="{{ $question_category_id }}">
                                    </div>
                                    <div class="col-md-10 form-group mb-3">
                                        <label>Pertanyaan / Pernyataan</label>
                                        <textarea id="ckeditor0" name="content" class="form-control">
                                            @if ($page == 'edit')
                                            {{ $question->content }}
                                            @endif
                                        </textarea>
                                    </div>
                                    <hr>
                                    <div class="offset-md-2 col-md-10 mb-2">
                                        <button onclick="getAnswerPreviousQuestion()" type="button" class="btn btn-secondary">Ambil Pilihan Jawaban dari Soal Sebelumnya</button>
                                    </div>
                                    <div class="col-md-2 form-group mb-2">
                                        <input type="text" name="sequence[]" class="form-control" value="a">
                                        <div class="form-check form-check-inline mt-2">
                                            @php 
                                            $isCheckedA = '';
                                            if ($page == 'edit') {
                                                if (!empty($question->question_details[0])) {
                                                    if ($question->question_details[0]->is_answer == 1) {
                                                        $isCheckedA = 'checked';
                                                    }
                                                }
                                            }
                                            @endphp
                                            <input class="form-check-input" type="checkbox" name="is_answer[0]" id="jawabanA" value="1" {{ $isCheckedA }}>
                                            <label class="form-check-label" for="jawabanA">Jawaban Benar</label>
                                        </div>
                                    </div>
                                    <div class="col-md-10 form-group mb-2">
                                        <textarea id="ckeditor1" name="choice[]" class="form-control">
                                            @if ($page == 'edit')
                                            {{ empty($question->question_details[0]) ? '' : $question->question_details[0]->choice }}
                                            @endif
                                        </textarea>
                                    </div>
                                    <div class="col-md-2 form-group mb-2">
                                        <input type="text" name="sequence[]" class="form-control" value="b">
                                        <div class="form-check form-check-inline mt-2">
                                            @php 
                                            $isCheckedB = '';
                                            if ($page == 'edit') {
                                                if (!empty($question->question_details[1])) {
                                                    if ($question->question_details[1]->is_answer == 1) {
                                                        $isCheckedB = 'checked';
                                                    }
                                                }
                                            }
                                            @endphp
                                            <input class="form-check-input" type="checkbox" name="is_answer[1]" id="jawabanB" value="1" {{ $isCheckedB }}>
                                            <label class="form-check-label" for="jawabanB">Jawaban Benar</label>
                                        </div>
                                    </div>
                                    <div class="col-md-10 form-group mb-2">
                                        <textarea id="ckeditor2" name="choice[]" class="form-control">
                                            @if ($page == 'edit')
                                            {{ empty($question->question_details[1]) ? '' : $question->question_details[1]->choice }}
                                            @endif
                                        </textarea>
                                    </div>
                                    <div class="col-md-2 form-group mb-2">
                                        <input type="text" name="sequence[]" class="form-control" value="c">
                                        <div class="form-check form-check-inline mt-2">
                                            @php 
                                            $isCheckedC = '';
                                            if ($page == 'edit') {
                                                if (!empty($question->question_details[2])) {
                                                    if ($question->question_details[2]->is_answer == 1) {
                                                        $isCheckedC = 'checked';
                                                    }
                                                }
                                            }
                                            @endphp
                                            <input class="form-check-input" type="checkbox" name="is_answer[2]" id="jawabanC" value="1" {{ $isCheckedC }}>
                                            <label class="form-check-label" for="jawabanC">Jawaban Benar</label>
                                        </div>
                                    </div>
                                    <div class="col-md-10 form-group mb-2">
                                        <textarea id="ckeditor3" name="choice[]" class="form-control">
                                            @if ($page == 'edit')
                                            {{ empty($question->question_details[2]) ? '' : $question->question_details[2]->choice }}
                                            @endif
                                        </textarea>
                                    </div>
                                    <div class="col-md-2 form-group mb-2">
                                        <input type="text" name="sequence[]" class="form-control" value="d">
                                        <div class="form-check form-check-inline mt-2">
                                            @php 
                                            $isCheckedD = '';
                                            if ($page == 'edit') {
                                                if (!empty($question->question_details[3])) {
                                                    if ($question->question_details[3]->is_answer == 1) {
                                                        $isCheckedD = 'checked';
                                                    }
                                                }
                                            }
                                            @endphp
                                            <input class="form-check-input" type="checkbox" name="is_answer[3]" id="jawabanD" value="1" {{ $isCheckedD }}>
                                            <label class="form-check-label" for="jawabanD">Jawaban Benar</label>
                                        </div>
                                    </div>
                                    <div class="col-md-10 form-group mb-2">
                                        <textarea id="ckeditor4" name="choice[]" class="form-control">
                                            @if ($page == 'edit')
                                            {{ empty($question->question_details[3]) ? '' : $question->question_details[3]->choice }}
                                            @endif
                                        </textarea>
                                    </div>
                                    <div class="col-md-2 form-group mb-2">
                                        <input type="text" name="sequence[]" class="form-control" value="e">
                                        <div class="form-check form-check-inline mt-2">
                                            @php 
                                            $isCheckedE = '';
                                            if ($page == 'edit') {
                                                if (!empty($question->question_details[4])) {
                                                    if ($question->question_details[4]->is_answer == 1) {
                                                        $isCheckedE = 'checked';
                                                    }
                                                }
                                            }
                                            @endphp
                                            <input class="form-check-input" type="checkbox" name="is_answer[4]" id="jawabanE" value="1" {{ $isCheckedE }}>
                                            <label class="form-check-label" for="jawabanE">Jawaban Benar</label>
                                        </div>
                                    </div>
                                    <div class="col-md-10 form-group mb-2">
                                        <textarea id="ckeditor5" name="choice[]" class="form-control">
                                            @if ($page == 'edit')
                                            {{ empty($question->question_details[4]) ? '' : $question->question_details[4]->choice }}
                                            @endif
                                        </textarea>
                                    </div>
                                    <div class="col-md-10 offset-md-2 mt-2">
                                        <div class="d-grid">
                                            <button type="submit" class="btn btn-primary btn-lg">Simpan</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        @endif
                        @if($page == 'list')
                        <style>p{margin-bottom:0}</style>
                        <div class="tab-pane active">
                            <table class="table table-borderless">
                                <tbody>
                                    @foreach ($questions as $question)
                                    <tr>
                                        <td width="10px" rowspan="2">{{ $question->number }}.</td>
                                        <td>{!! $question->content !!}</td>
                                        <td width="120px" rowspan="2">
                                            <a href="?page=edit&id={{ $question->id }}" class="btn btn-warning btn-sm">Edit</a>
                                            <a onclick="confirmDelete({{ $question->id }})" class="btn btn-danger btn-sm">Hapus</a>
                                            <form id="form-delete{{ $question->id }}" action="{{ route('questions.destroy', [$question->id]) }}" method="POST" style="display: none;">
                                                @method('DELETE')
                                                @csrf
                                            </form>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="p-0">
                                            <table class="table table-borderless table-sm">
                                                <tbody>
                                                    @foreach ($question->question_details as $question_detail)
                                                    <tr>
                                                        <td width="25px" class="text-success">
                                                            @if ($question_detail->is_answer == 1)
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check-circle-fill" viewBox="0 0 16 16">
                                                                <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
                                                            </svg>
                                                            @endif
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
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('script')
@if ($page == 'create' || $page == 'edit')
<script src="{{ asset('vendor/ckeditor5-build-classic/ckeditor.js') }}"></script>
<script>
class MyUploadAdapter {
    constructor(loader) {
        this.loader = loader;
    }

    upload() {
        return this.loader.file
            .then(file => new Promise((resolve, reject) => {
                this._initRequest();
                this._initListeners(resolve, reject, file);
                this._sendRequest(file);
            }));
    }

    abort() {
        if (this.xhr) {
            this.xhr.abort();
        }
    }

    _initRequest() {
        const xhr = this.xhr = new XMLHttpRequest();
        xhr.open( 'POST', "{{ route('upload', ['_token' => csrf_token() ])}}", true);
        xhr.responseType = 'json';
    }

    _initListeners(resolve, reject, file) {
        const xhr = this.xhr;
        const loader = this.loader;
        const genericErrorText = `Couldn't upload file: ${ file.name }.`;

        xhr.addEventListener('error', () => reject(genericErrorText));
        xhr.addEventListener('abort', () => reject());
        xhr.addEventListener('load', () => {
            const response = xhr.response;
            if (!response || response.error) {
                return reject(response && response.error ? response.error.message : genericErrorText);
            }
            resolve(response);
        });

        if (xhr.upload) {
            xhr.upload.addEventListener('progress', evt => {
                if (evt.lengthComputable) {
                    loader.uploadTotal = evt.total;
                    loader.uploaded = evt.loaded;
                }
            });
        }
    }

    _sendRequest(file) {
        const data = new FormData();
        data.append('upload', file);
        this.xhr.send(data);
    }
}

function MyCustomUploadAdapterPlugin(editor) {
    editor.plugins.get('FileRepository').createUploadAdapter = (loader) => {
        return new MyUploadAdapter(loader);
    };
}
</script>
<script>
    var csrf_token = $('meta[name=csrf-token]').attr('content');

    let editor0;
    let editor1;
    let editor2;
    let editor3;
    let editor4;
    let editor5;

    ClassicEditor.create(document.querySelector('#ckeditor0'), {extraPlugins: [MyCustomUploadAdapterPlugin]})
        .then(editor => { editor0 = editor }).catch(error => { alert(error) });

    ClassicEditor.create(document.querySelector('#ckeditor1'), {extraPlugins: [MyCustomUploadAdapterPlugin]})
        .then(editor => { editor1 = editor }).catch(error => { alert(error) });

    ClassicEditor.create(document.querySelector('#ckeditor2'), {extraPlugins: [MyCustomUploadAdapterPlugin]})
        .then(editor => { editor2 = editor }).catch(error => { alert(error) });

    ClassicEditor.create(document.querySelector('#ckeditor3'), {extraPlugins: [MyCustomUploadAdapterPlugin]})
        .then(editor => { editor3 = editor }).catch(error => { alert(error) });

    ClassicEditor.create(document.querySelector('#ckeditor4'), {extraPlugins: [MyCustomUploadAdapterPlugin]})
        .then(editor => { editor4 = editor }).catch(error => { alert(error) });

    ClassicEditor.create(document.querySelector('#ckeditor5'), {extraPlugins: [MyCustomUploadAdapterPlugin]})
        .then(editor => { editor5 = editor }).catch(error => { alert(error) });

    function getAnswerPreviousQuestion() {
        var question_category_id = $('input[name="question_category_id"]').val();
        $.post("{{ route('questioncategories.get_answer_previous_question') }}", { 
            _token: csrf_token,
            question_category_id: question_category_id
        },
        function(response) {
            if (response[0]) editor1.setData(response[0].choice);
            if (response[1]) editor2.setData(response[1].choice);
            if (response[2]) editor3.setData(response[2].choice);
            if (response[3]) editor4.setData(response[3].choice);
            if (response[4]) editor5.setData(response[4].choice);
        });
    }
</script>
@endif
<script>
    function confirmDelete(value) {
        var alert = window.confirm("Yakin ingin dihapus?")
        if (alert) {
            event.preventDefault();
            document.getElementById('form-delete' + value).submit();
        }
        else {
            return true
        }
    }
</script>
@endpush
