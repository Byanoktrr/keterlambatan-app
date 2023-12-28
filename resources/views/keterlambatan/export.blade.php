<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Surat Pernyataan Siswa </title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />

</head>

<body>
    <div class="container mt-5">
    <h5 class="h5 text-center">SURAT PERNYATAAN <br>TIDAK AKAN DATANG TERLAMBAT SEKOLAH</h5>
    <p class="justify mt-5">Yang bertanda tangan dibawah ini :</p>
    <h6 class="justify mt-5">Nama : {{ $late->students->name }}</h6>
    <h6 class="justify">NIS : {{ $late->students->nis }}</h6>
    <?php
$rombel = DB::table('rombels')->where('id', $student->rombel_id)->first();
$rayon = DB::table('rayons')->where('id', $student->rayon_id)->first();
$ps = DB::table('users')->where('id', $rayon->user_id)->first();
?>

<h6 class="text-left">Rombel : {{ $rombel ? $rombel->rombles : 'N/A' }}</h6>    
<h6 class="text-left">Rayon : {{ $rayon ? $rayon->rayon : 'N/A' }}</h6>


    <p class="mt-5">Dengan ini menyatakan bahwa saya telah melakukan pelanggaran tata tertib sekolah, yaitu terlambat datang ke sekolah sebanyak <b>{{ $rekap->first()->total }} kali</b> yang mana hal tersebut termasuk kedalam pelanggaran kedisiplinan. Saya Berjanji tidak akan terlambat datang ke sekolah lagi. Apabila saya terlambat datang ke sekolah lagi saya siap deiberikan sanksi yang sesuai dengan peraturan sekolah.</p>
    <p class="mt-5">Demikian surat pernyataan ini saya buat dengan penuh penyesalan.</p>


    <section class="container ttd">
    <table style="width: 100%;">
    <tr>
    <td style="width: 50%; padding: 10px;">
                    <div class="card border-0">
                        <div class="signature">
                            <h6 class="text-center mt-5">Peserta Didik</h6>
                            <div class="signature-box"></div>
                            <h6 class="text-center mt-5">{{ $late->students->name }}</h6>
                        </div>
                    </div>
                </td>
                <td style="width: 50%; padding: 10px;">
                    <div class="card border-0">
                        <div class="signature">
                            <h6 class="text-center mt-5">Ortu Peserta Didik</h6>
                            <div class="signature-box"></div>
                            <h6 class="text-center mt-5">(....................)</h6>
                        </div>
                    </div>
                </td>
            </tr>
            <tr>
                <td style="width: 50%; padding: 10px;">
                    <div class="card border-0">
                        <div class="signature">
                            <h6 class="text-center mt-5">Pembimbing Siswa</h6>
                            <div class="signature-box"></div>
                            <h6 class="text-center mt-5">{{ $ps ? $ps->name : 'N/A' }} (Pembimbing Siswa {{ $rayon ? $rayon->rayon : 'N/A' }} )</h6>
                        </div>
                    </div>
                </td>
                <td style="width: 50%; padding: 10px;">
                    <div class="card border-0">
                        <div class="signature">
                            <h6 class="text-center mt-5">Kepala Sekolah</h6>
                            <div class="signature-box"></div>
                            <h6 class="text-center mt-5">Nama Kepsek</h6>
                        </div>
                    </div>
                </td>
            </tr>
        </table>
</section>
<style>
.signature-box {
    border: 0px solid #000;
    height: 50px;
    margin: 20px auto;
    width: 200px;
}
.card.border-0 {
    display: flex;
    justify-content: space-between;
}
.justify {
        text-align: justify;
        text-justify: inter-word;
    }
</style>

</body>
</html>