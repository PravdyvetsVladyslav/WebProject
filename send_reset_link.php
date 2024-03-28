<?php
require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST" && !empty($_POST['email'])) {
    $email = $_POST['email'];

    // ϳ��������� �� ���� �����
    $mysqli = new mysqli('localhost', 'root', 'root', 'JustNews');
    
    // �������� �� ���� ���������� � ����� ������
    $result = $mysqli->query("SELECT * FROM `users` WHERE `email` = '$email'");
    
    if ($result->num_rows > 0) {
        $token = bin2hex(random_bytes(50)); // ��������� ���������� ������
        
        // ����� ��������� ������ � ��� �����
        $expires = new DateTime('NOW');
        $expires->add(new DateInterval('PT06H')); // ����� ���� ������ 6 �����
        $stmt = $mysqli->prepare("INSERT INTO password_reset (email, token, token_expiration) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $email, $token, $expires->format('Y-m-d H:i:s'));
        
        if ($stmt->execute()) {
            $_SESSION['message'] = "Token was successfully inserted into the database.";
        } else {
            $_SESSION['message'] = "Error inserting token: " . $stmt->error;
        }

        // ����� ����������� ������������ �����
        $mail = new PHPMailer(true);

        try {
            // ������������ ������� SMTP
            $mail->isSMTP();
            $mail->Host       = 'smtp.mailtrap.io';
            $mail->SMTPAuth   = true;
            $mail->Username   = 'aaed015fe74a2d';
            $mail->Password   = '9c186eba9bf6fd';
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port       = 2525;

            // ����������
            $mail->setFrom('noreply@JustNews.com', 'Your Application Name');
            $mail->addAddress($email); // ������� ��������������� ������, ��� ��� ����������

            // ���� �����
            $mail->isHTML(true);
            $mail->Subject = 'Password recovery';
            $mail->Body    = "To set a new password, follow the link: <a href='http://localhost/reset_password.php?token=$token'>Recover password</a>";

            $mail->send();
            $_SESSION['message'] = 'Instructions have been sent to your email.';
        } catch (Exception $e) {
            $_SESSION['message'] = "Sending error: {$mail->ErrorInfo}";
        }
    } else {
        $_SESSION['message'] = 'No user found with this email.';
    }
    $mysqli->close();
    // �������� ����� �� ������� forgot_password.php
    header('Location: forgot_password.php');
    exit;
}
?>
