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
    private static $where = NULL;
    private static $prepare = NULL;
    private static $select = '*';
    private static $connection;
    private static $result = NULL;
    private static $limit = NULL;
    private static $orderBy = NULL;
    private static $query = NULL;
    private static $join = NULL;
    private static $on = NULL;

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
        $column = implode(', ', array_keys($data));
        $arr = array_keys($data);
        $arr[0] = ':' . $arr[0];
        $placeholder = implode(', :', $arr);
        $prepare = self::$connection->prepare("INSERT INTO `" . self::$table . "`(" . $column . ") VALUES(" . $placeholder . ")");
        $prepare->execute($data);
        return $this;
    }

    public function update($data = []) {
        $need = NULL;
        foreach (array_keys($data) as $k => $v) {
            $need.="`{$k}` = :{$v},";
        }
        $prepare = self::$connection->prepare("UPDATE `" . self::$table . "` SET " . $need . " WHERE " . self::$where);
        $prepare->execute($data);
        return $this;
    }

    public function all() {
        $this->setQuery()->prepare();
        self::$prepare->setFetchMode(\PDO::FETCH_OBJ);
        self::$prepare->execute();
        while ($row = self::$prepare->fetch()) {
            self::$result[] = $row;
        }
        return (object) self::$result;
    }

    public function select($select = NULL) {
        self::$select = $select;
        return $this;
    }

    public function find($id = NULL) {
        $this->where('`id` = ' . $id);
        $this->setQuery()->prepare();
        self::$prepare->setFetchMode(\PDO::FETCH_OBJ);
        self::$prepare->execute();
        while ($row = self::$prepare->fetch()) {
            self::$result[] = $row;
        }
        return (object) self::$result;
    }

    public function where($where = NULL) {
        $this->setWhere($where);
        return $this;
    }

    private function setWhere($where = NULL) {
        if (is_array($where)) {
            $i = 0;
            $count = count($where);
            foreach ($where as $k => $v) {
                self::$where .= "`{$k}` = {$v}";
                if ($i != ($count - 1)) {
                    self::$where .= " AND ";
                }
                $i++;
            }
            return;
        }
        self::$where = " WHERE " . $where;
        return;
    }

    public static function query($query = NULL) {
        $class = new self;
        self::$prepare = self::$connection->prepare($query);
        self::$prepare->execute();
        while ($row = self::$prepare->fetch()) {
            self::$result[] = $row;
        }
        return self::$result;
    }

    public function get() {
        $this->setQuery()->prepare();
        self::$prepare->execute();
        while ($row = self::$prepare->fetch()) {
            self::$result[] = $row;
        }
        return (object) self::$result;
    }

    public function orderBy($column = NULL, $sort = NULL) {
        self::$orderBy = " ORDER BY `" . $column . "` " . $sort . " ";
        return $this;
    }

    public function limit($start, $total) {
        self::$limit = " LIMIT {$start}, {$total} ";
        return $this;
    }

    private function setQuery() {
        self::$query = "SELECT " . self::$select . " FROM `" . self::$table . "`" . self::$where . self::$orderBy . self::$limit;
        return $this;
    }

    public function join($table = NULL, $type = NULL) {
        if (is_null($type)) {
            self::$join = " INNER JOIN `{$table}` ";
        } else {
            self::$join = " " . strtoupper($type) . " JOIN `{$table}` ";
        }
        return $this;
    }

    public function on($where = NULL) {
        self::$on = " ON {$where} ";
        return $this;
    }

    private function prepare() {
        self::$prepare = self::$connection->prepare(self::$query);
    }

    public function __destruct() {
        self::$where = NULL;
        self::$prepare = NULL;
        self::$select = '*';
        self::$result = NULL;
        self::$limit = NULL;
        self::$orderBy = NULL;
        self::$query = NULL;
        self::$join = NULL;
        self::$on = NULL;
        self::$connection = NULL;
    }

}
