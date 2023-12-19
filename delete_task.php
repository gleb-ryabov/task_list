<?php
    session_start();

    require_once("connection_db.php");

    $login = $_SESSION["login"];
    
    
    if (isset($_POST["id_task"])){
        $id_task = $_POST["id_task"];

        //Зарос на удаление одной задачи
        $query = "DELETE from tasks WHERE id = :task AND user_id = (SELECT id FROM users WHERE login = :login)";
        $stmt = $db -> prepare($query);
        $stmt -> execute(array("task" => ($id_task), "login" => $login));
    }
    else{
        //Зарос на удаление всех задач
        $query = "DELETE from tasks WHERE user_id = (SELECT id FROM users WHERE login = :login)";
        $stmt = $db -> prepare($query);
        $stmt -> execute(array("login" => $login));
    }

    header("Location: tasks.php");
?>