<?php
/**
 * Created by PhpStorm.
 * User: MohamedAmine
 * Date: 2016-08-17
 * Time: 2:29 PM
 */

// paths
defined('DS') ? null : define('DS',DIRECTORY_SEPARATOR);
defined('SITE_ROOT') ? null : define('SITE_ROOT', realpath($_SERVER["DOCUMENT_ROOT"]).DS.'photo_gallery');
defined('LIB_PATH')  ? null : define('LIB_PATH' , SITE_ROOT.DS.'includes');


// load config file first
require_once (LIB_PATH.DS."config.php");
// load basic functions so that everything after can use them
require_once (LIB_PATH.DS."functions.php");
// load core object
require_once (LIB_PATH.DS."session.php");
require_once (LIB_PATH.DS."database.php");
require_once (LIB_PATH.DS."database_pdo.php");
require_once (LIB_PATH.DS."database_object.php");
// load DATABASE-related classes
require_once (LIB_PATH.DS."user.php");
require_once (LIB_PATH.DS."photograph.php");
require_once (LIB_PATH.DS."actualite.php");
require_once (LIB_PATH.DS."comment.php");
require_once (LIB_PATH.DS."pagination.php");
?>
