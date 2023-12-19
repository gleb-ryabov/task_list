<?php
    session_start();

    require_once('connection_db.php');

    //Запрос на выборку задач текущего пользователя
    $login = $_SESSION['login'];
    $query = "SELECT tasks.id, description, tasks.created_at, status FROM tasks 
        JOIN users ON users.id = tasks.user_id WHERE users.login= :login ORDER BY tasks.created_at DESC";
    $stmt = $db->prepare($query);
    $stmt -> execute(array(":login" => ($login)));
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
    <head>
        <title>Список задач</title>
        <meta charset = "UTF-8">
        <link rel = "stylesheet" href = "css/tasks.css">
    </head>

    <body>
        <!-- Блок добавления новой задачи -->
        <div class = "new_task">
            <form action = "new_task.php" method = "POST">
                <input type = "text" placeholder = "Введите новую задачу" id = "description" name = "description">
                <button id = "btn_new_task" type = "submit" disabled> Создать </button>
            </form>
        </div>

        <!-- Блок управления всеми задачами -->
        <div class = "manage_all_task">
            <form action="change_status_task.php" method="POST">
                <button type="submit" class = "btn_complite_all">Выполнить все задачи</button>
            </form>

            <form action="delete_task.php" method="POST">
                <button type="submit" class = "btn_delete_all">Удалить все задачи</button>
            </form>
        </div>

        <!-- Блок списка задач -->
        <div class = "task_list">
            <?php
                //$result - массив из запроса выборки задач пользователя, сделанного в начале документа
                foreach ($result as $row){
                    // Надпись на кнопке статуса
                    if ($row["status"] == "in work"){
                        $button_text = "Выполнено";
                    }
                    else{
                        $button_text = "Не выполнено";
                        echo    '<style>
                                    #description_' . $row['id'] . '{
                                        color:rgb(67, 176, 42) !important;
                                        text-decoration: line-through;
                                    }
                                </style>';
                    }
                    //Блок конкретной задачи
                    echo 
                    '<div class = "task">

                        <div class="task-content">
                            <a id="description_' . $row['id'] . '">' .
                                $row['description'] . '
                            <a>

                            <div class="buttons_task">
                                <form action="change_status_task.php" method="POST">
                                    <input type="hidden" name="id_task" value="' . $row['id'] . '">
                                    <input type="hidden" name="status_task" value="' . $row['status'] . '">
                                    <button type="submit">' . $button_text . '</button>
                                </form>

                                <form action = "delete_task.php" method = "POST">
                                    <input type = "hidden" name = "id_task" value = "' . $row['id'] . '">
                                    <button type = "submit" class="btn_delete"> Удалить </button>
                                </form>
                            </div>

                        </div>

                        <div class = "img_status">
                            <img src="img/' . $row['status'] . '.png">
                        </div>

                    </div>';
                }
            ?>

        </div>

        <!-- JS -->
        <script src = "js/block_button_task.js"></script>
    </body>
</html>