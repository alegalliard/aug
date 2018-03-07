<?php
class FileUploader{
	
	public 	$file_count = 0,
			$name 		= array(),
	 		$type 		= array(),
	 		$extension 	= array(),
	 		$tmp_name 	= array(),
			$size 		= array(),
	 		$error 		= array(),
	 		$upload_file_dir = UPLOAD_FOLDER;
	
	protected $ext_allowed = null;
		
	public function __construct($uploaded_file_name){
		if(trim($uploaded_file_name) == ""){
			throw new PhxException("Filename must be set in " . __CLASS__);
			return;
		}
			
		$this->file_count 	= (Integer) count($_FILES[$uploaded_file_name]['tmp_name']);
		$this->name			= $_FILES[$uploaded_file_name]['name'];
		$this->type			= $_FILES[$uploaded_file_name]['type'];
		$this->tmp_name		= $_FILES[$uploaded_file_name]['tmp_name'];
		$this->size			= $_FILES[$uploaded_file_name]['size'];
		$this->error		= $_FILES[$uploaded_file_name]['error'];
		
		if($this->file_count>1)
			foreach($this->name as $n)	 
				array_push($this->extension,end(explode('.', $n)));
		else
			array_push($this->extension,end(explode('.', $this->name)));
	}

	public function setAllowedExtensions(){
		$this->ext_allowed = func_get_args();
		return $this->ext_allowed;
	}

	public function upload(){
		if(is_dir($this->upload_file_dir) === false)
			mkdir($this->upload_file_dir, 0777, true);
	
		if(is_writable($this->upload_file_dir) === false)
			if(! chmod($this->upload_file_dir, 0777)){
				throw new PhxException("Could not write file into this directory: " . $this->upload_dir);
			}
			
			for($i=0; $i<$this->file_count; $i++){
			if(!$this->tmp_name[$i])
				continue;
			
			if(is_null($this->ext_allowed)){
				if(!@move_uploaded_file($this->tmp_name[$i], $this->upload_file_dir.$this->name[$i])){ 
					throw new UploadException($this->error[$i]);
				}
			} else if(is_array($this->ext_allowed)){
				if(in_array($this->extension[$i],$this->ext_allowed)){
					if(!@move_uploaded_file($this->tmp_name[$i], $this->upload_file_dir.$this->name[$i])){
						throw new UploadException($this->error[$i]);
					}
				}
			}
		}	
	}

	public function __destruct(){
		unset($this);
	}

}

class UploadException extends Exception{
    public function __construct($code) {
        $message = $this->codeToMessage($code);
        parent::__construct($message, $code);
    }

    private function codeToMessage($code){
        switch($code){
            case UPLOAD_ERR_INI_SIZE:
                $message = "The uploaded file exceeds the upload_max_filesize directive in php.ini";
                break;
            case UPLOAD_ERR_FORM_SIZE:
                $message = "The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form";
                break;
            case UPLOAD_ERR_PARTIAL:
                $message = "The uploaded file was only partially uploaded";
                break;
            case UPLOAD_ERR_NO_FILE:
                $message = "No file was uploaded";
                break;
            case UPLOAD_ERR_NO_TMP_DIR:
                $message = "Missing a temporary folder";
                break;
            case UPLOAD_ERR_CANT_WRITE:
                $message = "Failed to write file to disk";
                break;
            case UPLOAD_ERR_EXTENSION:
                $message = "File upload stopped by extension";
                break;
            default:
                $message = "Unknown upload error";
                break;
        }
        return $message;
    }
}