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
$photos = Photograph::find_all();
inclue_layout_template("admin_header.php")
?>
<div class="container">

<div class="row">
  <div class="box">
  <a class="btn" href="index.php">&laquo; Back</a>
  <a class="btn" href="photo_upload.php"><i class="fa fa-upload" aria-hidden="true"></i> Upload a new photo</a>
</div>
</div>

  <div class="box">
    <div class="row">
      <div class="twelve columns">
        <h2>Photographs</h2>
    <?php echo output_message($message); ?>
        <table class="bordred">
            <tr>
                <td>Image</td>
                <td>Filename</td>
                <td>Caption</td>
                <td>Size</td>
                <td>Type</td>

                <td>&nbsp;</td>
                <th>Comments</th>
            </tr>
            <?php foreach ($photos as $photo): ?>
            <tr>
                <td><img src="../<?php echo $photo->image_path(); ?>" width="100" alt=""></td>
                <td><?php echo $photo->filename; ?></td>
                <td><?php echo $photo->caption; ?></td>
                <td><?php echo $photo->size_as_text(); ?></td>
                <td><?php echo $photo->type; ?></td>
                <td><a class="btn"
                  onclick="return confirm('Delete this record?')"
                  href="delete_photo.php?id=<?php echo $photo->id; ?>">Delete</a></td>
                <td>
                    <a class="btn" href="comments.php?id=<?php echo $photo->id?>">
                      <i class="fa fa-comments" aria-hidden="true"></i>
                    <?php echo count($photo->comments());?>
                  </a>
                </td>

            </tr>
        <?php endforeach; ?>
        </table>
      </div>
    </div>
  </div>

    </div>

<?php inclue_layout_template("admin_footer.php"); ?>
