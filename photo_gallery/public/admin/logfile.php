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
    $logfile = SITE_ROOT.DS."logs".DS.'log.txt';
if(isset($_GET['clear'])  && $_GET['clear']){
    file_put_contents($logfile,'');
    // Add the first log entry
    log_action('Logs Cleared',"by User ID {$session->user_id}");
    redirect_to('logfile.php');
}

inclue_layout_template("admin_header.php")
?>
<div class="container">

<div class="row">
  <div class="box">
  <a class="btn" href="index.php">&laquo; Back</a>
  <a class="btn" href="logfile.php?clear=true">Clear log file</a>
</div>
  <div class="twelve columns">

    <div class="box">
    <h2>Log File</h2>

<?php
    if(file_exists($logfile)&&is_readable($logfile)&&
    $handle = fopen($logfile,'r')
    ){
        echo "<ul class=\"log-entries\">";
        while(!feof($handle)){
            $entry = fgets($handle);
            if(trim($entry) !=""){
              if (strpos($entry, 'failed') !== false) {
                echo "<li class=\"warn\">{$entry}</li>";
              }else{
                echo "<li>{$entry}</li>";
              }

            }
        }
        fclose($handle);
    }else{
        echo "Could not read from {$logfile}.";
    }
?>
</div>
</div>
</div>
</div>
<?php inclue_layout_template("admin_footer.php"); ?>
