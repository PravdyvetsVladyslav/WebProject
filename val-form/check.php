<?php
session_start();

$login = filter_var(trim($_POST['login']), FILTER_SANITIZE_STRING);
$name = filter_var(trim($_POST['name']), FILTER_SANITIZE_STRING);
$pass = filter_var(trim($_POST['pass']), FILTER_SANITIZE_STRING);
$male = filter_var(trim($_POST['male']), FILTER_SANITIZE_STRING);
$email = filter_var(trim($_POST['email']), FILTER_SANITIZE_STRING);
$country = filter_var(trim($_POST['country']), FILTER_SANITIZE_STRING);
$tel = filter_var(trim($_POST['tel']), FILTER_SANITIZE_STRING);
$age = filter_var(trim($_POST['age']), FILTER_SANITIZE_STRING);

// Перевірки довжини введених даних
if (mb_strlen($login) < 3 || mb_strlen($login) > 90) {
    echo "Invalid login length";
    exit();
} elseif (mb_strlen($name) < 3 || mb_strlen($name) > 50) {
    echo "Invalid name length";
    exit();
} elseif (mb_strlen($pass) < 2 || mb_strlen($pass) > 6) {
    echo "Invalid password length (2 to 6 characters)";
    exit();
} elseif (mb_strlen($male) < 3 || mb_strlen($male) > 50) {
    echo "invalid 1";
    exit();
} elseif (mb_strlen($email) < 3 || mb_strlen($email) > 50) {
    echo "invalid 2";
    exit();
} elseif (mb_strlen($country) < 3 || mb_strlen($country) > 50) {
    echo "invalid 3";
    exit();
} elseif (mb_strlen($tel) < 3 || mb_strlen($tel) > 50) {
    echo "invalid 4";
    exit();
} elseif ($age < 1945 || $age > 2024) {
    echo "Invalid age";
    exit();
}

$pass = md5($pass . "ghjsfkld2345");

$mysql = new mysqli('localhost', 'root', 'root', 'JustNews');

// Перевірка унікальності електронної пошти
$result = $mysql->query("SELECT * FROM `users` WHERE `email` = '$email'");
if ($result->num_rows > 0) {
    $_SESSION['register_error'] = "E-mail already registered";
    $mysql->close();
    header('Location: /reg.php'); // Повертаємося на сторінку реєстрації
    exit();
}

unset($_SESSION['register_error']);

// Вставка даних користувача в базу даних
$mysql->query("INSERT INTO `users` (`login`, `pass`, `name`, `male`, `email`, `country`, `tel`, `age`, `avatar`, `user_info`)
VALUES('$login', '$pass', '$name', '$male', '$email', '$country', '$tel', '$age', '$avatar', '$user_info')");

$mysql->close();

header('Location: /login.php');
?>
