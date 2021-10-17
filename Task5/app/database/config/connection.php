<?php

class connection
{
    private $hostname = 'localhost';
    private $username = 'root';
    private $password = '';
    private $database = 'task4-ecommerce';
    private $connection;
    // Connect to Database
    function __construct()
    {
        $this->connection = new mysqli($this->hostname, $this->username, $this->password, $this->database);
    }
    // DQL Function
    public function runDQL($query)
    {
        $result = $this->connection->query($query);
        // check data array is not empty
        if ($result->num_rows > 0) {
            return $result;
        } else {
            return [];
        }
    }
    // DmL Function
    public function runDML($query)
    {
        $result = $this->connection->query($query);
        // check DML Operation Success or not
        if($result) {
            return TRUE;
        } else {
            return FALSE;
        }
    }
}
