<?php
function addImg($path,$post_file_name){
    $newfilename="";
    if (!file_exists("$path")) {
    mkdir("$path", 0777, true);
}
        $targetFolder="$path/"; 
        $filename = $_FILES["$post_file_name"]["name"];
	$file_basename = substr($filename, 0, strripos($filename, '.')); // get file extention
	$file_ext =substr($filename, strripos($filename, '.')); // get file name
	$filesize = $_FILES["$post_file_name"]["size"];
	$allowed_file_types = array('.jpg','.png','.jpeg','.gif','.pdf');	

	if (in_array(strtolower($file_ext),$allowed_file_types) && ($filesize <4194304))
	{	
		// Rename file
		$newfilename = md5(rand(10,1000000)). $file_ext;
                
                //$_SESSION['image_ext']=$file_ext;
		if (file_exists($targetFolder . $newfilename))
		{
			// file already exists error
			//echo "You have already uploaded this file.";
		}
		else
		{		
			move_uploaded_file($_FILES["$post_file_name"]["tmp_name"], $targetFolder . $newfilename);
			//echo "File uploaded successfully.";
                        //$_SESSION['image_name']=$newfilename;
		}
	}
	elseif (empty($file_basename))
	{	
		// file selection error
		//echo "Please select a file to upload.";
            
	} 
	elseif ($filesize >2097152)
	{	
		// file size error
		//echo "The file you are trying to upload is too large.";
           
           //header("Location:add-upcoming-event.php");
          // exit();
	}
	else
	{
		// file type error
                
		//echo "Only these file typs are allowed for upload: " . implode(', ',$allowed_file_types);
                
	}
    	
	return $newfilename;	
     }
  