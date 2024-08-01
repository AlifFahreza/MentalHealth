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
  <title>Kelola Users - MentalHealth</title>
  <!-- Favicon -->
  <link rel="icon" href="../assets/img/brand/favicon.png" type="image/png">
  <!-- Fonts -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700">
  <!-- Icons -->
  <link rel="stylesheet" href="../assets/vendor/nucleo/css/nucleo.css" type="text/css">
  <link rel="stylesheet" href="../assets/vendor/@fortawesome/fontawesome-free/css/all.min.css" type="text/css">
  <!-- Page plugins -->
  <!-- Argon CSS -->
  <link rel="stylesheet" href="../assets/css/argon.css?v=1.2.0" type="text/css">
</head>

<body>
@include('layout.adminheader')

    <!-- Header -->
    <div class="header bg-primary pb-6">
      <div class="container-fluid">
        <div class="header-body">
          <div class="row align-items-center py-4">
            <div class="col-lg-6 col-7">
            </div>
            <div class="col-lg-6 col-5 text-right">
              <a href="{{ route('admin.insertUser') }}" class="btn btn-sm btn-neutral">Insert Data</a>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Page content -->
    <div class="container-fluid mt--6">
      <div class="row">
        <div class="col">
          <div class="card">
            <!-- Card header -->
            <div class="card-header border-0">
                <div class="wrap-input100 m-b-16">
                {{ csrf_field() }}
                    @if(session('pesan'))
                        <div class="alert alert-success alert-dismissable show fade">
                            <div class="alert-body">
                                <button class="close" data-dismiss="alert">
                                  <span>x</span>
                                </button>
                                {{session('pesan')}}
                            </div>
                        </div>
                    @endif
                </div>
              <h3 class="mb-0">Data Users</h3>
            </div>
            <!-- Light table -->
            <div class="table-responsive">
              <table class="table align-items-center table-flush">
                <thead class="thead-light">
                  <tr>
                    <th scope="col" class="sort" data-sort="name">Nama Lengkap</th>
                    <th scope="col" class="sort" data-sort="budget">Email</th>
                    <th scope="col">Alamat</th>
                    <th scope="col" class="sort" data-sort="completion">Nomor Telp</th>
                    <th scope="col" class="sort" data-sort="completion">Level</th>
                    <th scope="col" class="sort" data-sort="completion">Action</th>
                  </tr>
                </thead>
                <tbody class="list">
                  @forelse ($mahasiswas as $mahasiswa)
                    <tr>
                    <th scope="row">
                      <div class="media align-items-center">
                        <div class="media-body">
                          <span class="name mb-0 text-sm">{{$mahasiswa->name}}</span>
                        </div>
                      </div>
                    </th>
                    <td class="budget">
                    {{$mahasiswa->email}}
                    </td>
                    <td>
                      <div class="avatar-group">
                        @if(is_null($mahasiswa->alamat))
                             -
                        @endif
                        {{$mahasiswa->alamat}}
                      </div>
                    </td>
                    <td>
                      <div class="d-flex align-items-center">
                      @if(is_null($mahasiswa->nomor))
                             -
                      @endif
                      {{$mahasiswa->nomor}}
                      </div>
                    </td>
                    <td>
                      <div class="d-flex align-items-center">
                      @if(is_null($mahasiswa->level))
                             -
                      @endif
                      {{$mahasiswa->level}}
                      </div>
                    </td>
                    <td class="text-right">
                      <div class="dropdown">
                        <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                          <i class="fas fa-ellipsis-v"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                          <a class="dropdown-item" href="{{ url('/mahasiswa/'.$mahasiswa->id) }}">Show</a>
                          <a class="dropdown-item" href="{{ url('/mahasiswa/'.$mahasiswa->id.'/edit') }}">Edit</a>
                          <form action="{{ route('admin.destroyUser',
                                ['mahasiswa'=>$mahasiswa->id]) }}" method="POST">
                                @method('DELETE')
                                @csrf
                                <button class="dropdown-item" onclick="return confirm('Are you sure want to delete?')" style="outline: none">Delete</button>
                              </form>
                        </div>
                      </div>
                    </td>
                  </tr>
                    @empty
                      <td colspan="6" class="text-center">Tidak ada data...</td>
                    @endforelse
                </tbody>
              </table>
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
  <script src="../assets/vendor/jquery/dist/jquery.min.js"></script>
  <script src="../assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
  <script src="../assets/vendor/js-cookie/js.cookie.js"></script>
  <script src="../assets/vendor/jquery.scrollbar/jquery.scrollbar.min.js"></script>
  <script src="../assets/vendor/jquery-scroll-lock/dist/jquery-scrollLock.min.js"></script>
  <!-- Optional JS -->
  <script src="../assets/vendor/clipboard/dist/clipboard.min.js"></script>
  <!-- Argon JS -->
  <script src="../assets/js/argon.js?v=1.2.0"></script>
</body>

</html>