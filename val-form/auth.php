<?php
$login = filter_var(trim($_POST['login']), FILTER_SANITIZE_STRING);
$pass = filter_var(trim($_POST['pass']), FILTER_SANITIZE_STRING);
$pass = md5($pass."ghjsfkld2345");
$mysql = new mysqli('localhost', 'root', 'root', 'JustNews');
$result = $mysql->query("SELECT * FROM `users` WHERE `login` = '$login' AND `pass` = '$pass'");
$user = $result->fetch_assoc();
if(count($user) == 0) {

  echo "Такий користувач не знайдений";
  exit();
} 

setcookie('user',$user['name'], time() + 80,"/");

$mysql->close();

header('Location: /kab.php');
?>
