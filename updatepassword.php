<?php
session_start();
include 'profileupdatedata.php';
if (!isset($_SESSION['Email'])) {
  header('Location: index.php');
  echo $_SESSION['Email'];
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Update Password</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <style>
        #popup {
            display: none;
            position: absolute;
            top: 160px;
            right: 25px;
            z-index: 9999;
            text-align: center;
            width: 500px;
            height: 100px;
            padding-top: 40px;
            color: green;
        }
    </style>
</head>

<body>
  <section>
    <nav class="navbar navbar-light bg-success">
      <div class="container-fluid m-3">
        <a class="navbar-brand">
          <h1 class="text-light ms-2">Mail Man</h1>
        </a>
        <div class="dropdown">
          <div class="d-flex">
            <!-- username -->
            <button class="btn btn-outline-dark me-3" type="submit"><?php echo $_SESSION['Email']; ?></button>
            <?php
            $profile_url = !empty($data['Picture']) ? $data['Picture'] : 'piclogo.png';
            ?>

<div><img src="images/<?php echo $profile_url; ?>" class="rounded-5 dropdown-toggle fixd" style="width:50px;height:50px" alt="Avatar" data-bs-toggle="dropdown" aria-expanded="false" />
            <ul class="dropdown-menu mt-2" style="margin-left:95px;" aria-labelledby="dropdownMenu2">
            <li><button class="dropdown-item text-center" type="button"><a href="dashboard.php">Home</a></button></li>
            <li><button class="dropdown-item text-center" type="button"><a href="userprofile.php">Profile</a></button></li>
              <li><button class="dropdown-item text-center" type="button"><a href="phpinclude/logout.php">Log Out</a></button></li>
            </ul>

          </div>

          </div>

        </div>
      </div>

      </div>
    </nav>
    <div class="mask d-flex align-items-center h-100 gradient-custom-3" style="padding-top:150px">
      <div class="container h-100">

        <div class="row d-flex justify-content-center align-items-center h-100">
          <div class="col-12 col-md-9 col-lg-7 col-xl-6">
            <div class="card" style="border-radius: 15px;">
              <div class="card-body  py-5 px-5">
                <h2 class="text-uppercase text-center pt-2 mb-4">Set New Password</h2>

                <!-- form -->
                <form action="javascript:void(0)" id="formfp">
                  <div class="form-outline mb-3">
                    <label class="form-label" for="">Please Enter Current Password</label>
                    <input type="password" id="oldpassword" class="form-control form-control-lg" />
                    <span id="oldpassErr" class="text-danger"> </span>
                  </div>
                  <div class="form-outline mb-3">
                    <label class="form-label" for="">New Password</label>
                    <input type="password" id="password" class="form-control form-control-lg" />
                    <span id="passErr" class="text-danger"> </span>
                  </div>
                  <div class="form-outline mb-3">
                    <label class="form-label" for="">Confirm Password</label>
                    <input type="password" id="passwordagain" class="form-control form-control-lg" />
                    <span id="cpassErr" class="text-danger"> </span>
                  </div>
                  <div class="d-flex justify-content-between pt-4">
                    <div>
                      <button type="submit" class="btn btn-success" id="submit">Success</button>
                    </div>
                    <div class="float-right">
                      <a class="text-decoration-none text-success" href="index.php">Return To Login</a>
                    </div>
                  </div>
                </form>

              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <div class="alert alert-secondary " id="popup" role="alert"></div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
<script>
  $(document).ready(function() {

    $("#oldpassErr").val("");
           $("#passErr").val("");
             $("#cpassErr").val("");
    $("#formfp").submit(function(e) {
      e.preventDefault();
      var error = 0;
      var OldpassVal = $("#oldpassword").val();
      var PassVal = $("#password").val();
      var CnfpassVal = $("#passwordagain").val();
      var data = {
        'submit': true,
        'oldpassword': OldpassVal,
        'Password': PassVal,
        'passwordagain': CnfpassVal,


      }
      $.post("phpinclude/updatepasswordbe.php", data,
        function(data, textStatus, jqXHR) {

          if (data['response']) {
            // alert(data['message'])
            $("#oldpassword").val("");
            $("#password").val("");
            $("#passwordagain").val("");
            $("#oldpassErr").hide();
           $("#passErr").hide();
             $("#cpassErr").hide();
            

            $('#popup').html('<i><h4>' + data['message'] + '</h4><i>');
            $('#popup').show(function() {$('#popup').delay(700).fadeOut(700);});


            // location.href = "index.php"
          } else {
            $("#" + data['error_id']).html(data['message'])
          }
        },
        "JSON"
      );
    });
  });
</script>

</html>