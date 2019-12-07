<?php

function connectToDb()
{
    try {
        return new PDO('mysql:host=localhost;dbname=mytodo;', 'root', '111111');
    } catch (PDOException $e) {
        die($e->getMessage());
    }
}


function fetchAllTasks($pdo)
{
    $statement = $pdo->prepare('select * from todos');
    $statement ->execute();

    //$tasks = $statement->fetchAll(PDO::FETCH_OBJ);
    return $statement->fetchAll(PDO::FETCH_CLASS, 'Task');
}