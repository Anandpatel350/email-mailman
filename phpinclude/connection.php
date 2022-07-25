<?php
session_start();
class Dbconnection
{
  public $servername = "localhost";
  public $username = "root";
  public $password = "hestabit";
  public $Dbname = "mailman";
  public $conn;
  public function __construct()

  {
    $this->conn = new mysqli($this->servername, $this->username, $this->password, $this->Dbname);
  }
  public function insert($abs)
  {
    $value = $this->conn->query($abs);
    if ($value) {
      return true;
    } else {
      return false;
    }
  }
  public function checkquery($abs)
  {
    $val = $this->conn->query($abs);
    if ($val->num_rows>0) {
      return true;
    } else {
      return false;
    }
  }
  public function url($url)
  {
    header("location:" . $url);
  }
  public function login($data)
  {

    $log = $this->conn->query($data);
    $da = $log->fetch_assoc();
    $_SESSION['Email'] = $da['Email'];  
    $_SESSION['Picture'] = $da['Picture'];  
    if ($log->num_rows > 0) {
      return true;
    } else {
      return false;
    }
  }
  public function logout()
  {
    unset($_SESSION['Email']);
    header('location:../index.php');
  }
  public function fetchdata($abs)
  {
    $value = $this->conn->query($abs);
    $data = $value->fetch_assoc();
    if ($data) {
      return $data;
    } else {
      return false;
    }
  }
  function test_input($data)
  {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }
  function test_data($data) {
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }
}

$obj = new Dbconnection();
