<?php

require_once ("../includes/database.php");
require_once ("../includes/user.php");

//User::create_user("jtester", "pass123", "John", "Tester");

var_dump(User::find_user_by_id(1));
?>