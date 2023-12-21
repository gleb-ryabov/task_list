<?php
    session_start();

    require_once("connection_db.php");

    $id = $_SESSION["id"];
    
    
    if (isset($_POST["id_task"])){
        $id_task = $_POST["id_task"];

        //Зарос на удаление одной задачи
        $query = "DELETE from tasks WHERE id = :task AND user_id = :id";
        $stmt = $db->prepare($query);
        $stmt->execute(array("task" => ($id_task), "id" => $id));
    } else{
        //Зарос на удаление всех задач
        $query = "DELETE from tasks WHERE user_id = :id";
        $stmt = $db->prepare($query);
        $stmt->execute(array("id" => $id));
    }

    header("Location: tasks.php");
?>