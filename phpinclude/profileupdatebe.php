<?php
include "../profileupdatedata.php";
$updatearray = array();
$Ename=$_SESSION['Email'];
if (isset($_POST['submit'])) {
  $namepattern = "/^[A-Za-z]+$/";
  $patternyahoo = "/^[a-zA-Z]{3}+[a-zA-Z0-9_\-\.]+@yahoo\.com$/";
  $patterngmail = "/^[a-zA-Z]{3}+[a-zA-Z0-9_\-\.]+@gmail\.com$/";
  // $patternyahoo = "/^[a-zA-Z]{3}+[a-zA-Z0-9_\-\.]+@yahoo\.com$/";
  $ob = new Dbconnection();

  $Fname = $_POST['First_name'];
  

  if (empty($Fname)) {
    $updatearray['namerr'] = 'Please enter Name';
  }
  elseif(!preg_match($namepattern, $Fname)){

    $updatearray['namerr'] = 'Please enter valid Name';

  }
  else{
    $updatearray['namerr'] = '';
  }

  $Lname = $_POST['Last_name'];
  if (empty($Lname)) {
    $updatearray['lnamerr'] = 'Please enter last Name';
  }
  elseif(!preg_match($namepattern, $Lname)){

    $updatearray['lnamerr'] = 'Please enter valid last Nameiii';

  }
  else{
    $updatearray['lnamerr'] = '';
  }
  $Altname = $_POST['Atlemail_name'];
  if (!preg_match($patterngmail, $Altname) && !preg_match($patternyahoo, $Altname)) {

    $updatearray['cemailErr'] = 'email address not vlaid';
  } else {

    $updatearray['cemailErr'] = '';
  }
  $Picture = $_FILES['files'];
  $path = "../images/";
  $temp_name = $Picture['tmp_name'];
  $name = $Picture['name'];
  $path = $path . "/" . $name;
  if ($Picture != null) {
    $allowed =  array('jpeg', 'jpg', 'png', 'JPEG', 'JPG', 'PNG', 'GIF');
    $ext = pathinfo($Picture['name'], PATHINFO_EXTENSION);
    if (!in_array($ext, $allowed)) {
      $updatearray['picerr'] = 'Please updload valid image';
    } else if ($Picture['name']['size'] > 200000) {
      $updatearray['picerr'] = 'size should be less than 2 kb';
    } else {
      move_uploaded_file($temp_name, $path);
      $updatearray['picerr'] = '';
    }
  }


  $name = $Picture['name']!=null? $Picture['name'] : $data['Picture'];

  $count_x = 0;
  foreach ($updatearray as $key => $value) {
    if ($value != "") {
      $count_x = 1;
      break;
      
    }
  }

  if($count_x == 1) {
    echo json_encode(
      [
        "arrayvalue" => $updatearray,
        "response" => false
      ]
    );
  } else {
    $sql = "UPDATE users SET `First_name`  = '$Fname' , `Last_name`  = '$Lname' ,`Secordary_mail`  = '$Altname', `Picture`  = '$name'  WHERE Email = '$Ename'";
    $ob->insert($sql);
    echo json_encode([
      'response' => true,
      'message' => "Profile Updated successfully"

    ]);
  }

}

if(isset($_POST['id'])) {
$dlt="update users set Picture =null WHERE Email='$Ename'";
  if($obj->insert($dlt)) {
    echo json_encode([
      'response' => true,
      'message' => "Profile Photo Deleted"

    ]);
  } 
}
