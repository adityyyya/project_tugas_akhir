<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Login</title>

  <!-- Custom fonts for this template-->
  <link href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="{{ asset('css/sb-admin-2.min.css') }}" rel="stylesheet">

</head>


<body class="bg-gradient-primary d-flex align-items-center justify-content-center">
  
  <div class="container">

    <!-- Outer Row -->
    <div class="row justify-content-center">

      <div class="col-lg-7">

        <div class="card o-hidden border-10 shadow-lg my-5">
          <div class="card-body p-5">
            <!-- Nested Row within Card Body -->
              <div class="col-lg">
                <div class="p-5">
                  <div class="text-center">
                  <img src="/images/logobanjar.png" width="150px" height="150px" style="margin-bottom: 30px;">
                    <h1 class="h4 text-gray-900 mb-4" style="font-size: 20px;">SISTEM INFORMASI ARSIP KELURAHAN ALALAK TENGAH</h1>
                  </div>
                  <form id="loginForm" method="POST" action="/login">
                    <div class="form-group">
                      <input name="email" type="email" class="form-control form-control-user" id="exampleInputEmail" aria-describedby="emailHelp" placeholder="Enter Email Address...">
                    </div>
                    <div class="form-group">
                      <input name="password" type="password" class="form-control form-control-user" id="exampleInputPassword" placeholder="Password">
                    </div>
                    <div class="form-group">
                      <span id="error-msg" style="color: red;"></span>
                    </div>
                    <button type="button" onclick="validateForm()" class="btn btn-primary btn-block btn-user">Login</button>
                  </form>
                  <hr>
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

  <script>
  function validateForm() {
    var email = document.getElementById("exampleInputEmail").value;
    var password = document.getElementById("exampleInputPassword").value;
    var errorMsg = document.getElementById("error-msg");

    // Example validation, you should replace this with your actual validation logic
    if (email === "" || password === "") {
      errorMsg.innerText = "Email and password are required.";
    } else {
      // If validation succeeds, send login request via AJAX
      var xhr = new XMLHttpRequest();
      xhr.open("POST", "/login", true);
      xhr.setRequestHeader("Content-Type", "application/json");
      xhr.onreadystatechange = function () {
        if (xhr.readyState === XMLHttpRequest.DONE) {
          if (xhr.status === 200) {
            // If login successful, redirect to dashboard
            var response = JSON.parse(xhr.responseText);
            if (response.success) {
              window.location.href = "/dashboard"; // Redirect to dashboard or any other page
            } else {
              errorMsg.innerText = "Invalid email or password.";
            }
          } else {
            // Handle other status codes, e.g., server errors
            errorMsg.innerText = "An error occurred. Please try again later.";
          }
        }
      };
      xhr.send(JSON.stringify({ email: email, password: password }));
    }
  }
</script>


</body>

</html>
