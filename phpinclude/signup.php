<?php
include "connection.php";
if (isset($_POST['submit'])) {
  $ob = new Dbconnection();
  $errid = array();


  $Fname = $_POST['First_name'];
  $Lname = $_POST['Last_name'];
  $Uname = $_POST['User_Name'];
  $Ename = $_POST['Email_name'];
  $mailmanattern = "/^[\w.+\-]+@mailman\.com$/";
  $patterngmail = "/^[\w.+\-]+@gmail\.com$/";
  $namepattern = "/^[A-Za-z]+$/";
  $Altname = $_POST['Atlemail_name'];
  $Pass = $_POST['Passworda'];
  $Altpass = $_POST['ConfirmPassworda'];
  $Picture = $_FILES['files'];
 
  if ($Fname == '' and $Fname == null) {
    $errid['nameErr'] = 'Please Enter Name';
  } else if (!preg_match($namepattern, $Fname)) {
    $errid['nameErr'] = 'Only letters allowed';
  } else {
    $errid['nameErr']='';
   
    // unset( $errid['nameErr']);
  }

  if ($Lname == '' and $Lname == null) {
    $errid['lnameErr'] = 'Please Enter Name';
  } else if (!preg_match($namepattern, $Fname)) {
    $errid['lnameErr'] = 'Only letters allowed';
  } else {
  
    $errid['lnameErr']='';
  }


  if ($Uname == null) {
    $errid['unemeErr'] = 'Please fill  User Name';
  } else {
    $sql = "SELECT id from users where User_name = '$Uname'";
    $res = $ob->conn->query($sql);
    if ($res->num_rows > 0) {

      $errid['unemeErr'] = 'Please try another User Name';
    } else {
      $errid['unemeErr']='';
    }
  }

  // ------------check------------------
  if (!preg_match($mailmanattern, $Ename)) {
    $Ename = $_POST['Email_name'] . "@mailman.com";
  }
  if (!filter_var($Ename, FILTER_VALIDATE_EMAIL)) {

    $errid['emailErr'] = 'email address not vlaid';
  } else {
    $sql = "SELECT id from users where Email = '$Ename'";
    $res = $ob->conn->query($sql);
    if ($res->num_rows > 0) {
      $errid['emailErr'] = 'email address not unique';
    } else {
      $errid['emailErr']='';
    }
  }

  if (!preg_match($patterngmail, $Altname)) {

    $errid['cemailErr'] = 'email address not vlaid';
  } else {
    
    $errid['cemailErr']='';
  }

  if (!preg_match('/^(?=.*\d)(?=.*[A-Za-z])(?=.*[!@#$%])[0-9A-Za-z!@#$%]{8,20}$/', ($Pass))) {
    $errid['passErr'] = 'Password should be at least 8 characters in length and should include at least one upper case letter, one number, and one special character.';
  } else {
   
    $errid['passErr']='';
  }

  if ($Pass != $Altpass) {
    $errid['cpassErr'] = 'Password should be same';
  } else {
  
    $errid['cpassErr']='';
  }
  // $path = $_SERVER['DOCUMENT_ROOT'] . "/mail_project/images";
  $path="../images/";
  $temp_name = $Picture['tmp_name'];
  $name = $Picture['name'];
  $path = $path . "/" . $name;
  if ($Picture != null) {
    $allowed =  array('jpeg', 'jpg', 'png', 'JPEG', 'JPG', 'PNG', 'GIF');
    $ext = pathinfo($Picture['name'], PATHINFO_EXTENSION);
    if (!in_array($ext, $allowed)) {
     $errid['picerr'] = 'Please updload valid image';
    } else if ($Picture['name']['size'] > 200000) {
      $errid['picerr'] = 'size should be less than 2 kb';
    } else {
      move_uploaded_file($temp_name, $path);
      $errid['picerr']='';
    }
  }
//   $length = count($CodeWallTutorialArray);
// $i=0;
// $counter=0;
//   while($errid<$length){
// if($errid[$i]!='')
// {
//   $counter=1;
// }
//   }
$count=0;
foreach ( $errid as $key => $value ) {
  if($value != ''){
    $count=1;
    break;
  }
}

  if ($count==1) {
    echo json_encode(
      [
        "arrayvalue" => $errid,
        "response" => false
      ]
    );
  } else {
    $w = "INSERT INTO users(First_name, Last_name ,User_name,Picture, Email, Secordary_mail, Password,Confirmpassword) VALUES ('$Fname', '$Lname', '$Uname','$name', '$Ename', '$Altname', '$Pass','$Altpass')";
    $obj->insert($w);
    echo json_encode(['response' => true]);
  }
}
