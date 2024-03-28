<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Personal Cabinet</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background-image: url('https://files.oaiusercontent.com/file-Dgb9NZJVcQZpudiFOCUJFXeH?se=2024-03-24T10%3A46%3A20Z&sp=r&sv=2021-08-06&sr=b&rscc=max-age%3D31536000%2C%20immutable&rscd=attachment%3B%20filename%3D5246078b-2055-4902-bb2e-4c641134e323.webp&sig=43uQfT0M4pgopEpmIPeSuY2POvZAPjNeXJ3vr5vbYuU%3D');
      background-size: cover;
      background-position: center;
      color: #000;
      margin: 0;
      padding: 0;
    }
.container, .user-info-container {
  width: 100%;
  max-width: 800px;
  margin: 40px auto;
  background-color: rgba(21, 175, 80, 0.8,);
  padding: 10px;
  border-radius: 25px;
  box-shadow: 0 2px 10px rgba(0,0,0,0.9);
}
h1, h2, h3, label {
  color: #000;
}
a, .button {
  background-color: #000;
  color: #ffffff;
  padding: 10px 15px;
  text-decoration: none;
  border-radius: 5px;
  display: inline-block;
}
a:hover, .button:hover {
  background-color: #0056b3;
}
.header, .footer {
  background-color: rgba(21, 175, 80, 0.8,);
  color: #ffffff;
  text-align: center;
  padding: 10px 0;
}
.footer {
  position: absolute;
  bottom: 0;
  width: 100%;
}
.user-info {
  padding: 10px;
  background-color: rgba(21, 175, 80, 0.8,);
  margin-bottom: 20px;
  border-radius: 5px;
}
.user-info label {
  font-weight: bold;
}
.user-info div {
  margin-bottom: 30px;
}
.edit-background-form, .edit-avatar-form {
  margin-top: 10px;
}
.data-visualization, .settings {
  display: flex;
  width: 100%;
  max-width: 800px;
  margin: 10px auto;
  background-color: rgba(21, 175, 80, 0.8,);
  padding: 20px;
  border-radius: 25px;
  flex-direction: column;
  gap: 20px;
  min-height: 190px;
  box-shadow: 0 2px 10px rgba(0,0,0,0.9);
}
.back-button {
  display: inline-block;
  padding: 10px 20px;
  font-size: 16px;
  color: #ffffff;
  background-color: rgba(21, 175, 80, 0.8,);
  border: none;
  border-radius: 5px;
  text-decoration: none;
  transition: background-color 0.3s;
  box-shadow: 0 2px 10px rgba(0,0,0,0.9);
  width: 70px;
}
.back-button:hover {
  background-color: #0056b3;
}
#edit-btn {
  cursor: pointer;
  border: none;
  background: transparent;
  color: #000;
  font-size: 20px;
  position: absolute;
  top: 0;
  right: 0;
}
#save-btn {
  display: none;
  margin-top: 10px;
}
  </style>
</head>
<body>

<?php
$conn = new mysqli("localhost", "root", "root", "JustNews");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$username = $_COOKIE['user'] ?? 'guest';
$sql = "SELECT * FROM users WHERE name='$username'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $userInfo = $row["user_info"] ?? "Click the pencil icon to add information about yourself."; // Використовуйте цей рядок для відображення, якщо user_info відсутній
} else {
    echo "<p>User not found or not logged in.</p>";
    $row = null; // Забезпечуємо, що змінна $row порожня, якщо користувач не знайдений
}
$conn->close();
?>

<div class="header">
  <h1>Personal Cabinet</h1>
</div>

<div class="user-info-container">
    <?php if ($row): ?>
        <div class='user-info'>
            <div><label>Name:</label> <?php echo $row["name"]; ?></div>
            <div><label>Email:</label> <?php echo $row["email"]; ?></div>
            <div><label>Age:</label> <?php echo $row["age"]; ?></div>
            <div><label>Gender:</label> <?php echo ($row["gender"] ? "Male" : "Female"); ?></div>
            <div><label>Country:</label> <?php echo $row["country"]; ?></div>
            <div><label>Username:</label> <?php echo $row["login"]; ?></div>
            <?php if ($row["avatar"]): ?>
                <img src="<?php echo $row["avatar"]; ?>" alt="Avatar" style="width: 100px; height: 100px; object-fit: cover;">
            <?php else: ?>
                <div style="width: 100px; height: 100px; display: flex; align-items: center; justify-content: center; background-color: #f0f0f0;"><p>No avatar</p></div>
            <?php endif; ?>
        </div>
        <form class="edit-avatar-form" method="post" enctype="multipart/form-data" action="update_avatar.php">
            <label for="avatar-upload" class="button">Change avatar</label>
            <input id="avatar-upload" type="file" name="avatar" style="display: none;" onchange="this.form.submit();">
        </form>
    <?php else: ?>
        <p>Please log in to view your information.</p>
    <?php endif; ?>
</div>

<div class="section data-visualization">
  <h3>About Me</h3>
  <div id="user-info-display" style="position: relative;">
    <p id="user-info-text" contenteditable="false"><?php echo $userInfo; ?></p>
    <button id="edit-btn" style="position: absolute; top: 0; right: 0; background: none; border: none; cursor: pointer;">
      ✎ <!-- Використовуємо Emoji як іконку олівця для простоти -->
    </button>
  </div>
  <button id="save-btn" class="button" style="display: none;">Done</button>
  <a href="main-3.html" class="back-button">Back</a>
</div>

<script>
document.getElementById('edit-btn').addEventListener('click', function() {
  let userInfoText = document.getElementById('user-info-text');
  userInfoText.contentEditable = true;
  userInfoText.focus(); // Встановлюємо фокус на елемент для редагування

  // Якщо текст є написом за замовчуванням, очищуємо його перед редагуванням
  if (userInfoText.innerText === "Click the pencil icon to add information about yourself.") {
    userInfoText.innerText = "";
  }

  document.getElementById('edit-btn').style.display = 'none';
  document.getElementById('save-btn').style.display = 'inline-block';
});

document.getElementById('save-btn').addEventListener('click', function() {
  let userInfoText = document.getElementById('user-info-text');
  userInfoText.contentEditable = false;
  document.getElementById('save-btn').style.display = 'none';
  document.getElementById('edit-btn').style.display = 'inline-block';

  // Якщо користувач не ввів жодної інформації, повертаємо напис за замовчуванням
  if (userInfoText.innerText.trim() === "") {
    userInfoText.innerText = "Click the pencil icon to add information about yourself.";
  }

  // AJAX запит для збереження інформації без перезавантаження сторінки
  let xhr = new XMLHttpRequest();
  xhr.open("POST", "update_user_info.php", true);
  xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
  xhr.onreadystatechange = function() {
    if (this.readyState === XMLHttpRequest.DONE && this.status === 200) {
      // Виведення повідомлення про успіх чи помилку
      console.log("Information updated successfully");
    }
  }
  xhr.send("user_info=" + encodeURIComponent(userInfoText.innerText));
});
</script>



<div class="footer">
  <p>&copy; 2024 JustNews. All rights reserved.</p>
</div>

</body>
</html>
