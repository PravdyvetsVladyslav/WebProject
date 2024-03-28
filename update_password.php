<?php
session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['token']) && isset($_POST['password'])) {
    $token = $_POST['token'];
    $newPassword = $_POST['password'];

    // ϳ��������� �� ���� �����
    $mysqli = new mysqli('localhost', 'root', 'root', 'JustNews');

    if ($mysqli->connect_error) {
        $_SESSION['message'] = "������� ���������� �� ���� �����: " . $mysqli->connect_error;
        header('Location: reset_password.php');
        exit;
    }

    // �������� ������
    $stmt = $mysqli->prepare("SELECT email FROM password_reset WHERE token = ? AND token_expiration > NOW()");
    $stmt->bind_param("s", $token);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $userEmail = $result->fetch_assoc()['email'];

        // ��������� ������
        $newPasswordHash = md5($newPassword . "ghjsfkld2345");  // �������������� ������� ��������� ��������� � �������� ��������
        $updateStmt = $mysqli->prepare("UPDATE users SET pass = ? WHERE email = ?");
        $updateStmt->bind_param("ss", $newPasswordHash, $userEmail);
        $updateStmt->execute();

        if ($updateStmt->affected_rows === 1) {
            $_SESSION['message'] = 'Password successfully updated.';
            // �������� ������ ������ ���� �������� ��������� ������
            $deleteStmt = $mysqli->prepare("DELETE FROM password_reset WHERE email = ?");
            $deleteStmt->bind_param("s", $userEmail);
            $deleteStmt->execute();
            header('Location: login.php'); // �������� �� ������� �����
            exit;
        } else {
            $_SESSION['message'] = 'Error updating password.';
            header('Location: reset_password.php'); // �������� ����� �� ������� ��������� ������
            exit;
        }
    } else {
        $_SESSION['message'] = 'Invalid or outdated recovery token.';
        header('Location: reset_password.php'); // �������� ����� �� ������� ��������� ������
        exit;
    }
} else {
    $_SESSION['message'] = 'Invalid request.';
    header('Location: reset_password.php'); // �������� ����� �� ������� ��������� ������
    exit;
}
?>
