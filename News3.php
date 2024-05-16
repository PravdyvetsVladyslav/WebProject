<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Game News</title>
  <link rel="stylesheet" href="styles.css">

  <style>
  body {
  background-image: url('background1.jpg');
  background-size: cover; /* Змінюємо розмір фону, щоб він повністю покривав весь екран */
  background-position: center; /* Розміщуємо фон по центру */
  background-repeat: no-repeat; /* Забороняємо повторення фонового зображення */
  margin: 0;
}

  .container {
  max-width: 700px;
  margin: 0 auto;
  padding: 0 40px; /* Додавання внутрішнього відступу для контейнера */
  
}

.news-item {
  width: 390px; /* Задаємо ширину блоків */
  height: 470px;
  margin: 90px; /* Відступ між блоками */
  padding: 20px;
  border: 1px solid #fff;
  border-radius: 15px;
  cursor: pointer;
  transition: transform 0.3s ease;
  position: center;
  overflow: clip;
  

}

.news-item img {
  width: 100%;
  height: 80%;
  object-fit: cover;
  margin-top: 5%;
   margin-left: 1%;
   margin-right: 5%
}

.news-item .content {
  margin-top: 5%;
}

.news-item:hover {
  transform: scale(1.09);
}

.news-container {
  display: flex;
  flex-wrap: wrap;
  justify-content: center; /* Розташовуємо блоки рівномірно по контейнеру */
  align-items: flex-start; /* Відцентрування по вертикалі */
  margin-top: 20px; /* Додатковий відступ зверху між пошуковим полем і блоками новин */
  
}

#searchInput {
  width: 100%;
  padding: 10px;
  margin-bottom: 20px;
  margin-top: 10px;
}

.news-item.expanded {
  width: 65%; /* Зміна ширини блоку при розширенні */
  height: 76vh; /* Зміна висоти блоку при розширенні */
  margin: 10px 50px 20px; /* Відцентрування блоку по вертикалі і горизонталі */
  z-index: 999; /* Розміщення блоку поверх інших елементів */
  position: fixed; /* Фіксоване розташування для збереження видимості під час прокручування */
  top: 10%; /* Розміщення блоку зверху відносно вікна перегляду */
  left: 50%; /* Розміщення блоку по центру горизонталі */
  transform: translateX(-50%); /* Коригування розташування по горизонталі */
  overflow-y: auto; /* Дозволяє прокручувати вміст блоку, якщо він перевищує висоту */
  background-color: rgba(21, 175, 80, 0.8,);
  backdrop-filter: blur(10px);

  
}
.news-item.expanded img {
  width: 80%; /* Забезпечення ширини картинки на весь розмір блоку */
  height: 80%; /* Налаштування висоти картинки у відповідності з вашими потребами */
  position: center;
  object-fit: contain; /* Збереження пропорцій і вписування зображення в блок */
  margin: 20px ; /* Видалення будь-яких зовнішніх відступів */
  transform: translateX(10%); /* Коригування розташування по горизонталі */

}
.news-item.expanded .content {
  backdrop-filter: none; /* Скасування розмиття для контенту */
}
#searchButton {
      padding: 10px 20px;
      margin-left: 10px;
      }
       #searchInput {
      width: 70%;
      padding: 10px;
    }

     .header {
      display: flex;
      align-items: center;
      justify-content:center ;
      border: 1px solid #000;
      background-color: #050A0E;
      
    }

    .logo {
      display: flex;
      align-items: center;
    }

    .logo img {
      width: 250px;
      height: 150px;
      margin-right: 10px;
    }

    .logo h1 {
      margin: 0;
      font-size: 24px;
      font-weight: bold;
    }
    .news-item h3,
.news-item p {
  color: white;
}
.pagination {
  display: flex;
  justify-content: center;
  margin: 1em;
}

.pagination-link {
  display: inline-block;
  padding: 8px 16px;
  background-color: black; /* Змінюємо колір фону кнопок */
  color: white; /* Змінюємо колір тексту кнопок */
  text-decoration: none;
  margin: 0 4px;
  border-radius: 4px;
  transition: background-color 0.3s ease; /* Додаємо плавний ефект переходу */
}

.pagination-link:hover {
  background-color: #333; /* Змінюємо колір фону кнопок при наведенні */
}
  </style>
</head>
<body>


  </div>
  <div class="container">
    <input type="text" id="searchInput" placeholder="Search">
    <button id="searchButton">🔍</button>
  </div>
  <div class="news-container" id="newsContainer">
    <!-- News items will be added here via JavaScript -->
  </div>
    <div class="pagination">
  <a href="News.php" class="pagination-link">1</a>
  <a href="News2.php" class="pagination-link">2</a>
  <a href="News3.php" class="pagination-link">3</a>
</div>

  <script src="News3.js"></script>
<footer style="background-color: black; color: white; padding: 60px; text-align: center;">
  <div style="display: flex; align-items: center; justify-content: center; flex-wrap: wrap;">
    <img src="photo/logo.png" alt="Logo" style="width: 100px; height: auto; margin-right: 20px;">
    <div style="margin-top: 20px;">
      <span>PRIVACY POLICY</span>
      <span>|</span>
      <span>TERMS OF SERVICE</span>
      <span>|</span>
      <span>BEHAVIOR RULES</span>
      <span>|</span>
      <span>COOKIE SETTINGS</span>
      <span>|</span>
      <span>© 2024</span>
    </div>
  </div>
</footer>


</body>
</html>
