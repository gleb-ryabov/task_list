<!DOCTYPE html>
    <head>
        <title> Авторизация </title>
        <meta charset = "UTF-8">
        <link rel = "stylesheet" href = "css/login.css">
    </head>
    <body>
        
        <form action = "authentication.php" method = "POST">
            <h3> Авторизация </h3>
            <p>Логин: <input type = "text" name = "login" id = "login"></p>
            <p>Пароль: <input type = "password" name = "password" id = "password"></p>
            <p><button type = "submit" id="btn_login" disabled> Войти </button>
        </form>

        
        <!-- Вывод уведомления при неправильном вводе пароля -->
        <?php
            if (isset($_GET["password"])) {
                echo "<script>alert('Вы ввели неправильный пароль. Попробуйте еще раз или войдите с другим логином.');</script>";
            }
        ?>

        <!-- JS -->
        <script src = "js/block_button_login.js"></script>
        <script src = "js/alert_uncorrect_password.js"></script>
    </body>
</html>