@extends('layouts.template')

@section('content')
    <h1>Dashboard</h1>
    <p>Home / User / <span><b>Edit Akun</b></span></p>
    <div class="d-flex justify-content-end">
        <a class="btn btn-secondary me-2" href="{{ route('user.index') }}">Kembali</a></button>
    </div>
    <form action="{{ route('user.update', $user['id']) }}" method="POST" class="card mt-3 p-5">
        @if ($errors->any())
            <ul class="alert alert-danger">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        @endif
        @if (Session::get('success'))
            <div class="alert alert-success">{{ Session::get('success') }}</div>
        @endif
        @csrf
        @method('PATCH')
        <div class="mb-3 row">
            <label for="name" class="col-sm-2 col-form-label">Nama</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="name" name="name" value="{{ $user['name'] }}">
            </div>
        </div>
        <div class="mb-3 row">
            <label for="email" class="col-sm-2 col-form-label">Email</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="email" name="email" value="{{ $user['email'] }}">
            </div>
        </div>
        <div class="mb-3 row">
            <label for="type" class="col-sm-2 col-form-label">Role</label>
            <div class="col-sm-10">
                <select class="form-control" id="role" name="role">
                    <option hidden disabled>Pilih</option>
                    <option value="admin" {{ $user['admin'] == 'admin' ? 'selected' : '' }}>Admin</option>
                    <option value="ps" {{ $user['ps'] == 'ps' ? 'selected' : '' }}>Pembimbing Siswa</option>
                </select>
            </div>
        </div>
        <div class="mb-3 row">
            <label for="password" class="col-sm-2 col-form-label">Password</label>
            <div class="col-sm-10">
                <input type="password" class="form-control" id="password" name="password" value="password">
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Kirim Data</button>
    </form>
@endsection
