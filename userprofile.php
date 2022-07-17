<?php
session_start();
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

  <title>User Profile </title>
</head>
<body>

  <!-- dddddddd -->
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
                    
                        <div><img src="images/<?php echo $profile_url; ?>" class="rounded-5 dropdown-toggle fixd" style="width:50px" alt="Avatar" data-bs-toggle="dropdown" aria-expanded="false" />
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenu2">
                                <li><button class="dropdown-item text-center" type="button"><a href="phpinclude/logout.php">Log Out</a></button></li>
                            </ul>

                        </div>
                    
                </div>
            </div>

        </div>
    </nav>
  <!-- sssss -->
  <h1 id="msg" class="text-danger text-center pt-5"></h1>
  <section>
    <div class="container h-custom">

      <div class="row d-flex justify-content-center align-items-center h-100 ms-5">

        <div class="col-md-9 ">
        <div><label for="FirstName"></label>
                <input type="text" id="FirstName" class="form-control form-control-lg w-75 mb-3" placeholder="First Name" value="<?php echo $data['First_name'];?>" disabled />
              </div>
              <div>
             <input type="text" id="LastName" class="form-control form-control-lg w-75 mb-3" placeholder="Last Name" value="<?php echo $data['Last_name']; ?>"disabled />
                 </div>
              <div>
                <input type="email" id="AltEmail" class="form-control form-control-lg w-75 mb-3" placeholder="Enter Email" value="<?php echo $data['Email']; ?>"disabled />
                 </div>
              <div>
                <input type="email" id="AltEmail" class="form-control form-control-lg w-75 mb-3" placeholder="Enter Email" value="<?php echo $data['Secordary_mail']; ?>"disabled />
              </div>
              <div class="d-flex justify-content-start">
              <a href="updatepassword.php" class="pe-2">Edit Password</a>|<a href="profileUpdate.php" class="ps-2">Edit Profile</a>
              </div>
        </div>
        <div class="col-md-3">

          <img src="images/<?php echo $profile_url ; ?>" class="img-fluid" alt="Sample image">

        </div>
      </div>
    </div>
  </section>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>

</html>