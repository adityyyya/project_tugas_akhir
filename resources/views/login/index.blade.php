<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Login</title>
  <link rel="icon" type="image/png" href="{{asset('images/logobanjar.png')}}">
  
  <!-- Custom fonts for this template-->
  <link href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="{{ asset('css/sb-admin-2.min.css') }}" rel="stylesheet">
  <style>
    body {
        background-image: url('/images/banjarmasin.jpg'); 
        background-size: cover;
        background-position: center;
    }
</style>
</head>

<body>
  
  <div class="container">

    <!-- Outer Row -->
    <div class="row justify-content-center">

      <div class="col-lg-6">

        <div class="card o-hidden border-10 shadow-lg my-5">
          <div class="card-body p-3">
            <!-- Nested Row within Card Body -->
            <div class="col-lg">
              <div class="p-3">
                  <div class="text-center">
                            @if (session()->has('LoginError'))
                            <div class="alert alert-danger alert-dismissible fade show mt-2" role="alert">
                                {{ session('LoginError') }}
                                <button type="button" class="close" data-bs-dismiss="alert" aria-label="Close">&times;</button>
                            </div>
                        @endif
                                                           
                      <img src="{{asset('images/logobanjar.png')}}" width="150px" height="150px" style="margin-bottom: 30px;">
                      <h1 class="h4 text-gray-900 mb-4" style="font-size: 24px;">SISTEM INFORMASI ARSIP KELURAHAN ALALAK TENGAH</h1>
                      <p class="text-gray-700 mb-4">Login ke akun anda sekarang</p>
                  </div>
                  <form id="loginForm" method="POST" action="{{route('cek_login')}}" onsubmit="return validateForm()">
                    @csrf
                    <div class="form-group">
                        <label for="email">Email Address</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-user"></i></span>
                            </div>
                            <input name="email" type="email" class="form-control form-control-user @error('email') is-invalid @enderror"
                            id="exampleInputEmail" aria-describedby="emailHelp" placeholder="Enter Email Address..." autofocus required
                            value="{{ old('email') }}">
                            @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                          </div>
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-lock"></i></span>
                            </div>
                            <input name="password" type="password" class="form-control form-control-user" id="exampleInputPassword" 
                            placeholder="Password" required>
                        </div>
                    </div> 
                    <div class="form-group">
                        <span id="error-msg" style="color: red;"></span>
                    </div>
                    <button type="submit" class="btn btn-primary btn-block btn-user">
                        <i class="fas fa-sign-in-alt"></i> Login
                    </button>
                </form>                                                   
              </div>
              <script>
                function validateForm() {
                    var email = document.getElementById("exampleInputEmail").value;
                    var password = document.getElementById("exampleInputPassword").value;
                    var errorMsg = document.getElementById("error-msg");
            
                    if (email.trim() === '') {
                        errorMsg.textContent = 'Email harus diisi.';
                        return false;
                    }
            
                    if (password.trim() === '') {
                        errorMsg.textContent = 'Password harus diisi.';
                        return false;
                    }
            
                    // Jika email dan password terisi, kosongkan pesan kesalahan
                    errorMsg.textContent = '';
                    return true; // Mengembalikan nilai true jika validasi berhasil
                }
            </script>                      
          </div>          
                </div>
              </div>
            </div>
          </div>
        </div>

      </div>

    </div>

  </div>

  <!-- Bootstrap core JavaScript-->
  <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
  <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

  <!-- Core plugin JavaScript-->
  <script src="{{ asset('vendor/jquery-easing/jquery.easing.min.js') }}"></script>

  <!-- Custom scripts for all pages-->
  <script src="{{ asset('js/sb-admin-2.min.js') }}"></script>

</body>

</html>
