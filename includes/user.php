<?php
require_once (LIB_PATH.DS."database.php");

class User extends DatabaseObject {

    protected static $table_name="users";
    public $id;
    public $username;
    public $password;
    public $first_name;
    public $last_name;

    public static function authenticate($username="",$password="") {
        global $database;
        $username = $database->mysql_prep("$username");
        $password = $database->mysql_prep("$password");

        $sql = "SELECT * FROM users 
                WHERE username = '{$username}' 
                AND password = '{$password}' 
                LIMIT 1";

        $result_array = self::find_by_sql($sql);
        return !empty($result_array) ? array_shift($result_array) : false;
    }

    public function full_name() {
        if((isset($this->first_name)) && isset($this->first_name)) {
            return $this->first_name . " " . $this->last_name;
        } else {
            return "";
        }
    }

    public static function create_user($username, $password, $f_name, $l_name){
        global $database;

        $query  = "";
        $query .= "INSERT INTO users \n";
        $query .= "'username', 'password', 'first_name', 'last_name') \n";
        $query .= "VALUES ('{$username}', '{$password}', '{$f_name}', '{$l_name}'); ";

        $database->db_query($query);

    }

    function __toString()
    {
        return $this->username . " " . $this->last_name;
    }

    public function create() {
        global $database;

        $sql  = "INSERT INTO users (";
        $sql .= "username, password, first_name, last_name";
        $sql .= ") VALUES ('";
        $sql .= $database->mysql_prep($this->username) ."', '";
        $sql .= $database->mysql_prep($this->password) ."', '";
        $sql .= $database->mysql_prep($this->first_name) ."', '";
        $sql .= $database->mysql_prep($this->last_name) ."')";

        if($database->db_query($sql)) {
            $this->id = $database->insert_id();
            return true;
        } else {
            return false;
        }
    }

    public function update() {
        global $database;

        $sql  = "UPDATE users SET ";
        $sql .= "username='". $database->mysql_prep($this->username) ."', ";
        $sql .= "password='". $database->mysql_prep($this->password) ."', ";
        $sql .= "first_name='". $database->mysql_prep($this->first_name) ."', ";
        $sql .= "last_name='". $database->mysql_prep($this->last_name) ."' ";
        $sql .= "WHERE id=". $database->mysql_prep($this->id);
        $database->db_query($sql);
        return ($database->affected_rows() == 1) ? true : false;
    }

    public function delete() {
        global $database;

        $sql  = "DELETE FROM users ";
        $sql .= "WHERE id =". $database->mysql_prep($this->id);
        $sql .= " LIMIT 1";
        $database->db_query($sql);
        return ($database->affected_rows() == 1) ? true : false;
    }
}