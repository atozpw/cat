@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8">
            <h2>Psikogram</h2>
        </div>
        <div class="col-md-4">
            <select name="user_id" class="select-participant">
                <option value="">Pilih Peserta</option>
                @foreach ($participants as $participant)
                <option value="{{ $participant->id }}">{{ $participant->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-12">
            <div class="card mt-2">
                <div class="card-body pb-0">
                    <table class="table table-borderless">
                        <tbody>
                            <tr>
                                <td width="150px">No. Ujian</td>
                                <td>: </td>
                                <td width="150px">Tanggal Ujian</td>
                                <td>: </td>
                            </tr>
                            <tr>
                                <td>Nama Peserta</td>
                                <td>: </td>
                                <td>Tempat Ujian</td>
                                <td>: </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="card mt-3">
                <div class="card-body p-0">
                    <table class="table mb-0">
                        <thead class="table-secondary">
                            <tr>
                                <th class="text-center" width="60px">No</th>
                                <th>Aspek Psikologi</th>
                                <th class="text-center" width="80px">B</th>
                                <th class="text-center" width="80px">CB</th>
                                <th class="text-center" width="80px">C</th>
                                <th class="text-center" width="80px">K</th>
                                <th class="text-center" width="80px">KS</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="text-center">1</td>
                                <td>Kemampuan Berfikir Praktis</td>
                                <td class="text-center"></td>
                                <td class="text-center"></td>
                                <td class="text-center"></td>
                                <td class="text-center"></td>
                                <td class="text-center"></td>
                            </tr>
                            <tr>
                                <td class="text-center">2</td>
                                <td>Kemampuan Berfikir Verbal</td>
                                <td class="text-center"></td>
                                <td class="text-center"></td>
                                <td class="text-center"></td>
                                <td class="text-center"></td>
                                <td class="text-center"></td>
                            </tr>
                            <tr>
                                <td class="text-center">3</td>
                                <td>Kemampuan Berfikir Logis</td>
                                <td class="text-center"></td>
                                <td class="text-center"></td>
                                <td class="text-center"></td>
                                <td class="text-center"></td>
                                <td class="text-center"></td>
                            </tr>
                            <tr>
                                <td class="text-center">4</td>
                                <td>Kemampuan Berfikir Analitis</td>
                                <td class="text-center"></td>
                                <td class="text-center"></td>
                                <td class="text-center"></td>
                                <td class="text-center"></td>
                                <td class="text-center"></td>
                            </tr>
                            <tr>
                                <td class="text-center">5</td>
                                <td>Stabilitas Emosi</td>
                                <td class="text-center"></td>
                                <td class="text-center"></td>
                                <td class="text-center"></td>
                                <td class="text-center"></td>
                                <td class="text-center"></td>
                            </tr>
                            <tr>
                                <td class="text-center">6</td>
                                <td>Prososial</td>
                                <td class="text-center"></td>
                                <td class="text-center"></td>
                                <td class="text-center"></td>
                                <td class="text-center"></td>
                                <td class="text-center"></td>
                            </tr>
                            <tr>
                                <td class="text-center">7</td>
                                <td>Penyesuaian Diri</td>
                                <td class="text-center"></td>
                                <td class="text-center"></td>
                                <td class="text-center"></td>
                                <td class="text-center"></td>
                                <td class="text-center"></td>
                            </tr>
                            <tr>
                                <td class="text-center">8</td>
                                <td>Kepercayaan Diri</td>
                                <td class="text-center"></td>
                                <td class="text-center"></td>
                                <td class="text-center"></td>
                                <td class="text-center"></td>
                                <td class="text-center"></td>
                            </tr>
                            <tr>
                                <td class="text-center">9</td>
                                <td>Motif Berprestasi</td>
                                <td class="text-center"></td>
                                <td class="text-center"></td>
                                <td class="text-center"></td>
                                <td class="text-center"></td>
                                <td class="text-center"></td>
                            </tr>
                            <tr>
                                <td class="text-center">10</td>
                                <td>Pengambilan Keputusan</td>
                                <td class="text-center"></td>
                                <td class="text-center"></td>
                                <td class="text-center"></td>
                                <td class="text-center"></td>
                                <td class="text-center"></td>
                            </tr>
                            <tr>
                                <td class="text-center">11</td>
                                <td>Kecepatan</td>
                                <td class="text-center"></td>
                                <td class="text-center"></td>
                                <td class="text-center"></td>
                                <td class="text-center"></td>
                                <td class="text-center"></td>
                            </tr>
                            <tr>
                                <td class="text-center">12</td>
                                <td>Ketelitian</td>
                                <td class="text-center"></td>
                                <td class="text-center"></td>
                                <td class="text-center"></td>
                                <td class="text-center"></td>
                                <td class="text-center"></td>
                            </tr>
                            <tr>
                                <td class="text-center">13</td>
                                <td>Ketahanan</td>
                                <td class="text-center"></td>
                                <td class="text-center"></td>
                                <td class="text-center"></td>
                                <td class="text-center"></td>
                                <td class="text-center"></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card mt-3">
                <div class="card-body p-0">
                    <table class="table mb-0">
                        <thead class="table-secondary">
                            <tr>
                                <th class="text-center">Nilai / Posisi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="text-center">&nbsp;</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card mt-3">
                <div class="card-body p-0">
                    <table class="table mb-0">
                        <thead class="table-secondary">
                            <tr>
                                <th class="text-center">Kesimpulan</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="text-center">&nbsp;</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
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
$(document).ready(function () {
    $('.select-participant').select2({
        placeholder: 'Pilih Peserta',
        width: '100%'
    });
})
</script>    
@endpush
