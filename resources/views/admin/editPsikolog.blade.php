<!--
=========================================================
* Argon Dashboard - v1.2.0
=========================================================
* Product Page: https://www.creative-tim.com/product/argon-dashboard


* Copyright  Creative Tim (http://www.creative-tim.com)
* Coded by www.creative-tim.com



=========================================================
* The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.
-->
<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="Start your development with a Dashboard for Bootstrap 4.">
  <meta name="author" content="Creative Tim">
  <title>Edit User - MentalHealth</title>
  <!-- Favicon -->
  <link rel="icon" href="../assets/img/brand/favicon.png" type="image/png">
  <!-- Fonts -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700">
  <!-- Icons -->
  <link rel="stylesheet" href="{{ asset('../assets/vendor/nucleo/css/nucleo.css') }}" type="text/css">
  <link rel="stylesheet" href="{{ asset('../assets/vendor/@fortawesome/fontawesome-free/css/all.min.css')}}" type="text/css">
  <!-- Argon CSS -->
  <link rel="stylesheet" href="{{ asset('../assets/css/argon.css?v=1.2.0') }}" type="text/css">
</head>

<body>
@include('layout.adminheader')
    <!-- Header -->
    <div class="header pb-6 d-flex align-items-center" style="min-height: 500px; background-image: url(../../assets/img/theme/profile-cover.jpg); background-size: cover; background-position: center top;">
      <!-- Mask -->
      <span class="mask bg-gradient-default opacity-8"></span>
      <!-- Header container -->
      <div class="container-fluid d-flex align-items-center">
        <div class="row">
          <div class="col-lg-7 col-md-10">
            <h1 class="display-2 text-white">Hello Admin</h1>
            <p class="text-white mt-0 mb-5">Pada halaman ini, anda dapat melakukan edit data user psikolog.</p>
          </div>
        </div>
      </div>
    </div>
    <!-- Page content -->
    <div class="container-fluid mt--8">
      <div class="row">
        <div class="col-xl-12 order-xl-1">
          <div class="card">
            <div class="card-header">
              <div class="row align-items-center">
                <div class="col-8">
                  <h3 class="mb-0">Biodata {{$data->name}}</h3>
                </div>
              </div>
            </div>
            <div class="card-body">
            <form action="{{ route('admin.updatePsikolog',
            ['psikolog' => $data->id]) }}" method="POST">
            @method('PATCH')
              @csrf
              <h6 class="heading-small text-muted mb-4">Contact information</h6>
                <div class="pl-lg-4">
                  <div class="row">
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="input-username">Name</label>
                        <input type="text" id="name" name="name" class="form-control @error('name') is-invalid @enderror" placeholder="Input Name" value="{{ old('name') ?? $data->name }}" >
                        @error('name')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="input-email">Email address</label>
                        <input type="email" id="email" name="email" class="form-control @error('email') is-invalid @enderror" placeholder="Input Email" value="{{ old('email') ?? $data->email }}" >
                        @error('email')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror  
                    </div>
                    </div>
                    </div>
                  </div>
                <div class="pl-lg-4">
                  <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="form-control-label" for="input-address">Address</label>
                            <input id="alamat" name="alamat" class="form-control @error('alamat') is-invalid @enderror" placeholder="Input Address" type="text" value="{{ old('alamat') ?? $data->alamat }}" >
                            @error('alamat')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror  
                        </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-lg-12">
                      <div class="form-group">
                        <label class="form-control-label" for="input-city">Number</label>
                        <input type="text" id="nomor" name="nomor" class="form-control @error('nomor') is-invalid @enderror" placeholder="Input Number" value="{{ old('nomor') ?? $data->nomor }}">
                        @error('nomor')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror    
                    </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary mb-2" onclick="return confirm('Are you sure want to update?')">Edit Data</button>
                </form>
            </div>
          </div>
        </div>
      </div>
    </div>
      <!-- Footer -->
      <footer class="footer pt-0">
        <div class="row align-items-center justify-content-lg-between">
          <div class="col-lg-6">
            <div class="copyright text-center  text-lg-left  text-muted">
              &copy; 2020 <a href="https://www.creative-tim.com" class="font-weight-bold ml-1" target="_blank">Creative Tim</a>
            </div>
          </div>
        </div>
      </footer>
    </div>
  </div>
  <!-- Argon Scripts -->
  <!-- Core -->
  <script src="{{ asset('../assets/vendor/jquery/dist/jquery.min.js') }}"></script>
  <script src="{{ asset('../assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js')}}"></script>
  <script src="{{ asset('../assets/vendor/js-cookie/js.cookie.js')}}"></script>
  <script src="{{ asset('../assets/vendor/jquery.scrollbar/jquery.scrollbar.min.js')}}"></script>
  <script src="{{ asset('../assets/vendor/jquery-scroll-lock/dist/jquery-scrollLock.min.js')}}"></script>
  <!-- Argon JS -->
  <script src="{{ asset('../assets/js/argon.js?v=1.2.0"></script>
</body>

</html>