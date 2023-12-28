@extends('layouts.template')

@section('content')
    <h1>Dashboard</h1>
    <p>Home / Data Siswa / <span><b>Edit Data Siswa</b></span></p>
    <div class="d-flex justify-content-end">
        <a class="btn btn-secondary me-2" href="{{ route('student.index')}}">Kembali</a></button>
    </div>
    <form action="{{ route('student.update', $students['id']) }}" method="post" class="card mt-3 p-5">
        @if ($errors->any())
            <ul class="alert alert-danger">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        @endif
        @csrf
        @method('PATCH')   
        @if (Session::get('success'))
            <div class="alert alert-success">{{ Session::get('success') }}</div>
        @endif
        @csrf
        <div class="mb-3 row">
            <label for="nis" class="col-sm-2 col-form-label @error('nis') is-innvalid @enderror">NIS</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="nis" name="nis" value="{{ $students['nis'] }}">
                @error('nis')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="mb-3 row">
            <label for="name" class="col-sm-2 col-form-label @error('name') is-innvalid @enderror">Nama</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="name" name="name" value="{{ $students['name'] }}">
                @error('name')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="mb-3 row">
            <label for="user_id" class="col-sm-2 col-form-label">Rombel</label>
            <div class="col-sm-10">
                <select class="form-control" id="rombel_id" name="rombel_id">
                    <option selected hidden disabled>Pilih Rombel</option>
                    @foreach ($rombels as $rombel)
                        <option selected value="{{ $rombel['rombles'] }}">{{ $rombel['rombles'] }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="mb-3 row">
            <label for="user_id" class="col-sm-2 col-form-label">Rayon</label>
            <div class="col-sm-10">
                <select class="form-control" id="rayon_id" name="rayon_id">
                    <option selected hidden disabled>Pilih Rayon</option>
                    @foreach ($rayons as $rayon)
                        <option selected value="{{ $rayon['rayon'] }}">{{ $rayon['rayon'] }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Kirim Data</button>
    </form>
@endsection
