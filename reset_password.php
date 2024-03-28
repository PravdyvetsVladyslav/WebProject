<?php
// ��������, �� ����� ��������� � ������
if (isset($_GET['token'])) {
    $token = $_GET['token'];

    // ϳ��������� �� ���� �����
    $mysqli = new mysqli('localhost', 'root', 'root', 'JustNews');
    
    // ��������, �� ����� ���� � ��� ����� � �� �� ��������� ����� 䳿
    $stmt = $mysqli->prepare("SELECT email FROM password_reset WHERE token = ? AND token_expiration > NOW()");
    $stmt->bind_param("s", $token);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 0) {
        exit('Invalid or expired token.');
    }

    // ���� ����� ������, ������� ����� �����
} else {
    exit('Invalid request. No token provided.');
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Creating a new Password</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" />
    <link rel="stylesheet" href="css/logform.css"> <!-- �������������, �� ��� ���� ���� �� �� ������ ���� -->
</head>
<body>
<div class="container mt-4">
    <h2>creating a new password</h2>
    <form action="update_password.php" method="post">
        <input type="hidden" name="token" value="<?= htmlspecialchars($token) ?>">
        <label for="password">New Password:</label>
        <input type="password" name="password" id="password" required>
        <button type="submit">Recover Password</button>
    </form>
    </div>
</body>
</html>
