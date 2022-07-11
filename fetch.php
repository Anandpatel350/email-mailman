<?php
include 'phpinclude/connection.php';

$email = $_SESSION['Email'];
// ----------------compose----------------------
if (isset($_POST['submsg'])) {

  $to_mail = $_POST['to_name'];
  if ($to_mail==$email) {
    echo json_encode([
      'response' => false,
      'error_id' => 'toname'
    ]);
    die;
  }

  if (!filter_var($to_mail, FILTER_VALIDATE_EMAIL)) {
    echo json_encode([
      'response' => false,
      'error_id' => 'toname'
    ]);
    die;
  }
  $sql = "SELECT id from users where Email = '$to_mail'";
  $che = $obj->checkquery($sql);
  if ($che == false) {
    echo json_encode([
      'response' => false,
      'error_id' => 'toname'
    ]);
    die;
  }
  $cc_mail = $_POST['cc_name'];
  if ($cc_mail != null) {
    if (!filter_var($cc_mail, FILTER_VALIDATE_EMAIL)) {
      echo json_encode([
        'response' => false,
        'error_id' => 'ccname'
      ]);
      die;
    }
    $sql = "SELECT id from users where Email = '$cc_mail'";
    $che = $obj->checkquery($sql);
    if ($che == false) {
      echo json_encode([
        'response' => false,
        'error_id' => 'ccname'
      ]);
      die;
    }
  }

  $bcc_mail = $_POST['bcc_name'];
  if ($bcc_mail != null) {
    if (!filter_var($bcc_mail, FILTER_VALIDATE_EMAIL)) {
      echo json_encode([
        'response' => false,
        'error_id' => 'bccname'
      ]);
      die;
    }
    $sql = "SELECT id from users where Email = '$bcc_mail'";
    $che = $obj->checkquery($sql);
    if ($che == false) {
      echo json_encode([
        'response' => false,
        'message' => "email address not vlaid",
        'error_id' => 'bccname'
      ]);
      die;
    }
  }
  $sub_mail = $_POST['sub_name'];
  $text_mail = $_POST['text_name'];

  $attechment = $_FILES['files'];
  $path = $_SERVER['DOCUMENT_ROOT'] . "/mail_project/images";
  $temp_name = $attechment['tmp_name'];
  $name = $attechment['name'];
  $path = $path . "/" . $name;
  move_uploaded_file($temp_name, $path);

  $dat = date("d-m-y h:i:s");

  $wa = "INSERT INTO userdata(to_email,from_email, cc_email,bcc_email ,`subject`, `message`, attachment,`time`,sendstatus,recievestatus,draftstatus,trashstatus) VALUES ('$to_mail','$email','$cc_mail','$bcc_mail', '$sub_mail', '$text_mail ', '$name','$dat','0','0','0','0')";

  if ($obj->insert($wa)) {
    echo json_encode(['response' => true, 'message' => 'Msg sent successfull']);
  }
}
// -----------sentbox-------------
if (isset($_POST['sendItem'])) {
  $sql = "SELECT * FROM userdata  WHERE from_email='$email' and trashstatus ='0' ORDER BY id desc";

  $result = $obj->conn->query($sql);

  // print_r($result);

  if ($result->num_rows > 0) {
    $output = $result->fetch_all(MYSQLI_ASSOC);
    echo json_encode($output);
  } else {
    echo json_encode(["msg" => "0 result found", "status" => false]);
  }
}
// -----------draft-------------
if (isset($_POST['sendItemd'])) {
  $sql = "SELECT * FROM userdata  WHERE from_email='$email' and trashstatus ='1' ORDER BY id desc";

  $result = $obj->conn->query($sql);

  // print_r($result);

  if ($result->num_rows > 0) {
    $output = $result->fetch_all(MYSQLI_ASSOC);
    echo json_encode($output);
  } else {
    echo json_encode(["msg" => "0 result found", "status" => false]);
  }
}
// --------------------inbox----------
if (isset($_POST['inboxitem'])) {
  $sql = "SELECT * FROM userdata  WHERE (to_email='$email' or cc_email='$email' or bcc_email='$email') and draftstatus ='0' ORDER BY id desc";

  $result = $obj->conn->query($sql);

  // print_r($result);

  if ($result->num_rows > 0) {
    $output = $result->fetch_all(MYSQLI_ASSOC);
    echo json_encode($output);
  } else {
    echo json_encode(["msg" => "0 result found", "status" => false]);
  }
}

// -----------------------------------checkbox------------------------
if (isset($_POST['id'])) {
  $IDD=$_POST['id'];  
  $sql = "UPDATE userdata SET draftstatus = '1' WHERE id='$IDD'";
  if($obj->insert($sql))
  {
    echo json_encode([
      'response' => true,
      'message' => "selected value deleted",
    ]);
  }
  else
{
  echo json_encode([
    'response' => false,
    'message' => "selected value not deleted",
  
  ]);
}

 
}
