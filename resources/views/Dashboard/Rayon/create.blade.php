@extends('layouts.template')

@section('content')
    <h1>Dashboard</h1>
    <p>Home / Data Rayon / <span><b>Tambah Akun</b></span></p>
    <div class="d-flex justify-content-end">
        <a class="btn btn-secondary me-2" href="{{ route('rayon.index') }}">Kembali</a></button>
    </div>
    <form action="{{ route('rayon.store') }}" method="post" class="card mt-3 p-5">
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
            <label for="rayon" class="col-sm-2 col-form-label @error('rayon') is-innvalid @enderror">Rayon</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="rayon" name="rayon" value="{{ old('rayon') }}">
                @error('rayon')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="mb-3 row">
            <label for="user_id" class="col-sm-2 col-form-label">Pembimbing Siswa</label>
            <div class="col-sm-10">
                <select class="form-control" id="user_id" name="user_id">
                    <option selected hidden disabled>Pilih Pembimbing Siswa</option>
                    @foreach ($users as $user)
                    <option value="{{ $user['id'] }}"> {{ $user['name'] }} </option>
                    @endforeach
                </select>
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Kirim Data</button>
    </form>
@endsection
