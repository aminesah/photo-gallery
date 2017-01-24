<?php
/**
 * Created by PhpStorm.
 * User: MohamedAmine
 * Date: 2016-08-17
 * Time: 12:06 AM00000
 */
require_once (LIB_PATH.DS."config.php");
class MysqlDatabase{
    private $connection;
    public function __construct()
    {
        $this->open_connection();
    }
    public function close_connection(){
        if(isset($this->connection)){
            mysqli_close($this->connection);
            unset($this->connection);
        }
    }
    public function open_connection(){
        $this->connection = mysqli_connect(DB_SERVER,DB_USER,DB_PASS,DB_NAME);
        if(mysqli_connect_errno()){
            die("Database connection failed :".mysqli_connect_errno()."(".mysqli_connect_error().")");
        }
    }
    public function query($sql){
        $result = mysqli_query($this->connection,$sql);
        echo mysqli_error($this->connection);
        //echo "<br> {$sql}";
        $this->confirm_query($result);
        return $result;
    }
    // Helper functions !
    private function confirm_query($result){
        if(!$result){
            die("Database query failed !");
        }
    }
    // database neutral !
    public function escape_value($string){
        $escaped_string = mysqli_real_escape_string($this->connection,$string);
        return $escaped_string;
    }
    public function fetch_array($result_set){
        return mysqli_fetch_array($result_set);
    }
    public function insert_id(){
        return mysqli_insert_id($this->connection);
    }
    public  function affected_rows(){
        return mysqli_affected_rows($this->connection);
    }


}
$database = new MysqlDatabase();
$db =&$database;
?>
