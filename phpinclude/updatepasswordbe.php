<?php
include '../profileupdatedata.php';
if (isset($_POST['submit'])) {
    $email = $_SESSION['Email'];
    $oldpass = $_POST['oldpassword'];
    $Pass = $_POST['Password'];
    if (!preg_match('/^(?=.*\d)(?=.*[A-Za-z])(?=.*[!@#$%])[0-9A-Za-z!@#$%]{8,20}$/', ($Pass))) {
        echo json_encode([
            'response' => false,
            'message' => "Please Enter Strong Password",
            'error_id' => 'passErr'
        ]);
        die;
    }
    $Altpass = $_POST['passwordagain'];
    if ($Pass != $Altpass) {
        echo json_encode([
            'response' => false,
            'message' => "Password should be same",
            'error_id' => 'cpassErr'
        ]);
        die;
    }
    $passdata = $data['Password'];
    if ($oldpass == $passdata) {
        $result = "UPDATE users SET `Password`  = '$Pass' , `Confirmpassword`='$Pass' WHERE Email = '$email'";
        if ($obj->insert($result)) {
            echo json_encode(['response' => true, 'message' => 'password changed']);
        }
    } else {
        echo json_encode([
            'response' => false,
            'message' => "Please Enter Correct password",
            'error_id' => 'oldpassErr'
        ]);
        die();
    }
}
