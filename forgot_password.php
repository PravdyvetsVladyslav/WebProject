<?php
session_start();

// Перевіряємо, чи було встановлено повідомлення в сесії (наприклад, після відправки форми)
$message = '';
if (isset($_SESSION['message'])) {
    $message = $_SESSION['message'];
    unset($_SESSION['message']); // Очистимо повідомлення з сесії після його зчитування
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Forgot Password</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" />
    <link rel="stylesheet" href="css/logform.css">
</head>
<body>
<div class="container mt-4">
    <!-- Відображення повідомлення, якщо воно є -->
    <?php if ($message): ?>
        <div class="alert alert-info"><?= htmlspecialchars($message) ?></div>
    <?php endif; ?>

    <h2>Forgot Password</h2>
    <form action="send_reset_link.php" method="post">
        <input type="email" name="email" id="email" required placeholder="Enter your email">
        <button type="submit">Send Reset Link</button>
    </form>
</div>
</body>
</html>
