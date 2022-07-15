<?php
include "connection.php";
if(isset($_POST['submit']))
{
 $user_name = $obj->test_input($_POST['email']);
 $password = $obj->test_input($_POST['password']);

      $data = "select Email,User_name, Password from users where (Email='$user_name' or User_name='$user_name') and Password='$password'";
      if($obj->login($data))
      {
         
          echo json_encode([
            'response'=>true

        ]);
      }
      else{
         echo json_encode([
             'response'=>false,
             'message'=>"Incorrect user name or password",
             'error_id'=>'error'
         ]);
      }
  }
