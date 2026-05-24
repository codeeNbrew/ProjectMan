<?php

class Databases{
    private $host = "localhost";
    private $port = 3306;
    private $username = "root";
    private $password = "240907";
    private $database = "db_pencatatan_project";

    public $conn;

    public function __construct(){
        $this->conn = new mysqli($this->host, $this->username, $this->password, $this->database,$this->port, );

        if ($this->conn->connect_error) {
            die("Koneksi ke database gagal: " . $this->conn->connect_error);
        }
    }

    public function getConnection(){
        return $this->conn;
    }
}
?>