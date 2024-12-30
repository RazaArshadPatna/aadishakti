<?php 
function multi($path,$post_filename){

$targetDir = $path; 
    $allowTypes = array('jpg','png','jpeg','gif'); 
     $name = date('Y-m-d H:i:s');
    $statusMsg = $errorMsg = $insertValuesSQL = $errorUpload = $errorUploadType = ''; 
    $fileNames = array_filter($_FILES["$post_filename"]["name"]); 
    
    if(!empty($fileNames)){ 
        foreach($_FILES["$post_filename"]["name"] as $key=>$val){ 
            // File upload path 
            $fileName = basename($_FILES["$post_filename"]['name'][$key]); 
            $file_basename = substr($fileName, 0, strripos($fileName, '.')); // get file extention
            $file_ext =substr($fileName, strripos($fileName, '.'));
            $newfilename = md5(rand(10,1000000)). $file_ext;
            $targetFilePath = $targetDir . $newfilename; 
             
            // Check whether file type is valid 
            $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION); 
            if(in_array($fileType, $allowTypes)){ 
                // Upload file to server 
                if(move_uploaded_file($_FILES["$post_filename"]["tmp_name"][$key], $targetFilePath)){ 
                    // Image db insert sql 
                    $insertValuesSQL .= $newfilename.','; 
                }else{ 
                    $errorUpload .= $_FILES['files']['name'][$key].' | '; 
                } 
            }else{ 
                $errorUploadType .= $_FILES['files']['name'][$key].' | '; 
            } 
        } 
         
        // Error message 
        $errorUpload = !empty($errorUpload)?'Upload Error: '.trim($errorUpload, ' | '):''; 
        $errorUploadType = !empty($errorUploadType)?'File Type Error: '.trim($errorUploadType, ' | '):''; 
        $errorMsg = !empty($errorUpload)?'<br/>'.$errorUpload.'<br/>'.$errorUploadType:'<br/>'.$errorUploadType;
      
        return $insertValuesSQL;
        
    }
}
    ?> 