<?php
include 'profileupdatedata.php';
if (!isset($_SESSION['Email'])) {
  header('Location: index.php');
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=H, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <link href="scsscode/index.css" rel="stylesheet">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

  <title>Edit Profile</title>
</head>

<body>
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
  </nav>
  <section style="margin-top: 150px;">
    <div class="container h-custom">

      <div class="row d-flex justify-content-center align-items-center h-100 ms-5">

        <div class="col-md-10 ">

          <h2>Mailman.com</h2>
          <div>
            <form id="formdata">
              <span id="RgsErr" class="text-danger"></span>
              <div><label for="FirstName">First Name</label>
                <input type="text" id="FirstName" class="form-control form-control-lg w-75" placeholder="First Name" value="<?php echo $data['First_name']; ?>" required />
                <span id="namerr" class="text-danger"></span>
              </div>
              <div class="mt-3">
                <label for="LastName">Last Name</label>
                <input type="text" id="LastName" class="form-control form-control-lg w-75" placeholder="Last Name" value="<?php echo $data['Last_name']; ?>" required />
                <span id="lnamerr" class="text-danger"></span>
              </div>
              <div class="mt-3">
                <label for="AltEmail"> Enter Recovery E-mail</label>
                <input type="email" id="AltEmail" class="form-control form-control-lg w-75" placeholder="Enter Email" value="<?php echo $data['Secordary_mail']; ?>" required />
                <span id="cemailErr" class="text-danger"></span>
              </div >
              <input type="button" class="btn btn-success mt-3" value="submit" id="profileupdate">
            </form>
          </div>
        </div>
        <div class="col-md-2">
          <img src="images/<?php echo $profile_url; ?>" class="img-fluid" alt="Sample image" style="width:300px;height:170px"/>
          <div class="d-flex justify-content-around">
            <label for="Pic" class="btn btn-success mt-2">Select Picture</label>
            <input id="Pic" style="visibility:hidden;" id="Pic" type="file" value="picture" name="avtar">
            <button type="button" class="btn btn-success mt-2" id="deletepic"> Remove Picture</button>
            
          </div>
          <span id="picerr" class="text-danger"></span>
        </div>
      </div>
  </section>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
<script>
  $(document).ready(function() {
    $("#profileupdate").click(function(event) {
      var error = 0;
      var FnameVal = $("#FirstName").val();
      var LnameVal = $("#LastName").val();
      var AltemailVal = $("#AltEmail").val();
      var formData = new FormData();
      var file = document.querySelector('#Pic');
      formData.append("files", file.files[0]);
      formData.append("submit", true);
      formData.append("First_name", FnameVal);
      formData.append("Last_name", LnameVal);
      formData.append("Atlemail_name", AltemailVal);
      $.ajax({
        url: "phpinclude/profileupdatebe.php",
        data: (formData),
        cache: false,
        processData: false,
        contentType: false,
        dataType: 'JSON',
        type: 'POST',
        success: function(data) {

          if (!data.response) {
            $.each(data.arrayvalue, function(index, value) {
              $("#" + index).html(value);
            });
          } else {
            alert("Profile updated successfully")
            location.href = "profileUpdate.php"
          }
        }



      });

    });

    $("#deletepic").click(function(event) {

      $.ajax({
        url: "phpinclude/profileupdatebe.php",
        type: 'POST',
        data: {
          id: 1
        },
        dataType: 'JSON',
        success: function(data) {
          if (data['response']) {
            // alert(data['message']);
            location.href = "profileUpdate.php"
          }
        }
      });

    });
  });
</script>

</html>