<?php

# bootstrap: responsible for behind the scene
$config = require 'config.php';
require 'database/Connection.php';
require 'database/QueryBuilder.php';


return new QueryBuilder(
    Connection::make($config['database'])
);