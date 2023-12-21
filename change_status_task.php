<?php
    session_start();

    require_once("connection_db.php");

    $id = $_SESSION["id"];


    if (isset($_POST['id_task'])) {

        $id_task = $_POST["id_task"];
        $status_task = $_POST['status_task'];

        //Подбор нового статуса задачи
        $new_status_task = "in work";
        if ($status_task == "in work"){
            $new_status_task = "complited";
        }

        //Зарос на изменение статуса одной задачи
        $query = "UPDATE tasks SET status = :status WHERE id = :task AND user_id = :id";
        $stmt = $db->prepare($query);
        $stmt->execute(array("status" => ($new_status_task), "task" => ($id_task), "id" => $id));
    } else {
        //Запрос на изменения выполненного статуса всех задач
        $query = "UPDATE tasks SET status = 'complited' WHERE user_id = :id";
        $stmt = $db->prepare($query);
        $stmt->execute(array("id" => $id));
    }

    header("Location: tasks.php");
?>