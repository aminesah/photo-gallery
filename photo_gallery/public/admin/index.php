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
inclue_layout_template("admin_header.php");
$err = "";
$nbcomments = Comment::count_all();
$nbphotos  = Photograph::count_all();
$user = User::find_by_id($session->user_id);
?>

  <div class="container">
    <div class="box">
  <div class="row">
    <div class="twelve columns">
      <a class="btn" href="../index.php">Back to website</a>
      <a class="btn" href="logout.php">Logout</a>

    </div>
    </div>
  </div>
<div class="box">
  <div class="row">
    <div class="twelve columns">
        <h2>Control Panel</h2>
    </div>
    </div>

    <div class="row">
      <ul>
        <div class="four columns">
          <li class="item">
            <a  href="logfile.php">
              <h4>Log File</h4>
                <span class="fa fa-cog icone" aria-hidden="true"></span>
                <p>
                  trace logging attempts
                </p>
            </a>
          </li>
        </div>
        <div class="four columns">
          <li class="item">
            <a  href="list_photos.php">
              <h4>Manage Photos</h4>
                <span class="fa fa-file-text-o icone" aria-hidden="true"></span>
                <p>
                  upload, delete, manage comments
                </p>
            </a>
          </li>
        </div>
        <div class="four columns">
          <li class="item">
            <a  href="#">
              <h4>Statistiques</h4>
              <p  class="repport"><i class="fa fa-user-o" aria-hidden="true"></i> User: <span><?= $user->username; ?></span></p>
              <p class="repport"><i class="fa fa-file-image-o" aria-hidden="true"></i> Photographs :<span><?php echo $nbphotos?></span></p>
              <p class="repport"><i class="fa fa-comments" aria-hidden="true"></i> Comments :<span><?php echo $nbcomments?></span></p>
              <p class="repport"><i class="fa fa-exclamation-circle" aria-hidden="true"></i> Last visit :<span><?php echo $user->last_visit;?></span></p>
            </a>
          </li>
        </div>
      </ul>
    </div>

    </div>
    </div>




<?php echo output_message($err); ?>
<?php echo output_message($message); ?>
<?php inclue_layout_template("admin_footer.php"); ?>
