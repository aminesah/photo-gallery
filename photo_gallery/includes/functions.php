<?php
/**
 * Created by PhpStorm.
 * User: MohamedAmine
 * Date: 2016-08-16
 * Time: 11:28 PM
 */

function redirect_to($location = null ){
    if($location != null){
        header("Location: {$location}");
        exit;
    }
}

function output_message($msg =""){
    if(!empty($msg)){
        return "<p class=\"message\">{$msg}</p>";
    }else{
        return "";
    }
}
function __autoload($class_name){
    $class_name = strtolower($class_name);
    $path = LIB_PATH.DS."{$class_name}.php";
    if(file_exists($path)){
        require_once ($path);
    }else{
        die("The file {$path} could not be found !");
    }

}
function inclue_layout_template($template=""){
    include(SITE_ROOT.DS.'public'.DS.'layouts'.DS.$template);
}
function log_action($action , $message=""){
    $logfile = SITE_ROOT.DS.'logs'.DS.'log.txt';
    if($hande = fopen($logfile,'a')){
        $timestamp = strftime('%Y-%m-%d %H:%M:%S',time());
        $content = "{$timestamp} | {$action} : {$message} \r\n";
        fwrite($hande,$content);
        fclose($hande);

    }else{
        echo "Could not open log file for writing. ";

    }
}
function datetime_to_text($datetime=""){
    return strftime("%B %d, %Y at %I:%M:%p",strtotime($datetime));
}