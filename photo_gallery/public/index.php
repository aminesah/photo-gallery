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
$per_page = 9;
// total record count
$total_count = Photograph::count_all();

//$photos = Photograph::find_all();
$pagination  = new Pagination($page,$per_page,$total_count);
$sql = "SELECT * FROM photographs ";
$sql .= " LIMIT {$per_page} ";
$sql .=" OFFSET {$pagination->offset()}";
$photos = Photograph::find_by_sql($sql);
inclue_layout_template("header.php");
?>

<div class="container main">
      <?php $c = count($photos)/3; $k=0; ?>

      <?php for($i = 0;$i<$c;$i++): ?>

  <div class="row">
      <?php for($j=0; $j<3; $j++): ?>
      <?php if($k>=count($photos)) break; ?>
        <div class="four columns">
            <a class="image-link" href="photo.php?id=<?php echo $photos[$k]->id; ?>"><img src="<?php echo $photos[$k]->image_path(); ?>" alt=""></a>
            <?php $k++;?>

      </div>
  <?php endfor; ?>
  </div>
  <?php endfor; ?>
    <div class="row">
    <div class="twelve columns">

          <?php
            if($pagination->total_pages() > 1) {

              echo "<ul class=\"pagination\">";
              if($pagination->has_previous_page()) {
                echo "<li><a href=\"index.php?page=";
                echo $pagination->previous_page();
                echo "\">&laquo</a></li> ";
              }

              for($i=1; $i <= $pagination->total_pages(); $i++) {
                if($i == $page) {
                  echo " <li><a class=\"active\">{$i}</a></li> ";
                } else {
                  echo " <li><a  href=\"index.php?page={$i}\" >{$i}</a></li> ";
                }
              }

              if($pagination->has_next_page()) {
                echo " <li><a href=\"index.php?page=";
                echo $pagination->next_page();
                echo "\">&raquo;</a></li> ";
              }
              echo "</ul>";
            }

          ?>

</div>
</div>
  </div>


<?php inclue_layout_template("footer.php"); ?>
