<?php
session_start();
if (isset($_SESSION['Email'])) {
    header('Location: dashboard.php');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=H, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <meta name="viewport" content="width=H, initial-scale=1.0">
  <link href="scsscode/index.css" rel="stylesheet">
  <!-- <script defer src="val.js"></script> -->
  <title></title>
</head>

<body>
  <section class="vh-100">
    <div class="container-fluid h-custom">
      <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col-md-9 col-lg-6 col-xl-5">
          <h2 class="text-center">Mailman.com</h2>
          <img src="./pictures/logo.png" class="img-fluid pt-2" alt="Sample image">
        </div>
        <div class="col-md-8 col-lg-6 col-xl-4 offset-xl-1">
          <div class="border p-5">
            <!-- form -->
            <form action="phpinclude/login.php" method="post" enctype="multipart/form-data" id="formup">
              <h3 class="text-danger pb-2"><?php
                                            ?></h3>
              <h2>Login To Your Account</h2>
              <!-- Email input -->
              <span id="error" class="text-danger"></span>
              <div class="form-outline mb-4 pt-3">
                <label class="form-label" for="Email">Email address</label>
                <input type="text" name="UserName" id="Email" class="form-control form-control-lg" placeholder="Enter Email/User Name" />
                <span id="EmailErr" class="text-danger"></span>
              </div>
              <!-- Password input -->
              <div class="form-outline mb-3">
                <label class="form-label" for="Password">Password</label>
                <input type="password" id="Password" name="Passworda" class="form-control form-control-lg" placeholder="Enter password" />
              </div>

              <div class="d-flex justify-content-between pt-3">
                <a href="./forgetlink.php" class="pt-2">Forgot password?</a>
                <button type="submit" class="btn btn-success btn-lg gradient-custom-4 " id="Signin" name="submit">login</button>
              </div>
              <div>
                <p class="pt-3">don't have an account yet?</p>
                <a href="./registration.php">
                  <button type="button" class="btn btn-success btn-lg mt-3">Create One</button>
                </a>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </section>


</body>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<!-- Jquary validation -->
<script>
  $(document).ready(function() {
    $("#formup").submit(function(e) {
      e.preventDefault();
      var error = 0;
      var EmailVal = $("#Email").val();
      var PassVal = $("#Password").val();
      var data = {
        'submit': true,
        'email': EmailVal,
        'password': PassVal
      }
      $.post("phpinclude/login.php", data,
        function(data, textStatus, jqXHR) {
          if (!data['response']) {
            $("#" + data['error_id']).html(data['message'])
          } else {
            location.href = "dashboard.php"
          }
        },
        "JSON"
      );
    });
  });
</script>

</html>