<?php
   include 'connection.php';
   date_default_timezone_set('Asia/Kolkata');
    function gohomeurl(){
    	//return 'https://rdnews24.com/';
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
   function product_status(){
   	$data=array(
   				'1'=>'Request',
   				'2'=>'Accept',
   				'3'=>'Delivered',
   				'4'=>'Returned',
   				'5'=>'Cancel',
   				'6'=>'Return Request',
   				);
   	return $data;
   }
   function status_color(){
   	$data=array(
   				'1'=>'primary',
   				'2'=>'success',
   				'3'=>'warning',
   				'4'=>'danger',
   				'5'=>'danger',
   				'6'=>'info',
   				);
   	return $data;
   }
   function validate_input( $post_data )
   {
   	$value = trim($post_data);
   	$value = stripslashes($value);
   	$value = htmlspecialchars($value);
   	return $value;
   }
   //*** select query from database ****//
   function select_all_record( $conn, $table_name, $param=false, $select=false,$like=false,$order=false )
   {
   	$where = false;
   	$select_str= "*";
   	if( isset($select) && !empty( $select ) )
   	{
   		$select_str = implode( $select, ",");
   	}
   	if( isset ( $param )  && !empty ( $param ) && is_array( $param ))
   	{
   		$where_str = "";
   		$count = count( $param );
   		$and = $count > 1 ? " AND " : false;
   		foreach( $param as $key=>$value )
   		{
   			$where_str.= $key."='".$value."'".$and."";
   		}
   		$where_str = rtrim( $where_str, " AND ");
   		$where = "WHERE ". $where_str;
   	}
   	if( isset($like) && !empty($like) )//use in search products//
   	{
   		$like = $like;
   		(empty( $where_str ) ) ? $where = "WHERE ": $like = "AND ".$like;
   		//(empty
   	}
   	$sql = " SELECT $select_str  FROM $table_name  $where  $like" ;
   	$result = $conn->query( $sql );
   	return $result;
   }
   //*****---------------------------------****//
   function prepare_for_insert( $table_field )
   {
   	$prepare_data = array();
   	if( is_array( $table_field ) )
   	{
   		$count = count( $table_field );
   		for($i=0;$i<$count;$i++)
   		{
   			if( isset( $_POST[ $table_field[$i] ] ) )
   			{
   				$prepare_data[ $table_field[$i] ] = validate_input( $_POST[$table_field[$i]] );
   			}
   		}
   	}
   	return $prepare_data;
   }
   /***For pagenation *****/
    function displayPaginationBelow($per_page,$page,$page_url,$total){
            $adjacents = "2"; 
       	$page = ($page == 0 ? 1 : $page);  
       	$start = ($page - 1) * $per_page;								
       	$prev = $page - 1;							
       	$next = $page + 1;
           $setLastpage = ceil($total/$per_page);
       	$lpm1 = $setLastpage - 1;
       	$setPaginate = "";
       	if($setLastpage > 1)
       	{	
       		$setPaginate .= "<ul class='pagination'>";
                      // $setPaginate .= "<li class='setPage'>Page $page of $setLastpage</li>";
   			if($prev > 0){
   				$setPaginate.= "<li><a href='{$page_url}p=$prev'>Prev</a></li>";
   			}
       		if ($setLastpage < 7 + ($adjacents * 2))
       		{	
       			for ($counter = 1; $counter <= $setLastpage; $counter++)
       			{
       				if ($counter == $page){
       					$setPaginate.= "<li class='active'><a class='current_page'>$counter</a></li>";
   					}else{
   						$setPaginate.= "<li><a href='{$page_url}p=$counter'>$counter</a></li>";	
   					}
       			}
       		}
       		elseif($setLastpage > 5 + ($adjacents * 2))
       		{
       			if($page < 1 + ($adjacents * 2))		
       			{
       				for ($counter = 1; $counter < 4 + ($adjacents * 2); $counter++)
       				{
       					if ($counter == $page)
       						$setPaginate.= "<li class='active'><a class='current_page'>$counter</a></li>";
       					else
       						$setPaginate.= "<li><a href='{$page_url}p=$counter'>$counter</a></li>";					
       				}
       				$setPaginate.= "<li><a href='{$page_url}p=$lpm1'>$lpm1</a></li>";
       				$setPaginate.= "<li><a href='{$page_url}p=$setLastpage'>$setLastpage</a></li>";		
       			}
       			elseif($setLastpage - ($adjacents * 2) > $page && $page > ($adjacents * 2))
       			{
       				$setPaginate.= "<li><a href='{$page_url}'>1</a></li>";
       				$setPaginate.= "<li><a href='{$page_url}'>2</a></li>";
       				for ($counter = $page - $adjacents; $counter <= $page + $adjacents; $counter++)
       				{
       					if ($counter == $page)
       						$setPaginate.= "<li class='active'><a class='current_page'>$counter</a></li>";
       					else
       						$setPaginate.= "<li><a href='{$page_url}p=$counter'>$counter</a></li>";					
       				}
       				$setPaginate.= "<li><a href='{$page_url}p=$lpm1'>$lpm1</a></li>";
       				$setPaginate.= "<li><a href='{$page_url}p=$setLastpage'>$setLastpage</a></li>";		
       			}
       			else
       			{
       				$setPaginate.= "<li><a href='{$page_url}p=1'>1</a></li>";
       				$setPaginate.= "<li><a href='{$page_url}p=2'>2</a></li>";
       				for ($counter = $setLastpage - (2 + ($adjacents * 2)); $counter <= $setLastpage; $counter++)
       				{
       					if ($counter == $page)
       						$setPaginate.= "<li class='active'><a class='current_page'>$counter</a></li>";
       					else
       						$setPaginate.= "<li><a href='{$page_url}p=$counter'>$counter</a></li>";					
       				}
       			}
       		}
       		if ($page < $counter - 1){ 
   				$setPaginate.= "<li><a href='{$page_url}p=$next'>Next</a></li>";
                   $setPaginate.= "<li><a href='{$page_url}p=$setLastpage'>Last</a></li>";
       		}else{
   				$setPaginate.= "<li class='active'><a class='current_page'>Next</a></li>";
                   $setPaginate.= "<li class='active'><a class='current_page'>Last</a></li>";
               }
       		$setPaginate.= "</ul>\n";		
       	}
           return $setPaginate;
       }?>