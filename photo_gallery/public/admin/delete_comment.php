<?php
/**
 * Created by PhpStorm.
 * User: MohamedAmine
 * Date: 2016-08-16
 * Time: 11:26 PM
 */
require_once ("../../includes/initialize.php");
if( !$session->is_logged_in()){redirect_to("login.php");
}
if(empty($_GET['id'])){
    $session->message('No comment ID was provided');
    redirect_to('index.php');
}
$comment = Comment::find_by_id($_GET['id']);
if($comment && $comment->delete()){
    $session->message('The comment was deleted.');
    redirect_to("comments.php?id={$comment->photograph_id}");

}else{
    $session->message('The comment could not be deleted.');
    redirect_to('index.php');
}
?>
table>tr*5>td{fati}
