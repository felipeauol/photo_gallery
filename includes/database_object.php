<?php

//Require database since it will be used by class
require_once(LIB_PATH.DS.'database.php');
class DatabaseObject {

    //Common Database Methods

    public static function find_all() {

        $result_set = static::find_by_sql("SELECT * FROM " .static::$table_name);

        return $result_set;
    }

    public static function find_user_by_id($id) {
        global $database;

        $result_array = static::find_by_sql("SELECT * FROM " .static::$table_name." WHERE id = {$id} LIMIT 1");

        return !empty($result_array) ? array_shift($result_array) : false;
    }

    public static function find_by_sql($sql="") {
        global $database;
        $result_set = $database->db_query($sql);
        $object_array = array();
        while ($row = $database->fetch_array($result_set)){
            $object_array[] = static::instantiate($row);
        }

        return $object_array;
    }

    private static function instantiate($user_record){

        $object = new static;

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