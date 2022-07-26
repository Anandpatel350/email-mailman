<?php
include 'phpinclude/connection.php';

$email = $_SESSION['Email'];
$limit_ofset = 10;
$page = "";

// ----------------compose----------------------
if (isset($_POST['submsg'])) {

  $msgarray=array();

  $to_mail = strtolower($_POST['to_name']);

if(($to_mail==$email)){
  $msgarray[0]='toname';
}elseif (!filter_var($to_mail, FILTER_VALIDATE_EMAIL)) {
    $msgarray[0]='toname';
  }
  else
  {
  $sql = "SELECT id from users where Email = '$to_mail'";
  $che = $obj->checkquery($sql);
  if ($che == false) {
    $msgarray[0]='toname';
  }
}
  
  $cc_mail = strtolower($_POST['cc_name']);
  
  if ($cc_mail != null) {
    if(($cc_mail==$email || $cc_mail==$to_mail)){
      $msgarray[1]='ccname';
    }
    elseif (!filter_var($cc_mail, FILTER_VALIDATE_EMAIL)) {
      $msgarray[1]='ccname';
    }
   else{
    $sql = "SELECT id from users where Email = '$cc_mail'";
    $che = $obj->checkquery($sql);
    if ($che == false) {
      $msgarray[1]='ccname';
    }
  }
  }

  $bcc_mail = strtolower($_POST['bcc_name']);
  
  if ($bcc_mail != null) {
    if(($bcc_mail==$email || $bcc_mail==$to_mail || $bcc_mail==$cc_mail)){
      $msgarray[2]='bccname';
    }
    elseif (!filter_var($bcc_mail, FILTER_VALIDATE_EMAIL)) {
      $msgarray[2]='bccname';
    }
    else{
    $sql = "SELECT id from users where Email = '$bcc_mail'";
    $che = $obj->checkquery($sql);
    if ($che == false) {
      $msgarray[2]='bccname';
    }
  }
  }
  $sub_mail = $obj->test_input($_POST['sub_name']);

  $text_mail = $obj->test_data($_POST['text_name']);

  $attechment = $_FILES['files'];
  $path = $_SERVER['DOCUMENT_ROOT'] . "/mail_project/images";
  $temp_name = $attechment['tmp_name'];
  $name = $attechment['name'];
  $path = $path . "/" . $name;
  move_uploaded_file($temp_name, $path);

  $dat = date("d-m-y h:i:s");

  if((count($msgarray) == 0)) {
    $wa = "INSERT INTO userdata(to_email,from_email, cc_email,bcc_email ,`subject`, `message`, attachment,`time`,from_trash,to_trash,cc_trash,bcc_trash,draft) VALUES ('$to_mail','$email','$cc_mail','$bcc_mail', '$sub_mail', '$text_mail ', '$name','$dat','0','0','0','0','0')";
    $obj->insert($wa);
    echo json_encode(['response' => true, 'message' => 'Massage sent successfully']);
  }
  else{
    echo json_encode(
      [
        "error_value" => $msgarray,
        "response" => false
      ]
    );
  }
}
// -----------
if (isset($_POST['draftdata'])) {

  $to_mail = $obj->test_input($_POST['to_name']);
  $cc_mail = $obj->test_input($_POST['cc_name']);
  $bcc_mail = $obj->test_input($_POST['bcc_name']);
  $sub_mail = $obj->test_input($_POST['sub_name']);
  $text_mail = $obj->test_data($_POST['text_name']);
  $attechment = $_FILES['files'];
  $path = $_SERVER['DOCUMENT_ROOT'] . "/mail_project/images";
  $temp_name = $attechment['tmp_name'];
  $name = $attechment['name'];
  $path = $path . "/" . $name;
  move_uploaded_file($temp_name, $path);

  $dat = date("d-m-y h:i:s");
  if(!($to_mail==null && $cc_mail==null && $bcc_mail==null &&  $sub_mail ==null && $text_mail==null && $attechmen==null)){
  $wa = "INSERT INTO userdata(from_email,to_email, cc_email,bcc_email ,`subject`, `message`, attachment,`time`,from_trash,to_trash,cc_trash,bcc_trash,draft) VALUES ('$email','$to_mail','$cc_mail','$bcc_mail', '$sub_mail', '$text_mail ', '$name','$dat','0','0','0','0','1')";

  if ($obj->insert($wa)) {
    echo json_encode(['response' => true, 'message' => 'Massage saved in draft successfully']);
  }
}
}
// ------------open mail in inbox ------------

if (isset($_POST['selectrow_inbox'])) {
  $vaue = $_POST['selectrow_inbox_data'];

  $sql = "SELECT * FROM userdata  WHERE id='$vaue' ORDER BY id desc";

  $result = $obj->conn->query($sql);
  $output = $result->fetch_all(MYSQLI_ASSOC);
  $result_check = $obj->fetchdata($sql);
  if($email == $result_check['to_email']) {
    $readqry = "UPDATE userdata SET read_unread_to = '0' WHERE id='$vaue'";
   
  } else if($email == $result_check['cc_email']) {
    $readqry = "UPDATE userdata SET read_unread_cc = '0' WHERE id='$vaue'";
  } else if($email == $result_check['bcc_email']) {
    $readqry = "UPDATE userdata SET read_unread_bcc = '0' WHERE id='$vaue'";
  }
  $obj->insert($readqry);
  echo json_encode($output);

 

}


// ------------open mail------------

if (isset($_POST['selectrow'])) {
  $vaue = $_POST['selectrow'];
  $sql = "SELECT * FROM userdata  WHERE id='$vaue' ORDER BY id desc";
  $result = $obj->conn->query($sql);
  $output = $result->fetch_all(MYSQLI_ASSOC);
  echo json_encode($output);
}
// -----------sentbox---------------------------------------------------------------------------------------------------------------
if (isset($_POST['sendItem'])) {

  if (isset($_POST['page_no'])) {
    $page = $_POST['page_no'];
  } else {
    $page = 1;
  }
  $ofset = ($page - 1) * $limit_ofset;

  $sql = "SELECT * FROM userdata  WHERE from_email='$email' and (from_trash ='0' and draft='0') ORDER BY id desc limit {$ofset},{$limit_ofset}";

  $result = $obj->conn->query($sql);
  $output = $result->fetch_all(MYSQLI_ASSOC);

  $datavalue = '';
  $datavalue .=" <table class='table'>  <div id='table_head'> <tr><th style='width:5%'></th> <th style='width:42%'>To</th><th style='width:38%'>subject</th><th style='width:15%'>YY/MM-DD</th> </tr></div><tbody >";
  foreach ($output as $k => $v) {
    $datavalue .= "<tr data-id=" . $v['id'] . "><td><input type='checkbox' name='inboxtable' class='checkinbox' data-id=" . $v['id'] . "></td><td class='inboxclass'>" . $v['to_email'] . "</td><td class='inboxclass'>" .  $a = (!empty($v['subject']) ? $v['subject'] : '(No Subject)'). "</td><td class='inboxclass'>" . $v['time'] . "</td></tr>";
  }
  $datavalue .= "</tbody> </table>";

  $sql_total = "SELECT * FROM userdata  WHERE from_email='$email' and (from_trash ='0' and draft='0')";
  $total_record = $obj->conn->query($sql_total);
  $total_numrow = $total_record->num_rows;
  $total_pages = ceil($total_numrow / $limit_ofset);

  $datavalue .= "<nav aria-label='Page navigation example' id='paggi'> <ul class='pagination'>";
  for ($i = 1; $i <= $total_pages; $i++) {

    $datavalue .= "<a class='page-link' id='{$i}'>{$i}</a>";
  }

  $datavalue .= "</ul></nav>";


  if ($result->num_rows > 0) {
    echo json_encode([$datavalue]);
  } else {
    echo json_encode(["massege" => "0 result found", "status" => false]);
  }
}
// --------------draft---------------
if (isset($_POST['draftitem'])) {
  if (isset($_POST['page_no'])) {
    $page = $_POST['page_no'];
  } else {
    $page = 1;
  }
  $ofset = ($page - 1) * $limit_ofset;

  $sql = "SELECT * FROM userdata  WHERE from_email='$email' and (from_trash ='0' and draft='1') ORDER BY id desc limit {$ofset},{$limit_ofset}";
  $result = $obj->conn->query($sql);
  $output = $result->fetch_all(MYSQLI_ASSOC);

  $datavalue = '';
  $datavalue .=" <table class='table'>  <div id='table_head'> <tr><th style='width:5%'></th> <th style='width:42%'>To</th><th style='width:38%'>subject</th><th style='width:15%'>YY/MM-DD</th> </tr></div><tbody >";
  
  foreach ($output as $k => $v) {
    $datavalue .= "<tr data-id=" . $v['id'] . "><td><input type='checkbox' name='inboxtable' class='checkinbox' data-id=" . $v['id'] . "></td><td class='inboxclass text-danger'>" .  $b = (!empty($v['to_email']) ? $v['to_email']: 'Draft') . "</td><td class='inboxclass'>" . $a = (!empty($v['subject']) ? $v['subject'] : '(No Subject)'). "</td><td class='inboxclass'>" . $v['time'] . "</td></tr>";
  }
  $datavalue .= "</tbody> </table>";

  $sql_total = "SELECT * FROM userdata  WHERE from_email='$email' and (from_trash ='0' and draft='1')";
  $total_record = $obj->conn->query($sql_total);
  $total_numrow = $total_record->num_rows;
  $total_pages = ceil($total_numrow / $limit_ofset);

  $datavalue .= "<nav aria-label='Page navigation example' id='paggi'> <ul class='pagination'>";
  for ($i = 1; $i <= $total_pages; $i++) {

    $datavalue .= "<a class='page-link' id='{$i}'>{$i}</a>";
  }

  $datavalue .= "</ul></nav>";


  if ($result->num_rows > 0) {
    echo json_encode([$datavalue]);
  } else {
    echo json_encode(["massege" => "0 result found", "status" => false]);
  }
}

// -----------trash-------------
if (isset($_POST['trashitem'])) {
  if (isset($_POST['page_no'])) {
    $page = $_POST['page_no'];
  } else {
    $page = 1;
  }
  $ofset = ($page - 1) * $limit_ofset;

  $sql = "SELECT * FROM userdata  WHERE (from_email='$email' and from_trash='1' and from_delete='0') or (to_email='$email' and to_trash='1' and to_delete='0' ) or (cc_email='$email' and cc_trash='1' and cc_delete='0' ) or (bcc_email='$email' and bcc_trash='1' and bcc_delete='0' ) ORDER BY time desc limit {$ofset},{$limit_ofset}";

  $result = $obj->conn->query($sql);
  $output = $result->fetch_all(MYSQLI_ASSOC);
  $datavalue = '';
  $datavalue .=" <table class='table'>  <div id='table_head'> <tr><th style='width:5%'></th> <th style='width:42%'>........@mailman.com</th><th style='width:38%'>subject</th><th style='width:15%'>YY/MM-DD</th> </tr></div><tbody >";
  foreach ($output as $k => $v) {
    $datavalue .= "<tr data-id=" . $v['id'] . "><td><input type='checkbox' name='inboxtable' class='checkinbox' data-id=" . $v['id'] . "></td><td class='inboxclass'>" . $v['from_email'] . "</td><td class='inboxclass'>" .  $a = (!empty($v['subject']) ? $v['subject'] : '(No Subject)'). "</td><td class='inboxclass'>" . $v['time'] . "</td></tr>";
  }
  $datavalue .= "</tbody> </table>";

  $sql_total = "SELECT * FROM userdata  WHERE (from_email='$email' and from_trash='1' and from_delete='0') or (to_email='$email' and to_trash='1' and to_delete='0' ) or (cc_email='$email' and cc_trash='1' and cc_delete='0' ) or (bcc_email='$email' and bcc_trash='1' and bcc_delete='0' )";
  $total_record = $obj->conn->query($sql_total);
  $total_numrow = $total_record->num_rows;
  $total_pages = ceil($total_numrow / $limit_ofset);

  $datavalue .= "<nav aria-label='Page navigation example' id='paggi'> <ul class='pagination'>";
  for ($i = 1; $i <= $total_pages; $i++) {

    $datavalue .= "<a class='page-link' id='{$i}'>{$i}</a>";
  }

  $datavalue .= "</ul></nav>";


  if ($result->num_rows > 0) {
    echo json_encode($datavalue);
  } else {
    echo json_encode(["massege" => "0 result found", "status" => false]);
  }
}
// --------------------inbox----------
if (isset($_POST['inboxitem'])) {
  
  if (isset($_POST['page_no'])) {
    $page = $_POST['page_no'];
  } else {
    $page = 1;
  }
  $ofset = ($page - 1) * $limit_ofset;

  $sql = "SELECT * FROM userdata  WHERE (to_email='$email'and to_trash='0' or cc_email='$email' and cc_trash='0' or bcc_email='$email' and bcc_trash='0') and  draft='0' ORDER BY id desc limit {$ofset},{$limit_ofset} ";
  $result = $obj->conn->query($sql);
  $output = $result->fetch_all(MYSQLI_ASSOC);
  $datavalue = '';
  
  $datavalue .= " <table class='table'>  <div id='table_head'> <tr><th style='width:5%'></th> <th style='width:42%'>From</th><th style='width:38%'>subject</th><th style='width:15%'>YY/MM-DD</th> </tr></div><tbody >";
  foreach ($output as $k => $v) {
    if($email == $v['to_email']){
    $datavalue .= "<tr style=" . (!empty($v['read_unread_to']) ? 'font-weight:500' : 'font-weight:350') ." data-id=" . $v['id'] ."><td><input type='checkbox' name='inboxtable' class='checkinbox' data-id=" . $v['id'] . "></td><td class='inboxclass'>" . $v['from_email'] . "</td><td class='inboxclass'>" .  $a = (!empty($v['subject']) ? $v['subject'] : '(No Subject)'). "</td><td class='inboxclass'>" . $v['time'] . "</td></tr>";
    }elseif($email ==$v['cc_email']){
      $datavalue .= "<tr style=" . (!empty($v['read_unread_cc']) ? 'font-weight:500' : 'font-weight:350') ." data-id=" . $v['id'] ."><td><input type='checkbox' name='inboxtable' class='checkinbox' data-id=" . $v['id'] . "></td><td class='inboxclass'>" . $v['from_email'] . "<span class='text-success small'>-(cc)</span>"."</td><td class='inboxclass'>" .  $a = (!empty($v['subject']) ? $v['subject'] : '(No Subject)'). "</td><td class='inboxclass'>" . $v['time'] . "</td></tr>";
    }elseif($email == $v['bcc_email']){
      $datavalue .= "<tr style=" . (!empty($v['read_unread_bcc']) ? 'font-weight:500' : 'font-weight:350') ." data-id=" . $v['id'] ."><td><input type='checkbox' name='inboxtable' class='checkinbox' data-id=" . $v['id'] . "></td><td class='inboxclass'>" . $v['from_email'] . "<span class='text-success small'>-(bcc)</span>"."</td><td class='inboxclass'>" .  $a = (!empty($v['subject']) ? $v['subject'] : '(No Subject)'). "</td><td class='inboxclass'>" . $v['time'] . "</td></tr>";
    }
  }
  $datavalue .= "</tbody> </table>";

  $sql_total = "SELECT * FROM userdata  WHERE (to_email='$email'and to_trash='0' or cc_email='$email' and cc_trash='0' or bcc_email='$email' and bcc_trash='0') and  draft='0'";
  $total_record = $obj->conn->query($sql_total);
  $total_numrow = $total_record->num_rows;
  $total_pages = ceil($total_numrow / $limit_ofset);

  $datavalue .= "<nav aria-label='Page navigation example' id='paggi'> <ul class='pagination'>";
  for ($i = 1; $i <= $total_pages; $i++) {

    $datavalue .= "<a class='page-link' id='{$i}'>{$i}</a>";
  }

  $datavalue .= "</ul></nav>";


  if ($result->num_rows > 0) {
    echo json_encode([$datavalue]);
  } else {
    echo json_encode(["massege" => "0 result found", "status" => false]);
  }
}

// -----------------------------------inbox delete------------------------
if (isset($_POST['inbox_value'])) {
  $IDD = $_POST['inbox_delete'];
  $qry = "select * from userdata where id='$IDD'";
  $result = $obj->fetchdata($qry);
  if($email == $result['to_email']) {
    $sql = "UPDATE userdata SET to_trash  = '1' WHERE id='$IDD'";
   
  } else if($email == $result['cc_email']) {
    $sql = "UPDATE userdata SET cc_trash  = '1' WHERE id='$IDD'";
  } else if($email == $result['bcc_email']) {
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
// ----------------trash item delete-------------
if (isset($_POST['trash_value_delete'])) {
  $IDD = $_POST['trash_delete'];
  $qry = "select * from userdata where id='$IDD'";
  $result = $obj->fetchdata($qry);
  // print_r($result);die();
  if($email == $result['from_email']) {
    $sql = "UPDATE userdata SET from_delete  = '1' WHERE id='$IDD'";
   
  }else if($email == $result['to_email']) {
    $sql = "UPDATE userdata SET to_delete  = '1' WHERE id='$IDD'";
   
  } else if($email == $result['cc_email']) {
    $sql = "UPDATE userdata SET cc_delete  = '1' WHERE id='$IDD'";
  } else if($email == $result['bcc_email']) {
    $sql = "UPDATE userdata SET bcc_delete  = '1' WHERE id='$IDD'";
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
// -------------trash_restore-------------------
if (isset($_POST['trash_value_restore'])) {
  $IDD = $_POST['trash_restore'];
  $qry = "select * from userdata where id='$IDD'";
  $result = $obj->fetchdata($qry);
  if($email == $result['from_email']) {
    $sql = "UPDATE userdata SET from_trash  = '0' WHERE id='$IDD'";
   
  }else if($email == $result['to_email']) {
    $sql = "UPDATE userdata SET to_trash  = '0' WHERE id='$IDD'";
   
  } else if($email == $result['cc_email']) {
    $sql = "UPDATE userdata SET cc_trash  = '0' WHERE id='$IDD'";
  } else if($email == $result['bcc_email']) {
    $sql = "UPDATE userdata SET bcc_trash  = '0' WHERE id='$IDD'";
  }
  if ($obj->insert($sql)) {
    echo json_encode([
      'response' => true,
      'message' => "value Restored",
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
  $sql = "UPDATE userdata SET draft = '1',from_trash='1' WHERE id='$IDD'";
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
// ------------read unread functinality-----------
if (isset($_POST['inbox_value_unread']) || isset($_POST['inbox_value_Read'])) {
  $IDD = (!empty($_POST['inbox_value_unread_data']) ? $_POST['inbox_value_unread_data'] : $_POST['inbox_value_Read_data']);

  $qry = "select * from userdata where id='$IDD'";
  $result = $obj->fetchdata($qry);
  if($email == $result['to_email']) {
    if(isset($_POST['inbox_value_unread'])){
      $sql = "UPDATE userdata SET read_unread_to = '1' WHERE id='$IDD'";
    } else
    {
      $sql = "UPDATE userdata SET read_unread_to = '0' WHERE id='$IDD'"; 
    }
   
  } else if($email == $result['cc_email']) {
    if(isset($_POST['inbox_value_unread'])){
      $sql = "UPDATE userdata SET read_unread_cc = '1' WHERE id='$IDD'";
    } else
    {
      $sql = "UPDATE userdata SET read_unread_cc = '0' WHERE id='$IDD'"; 
    }
  } else if($email == $result['bcc_email']) {
    if(isset($_POST['inbox_value_unread'])){
      $sql = "UPDATE userdata SET read_unread_bcc = '1' WHERE id='$IDD'";
    } else
    {
      $sql = "UPDATE userdata SET read_unread_bcc = '0' WHERE id='$IDD'"; 
    }
  }


 if ($obj->insert($sql)) {
    echo json_encode([
      'response' => true,
    ]);
  } 
  
}
// -----------------------------------searchbar------------------------
if (isset($_POST['searchitem'])) {
  $IDD = $_POST['serchtext'];
  if (isset($_POST['page_no'])) {
    $page = $_POST['page_no'];
  } else {
    $page = 1;
  }
  $ofset = ($page - 1) * $limit_ofset;

  $sql = "SELECT * FROM userdata WHERE subject like '%$IDD%' and (from_email='$email' and from_trash='0' or to_email='$email' and to_trash='0' or cc_email='$email' and cc_trash='0' or bcc_email='$email' and bcc_trash='0') and  draft='0' ORDER BY id desc limit {$ofset},{$limit_ofset}";

  $result = $obj->conn->query($sql);
  $output = $result->fetch_all(MYSQLI_ASSOC);

  $datavalue = '';
  $datavalue .= " <table class='table'>  <div id='table_head'> <tr><th></th> <th>@mailman.com</th><th>subject</th> <th>YY/MM-DD</th> </tr></div><tbody >";
  foreach ($output as $k => $v) {
    $datavalue .= "<tr data-id=" . $v['id'] . "><td><input type='checkbox' name='inboxtable' class='checkinbox' data-id=" . $v['id'] . "></td><td class='inboxclass'>" . $v['from_email'] . "</td><td class='inboxclass'>" .  $v['subject'] . "</td><td class='inboxclass'>" . $v['time'] . "</td></tr>";
  }
  $datavalue .= "</tbody> </table>";

  $sql_total = "SELECT * FROM userdata WHERE subject like '%$IDD%' and (from_email='$email' and from_trash='0' or to_email='$email' and to_trash='0' or cc_email='$email' and cc_trash='0' or bcc_email='$email' and bcc_trash='0') and  draft='0'";
  $total_record = $obj->conn->query($sql_total);
 
  $total_numrow = $total_record->num_rows; 
  $total_pages = ceil($total_numrow / $limit_ofset);

  $datavalue .= "<nav aria-label='Page navigation example' id='paggii'> <ul class='pagination justify-content-center'>";
  for ($i = 1; $i <= $total_pages; $i++) {

    $datavalue .= "<a class='page-link' id='{$i}'>{$i}</a>";
  }

  $datavalue .= "</ul></nav>";
  if ($result->num_rows > 0) {
    
    echo json_encode($datavalue);
  } else {
    echo json_encode(["massege" => "0 result found", "status" => false]);
  }
}
