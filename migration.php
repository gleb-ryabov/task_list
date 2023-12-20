<?php
    require_once("connection_db.php");

    /**
     * Функция, возвращающая список файлов для миграции
     * @param PDO $db - объект подключения к базе данных
     * @return string[] - массив строк с именами файлов для миграции
     */
    function getMigrationFiles($db) {
        $sqlFolder = __DIR__ . '/sql/';
        $allFiles = glob($sqlFolder . '*.sql');
    
        $query = "SHOW TABLES LIKE '" . DB_TABLE_VERSIONS . "'";
        $result = $db->query($query);
        $firstMigration = ($result->rowCount() === 0);
        
        if ($firstMigration) {
            return $allFiles;
        }
    
        $versionsFiles = array();
        $query = "SELECT `name` FROM " . DB_TABLE_VERSIONS;
        $data = $db->query($query)->fetchAll(PDO::FETCH_ASSOC);
        foreach ($data as $row) {
            array_push($versionsFiles, $sqlFolder . $row['name']);
        }
    
        return array_diff($allFiles, $versionsFiles);
    }

    /** Функция миграции
     * @param PDO $db - объект подключения к базе данных
     * @param string $file - название файла sql
     */
    function migrate($db, $file) {
        //Выполнение mysql-запроса из внешнего файла
        $command = sprintf('mysql -u%s -p%s -h %s -D %s < %s', DB_USER, DB_PASSWORD, DB_SERVER, DB_NAME, $file);    
        shell_exec($command);
    
        $baseName = basename($file);
        $query = "INSERT INTO " .DB_TABLE_VERSIONS . " (`name`) values('$baseName')";
        $db->query($query);
    }


    // Вызов функций миграции
    $files = getMigrationFiles($db);
    if (!(empty($files))) {
        echo 'Начинаем миграцию...<br><br>';
        foreach ($files as $file) {
            migrate($db, $file);
            echo basename($file) . '<br>';
        }
        echo '<br>Миграция завершена.';  
    }
    else{
        echo 'Ваша база данных в актуальном состоянии.';
    }
?>