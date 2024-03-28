<?php session_start(); ?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Registration</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" />
    <link rel="stylesheet" href="css/Regform.css"
    <body>
   <div class="container mt-4">
    <?php
    if ($_COOKIE['user'] == ''):
        if (isset($_SESSION['register_error'])) {
            echo '<div style="color: red;">' . $_SESSION['register_error'] . '</div>';
            unset($_SESSION['register_error']); 
        }
    ?>
    <h1>Registration</h1>
    <form action="val-form/check.php" method="post">
        <input type="text" class="form-control" name="login" id="login" placeholder="Enter Login"><br>
        <input type="text" class="form-control" name="name" id="name" placeholder="Enter Name"><br>
        <input type="password" class="form-control" name="pass" id="pass" placeholder="Enter Password"><br>
        <select class="form-control" name="male" id="male"><placeholder="Choose male"><required="required">
        <option value="" disabled selected hidden>Choose male</option>
        <option value="man">man</option>
        <option value="woman">woman</option>
         <option value="Helicopter Mi8">Helicopter Mi8</option>
        <select><br>
        <input type="text" class="form-control" name="email" id="email" placeholder="Enter email"><br>
        <select class="form-control" name="country" id="country" required="required">
    <option value="" disabled selected hidden>Select a country</option>
    <option value="United States">United States</option>
    <option value="China">China</option>
    <option value="India">India</option>
    <option value="Indonesia">Indonesia</option>
    <option value="Pakistan">Pakistan</option>
    <option value="Brazil">Brazil</option>
    <option value="Spain">Spain</option>
    <option value="Bangladesh">Bangladesh</option>
    <option value="Ukraine">Ukraine</option>
    <option value="Mexico">Mexico</option>
    <option value="Japan">Japan</option>
    <option value="Poland">Poland</option>
    <option value="Philippines">Philippines</option>
    <option value="Egypt">Egypt</option>
    <option value="Vietnam">Vietnam</option>
    <option value="DR Congo">DR Congo</option>
    <option value="Turkey">Turkey</option>
    <option value="Iran">Iran</option>
    <option value="Germany">Germany</option>
    <option value="Thailand">Thailand</option>
    </select><br>
    <input type="tel" class="form-control" name="tel" id="tel" placeholder="Enter phone number"><br>
     <select type="age" class="form-control" name="age" id="age" required="required">
            <option value="" disabled selected hidden>Select your age</option>
            <?php
            for ($year = 2024; $year >= 1945; $year--) {
                echo '<option value="' . $year . '">' . $year . '</option>';
            }
            ?>
        </select><br>
        <button class="btn-success register" type="submit">Register</button>
        <a href="/main-2.html" class="back"><span class="text">Back</span></a>
        <a href="/login.php" class="login"><span class="text">Login</span></a>
    </form>
    <?php endif;?>
</div>
    </body>
</html>



