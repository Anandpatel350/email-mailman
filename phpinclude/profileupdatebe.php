<?php
include "../profileupdatedata.php";
// var_dump($_SESSION['Picture']);die;
$ssn=$_SESSION['Email'];
if (isset($_POST['submit'])) {
  $ob = new Dbconnection();
  $Fname = $_POST['First_name'];

  if (empty($Fname)) {
    echo json_encode([
      'response' => false,
      'message' => "Name not vlaid",
      'error_id' => 'namerr'
    ]);
    die;
  }
  $Lname = $_POST['Last_name'];
  if (empty($Lname)) {
    echo json_encode([
      'response' => false,
      'message' => "Last Name not vlaid",
      'error_id' => 'lnamerr'
    ]);
    die;
  }
  $Ename = $_POST['Email_name'];
  $Altname = $_POST['Atlemail_name'];
  if (!filter_var($Altname, FILTER_VALIDATE_EMAIL)) {
    echo json_encode([
      'response' => false,
      'message' => "email address not vlaid",
      'error_id' => 'cemailErr'
    ]);
    die;
  }
  // $Picture = $_FILES['files'];
  $Picture = $_FILES['files'];
  $allowed =  array('jpeg', 'jpg', 'png', 'gif', 'bmp', 'JPEG', 'JPG', 'PNG', 'GIF', 'BMP','');
  $ext = pathinfo($Picture['name'], PATHINFO_EXTENSION);
  if (!in_array($ext, $allowed)) {
    echo json_encode([
      'response' => false,
      'message' => "Please updload valid image",
      'error_id' => 'picerr'
    ]);
    die;
  }
  // $path = $_SERVER['DOCUMENT_ROOT'] . "/mail_project/images";
  $path = "../images";
  $temp_name = $Picture['tmp_name'];
  $name = $Picture['name'];
  $path = $path . "/" . $name;
  if (move_uploaded_file($temp_name, $path)) {
    // echo 'true';
  } else {
    // echo 'false';
  }
  $name = $Picture['name']!=null? $Picture['name'] : $data['Picture'];
  $sql = "UPDATE users SET `First_name`  = '$Fname' , `Last_name`  = '$Lname' ,`Secordary_mail`  = '$Altname', `Picture`  = '$name'  WHERE Email = '$Ename'";
  if ($ob->insert($sql)) {
    echo json_encode([
      'response' => true,
      'message' => "Profile Updated successfully"

    ]);
  } else {
    echo json_encode([
      'response' => false,
      'message' => "Somthing Went wrong",
      'error_id' => 'RgsErr'
    ]);
  }
}

if(isset($_POST['id'])) {
$dlt="update users set Picture =null WHERE Email='$ssn'";
  if($obj->insert($dlt)) {
    echo json_encode([
      'response' => true,
      'message' => "Profile Photo Deleted"

    ]);
  } 
}
