<?php

class DBManager
{
    private $ip;
    private $user;
    private $password;
    private $database;

    public function __construct()
    {
        // TODO: make it dynamic
        $this->ip = "localhost";
        $this->user = "root";
        $this->password = "";
        $this->database = "gästebuch";
    }

    public function SetupConnection()
    {
        return new mysqli($this->ip, $this->user, $this->password, $this->database);
    }

    public function Execute($query)
    {
        $result = $this->SetupConnection()->query($query);
        $result_array = array();

        while($row = $result->fetch_object())
        {
            array_push($result_array, $row);
        }
        return $result_array;
    }

    public function ExecuteNonQuery($query)
    {
        $connection = $this->SetupConnection();
        $result = $connection->query($query);
        $_SESSION['last_id'] = $connection->insert_id;

        return $result;
    }
}
?>