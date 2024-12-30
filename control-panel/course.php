<?php
session_start();
include '../include/connection.php';
require_once '../common/Image-Uploads.php';
require_once '../common/test-input.php';
require_once '../common/getLastId.php';
$goto=$_SERVER['HTTP_REFERER'];


function save($conn,$course,$course_id,$name,$total_duration,$course_frequency,$fee,$course_details,$eligibility,$status,$cby,$cdate){
    $sql="INSERT INTO `courses`(`course`,`course_id`,`name`, `total_duration`, `course_frequency`, `fee`,`course_details`, `eligibility`,`status`, `cby`, `cdate` ) VALUES(?,?,?,?,?,?,?,?,?,?,?)";
    $s=$conn->prepare($sql);
    $s->bind_param("sssssssssss",$course,$course_id,$name,$total_duration,$course_frequency,$fee,$course_details,$eligibility,$status,$cby,$cdate);
    if($s->execute()){
        return true;
    } else {
		return FALSE;
    }
}


function update($conn,$course,$name,$total_duration,$course_frequency,$fee,$course_details,$eligibility,$status,$id){
    $sql="update  `courses` set `course`=?,`name`=?, `total_duration`=?, `course_frequency`=?,`fee`=?,`course_details`=?, `eligibility`=?, `status`=? where id=?";
    $s=$conn->prepare($sql);
    $s->bind_param("sssssssss",$course,$name,$total_duration,$course_frequency,$fee,$course_details,$eligibility,$status,$id);
    if($s->execute()){
        return true;
    } else {
        return FALSE;
    }
}
     

       
       
		
		$width=4; $table_name="courses";$prefix="C";
		
		$course_id= getLastID($conn, $width, $table_name, $prefix);
		
                $course= test_input($_POST['course']);
                $name= test_input($_POST['name']);
                $total_duration=test_input($_POST['total_duration']);
				$course_frequency=test_input($_POST['course_frequency']);
                $fee=test_input($_POST['fee']);
                $status=test_input($_POST['status']);
                $eligibility=test_input($_POST['eligibility']);
                $course_details=test_input($_POST['content1']);
                $cdate=date("Y-m-d H:i:s");
                $cby=$_SESSION['id_mart_admin'];
                
        if(isset($_POST['Edit_id'])){
            $id=$_POST['Edit_id'];
            $p= update($conn,$course,$name,$total_duration,$course_frequency,$fee,$course_details,$eligibility,$status,$id);
        }else{
           
            $p= save($conn,$course,$course_id,$name,$total_duration,$course_frequency,$fee,$course_details,$eligibility,$status,$cby,$cdate);
            
        }
        
        if($p){
            $_SESSION['msg']="success";
           header("Location:$goto");
        }else{
            $_SESSION['error']="error";
           header("Location:$goto");
        }


