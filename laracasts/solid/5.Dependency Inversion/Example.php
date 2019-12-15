<?php

interface ConnectionInterface {
    public function connect();

}

class DbConnection implements ConnectionInterface {
    public function connect()
    {
    }
}
class PasswordReminder {

    /**
     * @var MySQLConnection
     */

    private $dbConnection;

    public function __construct(ConnectionInterface $dbconnection)
    {
        $this->dbConnection = $dbconnection;
    }
}