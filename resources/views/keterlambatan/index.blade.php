@extends('layouts.template')

@section('content')
    <h1>Data terlambat</h1>
    <p>Home / <span><b>Terlambat</b></span></p>
    <div class="my-4">
        <a href="{{ route('keterlambatan.create') }}" class="btn btn-primary">Tambah</i></a>
        <a href="" class="btn btn-info text-white">Export Data Keterlambatan</i></a>
    </div>
    <ul class="nav nav-tabs" role="tablist">
        <li class="nav-item" role="presentation">
            <a class="nav-link active" id="simple-tab-0" data-bs-toggle="tab" href="#simple-tabpanel-0" role="tab"
                aria-controls="simple-tabpanel-0" aria-selected="true">Keseluruhan Data</a>
        </li>
        <li class="nav-item" role="presentation">
            <a class="nav-link" id="simple-tab-1" data-bs-toggle="tab" href="#simple-tabpanel-1" role="tab"
                aria-controls="simple-tabpanel-1" aria-selected="false">Rekapitulasi Data</a>
        </li>
    </ul>
    <div class="tab-content pt-5" id="tab-content">
        <div class="tab-pane active" id="simple-tabpanel-0" role="tabpanel" aria-labelledby="simple-tab-0">
            <table class="table table-bordered table-striped mt-3">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Tanggal</th>
                        <th>Informasi</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $no = 1;
                    @endphp
                    @foreach ($lates as $late)
                        <tr>
                            <td>{{ $no++ }}</td>
                            <td>{{ $late->students->name}}</td>
                            <td>{{ $late['date_time_late'] }}</td>
                            <td>{{ $late['information'] }}</td>
                            <td class="d-flex">
                                <a href="{{ route('keterlambatan.edit', $late['id']) }}"
                                    class="btn btn-primary me-2">Edit</a>
                                <form action="{{ route('keterlambatan.delete', $late['id']) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                        data-bs-target="#exampleModal{{ $late['id'] }}">Delete</button>
                                    <div class="modal fade" id="exampleModal{{ $late['id'] }}" tabindex="-1"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Konfigurasi Hapus
                                                    </h1>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    Yakin Anda Ingin Menghapus Data ini ?
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-danger">Delete</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="tab-pane" id="simple-tabpanel-1" role="tabpanel" aria-labelledby="simple-tab-1">
            <table class="table table-bordered table-striped mt-3">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nis</th>
                        <th>Nama</th>
                        <th>Jumlah Keterlambatan</th>
                        <th>aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $no = 1;
                    @endphp
                    {{-- @foreach ($rayons as $rayon) --}}
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td class="d-flex"> </td>
                    </tr>
                    {{-- @endforeach --}}
                </tbody>
            </table>
        </div>
    </div>
@endsection
