<?php
    session_start();

    require_once("connection_db.php");

    $login = $_SESSION["login"];


    if (isset($_POST['id_task'])) {

        $id_task = $_POST["id_task"];
        $status_task = $_POST['status_task'];

        //Подбор нового статуса задачи
        if ($status_task == "in work"){
            $new_status_task = "complited";
        }
        else {
            $new_status_task = "in work";
        }

        //Зарос на изменение статуса одной задачи
        $query = "UPDATE tasks SET status = :status WHERE id = :task AND user_id = 
            (SELECT id FROM users WHERE login = :login)";
        $stmt = $db -> prepare($query);
        $stmt -> execute(array("status" => ($new_status_task), "task" => ($id_task), "login" => $login));
    }
    else {
        //Запрос на изменения выполненного статуса всех задач
        $query = "UPDATE tasks SET status = 'complited' WHERE user_id = (SELECT id FROM users WHERE login = :login)";
        $stmt = $db -> prepare($query);
        $stmt -> execute(array("login" => $login));
    }

    header("Location: tasks.php");
?>