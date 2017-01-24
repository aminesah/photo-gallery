
<?php
/**
 * Created by PhpStorm.
 * User: MohamedAmine
 * Date: 2016-08-22
 * Time: 12:33 AM
 */
require_once ("../includes/initialize.php");
if(empty($_GET['id'])){
    $session->message('No photograph ID was provided');
    redirect_to('index.php');
}
$photo = Photograph::find_by_id($_GET['id']);
if(!$photo){
    $session->message('The photo could not be located. ');
    redirect_to('index.php');
}
if(isset($_POST['submit'])){
    $author = trim($_POST['author']);
    $body  =trim($_POST['body']);

    $new_comment = Comment::make($photo->id ,$author,$body);


    if($new_comment && $new_comment->save()){
        // No message needed ; seeing the comment is proof enough
        redirect_to("photo.php?id={$photo->id}");
    }else{
        $message = "There was an error that preventd the comment from being saved.";
    }
}else{
    $author = "";
    $body   ="";
}
$comments = $photo->comments();
inclue_layout_template("header.php");
?>

<div class="container">
  <div class="row">
    <div class="box">
    <a class="btn" href="index.php">&laquo; Back</a>
  </div>
 <div class="box">
    <div class="row">
    <div class="twelve columns">
    <img  class="img-view" src="<?php echo $photo->image_path(); ?>" alt="">
    <p><span class="info">Caption : </span><?php echo $photo->caption; ?></p>
    </div>
    </div>
    </div>
<hr>
<!-- list comments -->
<h3>Comments :</h3>
<?php foreach($comments as $comment): ?>
<div class="comment-box">
    <div class="row">
        <div class="eleven columns">
      <div class="author">
          <span><?php echo htmlentities($comment->author); ?></span> Wrote :
      </div>
      <div>
            <p>
              <?php echo strip_tags($comment->body,'<strong><em><p>'); ?>
            </p>
      </div>
      <div class="meta-info" style="font-style: italic; font-size: 0.8em; text-align:right;">
          <?php echo datetime_to_text($comment->created); ?>
      </div>
    </div>
  </div>
  </div>
    <?php endforeach; ?>
    <?php if(empty($comments)){ echo "No comments.";} ?>

<div id="comment-form">
    <h3>New comment</h3>
    <div class="error-box"><?php echo output_message($message) ?></div>
    <form action="photo.php?id=<?php echo $photo->id ?>" method="post">
      <div class="row">
        <div class="twelve columns">
              <label for="exampleEmailInput">Your name:</label>
                <input class="u-full-width" type="text" name="author" value="<?php echo $author;?>">
        </div>
        <div class="twelve columns">
              <label for="exampleEmailInput">Your comment:</label>
                <textarea class="u-full-width" name="body" placeholder="Your comment here" value="<?php echo $body;?>"></textarea>
        </div>
          <input class="button-primary" type="submit" name="submit" value="Comment">
          </div>
    </form>
</div>
   </div>

<?php inclue_layout_template("footer.php"); ?>
