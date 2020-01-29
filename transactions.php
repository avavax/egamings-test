<?php
error_reporting(E_ALL);

include_once 'config.php';

class Transactions {

    private $mysql;

    public function __construct() {

        $this->mysql = new \mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);


        if ($this->mysql->connect_errno) {
            echo "Connection failed\n";
            echo "Error: {$this->mysql->connect_error}\n";
            die();
        }

    }

    public function getCount() {

        $result = $this->mysql->query("SELECT MAX(id) AS Transactions FROM testdata");
        //$result = $this->mysql->query("SELECT count(user) AS Transactions FROM testdata");
        $row = $result->fetch_assoc();
        return $row['Transactions'];
    }

    public function getList($limit, $offset) {

        $result = $this->mysql->query("SELECT * FROM testdata LIMIT {$offset},{$limit}");
        return $result->fetch_all(MYSQLI_ASSOC);

    }

    public function getSummary() {

        $query = "SELECT
                type, SUM(amount) as amount
            FROM
                testdata
            GROUP BY type
            ORDER BY type";
        $result = $this->mysql->query($query);
        return $result->fetch_all(MYSQLI_ASSOC);

    }

    public function getTop() {


        $query = "SELECT
                user, amount
            FROM
                egtest.testdata
            ORDER BY amount desc
            limit 10";
        $result = $this->mysql->query($query);
        return $result->fetch_all(MYSQLI_ASSOC);

    }

    public function addTransaction(String $name, String $type, int $sum) {

        $result = $this->mysql->query("INSERT INTO testdata (user, type, amount)
            VALUES ('$name', '$type', $sum)");
        return $result;
    }

}