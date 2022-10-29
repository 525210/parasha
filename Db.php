<?php

class Db
{
    public $user;
    public $password;
    public $db;
    public $host;
    public $dsn;
    public $conn;

    public function __construct()
    {
        $this->user = 'root';
        $this->password = 'red-e525210';
        $this->db = 'parasha';
        $this->host = 'localhost';
        $this->dsn = 'mysql:host=' . $this->host . ';dbname=' . $this->db;
        $this->conn = new PDO($this->dsn, $this->user, $this->password, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
    }

    public function inserDataToDb($tz, $code_ishi)
    {
        $sql = 'INSERT INTO `0768178002-n`(`tz`, `code_ishi`) VALUES(?, ?)';
        $query = $this->conn->prepare($sql);
        $query->execute([$tz, $code_ishi]);
    }

    public function readDataFromDbRashi()
    {
        $sql = 'SELECT * FROM `0768178002-n`';
        $query = $this->conn->query($sql);
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    
}