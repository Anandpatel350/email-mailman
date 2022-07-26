<?php
// use email\sendEmail;
include 'connection.php';
include '../mail.php';
$email=$_POST['email'];
class ResetLink extends Dbconnection
{
    function __construct()
    {
        $ob = new Dbconnection();
        $this->conn = $ob->conn;
    }
    function send_link($email)
    {
        $sql = "SELECT Secordary_mail from users where Email='{$email}'";
        $result = $this->conn->query($sql);

        if ($result->num_rows>0) {
            $data = $result->fetch_assoc();
            $reset_link = time();
            $unique_id = base64_encode($email);
            $subject = "Reset Link for reseting password";
            $html = "
           <h1>Click on the given link to reset password</h1> 
           <a href='http://localhost/mail_project/forgetpassword.php?reset=" . $reset_link . "&unique_id=" . $unique_id . "' style='    color: #fff;background-color: #198754;border-color: #198754;padding: 0.5rem 1rem;font-size: 1.25rem;border-radius: 0.3rem;'>Reset Password</a>
            ";
            $ob = new sendEmail();
            $ob->email_send($data['Secordary_mail'], $subject, $html, 'Hestabit');
            $sql = "UPDATE users set reset_link='$reset_link' where Email='{$email}'";
            $res = $this->conn->query($sql);
            echo json_encode([
                'response' => true,
            ]);
        } else {
            echo json_encode([
                'response' => false,
                'message' => "Invalid Email Address",
                'error' => "error"
            ]);
        }
    }
}


if (isset($_POST['send_reset_link'])) {
    $ob = new ResetLink();
    $ob->send_link($_POST['email']);
}
