<?php

/**
 * Created by PhpStorm.
 * User: developers
 * Date: 2/10/2018
 * Time: 1:16 PM
 */
class Database
{
    // specify your own database credentials
    private $host = "127.0.0.1";//localhost
    private $dbName = "android_forum";//
    private $username = "root";
    private $password = "";
    private $charSet = "utf8";
    private $port = "3306";

    private $conn;
    private $stmt;

    // get the database connection
    public function getConnection(){

        $this->conn = null;

        try{
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->dbName.
                ";port=" . $this->port. ";charset=" . $this->charSet, $this->username, $this->password);
            $this->conn->exec("set names utf8");
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->conn->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
        }catch(PDOException $exception){
            echo "Connection error: " . $exception->getMessage();
        }

        return $this->conn;
    }

    public function closeConnection(){
        $this->conn = null;
    }


    //Databse helper function
    public function query($query){
        $this->stmt = null;
        try{
            $this->stmt = $this->conn->prepare($query);
        }catch(PDOException $e){
            echo $e->getMessage();
        }
    }
    public function bind($param, $value, $type = null){
        if (is_null($type)) {
            switch (true) {
                case is_int($value):
                    $type = PDO::PARAM_INT;
                    break;
                case is_bool($value):
                    $type = PDO::PARAM_BOOL;
                    break;
                case is_null($value):
                    $type = PDO::PARAM_NULL;
                    break;
                default:
                    $type = PDO::PARAM_STR;
            }
        }
        $this->stmt->bindValue($param, $value, $type);
    }
    public function execute(){
        try{
            return $this->stmt->execute();
        }catch(PDOException $e){
            echo $e->getMessage();
            return null;
        }
    }
    public function resultList(){
        $this->execute();
        try{
            return $this->stmt->fetchAll(PDO::FETCH_ASSOC);
        }catch(PDOException $e){
            echo $e->getMessage();
            return null;
        }
    }
    public function resultSingle(){
        $this->execute();
        return $this->stmt->fetch(PDO::FETCH_ASSOC);
    }
    public function rowCount(){
        try{
            return $this->stmt->rowCount();
        }catch(PDOException $e){
            echo $e->getMessage();
            return null;
        }
    }
    public function lastInsertId(){
        try{
            return $this->conn->lastInsertId();
        }catch(PDOException $e){
            echo $e->getMessage();
            return null;
        }
    }
    public function insertHelper($tableName, $data_array){

        $columns = array();
        $bindColumns = array();
        foreach ($data_array as $key => $value) {
            $columns[] = $key;
            $bindColumns[] = ':'.$key;
        }
        $cols = implode(",",$columns);
        $bindParam = implode(",",$bindColumns);
        $query = "INSERT INTO `" . $tableName . "` (" . $cols . ") VALUES (" . $bindParam . ")";
        try{
            $this->query($query);
            foreach ($data_array as $key => $value) {
                $this->bind(':'.$key, $value);
            }
            $this->execute();
        }catch(PDOException $e){
            echo $e->getMessage();
            return null;
        }
        return $this->lastInsertId();
    }
    public function updateHelper($tableName, $data_array, $where_array, $whereType = 'AND'){
        $columnArr = array();
        $query = " UPDATE ".$tableName." SET ";
        //colunm
        $rowNo = 0;
        foreach ($data_array as $column => $value) {
            $rowNo++;
            if($rowNo==1){
                $query .=$column."=".":".$column;
            }else{
                $query .=",".$column."=".":".$column;
            }

            $columnArr[]=$column;
        }
        $query .=" WHERE ";

        //where
        $whereNo = 0;
        foreach ($where_array as $where_column => $where_value) {
            $whereNo++;
            $where_column_query_bind = $where_column;
            if(in_array($where_column, $columnArr)) {
                $where_column_query_bind .= $whereNo;
            }
            if($whereNo==1){
                $query .=$where_column."=".":".$where_column_query_bind;
            }else{
                $query .=" ".$whereType." ".$where_column."=".":".$where_column_query_bind;
            }
        }
        try{
            $this->query($query);

            //bind colunm
            foreach ($data_array as $column_bind => $value_bind) {
                $this->bind(':'.$column_bind, $value_bind);
            }
            //bind where
            $whereValueNo = 0;
            foreach ($where_array as $where_column_bind => $where_value_bind) {
                $whereValueNo++;
                $where_column_value_bind = $where_column_bind;
                if(in_array($where_column_bind, $columnArr)) {
                    $where_column_value_bind .= $whereValueNo;
                }
                $this->bind(':'.$where_column_value_bind, $where_value_bind);
            }
        }catch(PDOException $e){
            echo $e->getMessage();
            return false;
        }
        return $this->execute();
    }
}