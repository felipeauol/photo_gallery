<?php

//Define core paths
defined('DS') ? null : define('DS', DIRECTORY_SEPARATOR);

//Define Site Root
defined('SITE_ROOT') ? null :
    define('SITE_ROOT', DS.'Users'.DS.'felipedeoliveira'.DS.'Sites'.DS.'photo_gallery');

//Define path to the library
defined('LIB_PATH') ? null :
    define('LIB_PATH', SITE_ROOT.DS.'includes');

require_once(LIB_PATH.DS."config.php");
require_once(LIB_PATH.DS."functions.php");
require_once(LIB_PATH.DS."session.php");
require_once(LIB_PATH.DS."logger.php");
require_once(LIB_PATH.DS."database.php");
require_once(LIB_PATH.DS."database_object.php");
require_once(LIB_PATH.DS."user.php");
