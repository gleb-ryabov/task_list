<?php
    //Константы с данными для подключения к БД
    require_once ("constants.php");

    global $db;

    try{
        $db = new PDO('mysql:dbname=' . DB_NAME . ';host=' . DB_SERVER, DB_USER, DB_PASSWORD);
    }
    catch(PDOException $e){
        echo "Error connecting to the database: " . $e->getMessage();
        die;
    }
?>