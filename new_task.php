<?php
    session_start();

    require_once("connection_db.php");

    $id = $_SESSION["id"];
    $description = $_POST ["description"];
    $current_time = date("Y-m-d H:i:s");

    //Зарос на добавление новой задачи
    $query = "INSERT INTO tasks (id, user_id, description, created_at, status) 
        VALUES (NULL, :id, :description, :time, 'in work')";
    $stmt = $db->prepare($query);
    $stmt->execute(array("id" => $id, "description"=> $description,"time"=> $current_time));

    header("Location: tasks.php");
?>