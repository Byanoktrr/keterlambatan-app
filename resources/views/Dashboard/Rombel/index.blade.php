@extends('layouts.template')

@section('content')
    <div class="head container">
        <h1>Dashboard</h1>
        <p>Home / <span><b>Data Rombel</b></span></p>
    </div>
    <div class="d-flex justify-content-between">
        <form action="{{ route('rombel.index') }}" method="GET" class="d-flex">
            <div class="input-group">
                <input type="name" name="search" class="form-control">
                <button type="submit" class="btn btn-primary">Cari</button>
            </div>
            <a href="{{ route('rombel.index') }}" class="btn btn'-primary">Resfresh</a>
        </form>
        <div>
            <a class="btn btn-secondary me-2" href="{{ route('rombel.create') }}">Tambah Rombel</a></button>
        </div>
    </div>

    <table class="table table-bordered table-striped mt-3">
        <thead>
            <th>No</th>
            <th>Rombel</th>
            <th>Aksi</th>
        </thead>
        <tbody>
            @php
                $no = 1;
            @endphp
            @foreach ($rombles as $rombel)
                <tr>
                    <td> {{ ($rombles->currentpage() - 1) * $rombles->perpage() + $loop->index + 1 }}</td>
                    <td>{{ $rombel['rombles'] }}</td>
                    <td class="d-flex">
                        <a href="{{ route('rombel.edit', $rombel['id']) }}" class="btn btn-primary me-2">Edit</a>
                        <form action="{{ route('rombel.delete', $rombel['id']) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                data-bs-target="#exampleModal">Delete</button>
                            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                                aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="exampleModalLabel">Konfigurasi Hapus</h1>
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
    <div class="d-flex justify-content-end">
        @if ($rombles->count())
            {{ $rombles->links() }}
        @endif
    </div>
@endsection
