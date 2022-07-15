<?php
include "connection.php";
if (isset($_POST['submit'])) {
    $obf = new Dbconnection();

    $reset_link = $_POST['link_data'];

    $Pass = $_POST['Password'];

    if (!preg_match('/^(?=.*\d)(?=.*[A-Za-z])(?=.*[!@#$%])[0-9A-Za-z!@#$%]{8,20}$/', ($Pass))) {
        echo json_encode([
            'response' => false,
            'message' => "Password should be at least 8 characters in length and should include at least one upper case letter, one number, and one special character.",
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
    $sql = "UPDATE users SET `Password`  = '$Pass' , Confirmpassword = '$Altpass' WHERE reset_link = '$reset_link'";
    $res = $obf->conn->query($sql);
    // var_dump($res->num_rows);
    if (mysqli_affected_rows($obf->conn) > 0) {
        echo json_encode(['response' => true]);
    } else {
        echo json_encode(['resnose' => false, 'message' => "failed to change password"]);
    }
}
