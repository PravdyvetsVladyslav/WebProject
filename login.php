<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Authorization</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" />
    <link rel="stylesheet" href="css/logform.css"
    <body>
        <div class="container mt-4">
         <?php
            if ($_COOKIE['user'] == ''):
            ?>
            <h1>Authorization</h1>

            <form action="val-form/auth.php" method="post">

                <input type="text" class="form-control" name="login"
                       id="login" placeholder="Enter Login"><br>         

                <input type="password" class="form-control" name="pass"
                       id="pass" placeholder="Enter Password"><br>

                <button class="btn btn-success"
                        type="submit">
                    Login
                </button>                
        <a href="/reg.php" class="login"><span class="text">Make a new account</span></a>
        <button class="btn forgot-password" type="button" onclick="location.href='/forgot_password.php'">Forgot password?</button>
            </form>

        </div>
        <?php else: ?>
       <p>Hi <?=$_COOKIE['user']?><a href="/main-3.html">You already signed in</a>.</p>
           <?php endif;?>
    </body>
</html>




