<?php
session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['token']) && isset($_POST['password'])) {
    $token = $_POST['token'];
    $newPassword = $_POST['password'];

    // Підключення до бази даних
    $mysqli = new mysqli('localhost', 'root', 'root', 'JustNews');

    if ($mysqli->connect_error) {
        $_SESSION['message'] = "Помилка підключення до бази даних: " . $mysqli->connect_error;
        header('Location: reset_password.php');
        exit;
    }

    // Перевірка токена
    $stmt = $mysqli->prepare("SELECT email FROM password_reset WHERE token = ? AND token_expiration > NOW()");
    $stmt->bind_param("s", $token);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $userEmail = $result->fetch_assoc()['email'];

        // Оновлення паролю
        $newPasswordHash = md5($newPassword . "ghjsfkld2345");  // Використовуйте сильніші алгоритми хешування в реальних додатках
        $updateStmt = $mysqli->prepare("UPDATE users SET pass = ? WHERE email = ?");
        $updateStmt->bind_param("ss", $newPasswordHash, $userEmail);
        $updateStmt->execute();

        if ($updateStmt->affected_rows === 1) {
            $_SESSION['message'] = 'Password successfully updated.';
            // Очищення запису токена після успішного оновлення паролю
            $deleteStmt = $mysqli->prepare("DELETE FROM password_reset WHERE email = ?");
            $deleteStmt->bind_param("s", $userEmail);
            $deleteStmt->execute();
            header('Location: login.php'); // Редирект на сторінку входу
            exit;
        } else {
            $_SESSION['message'] = 'Error updating password.';
            header('Location: reset_password.php'); // Редирект назад на сторінку оновлення паролю
            exit;
        }
    } else {
        $_SESSION['message'] = 'Invalid or outdated recovery token.';
        header('Location: reset_password.php'); // Редирект назад на сторінку оновлення паролю
        exit;
    }
} else {
    $_SESSION['message'] = 'Invalid request.';
    header('Location: reset_password.php'); // Редирект назад на сторінку оновлення паролю
    exit;
}
?>
