<?php
/**
 * Created by PhpStorm.
 * User: MohamedAmine
 * Date: 2016-08-23
 * Time: 1:07 AM
 */
require_once ("../../includes/initialize.php");
$session->logout();
redirect_to('index.php');