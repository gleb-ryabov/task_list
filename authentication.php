<?php
    session_start();

    require_once("connection_db.php");

    //Данные из формы
    $login = $_POST['login'];
    $password = $_POST['password'];
    $hash_password = md5($password);

    //Поиск пользователя в БД
    $query = "SELECT * FROM users WHERE login = :login AND password = :password";
    $stmt = $db->prepare($query);
    $stmt -> execute(array('login' => $login, 'password' => $hash_password));

    if ($stmt->rowCount() > 0) {
        //Авторизация
        $_SESSION['login'] = $login;
    } else {
        try{
            //Регистрация и авторизация
            $current_time = date("Y-m-d H:i:s");
            $query = "INSERT INTO users (id, login, password, created_at) VALUES 
                (NULL, :login, :password, :time)";
            $stmt = $db->prepare($query);
            if ($stmt -> execute(array("login" => $login,"password" => $hash_password,"time" => $current_time))){
                $_SESSION['login'] = $login;
            }
        }
        catch(PDOException $e){
            //При вводе неправильного пароля возвращет на страницу аутентификации
            header ('Location: login.html?password=uncorrect');
            die;
        }
    }

    header ('Location: tasks.php');
?>