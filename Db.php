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
        $this->user = 'stas';
        $this->password = '0544525210';
        $this->db = 'parasha';
        $this->host = 'localhost';
        $this->dsn = 'mysql:host=' . $this->host . ';dbname=' . $this->db;
//        $this->conn = new PDO($this->dsn, $this->user, $this->password, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));

        try {
            $this->conn = new PDO($this->dsn, $this->user, $this->password, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
            // set the PDO error mode to exception
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//            echo "Connected successfully";
        } catch(PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }
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

    public function getDataFromDbRashi($start, $per_page) : array
    {
        $sql = "SELECT * FROM `0768178002-n` LIMIT $start, $per_page";
        $query = $this->conn->query($sql);
        return $query->fetchAll();
    }

    public function countLinesInDb() : int
    {
        $sql = 'SELECT count(*) FROM `0768178002-n`';
        $query = $this->conn->query($sql);
        return $query->fetchColumn();
    }

    public function getDataFromDbToEdit($id)
    {
        $sql = "SELECT * FROM `0768178002-n` WHERE `id` = '$id'";
        $query = $this->conn->query($sql);
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }


}