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

  <title>Forget-password-link</title>
</head>

<body>
  <section class="vh-100">
    <div class="container-fluid h-custom">
      <div class="row d-flex justify-content-center align-items-center h-100">

        <div class="col-md-9 col-lg-6 col-xl-5">
          <h2>Mailman.com</h2>
          <div>
            <form action="phpinclude/send_reset_link.php" id="resetForm">
              <span id="error" class="text-danger"></span>
              <p>Enter Your register E-mail</p>
              <input type="text" id="Email" class="form-control form-control-lg" name="email" placeholder="Enter Email" />
              <div class="d-flex pt-3 justify-content-between"><a href="index.php">back to login</a>
                <a href="#">
                  <button type="submit" class="btn btn-success btn-lg">Send</button>
                </a>
              </div>
            </form>
          </div>
        </div>
        <div class="col-md-8 col-lg-6 col-xl-4 offset-xl-1">
          <img src="./pictures/logo.png" class="img-fluid pt-2" alt="Sample image">
        </div>
      </div>
    </div>
  </section>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
  <script>
    $(document).ready(function() {
      $("#resetForm").submit(function(e) {
        e.preventDefault();
        var error = 0;
        var EmailVal = $("#Email").val();
        var data = {
          'send_reset_link': true,
          'email': EmailVal,
        }
        $.post("phpinclude/send_reset_link.php", data,
          function(data, textStatus, jqXHR) {
            if (!data['response']) {
              $("#" + data['error']).html(data['message'])
            } else {
              alert("sent success")
            }
          },
          "JSON"
        );
      });
    });
  </script>
</body>

</html>