<?php

# bootstrap: responsible for behind the scene
require 'database/Connection.php';
require 'database/QueryBuilder.php';

// case 1.
//$pdo = Connection::make();
//$query = new QueryBuilder($pdo);

// case 2.
//$query = new QueryBuilder(Connection::make());

// case 3.
return new QueryBuilder(
    Connection::make()
);