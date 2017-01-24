<?php
/**
 * Created by PhpStorm.
 * User: MohamedAmine
 * Date: 2016-08-16
 * Time: 11:26 PM
 */
require_once ("../../includes/initialize.php");
if( !$session->is_logged_in()){redirect_to("login.php");}
$max_file_size = 1048576;
if(isset($_POST['submit'])){
    $photo = new Photograph();
    $photo->caption = $_POST['caption'];
    $photo->attach_file($_FILES['file_upload']);
    if($photo->save()){
        $session->message("Photograph uploaded successfully.");
        redirect_to('list_photos.php');
    }else{
        // failure
        echo"oook";
        $message = join('<br>',$photo->errors);
    }
}
inclue_layout_template("admin_header.php");
?>
<div class="container">
<div class="row">
  <div class="twelve columns">
    <div class="error-box">
      <p><?php echo output_message($message) ?></p>

    </div>
    <div class="box">
<h2>Photo upload</h2>
    <form action="photo_upload.php" enctype="multipart/form-data" method="POST">
        <input type="hidden" name="MAX_FILE_SIZE" value="<?php echo $max_file_size; ?>">
        <input class="u-full-width" type="file" name="file_upload">
        <label for="exampleEmailInput">Caption :</label>
        <input class="u-full-width" type="text" name="caption"></p>
        <input class="button-primary" type="submit" name="submit" value="Upload">
    </form>
  </div>
    </div>
      </div>
        </div>
<?php inclue_layout_template("admin_footer.php"); ?>
