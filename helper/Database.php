<?php

class Database
{
    private $conn;

    public function __construct($servername, $username, $dbname, $password)
    {
        $this->conn = mysqli_connect($servername, $username, $password, $dbname);

        if (!$this->conn) {
            die("Connection failed: " . mysqli_connect_error());
        }
    }

    public function query($sql){
        $result = mysqli_query($this->conn, $sql);
        return mysqli_fetch_all($result, MYSQLI_ASSOC);
    }

    public function execute($sql)
    {
        return mysqli_query($this->conn, $sql);
    }

    public function getLastInsertId()
    {
        return $this->conn->insert_id;
    }

    public function __destruct()
    {
        mysqli_close($this->conn);
    }
}