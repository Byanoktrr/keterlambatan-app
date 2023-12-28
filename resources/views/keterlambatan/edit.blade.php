@extends('layouts.template')

@section('content')
    <h1>Dashboard</h1>
    <p>Home / Terlambat / <span><b>Edit Data Terlambat</b></span></p>
    <div class="d-flex justify-content-end">
        <a class="btn btn-secondary me-2" href="{{ route('keterlambatan.index') }}">Kembali</a></button>
    </div>
    <form action="{{ route('keterlambatan.update', $lates['id']) }}" method="post" class="card mt-3 p-5" enctype="multipart/form-data">
        {{-- kalau ada error validasi, akan di tampilkan disini --}}
        @if ($errors->any())
            <ul class="alert alert-danger">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        @endif
        {{-- kalau kedeteksi ada with seession namanya  --}}
        @if (Session::get('success'))
            <div class="alert alert-success">{{ Session::get('success') }}</div>
        @endif
        {{-- token syarat kirim data (agar sistem membaca bahawa data ini berasal dari sumber yang sah) wajib buat kirim data ke database --}}
        @csrf
        @method('PATCH')
        <div class="mb-3 row">
            <label for="nama" class="col-sm-2 col-form-label">Nama</label>
            <div class="col-sm-10">
                <select disabled class="form-control" id="nama" name="student_id">
                    <option  hidden disabled>Pilih nama</option>
                    @foreach ($students as $student)
                        <option selected value="{{ $student['id'] }}"> {{ $lates['students']['name'] }} </option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="mb-3 row">
            <label for="date_time_late" class="col-sm-2 col-form-label @error('date_time_late') is-innvalid @enderror">Waktu
                Terlambat</label>
            <div class="col-sm-10">
                <input type="datetime-local" class="form-control" id="date_time_late" name="date_time_late" value="">
                @error('date_time_late')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="mb-3 row">
            <label for="information"
                class="col-sm-2 col-form-label @error('information') is-innvalid @enderror">information</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="information" name="information" value="">
                @error('date_time_late')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="mb-3 row">
            <label for="bukti" class="col-sm-2 col-form-label @error('bukti') is-innvalid @enderror">bukti</label>
            <div class="col-sm-10">
                <input type="file" class="form-control" id="bukti" name="bukti" value="">
                @error('date_time_late')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Kirim Data</button>
    </form>


@endsection
