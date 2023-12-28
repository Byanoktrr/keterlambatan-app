@extends('layouts.template')

@section('content')
    <div class="head container">
        <h1>Dashboard</h1>
        <p>Home / <span><b>User</b></span></p>
    </div>
    <div class="d-flex justify-content-between">
        <form action="{{ route('user.index') }}" method="GET" class="d-flex">
            <div class="input-group">
                <input type="name" name="search" class="form-control">
                <button type="submit" class="btn btn-primary">Cari</button>
            </div>
            <a href="{{ route('user.index') }}" class="btn btn'-primary">Resfresh</a>
        </form>
        <div class="d-flex justify-content-end">
            <a class="btn btn-secondary me-2" href="{{ route('user.create') }}">Tambah Akun</a></button>
        </div>
    </div>

    <table class="table table-bordered table-striped mt-3">
        <thead>
            <th>#</th>
            <th>Nama</th>
            <th>Email</th>
            <th>Role</th>
            <th>Aksi</th>
        </thead>
        <tbody>
            @php
                $no = 1;
            @endphp
            @foreach ($users as $item)
                <tr>
                    <td>{{ ($users->currentpage() - 1) * $users->perpage() + $loop->index + 1 }}</td>
                    <td>{{ $item['name'] }}</td>
                    <td>{{ $item['email'] }}</td>
                    <td>{{ $item['role'] }}</td>
                    <td class="d-flex">
                        <a href="{{ route('user.edit', $item['id']) }}" class="btn btn-primary me-2">Edit</a>
                        <form action="{{ route('user.delete', $item['id']) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                data-bs-target="#exampleModal{{ $item['id'] }}">Delete</button>
                            <div class="modal fade" id="exampleModal{{ $item['id'] }}" tabindex="-1"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
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
        @if ($users->count())
            {{ $users->links() }}
        @endif
    </div>
@endsection
