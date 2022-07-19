<?php
include 'phpinclude/connection.php';

$email = $_SESSION['Email'];

// ----------------compose----------------------
if (isset($_POST['submsg'])) {

  $to_mail = $_POST['to_name'];
  if ($to_mail == $email) {
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

  $wa = "INSERT INTO userdata(to_email,from_email, cc_email,bcc_email ,`subject`, `message`, attachment,`time`,from_trash,to_trash,cc_trash,bcc_trash,draft) VALUES ('$to_mail','$email','$cc_mail','$bcc_mail', '$sub_mail', '$text_mail ', '$name','$dat','0','0','0','0','0')";

  if ($obj->insert($wa)) {
    echo json_encode(['response' => true, 'message' => 'Msg sent successfull']);
  }
}
// -----------
if (isset($_POST['draftdata'])) {

  $to_mail = $_POST['to_name'];
  $cc_mail = $_POST['cc_name'];
  $bcc_mail = $_POST['bcc_name'];
  $sub_mail = $_POST['sub_name'];
  $text_mail = $_POST['text_name'];
  $attechment = $_FILES['files'];
  $path = $_SERVER['DOCUMENT_ROOT'] . "/mail_project/images";
  $temp_name = $attechment['tmp_name'];
  $name = $attechment['name'];
  $path = $path . "/" . $name;
  move_uploaded_file($temp_name, $path);

  $dat = date("d-m-y h:i:s");
  $wa = "INSERT INTO userdata(from_email,to_email, cc_email,bcc_email ,`subject`, `message`, attachment,`time`,from_trash,to_trash,cc_trash,bcc_trash,draft) VALUES ('$email','$to_mail','$cc_mail','$bcc_mail', '$sub_mail', '$text_mail ', '$name','$dat','0','0','0','0','1')";

  if ($obj->insert($wa)) {
    echo json_encode(['response' => true, 'message' => 'Msg saved in draft successfull']);
  }
}

// ------------open mail------------

if (isset($_POST['selectrow'])) {
  $vaue = $_POST['selectrow'];

  $sql = "SELECT * FROM userdata  WHERE id='$vaue' ORDER BY id desc";

  $result = $obj->conn->query($sql);
    $output = $result->fetch_all(MYSQLI_ASSOC);
    echo json_encode($output);
   
}
// -----------sentbox-------------
if (isset($_POST['sendItem'])) {
  $sql = "SELECT * FROM userdata  WHERE from_email='$email' and (from_trash ='0' and draft='0') ORDER BY id desc";

  $result = $obj->conn->query($sql);

  // print_r($result);

  if ($result->num_rows > 0) {
    $output = $result->fetch_all(MYSQLI_ASSOC);
    echo json_encode($output);
  } else {
    echo json_encode(["msg" => "0 result found", "status" => false]);
  }
}
// --------------draft---------------
if (isset($_POST['draftitem'])) {

  $sql = "SELECT * FROM userdata  WHERE from_email='$email' and (from_trash ='0' and draft='1') ORDER BY id desc";

  $result = $obj->conn->query($sql);

  if ($result->num_rows > 0) {
    $output = $result->fetch_all(MYSQLI_ASSOC);
    echo json_encode($output);
  } else {
    echo json_encode(["msg" => "0 result found", "status" => false]);
  }
}

// -----------trash-------------
if (isset($_POST['trashitem'])) {
  $sql = "SELECT * FROM userdata  WHERE (from_email='$email' and from_trash='1') or (to_email='$email' and to_trash='1') or (cc_email='$email' and cc_trash='1') or (bcc_email='$email' and bcc_trash='1') ORDER BY time desc";

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
  // $sql = "SELECT * FROM userdata  WHERE (to_email='$email' or cc_email='$email' or bcc_email='$email') and  draft='0' ORDER BY id desc ";
  $sql = "SELECT * FROM userdata  WHERE (to_email='$email'and to_trash='0' or cc_email='$email' and cc_trash='0' or bcc_email='$email' and bcc_trash='0') and  draft='0' ORDER BY id desc ";
  

  $result = $obj->conn->query($sql);

  // print_r($result);

  if ($result->num_rows > 0) {
    $output = $result->fetch_all(MYSQLI_ASSOC);
    echo json_encode($output);
  } else {
    echo json_encode(["msg" => "0 result found", "status" => false]);
  }
}

// -----------------------------------inbox delete------------------------
if (isset($_POST['inbox_value'])) {
  $IDD = $_POST['inbox_delete'];
  $qry="select * from userdata where id='$IDD'";
$result=$obj->fetchdata($qry);
if($email==$result['to_email']){
  $sql = "UPDATE userdata SET to_trash  = '1' WHERE id='$IDD'";
} elseif($email==$result['cc_email'])
{
  $sql = "UPDATE userdata SET cc_trash  = '1' WHERE id='$IDD'";
}
elseif($email==$result['bcc_email'])
{
  $sql = "UPDATE userdata SET bcc_trash  = '1' WHERE id='$IDD'";
}
  if ($obj->insert($sql)) {
    echo json_encode([
      'response' => true,
      'message' => "selected value deleted",
    ]);
  } else {
    echo json_encode([
      'response' => false,
      'message' => "selected value not deleted",

    ]);
  }
}
// ------------send delete-------------
if (isset($_POST['Send_value'])) {
  $IDD = $_POST['send_delete'];
  $sql = "UPDATE userdata SET from_trash  = '1' WHERE id='$IDD'";
  if ($obj->insert($sql)) {
    echo json_encode([
      'response' => true,
      'message' => "selected value deleted",
    ]);
  } else {
    echo json_encode([
      'response' => false,
      'message' => "selected value not deleted",

    ]);
  }
}
// ----------draft delete-----------
if (isset($_POST['draft_value'])) {
  $IDD = $_POST['draft_delete'];
  $sql = "UPDATE userdata SET draft = '1' and from_trash='1' WHERE id='$IDD'";
  if ($obj->insert($sql)) {
    echo json_encode([
      'response' => true,
      'message' => "selected value deleted",
    ]);
  } else {
    echo json_encode([
      'response' => false,
      'message' => "selected value not deleted",

    ]);
  }
}
// -----------------------------------searchbar------------------------
if (isset($_POST['searchitem'])) {
  $IDD = $_POST['serchtext'];

  $sql = "SELECT * FROM userdata WHERE subject like '%$IDD%' and (from_email='$email' and from_trash='0' or to_email='$email' and to_trash='0' or cc_email='$email' and cc_trash='0' or bcc_email='$email' and bcc_trash='0') and  draft='0' ORDER BY id desc";

  $result = $obj->conn->query($sql);

  if ($result->num_rows > 0) {
    $output = $result->fetch_all(MYSQLI_ASSOC);
    echo json_encode($output);
  } else {
    echo json_encode(["msg" => "0 result found", "status" => false]);
  }
}
