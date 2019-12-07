<?php

class Connection
{
    # way to make a method accessible globally without requiring instance
    public static function make()
    {
        try {
            return new PDO('mysql:host=localhost;dbname=mytodo;', 'root', '111111');
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }
}

//# general
//$connection = new Connection();
//$connection->make();
//
//# static case;
//# :: => static method를 가리킴
//Connection::make();
