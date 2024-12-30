<?php include 'connection.php';

define('BASE_URL', 'http://test.com');

date_default_timezone_set('Asia/calcutta');

//Get Home URL

function getHomeUrl() {

	return BASE_URL;

}



//insert data

  function dbRowInsert($conn,$table_name,$form_data){

	

	$fields = array_keys($form_data);

	

	$sql="INSERT INTO ".$table_name."( `".implode('`,`', $fields)."`) VALUES ('".implode("','", $form_data)."')";

	

	$s=$conn->prepare($sql);

   

   if($s->execute()){

       

	    return $s->insert_id;

    

	}else{

     

	    return false;

   

    }

  }



// Delete data

   function dbRowDelete($conn, $table_name, $where_clause=''){

	

	$whereSQL = '';

    

	if(!empty($where_clause)){

	      

		   if(substr(strtoupper(trim($where_clause)), 0, 5) != 'WHERE'){

	         

			    $whereSQL = " WHERE ".$where_clause;

	        

			}else{

	            

				$whereSQL = " ".trim($where_clause);

	        }

	    }

	    $sql = "DELETE FROM ".$table_name.$whereSQL;

		

		$s=$conn->prepare($sql);

   

	    if($s->execute()){

			

			return true;

		

		}else{

		

			return false;

		

		}

	  

	}



//Update Data

	function dbRowUpdate($conn, $table_name, $form_data, $where_clause=''){

		

		$whereSQL = '';

	   

	    if(!empty($where_clause)){

	       

		   if(substr(strtoupper(trim($where_clause)), 0, 5) != 'WHERE'){

	            

			    $whereSQL = " WHERE ".$where_clause;

	       

		    } else {

	            

				$whereSQL = " ".trim($where_clause);

	        }

	    }

	    

		$sql = "UPDATE ".$table_name." SET ";

	    

		$sets = array();

	   

	    foreach($form_data as $column => $value){

	         

			 $sets[] = "`".$column."` = '".$value."'";

	    

		}

	   

	    $sql .= implode(', ', $sets);

	  

	    $sql .= $whereSQL;

	 

	    $s=$conn->prepare($sql);

   

	    if($s->execute()){

			

			return true;

		

		}else{

		

			return false;

		

		}

	}



// record set function 

function record_set($conn,$name,$query){

global ${"query_$name"};

global ${"$name"};

global ${"row_$name"};

global ${"totalRows_$name"};

	${"query_$name"} = "$query";

	${"$name"} = mysqli_query($conn,${"query_$name"}) or die('Connection failed:');

	${"totalRows_$name"} = mysqli_num_rows(${"$name"});

}



function status(){

	$data=array(

				'1'=>'Pending',

				'2'=>'in Progress',

				'3'=>'Hold',

				'4'=>'Active',
				
				'5'=>'Completed',

				'6'=>'Deactive',

				);

	return $data;

				

}



function status_color(){

	$data=array(

				'1'=>'primary',

				'2'=>'warning',

				'3'=>'warning',

				'4'=>'success',

				'5'=>'info',

				'6'=>'danger',

				);

	return $data;

				

}

?>