@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-6">
            <h2>Master Table</h2>
        </div>
        <div class="col-md-12">
            <div class="card">
                <div class="card-body p-0 table-responsive">
                    <table class="table mb-0">
                        <thead class="table-secondary">
                            <tr>
                                <th rowspan="2" class="align-middle">No. Urut</th>
                                <th colspan="4" class="text-center">Data Identitas</th>
                                <th colspan="4" class="text-center">Kecerdasan</th>
                                <th colspan="6" class="text-center">Kepribadian</th>
                                <th colspan="3" class="text-center">Kecermatan</th>
                                <th rowspan="2" class="text-center align-middle">Nilai PSI</th>
                                <th rowspan="2" class="text-center align-middle">KAT</th>
                                <th rowspan="2" class="text-center align-middle">Hasil PSI</th>
                            </tr>
                            <tr>
                                <th class="align-middle">No. Ujian</th>
                                <th class="align-middle">Nama Lengkap</th>
                                <th class="align-middle">Jenis Kelamin</th>
                                <th class="align-middle">Pendidikan</th>
                                <th class="text-center align-middle">Berfikir Praktis</th>
                                <th class="text-center align-middle">Berfikir Verbal</th>
                                <th class="text-center align-middle">Berfikir Logis</th>
                                <th class="text-center align-middle">Berfikir Analitis</th>
                                <th class="text-center align-middle">Stabilitas Emosi</th>
                                <th class="text-center align-middle">Prososial</th>
                                <th class="text-center align-middle">Penyesuaian Diri</th>
                                <th class="text-center align-middle">Kepercayaan Diri</th>
                                <th class="text-center align-middle">Motif Berprestasi</th>
                                <th class="text-center align-middle">Pengambilan Keputusan</th>
                                <th class="text-center align-middle">Kecepatan</th>
                                <th class="text-center align-middle">Ketelitian</th>
                                <th class="text-center align-middle">Ketahanan</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>220001</td>
                                <td>Asep Suprapto</td>
                                <td>Pria</td>
                                <td>S1</td>
                                <td class="text-center">10</td>
                                <td class="text-center">10</td>
                                <td class="text-center">10</td>
                                <td class="text-center">10</td>
                                <td class="text-center">10</td>
                                <td class="text-center">10</td>
                                <td class="text-center">10</td>
                                <td class="text-center">10</td>
                                <td class="text-center">10</td>
                                <td class="text-center">10</td>
                                <td class="text-center">10</td>
                                <td class="text-center">10</td>
                                <td class="text-center">10</td>
                                <td class="text-center">10</td>
                                <td class="text-center">10</td>
                                <td class="text-center">10</td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td>220002</td>
                                <td>Asep Suprapto</td>
                                <td>Pria</td>
                                <td>S1</td>
                                <td class="text-center">10</td>
                                <td class="text-center">10</td>
                                <td class="text-center">10</td>
                                <td class="text-center">10</td>
                                <td class="text-center">10</td>
                                <td class="text-center">10</td>
                                <td class="text-center">10</td>
                                <td class="text-center">10</td>
                                <td class="text-center">10</td>
                                <td class="text-center">10</td>
                                <td class="text-center">10</td>
                                <td class="text-center">10</td>
                                <td class="text-center">10</td>
                                <td class="text-center">10</td>
                                <td class="text-center">10</td>
                                <td class="text-center">10</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
