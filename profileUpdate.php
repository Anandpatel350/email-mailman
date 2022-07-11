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
  <meta name="viewport" content="width=H, initial-scale=1.0">
  <link href="scsscode/index.css" rel="stylesheet">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

  <title>Edit Profile</title>
</head>

<body>
  <nav class="navbar navbar-light bg-success p-4  px-5">
    <a>
      <h2 class="text-light ps-5">mailman</h2>
    </a>

    <div class="dropdown">
      <div class="d-flex py-2">
        <!-- username -->
        <button class="btn btn-outline-dark me-3" type="submit"><?php echo $_SESSION['Email']; ?></button>
        <?php
        $profile_url = !empty($data['Picture']) ? $data['Picture'] : 'piclogo.png';
        ?>
        <img src="images/<?php echo $profile_url; ?>" class="rounded-5 dropdown-toggle" style="width:40px" alt="Avatar" data-bs-toggle="dropdown" aria-expanded="false" />

        <ul class="dropdown-menu" aria-labelledby="dropdownMenu2">
          <li><button class="dropdown-item" type="button"><a href="phpinclude/logout.php">Log Out</a></button></li>
        </ul>
      </div>
    </div>
  </nav>
  <section class="vh-100">
    <div class="container h-custom">

      <div class="row d-flex justify-content-center align-items-center h-100 ms-5">

        <div class="col-md-9 ">

          <h2>Mailman.com</h2>
          <div>
            <form id="formdata">
              <span id="RgsErr" class="text-danger"></span>
              <div><label for="FirstName"></label>
                <input type="text" id="FirstName" class="form-control form-control-lg w-75 mb-3" placeholder="First Name" value="<?php echo $data['First_name']; ?>" required />
                <span id="namerr" class="text-danger"></span>
              </div>
              <div>
                <label for="LastName">Last Name</label>
                <input type="text" id="LastName" class="form-control form-control-lg w-75 mb-3" placeholder="Last Name" value="<?php echo $data['Last_name']; ?>" required />
                <span id="lnamerr" class="text-danger"></span>
              </div>
              <div>
                <label for="AltEmail"> Enter Recovery E-mail</label>
                <input type="email" id="AltEmail" class="form-control form-control-lg w-75 mb-3" placeholder="Enter Email" value="<?php echo $data['Secordary_mail']; ?>" required />
                <span id="cemailErr" class="text-danger"></span>
              </div>
              <input type="button" class="btn btn-success" value="submit" id="profileupdate">
            </form>
          </div>
        </div>
        <div class="col-md-3">
          <img src="images/<?php echo $profile_url; ?>" class="img-fluid" alt="Sample image" />
          <div class="d-flex justify-content-around"> <input type="file" id="Pic" class="btn btn-success mt-2 me-3 w-75" value="picture" name="avtar" class="pt-3">
            <button type="button" class="btn btn-success mt-2" id="deletepic"> Remove Picture</button>
          </div>
          <span id="picerr" class="text-danger"></span>
        </div>
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
      var EmailVal = "<?php echo $_SESSION['Email'] ?>";
      var AltemailVal = $("#AltEmail").val();
      var formData = new FormData();
      var file = document.querySelector('#Pic');
      formData.append("files", file.files[0]);
      formData.append("submit", true);
      formData.append("First_name", FnameVal);
      formData.append("Last_name", LnameVal);
      formData.append("Email_name", EmailVal);
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
          if (!data['response']) {
            // alert("#"+data['error_id'])
            $("#" + data['error_id']).html(data['message'])
          } else {
            // location.href = "dashboard.php"
            alert(data['message']);
            location.href = "profileUpdate.php"
          }
        }
      });

    });

    $("#deletepic").click(function(event) {  

      $.ajax({
        url: "phpinclude/profileupdatebe.php",
        type: 'POST',
        data : {id :1},
        dataType: 'JSON',
        success: function(data) { 
          if (data['response']) {
            alert(data['message']);
            location.href = "profileUpdate.php"
          }
        }
      });

    });
  });
</script>

</html>