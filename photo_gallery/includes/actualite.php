<?php
/**
 * Created by PhpStorm.
 * User: MohamedAmine
 * Date: 2016-08-21
 * Time: 9:24 PM
 */
require_once (LIB_PATH.DS."database.php");
class Acutalite extends DatabaseObject{

    protected static $table_name ='actualite';
    protected static $db_fields = array('id','title','date','photo','auth_name','content');
    public $id;
    public $title;
    public $date;
    public $photo;
    public $auth_name;
    public $content;
}