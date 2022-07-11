<?php  
include 'phpinclude/connection.php';
$Ename=$_SESSION['Email']; 
$qrt="select * from users where Email='$Ename'";      
$data=$obj->fetchdata($qrt);
?>