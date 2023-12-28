@extends('layouts.template')

@section('content')
    <div class="head container">
        <h1>Dashboard</h1>
        <p>Home / <span><b>Data Siswa</b></span></p>
    </div>
    <div class="d-flex justify-content-between">
        <form action="{{ route('student.index') }}" method="GET" class="d-flex">
            <div class="input-group">
                <input type="name" name="search" class="form-control">
                <button type="submit" class="btn btn-primary">Cari</button>
            </div>
            <a href="{{ route('student.index') }}" class="btn btn'-primary">Resfresh</a>
        </form>
        <div >
            <a class="btn btn-secondary me-2" href="{{ route('student.create') }}">Tambah Siswa</a></button>
        </div>
    </div>
    <table class="table table-bordered table-striped mt-3">
        <thead>
            <th>#</th>
            <th>Nis</th>
            <th>Nama</th>
            <th>Rombel</th>
            <th>Rayon</th>
        </thead>
        <tbody>
            @php
                $no = 1;
            @endphp
            @foreach ($students as $student)
                <tr>
                    <td>{{ $no++ }}</td>
                    <td>{{ $student['nis'] }}</td>
                    <td>{{ $student['name'] }}</td>
                    <td>{{ $student['rombel']['rombles'] }}</td>
                    <td>{{ $student['rayon']['rayon'] }}</td>
                    <td class="d-flex">
                        <a href="{{ route('student.edit', $student['id']) }}" class="btn btn-primary me-2">Edit</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
