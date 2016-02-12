<?php

/*
  | Project: fw
  | Description: my framework
  | Author: Pham Ngoc Phu
  | Alias: Phu Master
  | Email: phumaster.dev@gmail.com
 */
namespace PM;

class DB {

    private static $hostname;
    private static $dbname;
    private static $user;
    private static $passwd;
    private static $table;
    private static $select = '*';
    private static $connection;
    private static $result = NULL;

    public function __construct() {
        self::$hostname = Config::get('db')->hostname;
        self::$dbname = Config::get('db')->dbname;
        self::$user = Config::get('db')->dbuser;
        self::$passwd = Config::get('db')->dbpass;
        try {
            self::$connection = new \PDO("mysql:host=" . self::$hostname . ";dbname=" . self::$dbname . ";charset=utf8", self::$user, self::$passwd);
        } catch (PDOException $errors) {
            throw new Exception($errors->getMessage());
        }
    }

    public static function table($table = NULL) {
        self::$table = $table;
        return new self;
    }

    public function insert($data = []) {
        if (count($data) == 0) {
            return;
        }
        $column = implode(', ', array_keys($data));
        $arr = array_keys($data);
        $arr[0] = ':' . $arr[0];
        $placeholder = implode(', :', $arr);
        $prepare = self::$connection->prepare("INSERT INTO `" . self::$table . "`(" . $column . ") VALUES(" . $placeholder . ")");
        $prepare->execute($data);
        return $this;
    }

    public function all() {
        $prepare = self::$connection->prepare("SELECT " . self::$select . " FROM `" . self::$table . "`");
        $prepare->setFetchMode(\PDO::FETCH_OBJ);
        $prepare->execute();
        while ($row = $prepare->fetch()) {
            self::$result[] = $row;
        }
        return (object) self::$result;
    }

    public function toArray() {
        return self::$result;
    }

    public function __destruct() {
        self::$connection = NULL;
    }

}
