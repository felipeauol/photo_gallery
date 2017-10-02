<?php
require_once ("database.php");

class User {

    public $id;
    public $username;
    public $password;
    public $first_name;
    public $last_name;

    function __toString()
    {
        return $this->username . " " . $this->last_name;
    }

    public static function find_user_by_id($id) {
    global $database;

    $result_array = self::find_by_sql("SELECT * FROM users WHERE id = {$id} LIMIT 1");

    return !empty($result_array) ? array_shift($result_array) : false;
}

    public static function find_all() {

        $result_set = self::find_by_sql("SELECT * FROM users");

        return $result_set;
    }

    public static function find_by_sql($sql="") {
        global $database;
        $result_set = $database->db_query($sql);
        $object_array = array();
        while ($row = $database->fetch_array($result_set)){
            $object_array[] = self::instantiate($row);
        }

        return $object_array;
    }

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

    public static function create_user($username, $password, $f_name, $l_name){
        global $database;

        $query  = "";
        $query .= "INSERT INTO users \n";
        $query .= "'username', 'password', 'first_name', 'last_name') \n";
        $query .= "VALUES ('{$username}', '{$password}', '{$f_name}', '{$l_name}'); ";

        $database->db_query($query);

    }

    private static function instantiate($user_record){

        $object = new self;

        //Long boring way
//        $object->id         = $user_record['id'];
//        $object->username   = $user_record['username'];
//        $object->password   = $user_record['password'];
//        $object->first_name = $user_record['first_name'];
//        $object->last_name  = $user_record['last_name'];


        //Easier, smart way

        foreach($user_record as $attribute=>$value){
            if($object->has_attribute($attribute)){
                $object->$attribute = $value;
            }
        }
        return $object;
    }

    private function has_attribute($attribute){
       $object_vars = get_object_vars($this);

       return array_key_exists($attribute, $object_vars);
    }
}