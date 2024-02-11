<?php

require_once 'config/config.php';
class Database
{
    public $host = HOST;
    public $user = USER;
    public $psw = PASSWORD;
    public $database = DATABASE;
    public $link;
    public $error;

    public function __construct()
    {
        $this->dbConnect();
    }

    public function dbConnect()
    {
        $this->link = mysqli_connect($this->host, $this->user, $this->psw, $this->database);
        if (!$this->link) {
            $this->error = "Database connection failed";
            return false;
        }
    }

    //insert function
    public function insert($query)
    {
        $result = mysqli_query($this->link, $query) or die($this->link->error . __LINE__);
        if ($result) {
            return $result;
        } else {
            return false;
        }
    }
    // select function
    public function select($query)
    {
        $result = mysqli_query($this->link, $query) or die($this->link->error . __LINE__);
        if (mysqli_num_rows($result) > 0) {
            return $result;
        } else {
            return false;
        }
    }
    // Update function
    public function update($query)
    {
        $result = mysqli_query($this->link, $query) or die($this->link->error . __LINE__);
        if ($result) {
            return $result;
        } else {
            return false;
        }
    }

    //Delete function
    public function delete($query)
    {
        $result = mysqli_query($this->link, $query) or die($this->link->error . __LINE__);
        if ($result) {
            return $result;
        } else {
            return false;
        }
    }


}


?>