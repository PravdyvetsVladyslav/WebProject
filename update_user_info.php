<?php
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["user_info"])) {
    $userInfo = $_POST["user_info"];
    // Переконайтеся, що з'єднання з базою даних встановлено
    $conn = new mysqli("localhost", "root", "root", "JustNews");

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $username = $_COOKIE['user'];
    // Escape user input for security
    $userInfo = $conn->real_escape_string($userInfo);

    // Оновлення інформації користувача в базі даних
    $sql = "UPDATE users SET user_info='$userInfo' WHERE name='$username'";

    if ($conn->query($sql) === TRUE) {
        echo "Information updated successfully.";
    } else {
        echo "Error updating information: " . $conn->error;
    }

    $conn->close();

    // Перенаправлення назад до особистого кабінету
    header('Location: kab.php');
    exit;
}
?>
