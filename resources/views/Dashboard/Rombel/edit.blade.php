@extends('layouts.template')

@section('content')
    <div class="head container">
        <h1>Dashboard</h1>
        <p>Home / <span><b>Data Rombel</b></span></p>
    </div>
    <div class="d-flex justify-content-end">
        <a class="btn btn-secondary me-2" href="{{ route('rombel.index') }}">Kembali</a></button>
    </div>
    <form action="{{ route('rombel.update', $rombel['id']) }}" method="POST" class="card mt-3 p-5">
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
            <label for="rombles" class="col-sm-2 col-form-label">Nama Rombel Sebelumnya</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="rombles" name="rombles" disabled
                    value="{{ $rombel['rombles'] }}">
            </div>
        </div>
        <div class="mb-3 row">
            <label for="rombles" class="col-sm-2 col-form-label">Nama Rombel Baru</label>
            <div class="col-sm-10">
                <input type="rombles" class="form-control" id="rombles" name="rombles" value="">
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Kirim Data</button>
    </form>


@endsection
