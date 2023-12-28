@extends('layouts.template')

@section('content')
    <div class="head container">
        <h1>Dashboard</h1>
        <p>Home / <span><b>Data Rayon</b></span></p>
    </div>
    <div class="d-flex justify-content-between">
        <form action="{{ route('rayon.index') }}" method="GET" class="d-flex">
            <div class="input-group">
                <input type="name" name="search" class="form-control">
                <button type="submit" class="btn btn-primary">Cari</button>
            </div>
            <a href="{{ route('rayon.index') }}" class="btn btn'-primary">Resfresh</a>
        </form>
        <div >
            <a class="btn btn-secondary me-2" href="{{ route('rayon.create') }}">Tambah Rayon</a></button>
        </div>
    </div>
    <table class="table table-bordered table-striped mt-3">
        <thead>
            <th>#</th>
            <th>Rayon</th>
            <th>Pembimbing Siswa</th>
            <th>Aksi</th>
        </thead>    
        <tbody>
            @php
                $no = 1;
            @endphp
            @foreach ($rayons as $rayon)
                <tr>
                    <td>{{ ($rayons->currentpage() - 1) * $rayons->perpage() + $loop->index + 1 }}</td>
                    <td>{{ $rayon['rayon'] }}</td>
                    <td>{{ $rayon['user']['name']}}</td>
                    <td class="d-flex">
                        <a href="{{ route('rayon.edit', $rayon['id'])}}" class="btn btn-primary me-2">Edit</a>
                    </td>
                </tr>   
            @endforeach
        </tbody>
    </table>
    <div class="d-flex justify-content-end">
        @if ($rayons->count())
            {{ $rayons->links() }}
        @endif
    </div>
@endsection
