<?php
/**
 * Created by PhpStorm.
 * User: MohamedAmine
 * Date: 2016-08-21
 * Time: 9:24 PM
 */
require_once (LIB_PATH.DS."database.php");
class Photograph extends DatabaseObject{

    protected static $table_name ='photographs';
    protected static $db_fields = array('id','filename','type','size','caption');
    public $id;
    public $filename;
    public $type;
    public $size;
    public $caption;

    private $temp_path;
    protected $upload_dir = "images";
    public $errors = array();
    protected $upload_errors = array(
        UPLOAD_ERR_OK => "No errors.",
        UPLOAD_ERR_INI_SIZE => "Larger than upload_max_filesize.",
        UPLOAD_ERR_FORM_SIZE => "Larger than form MAX_FILE_SIZE",
        UPLOAD_ERR_PARTIAL => "Partial upload.",
        UPLOAD_ERR_NO_FILE => "No file. ",
        UPLOAD_ERR_NO_TMP_DIR=>"No temporary directory. ",
        UPLOAD_ERR_CANT_WRITE=>"Can't write to disk",
        UPLOAD_ERR_EXTENSION => "File upload stopped by extension. "
    );
    // Pass in $_FILE['uploaded_file']) as an arg
    public function attach_file($file){
        // Perform error cheking
        if(!$file || empty($file)|| !is_array($file)){
            $this->errors[] = "No file was uploaded. ";
            return false;
        }elseif($file['error'] !=0){
            $this->errors[] = $this->upload_errors[$file['error']];
            return false;
        }else{
            $this->temp_path = $file['tmp_name'];
            $this->filename = basename($file['name']);
            $this->type = $file['type'];
            $this->size = $file['size'];
            return true;
        }


    }
    public function save(){

        if(isset($this->id)){

            parent::update();

        }else{

            // Make sure there are no errors
            if(!empty($this->errors)){return false;}
            if(strlen($this->caption) >= 255){
                $this->errors[] = "The caption can only be 255 characters long.";
                return false;
            }
            if(empty($this->filename) || empty($this->temp_path)){
                $this->errors[] = "The file location was not available.";
                return false;
            }
            // Determine the target path
            $target_path = SITE_ROOT.DS.'public'.DS.$this->upload_dir.DS.$this->filename;
            if(file_exists($target_path)){
                echo $target_path;
                $this->errors[] = "The file {$this->filename} already exists.";
                return false;
            }

            // Attempt yo move the file
            if(move_uploaded_file($this->temp_path,$target_path)){
                if(parent::create()){
                    unset($this->temp_path);
                    return true;
                }
            }else{
                $this->errors[]= 'The file upload failed';
                return false;
            }
        }
    }
    public function image_path(){
        return $this->upload_dir.DS.$this->filename;
    }
    public function size_as_text(){
        if($this->size <1024){
            return "{$this->size} bytes";
        }elseif($this->size <1048576){
            $size_kb = round($this->size/1024);
            return "{$size_kb} KB";
        }else{
            $size_mb = round($this->size/1048576,1);
            return "{$size_mb} MB";
        }
    }
    public function comments(){
        return Comment::find_comments_on($this->id);
    }
    public function destroy(){
        // remove the db entry
        if(parent::delete()){
            $target_path = SITE_ROOT.DS.'public'.DS.$this->image_path();
            return unlink($target_path) ? true : false;
        }else{
            return false;
        }
    }

}
