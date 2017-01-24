<?php
/**
 * Created by PhpStorm.
 * User: MohamedAmine
 * Date: 2016-08-16
 * Time: 11:26 PM
 */
require_once ("../../includes/initialize.php");
if($session->is_logged_in()){
    redirect_to("index.php");
}
if(isset($_POST['submit'])){
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    $found_user = User::authenticate($username,$password);
    if ($found_user){
        $session->login($found_user);
        $found_user->last_visit = strftime("%Y-%m-%d %H:%M:%S", time());
        $found_user->update();
        log_action("Login","{$found_user->username} logged in. ");
        redirect_to("index.php");
    }else{
        $message = 'Username/password combination incorrect.';
        log_action("Login failed","{$username} , ip : {$_SERVER['REMOTE_ADDR']}");
    }



}else{
    $username ="";
    $password ="";
}
inclue_layout_template("admin_header.php");
?>
<div class="container">

    <div class="error-box"><?php echo output_message($message) ?></div>
    <form action="login.php" method="post">
      <div class="row">
        <div class="twelve columns">
              <label for="exampleEmailInput">Username:</label>
                <input class="u-full-width" type="text" name="username" value="<?php echo htmlentities($username)?>">
        </div>
        <div class="twelve columns">
              <label for="exampleEmailInput">Passdword:</label>
                <input class="u-full-width" type="password" name="password" value="<?php echo htmlentities($password)?>">
        </div>
<input class="button-primary" type="submit" name="submit" value="login">

          </div>
    </form>
  </div>

<?php inclue_layout_template("admin_footer.php"); ?>
<?php if(isset($database)){ $database->close_connection();} ?>
