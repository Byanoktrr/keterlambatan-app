@extends('layouts.template')

@section('content')
<h1>Data terlambat</h1>
    <p>Home / Data Keterlambatan / <span><b>Detail Data Keterlambatan</b></span></p>

<section class="item">

<div class="container">
<h6><b>Detail Data Keterlambatan {{$student->name}} | 
    {{$student->nis}} | 
    <?php
$rombel = DB::table('rombels')->where('id', $student->rombel_id)->first();
$rayon = DB::table('rayons')->where('id', $student->rayon_id)->first();
?>
    {{ $rombel->rombles }} | 
    {{ $rayon->rayon }}</b></h6>
    <div class="row">
        @foreach ($lates as $late)
        <div class="col-md-4">
            <div class="card border-0">
                <div class="card-body">
                <h4 class="text-left">Keterlambatan ke {{$loop->iteration}}</h4>
    
                <h6 class="text-left">{{ $late->date_time_late }}</h6>
                <h6 class="text-left text-primary">{{ $late->information }}</h6>       
                        
                <div class="text-center">
                    <img class="align-center img-fluid" src="{{ asset('storage/images/' . $late->bukti) }}" width="100px">
                </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    <a href="{{ route('keterlambatan.index') }}" class="btn btn-primary">Kembali</a>
</div>

<style>
.item {
    background-color: #ffff;
}

</style>
</section>
@endsection