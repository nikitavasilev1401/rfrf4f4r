<?php
    session_start();
        if ($_SESSION["mes_true"] == true){
            $name = $_SESSION["nameuser"];
            echo "<script>
            alert(\"Добро пожаловать $name, вы вошли в аккаунт.\");
            </script>";
            $_SESSION["mes_true"] = false;
        }
        else if ($_SESSION["mes_false"] == true){
            echo "<script>
            alert(\"Вы ввели неверные данные.\");
            </script>";
            $_SESSION["mes_false"] = false;
        }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Авторизация</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="form-container">
      <img src="img/bgImg.jpg" alt="" class="bg__img">
      <form class="form-box" method="POST" action="login.php">
        <img src="img/user.png" alt="" class="user">
        <h1>Добро пожаловать</h1>
        <input required type="text" name="login" placeholder="Логин">
        <input required type="password" name="password" placeholder="Пароль">
        <input type="submit" name="" value="Войти">
      </form>
    </div>


    
</body>
</html>