<?php
/**
 * Created by PhpStorm.
 * User: MohamedAmine
 * Date: 2016-08-16
 * Time: 11:26 PM
 */
require_once ("../includes/initialize.php");
// the current page number
$page = !empty($_GET['page']) ? (int)$_GET['page'] : 1;
// records per page
$per_page = 1;
// total record count
$total_count = Acutalite::count_all();


$pagination  = new Pagination($page,$per_page,$total_count);
$sql = "SELECT * FROM actualite ";
$sql .= " LIMIT {$per_page} ";
$sql .=" OFFSET {$pagination->offset()}";
$res = Acutalite::find_by_sql($sql);
var_dump($res)
//header("Access-Control-Allow-Origin: *");
//header("Content-Type:application/json; charset=utf-8");
//echo(json_encode($res));
?>