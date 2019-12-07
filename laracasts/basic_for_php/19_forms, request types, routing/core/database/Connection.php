<?php

class Connection
{
    public static function make($config)
    {
        try {
            return new PDO(
                $config['connection'].';dbname='.$config['name'],
                $config['username'],
                $config['password'],
                $config['options']
            );
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
