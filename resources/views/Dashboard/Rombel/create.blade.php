@extends('layouts.template')

@section('content')
<h1>Dashboard</h1>
<p>Home / Data Rombel / <span><b>Tambah Rombel</b></span></p>
<div class="d-flex justify-content-end">
    <a class="btn btn-secondary me-2" href="{{ route('rombel.index') }}">Kembali</a></button>
</div>
<form action="{{ route('rombel.store') }}" method="post" class="card mt-3 p-5">
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
        <label for="rombles" class="col-sm-2 col-form-label @error('rombles') is-innvalid @enderror">rombles</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="rombles" name="rombles" value="{{ old('rombles') }}">
            @error('rombles')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
    </div>
    <button type="submit" class="btn btn-primary">Kirim Data</button>
</form>
@endsection