<?php
/**
 * Created by PhpStorm.
 * User: MohamedAmine
 * Date: 2016-08-22
 * Time: 12:33 AM
 */
require_once ("../../includes/initialize.php");
if(empty($_GET['id'])){
    $session->message('No photograph ID was provided');
    redirect_to('index.php');
}
$photo = Photograph::find_by_id($_GET['id']);
if(!$photo){
    $session->message('The photo could not be located. ');
    redirect_to('index.php');
}
$comments = $photo->comments();
inclue_layout_template("admin_header.php");
?>
<div class="container">
  <div class="row">
    <div class="box">
    <a class="btn" href="list_photos.php">&laquo; Back</a>
  </div>
</div>
<div class="row">
  <div class="twelve columns">
    <h2>Comment on <span class="info"><?php echo $photo->filename; ?></span></h2>
    <div class="error-box">
      <p><?php echo output_message($message) ?></p>
    </div>
    </div>
</div>


<?php foreach ($comments as $comment):?>
    <div class="comment-box">
        <div class="row">
            <div class="eleven columns">
          <div class="author">
              <span><?php echo htmlentities($comment->author); ?></span> Wrote :
          </div>
          <div>
              <?php echo strip_tags($comment->body,'<strong><em><p>'); ?>
          </div>
          <div class="meta-info" style="font-style: italic; font-size: 0.8em; text-align:right;">
              <?php echo datetime_to_text($comment->created); ?>
          </div>
        </div>
        <div class="one column">
          <a class="btn"
          onclick="return confirm('Delete this record?')"
          href="delete_comment.php?id=<?php echo $comment->id; ?>"><span class="fa fa-trash-o " aria-hidden="true"></span>Delete</a>
        </div>
      </div>
      </div>
          <?php endforeach; ?>
          <?php if(empty($comments)) { echo 'no comment.';}?>

</div>


<?php inclue_layout_template("admin_footer.php"); ?>
