<?php

class DBAccess {
    var $host;
    var $db;
    var $user;
    var $pass;
    var $dsn = "";
    var $pdo = null;
    var $charset = 'utf8';
    var $option = [
      PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
      PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
      PDO::ATTR_EMULATE_PREPARES => false,
    ];
    
    function __construct($hostname, $dbname, $username, $password) {
        $this->host = $hostname;
        $this->db = $dbname;
        $this->user = $username;
        $this->pass = $password;
        $this->dsn = "mysql:host=$this->host;dbname=$this->db;charset=$this->charset";
        $this->pdo = new PDO($this->dsn,$this->user, $this->pass, $this->option);
    }

    // id,nameFirst,nameLast,address,city,st,zip,creditCard,balance

    // check if table exists
    function table_exists($table) {
        try {
            $exists = $this->pdo->query("SELECT 1 FROM $table LIMIT 1");
        } catch(Exception $e) {
            return false;
        }
        return $exists !== false;
    }

    // drop them hard, onto the hard concrete floor
    function drop_customers() {
        if($this->table_exists('customers')) {
            $sql = "DROP TABLE IF EXISTS customers CASCADE";
            $this->pdo->exec($sql);
        }
        // we don't hurt non-existing customers, they are innocent
    }

    // create table
    function create_customers() {
        if(!$this->table_exists('customers')) {
            // customers table doesn't exist
            try {
                $sql = "CREATE TABLE customers ( CustomerID int NOT NULL, FirstName varchar(20), LastName varchar(40),
Address varchar(100), City varchar(20), State varchar(2), Zip int, CreditCard varchar(20), Balance DECIMAL(8,2), PRIMARY KEY(CustomerID));";
                $this->pdo->exec($sql);
            } catch(PDOException $e) {
                exit($e->getMessage());
            }
        }
        // does nothing if table exists
    }

    function insert_row($id, $first, $last, $addr, $city, $state, $zip, $credit, $balance) {
        // assuming that data extraction will clean and validate data (maybe it won't)
        // don't assume existence
        $this->create_customers();
        $sql = "INSERT INTO customers (CustomerID, FirstName, LastName, Address, City, State, Zip, CreditCard, Balance)
VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?);";
        $prepared = $this->pdo->prepare($sql);
        $prepared->execute([$id, $first, $last, $addr, $city, $state, $zip, $credit, $balance]);
        echo $prepared->fetch();


    }

    // return array of items
    function query_state($state) {
        if(!$this->table_exists('customers')) {
            // No table, no data
            exit('No table exists.');
        }

        $sql = 'SELECT * FROM customers WHERE State = :state';
        $prepared = $this->pdo->prepare($sql);
        $prepared->execute(array('state' => $state));
        $fetched = $prepared->fetchAll();
        $data = array();
        foreach($fetched as $row) {
            $data[] = $row;
        }
        return $data;
    }
    
    
}

?>