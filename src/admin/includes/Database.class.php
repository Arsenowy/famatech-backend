<?php

require_once('database_config.php');

class Database
{
    public $connection;

    function __construct()
    {
        $this->open_db_connection();
    }

    public function open_db_connection()
    {
        $this->connection = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

        if ($this->connection->connect_errno) {
            die("nope" . $this->connection->connect_error);
        }
    }
}

$database = new Database();
