@extends('layouts.template')

@section('content')
    <div class="head container">
        <h1>Dashboard</h1>
        <p><span><b>Home</b></span> /</p>
    </div>
    <div class="isi">
        <div class="container mt-4">
            <div class="row">
              <div class="col-md-6 mb-4">
                <div class="card">
                  <div class="card-body">
                    <div class="row">
                      <div class="col-md-4">
                        <img src="https://via.placeholder.com/150" alt="Icon" class="img-fluid mb-2">
                      </div>
                      <div class="col-md-8">
                        <h5 class="card-title">Peserta Didik </h5>
                        <p class="card-text ml-2">
                          <?php
                             echo DB::table('students')->count(); 
                         ?>
                         
                        </p>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-6 mb-4">
                <div class="row">
                  <div class="col-md-6">
                    <div class="card">
                      <div class="card-body">
                        <div class="row">
                          <div class="col-md-4">
                            <img src="https://via.placeholder.com/150" alt="Icon" class="img-fluid mb-2">
                          </div>
                          <div class="col-md-8">
                            <h5 class="card-title">Administrator</h5>
                            <p class="card-text ml-2"><?php echo DB::table('users')->where('role', 'admin')->count(); ?></p>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="card">
                      <div class="card-body">
                        <div class="row">
                          <div class="col-md-4">
                            <img src="https://via.placeholder.com/150" alt="Icon" class="img-fluid mb-2">
                          </div>
                          <div class="col-md-8">
                            <h5 class="card-title">Pembimbing siswa</h5>
                            <p class="card-text ml-2"><?php echo DB::table('users')->where('role', 'ps')->count();?></p>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
          
              <div class="col-md-6 mb-4">
                <div class="card">
                  <div class="card-body">
                    <div class="row">
                      <div class="col-md-4">
                        <img src="https://via.placeholder.com/150" alt="Icon" class="img-fluid mb-2">
                      </div>
                      <div class="col-md-8">
                        <h5 class="card-title">Rombel</h5>
                        <p class="card-text ml-2"><?php echo DB::table('rombels')->count(); ?></p>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-md-6 mb-4">
                <div class="card">
                  <div class="card-body">
                    <div class="row">
                      <div class="col-md-4">
                        <img src="https://via.placeholder.com/150" alt="Icon" class="img-fluid mb-2">
                      </div>
                      <div class="col-md-8">
                        <h5 class="card-title">Rayon</h5>
                        <p class="card-text ml-2"><?php echo DB::table('rayons')->count() ?></p>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
    </div>
@endsection
