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
  <title>Input Psikolog - MentalHealth</title>
  <!-- Favicon -->
  <link rel="icon" href="../../assets/img/brand/favicon.png" type="image/png">
  <!-- Fonts -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700">
  <!-- Icons -->
  <link rel="stylesheet" href="../../assets/vendor/nucleo/css/nucleo.css" type="text/css">
  <link rel="stylesheet" href="../../assets/vendor/@fortawesome/fontawesome-free/css/all.min.css" type="text/css">
  <!-- Argon CSS -->
  <link rel="stylesheet" href="../../assets/css/argon.css?v=1.2.0" type="text/css">
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
            <p class="text-white mt-0 mb-5">Pada halaman ini, anda dapat melakukan pengisian data artikel yang ingin dipublish.</p>
          </div>
        </div>
      </div>
    </div>
    <!-- Page content -->
    <div class="container-fluid mt--8">
      <div class="row">
        <div class="col-xl-12 order-xl-1">
          <div class="card">
            <div class="card-body">
                <div class="pl-lg-0">
                    <div class="col-lg-12">
                <div class="pl-lg-0">
                    <div class="col-md-12">
                        <div class="form-group">

                            <div class="card">
                                <div class="card-body">
                                    <form action="{{ route('admin.updateArtikel',
                                                    ['artikel' => $data->id]) }}" method="POST" enctype="multipart/form-data">
                                                    @method('PATCH')
                                                    @csrf
                                        <div class="form-group">
                                            <label for="" class="label">Judul</label>
                                            <input type="text" class="form-control @error('judul') is-invalid @enderror" name="judul" value="{{ old('judul') ?? $data->judul }}">
                                            @error('judul')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="" class="label">Sinopsis</label>
                                            <input type="text" class="form-control @error('sinopsis') is-invalid @enderror" name="sinopsis" value="{{ old('sinopsis') ?? $data->sinopsis}}">
                                            @error('sinopsis')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="" class="label">Isi Blog</label>

                                            <textarea name="isi" id="isi" cols="30" rows="4" class="form-control @error('isi') is-invalid @enderror">{{ old('isi') ?? $data->isi}}</textarea>
                                            @error('isi')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                        <label for="exampleFormControlSelect1">Status</label>
                                        <select class="form-control" id="status" name="status">
                                            <option>Pending</option>
                                            <option>Publish</option>
                                        </select>
                                        </div>

                                        <div class="form-group">
                                            <label class="form-control-label" for="berkas">Gambar Artikel</label>
                                            <input type="file" class="form-control-file" id="berkas" name="berkas">
                                            @error('berkas')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <button type="submit" class="btn btn-primary mb-2">Edit Data</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    </div>
  </div>
  <!-- Argon Scripts -->
  <!-- Core -->
  <script src="../../assets/vendor/jquery/dist/jquery.min.js"></script>
  <script src="../../assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
  <script src="../../assets/vendor/js-cookie/js.cookie.js"></script>
  <script src="../../assets/vendor/jquery.scrollbar/jquery.scrollbar.min.js"></script>
  <script src="../../assets/vendor/jquery-scroll-lock/dist/jquery-scrollLock.min.js"></script>
  <!-- Argon JS -->
  <script src="../../assets/js/argon.js?v=1.2.0"></script>
  <script src="https://cdn.ckeditor.com/4.17.1/standard/ckeditor.js"></script>
    <script>
        CKEDITOR.replace( 'isi' );
    </script>
</body>

</html>