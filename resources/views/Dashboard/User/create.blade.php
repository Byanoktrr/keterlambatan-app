@extends('layouts.template')

@section('content')
    <h1>Dashboard</h1>
    <p>Home / User / <span><b>Tambah Akun</b></span></p>
    <div class="d-flex justify-content-end">
        <a class="btn btn-secondary me-2" href="{{ route('user.index') }}">Kembali</a></button>
    </div>
    <form action="{{ route('user.store') }}" method="post" class="card mt-3 p-5" enctype="multipart/form-data">
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
        <div class="mb-3 row">
            <label for="name" class="col-sm-2 col-form-label @error('name') is-innvalid @enderror">Nama</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}">
                @error('name')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="mb-3 row">
            <label for="email" class="col-sm-2 col-form-label @error('email') is-innvalid @enderror">Email</label>
            <div class="col-sm-10">
                <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}">
                @error('email')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="mb-3 row">
            <label for="role" class="col-sm-2 col-form-label">Role</label>
            <div class="col-sm-10">
                <select class="form-control" id="role" name="role">
                    <option selected hidden disabled>Pilih Role</option>
                    <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                    <option value="ps" {{ old('role') == 'ps' ? 'selected' : '' }}>Pembimbing Siswa</option>
                </select>
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Kirim Data</button>
    </form>
@endsection
