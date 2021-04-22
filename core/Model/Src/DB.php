<?php

namespace Core\Model\Src;

class DB{

    public static $pdo = null;

    public static function connect()
    {
        global $app;
        $configs = $app->configs()['mysql'];
        extract(get_object_vars((object) $configs));
        try {
            $conn = new \PDO("mysql:host=$host;dbname=$database", $username, $password);
            $conn->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        } catch (\PDOException $pe) {
            die("Could not connect to the database $database :" . $pe->getMessage());
        }
        self::$pdo = $conn;
    }

    public static function select($table, $query = "", $args = null)
    {
        self::connect();
        $query = "SELECT * FROM $table " . $query ;
        $stmt  = self::$pdo->prepare($query);
        $stmt->execute($args);
        return $stmt->fetchAll();
    }

    public static function insert($table, $query, $body)
    {
        self::connect();
        $query = "INSERT INTO $table SET " . $query;
        $stmt = self::$pdo->prepare($query);
        $stmt->execute($body);
        return self::$pdo->lastInsertId();
    }

    public static function update($id, $table, $query, $body)
    {
        self::connect();
        $query = "UPDATE $table SET " . $query . " WHERE id=$id";
        $stmt = self::$pdo->prepare($query);
        $stmt->execute($body);
    }

    public static function destroy($id, $table)
    {
        self::connect();
        $query = "DELETE FROM $table WHERE id=$id";
        $stmt = self::$pdo->prepare($query);
        $stmt->execute();
    }
}