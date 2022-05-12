<?php
class Connection
{
    static public function infoDatabase()
    {
        $infoDB = array(
            "database"=> "database-1",
            "user" => "root",
            "pass"=> ""
        );
        return $infoDB;
    }

    static public function connect()
    {
        try
        {
            $link = new PDO(
                "mysql:host=localhost;dbname=".Connection::infoDatabase()["database"],
                Connection::infoDatabase()["user"],
                Connection::infoDatabase()["pass"]
            );
            $link->exec("set names utf8");
        }
        catch(PDOException $e)
        {
            die("Error: ".$e->getMessage());
        }

        return $link;
    }

    static public function getColumnsData($table)
    {
        $database = Connection::infoDatabase()["database"];
        return Connection::connect()
        ->query("SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE table_schema = '$database' AND table_name = '$table'")
        ->fetchAll(PDO::FETCH_OBJ);
    }
}