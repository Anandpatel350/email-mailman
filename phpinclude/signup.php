<?php
include "connection.php";
if (isset($_POST['submit'])) {
  $ob = new Dbconnection();
  $Fname = $_POST['First_name'];
  $Lname = $_POST['Last_name'];
  $Uname = $_POST['User_Name'];
  $sql = "SELECT id from users where User_name = '$Uname'";
  $res = $ob->conn->query($sql);
  if ($res->num_rows > 0) {
    echo json_encode([
      'response' => false,
      'message' => "Please try another User Name",
      'error_id' => 'unemeErr'
    ]);
    die;
  }
  $Ename = $_POST['Email_name'];

  if (!filter_var($Ename, FILTER_VALIDATE_EMAIL)) {
    echo json_encode([
      'response' => false,
      'message' => "email address not vlaid",
      'error_id' => 'emailErr'
    ]);
    die;
  } else {
    $sql = "SELECT id from users where Email = '$Ename'";
    $res = $ob->conn->query($sql);
    if ($res->num_rows > 0) {
      echo json_encode([
        'response' => false,
        'message' => "email address not unique",
        'error_id' => 'emailErr'
      ]);
      die;
    }
  }
  $Altname = $_POST['Atlemail_name'];
  if (!filter_var($Altname, FILTER_VALIDATE_EMAIL)) {
    echo json_encode([
      'response' => false,
      'message' => "email address not vlaid",
      'error_id' => 'cemailErr'
    ]);
    die;
  }
  $Pass = $_POST['Passworda'];
  if (!preg_match('/^(?=.*\d)(?=.*[A-Za-z])(?=.*[!@#$%])[0-9A-Za-z!@#$%]{8,20}$/', ($Pass))) {
    echo json_encode([
      'response' => false,
      'message' => "Password should be at least 8 characters in length and should include at least one upper case letter, one number, and one special character.",
      'error_id' => 'passErr'
    ]);
    die;
  }
  $Altpass = $_POST['ConfirmPassworda'];
  if ($Pass != $Altpass) {
    echo json_encode([
      'response' => false,
      'message' => "Password should be same",
      'error_id' => 'cpassErr'
    ]);
    die;
  }
  $Picture = $_FILES['files'];
  $allowed =  array('jpeg', 'jpg', 'png', 'gif', 'bmp', 'JPEG', 'JPG', 'PNG', 'GIF', 'BMP', '');
  $ext = pathinfo($Picture['name'], PATHINFO_EXTENSION);
  if (!in_array($ext, $allowed)) {
    echo json_encode([
      'response' => false,
      'message' => "Please updload valid image",
      'error_id' => 'picerr'
    ]);
    die;
  }
  $path = $_SERVER['DOCUMENT_ROOT'] . "/mail_project/images";
  $temp_name = $Picture['tmp_name'];
  $name = $Picture['name'];
  $path = $path . "/" . $name;
  move_uploaded_file($temp_name, $path);


  $w = "INSERT INTO users(First_name, Last_name ,User_name,Picture, Email, Secordary_mail, Password,Confirmpassword) VALUES ('$Fname', '$Lname', '$Uname','$name', '$Ename', '$Altname', '$Pass','$Altpass')";

  if ($obj->insert($w)) {
    // $obj->url("../registration.php?msg=run");
    // session_start()
    $_SESSION['Email'] = $Ename;
    echo json_encode(['response' => true, 'message' => 'Registration successfull']);
  } else {
    echo json_encode([
      'response' => false,
      'message' => 'somthing went wrong', 'error_id' => 'Formsubmit'
    ]);
  }
}
