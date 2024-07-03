<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Login</title>
  <link rel="icon" type="image/png" href="{{asset('img/logobanjar.png')}}">
  
  <!-- Custom fonts for this template-->
  <link href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="{{ asset('css/sb-admin-2.min.css') }}" rel="stylesheet">
  <style>
    body {
        background-image: url('/img/banjarmasin.jpg'); 
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
                    <div id="errorMessage" class="alert alert-danger alert-dismissible fade show mt-2" role="alert">
                        {{ session('LoginError') }}
                        <button type="button" class="close" data-bs-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif                                                    
                      <img src="{{asset('images/logobanjar.png')}}" width="150px" height="150px" style="margin-bottom: 30px;">
                      <h1 class="h4 text-gray-900 mb-4" style="font-size: 24px;">SISTEM INFORMASI ARSIP KELURAHAN ALALAK TENGAH</h1>
                      <p class="text-gray-700 mb-4">Login ke akun anda sekarang</p>
                  </div>
                  <form id="loginForm" method="POST" action="{{route('cek_login')}}" onsubmit="return validateForm()">
                    @csrf
                    <div class="form-group">
                        <label for="email">Alamat Email</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-user"></i></span>
                            </div>
                            <input name="email" type="email" class="form-control form-control-user @error('email') is-invalid @enderror"
                            id="exampleInputEmail" aria-describedby="emailHelp" placeholder="Alamat Email" autofocus required
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
                          <input name="password" type="password" class="form-control form-control-user" id="exampleInputPassword" placeholder="Password" required>
                          <div class="input-group-append">
                              <span class="input-group-text" id="togglePassword">
                                  <i class="fas fa-eye"></i>
                              </span>
                          </div>
                      </div>
                  </div>
                    <div class="form-group">
                        <span id="error-msg" style="color: red;"></span>
                    </div>
                    <button type="submit" class="btn btn-primary btn-block btn-user" id="loginButton">
                      <i class="fas fa-sign-in-alt"></i> Login
                  </button>
                                 
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

  <!-- Bootstrap core JavaScript-->
  <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
  <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

  <!-- Core plugin JavaScript-->
  <script src="{{ asset('vendor/jquery-easing/jquery.easing.min.js') }}"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
  <!-- Custom scripts for all pages-->
  <script src="{{ asset('js/sb-admin-2.min.js') }}"></script>
  <script>
    function validateForm() {
        var email = document.getElementById('exampleInputEmail').value;
        var password = document.getElementById('exampleInputPassword').value;
        var errorMsg = document.getElementById('error-msg');

        if (!email && !password) {
            errorMsg.innerText = "Alamat email dan kata sandi harus diisi.";
            return false;
        } else if (!email) {
            errorMsg.innerText = "Alamat email harus diisi.";
            return false;
        } else if (!password) {
            errorMsg.innerText = "Kata sandi harus diisi.";
            return false;
        }
        return true;
    }

    document.getElementById('loginButton').addEventListener('click', function() {
        if (!validateForm()) {
            return false;
        }
    });
</script>
<script>
  document.addEventListener('DOMContentLoaded', function () {
      var closeButton = document.querySelector('.alert .close');
      closeButton.addEventListener('click', function () {
          var errorMessage = this.closest('.alert');
          errorMessage.remove();
      });
  });
</script>
<script>
  document.getElementById('togglePassword').addEventListener('click', function () {
      const passwordInput = document.getElementById('exampleInputPassword');
      const icon = this.querySelector('i');

      // Toggle password visibility
      if (passwordInput.type === 'password') {
          passwordInput.type = 'text';
          icon.classList.remove('fa-eye');
          icon.classList.add('fa-eye-slash');
      } else {
          passwordInput.type = 'password';
          icon.classList.remove('fa-eye-slash');
          icon.classList.add('fa-eye');
      }
  });
</script>
</body>
</html>
