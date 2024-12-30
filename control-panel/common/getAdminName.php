<?php

function getAdminName($conn,$admin_id){

    $sql="SELECT `username` FROM `admin_member` where admin_id=?";

    $s=$conn->prepare($sql);

    $s->bind_param("s",$admin_id);

    $s->bind_result($cv_name);

    if($s->execute()){

        while($s->fetch()){

            

        }

    }

    return $cv_name;

}





function getUserName($conn,$user_id){

    $sql="SELECT `name`,mobile FROM `web_user` where id=?";

    $s=$conn->prepare($sql);

    $s->bind_param("s",$user_id);

    $s->bind_result($cv_name,$mobile);

    if($s->execute()){

        while($s->fetch()){

            

        }

    }

	if(!empty($cv_name)){

		return $cv_name;

	}else{

		return $mobile;

	}

	

	

    

}





function getUserId($conn,$user_name){

	$data_array=array();

    $sql="SELECT id FROM `web_user` where mobile like '%".$user_name."%' or name like '%".$user_name."%'";

    $s=$conn->prepare($sql);

    $s->bind_result($id);

    if($s->execute()){

        while($s->fetch()){

            array_push($data_array,$id);

        }

    }

	

		return $data_array;

	

}
function getCountry($conn,$cid){

    $sql="SELECT `name` FROM `master_country` where status='Active' AND cid=?";

    $s=$conn->prepare($sql);

    $s->bind_param("s",$cid);

    $s->bind_result($country);

    if($s->execute()){

        while($s->fetch()){

        }

    }

    return $country;

}

function getState($conn,$sid){

    $sql="SELECT `name` FROM `master_state` where sid=?";

    $s=$conn->prepare($sql);

    $s->bind_param("s",$sid);

    $s->bind_result($state);

    if($s->execute()){

        while($s->fetch()){

        }

    }

    return $state;

}
function getDistrict($conn,$did){

    $sql="SELECT `name` FROM `master_district` where did=?";

    $s=$conn->prepare($sql);

    $s->bind_param("s",$did);

    $s->bind_result($district);

    if($s->execute()){

        while($s->fetch()){

        }

    }

    return $district;

}

function getParentCompany($conn,$pid){

    $sql="SELECT `cname` FROM `parent_company` where comp_id=?";

    $s=$conn->prepare($sql);

    $s->bind_param("s",$pid);

    $s->bind_result($parent);

    if($s->execute()){

        while($s->fetch()){

        }

    }

    return $parent;

}

function calculate_comission($conn,$user_id){

	$total_amount=0;
	
	$sql='SELECT web_employee_service.company_pay FROM web_employee_service INNER JOIN client_service ON client_service.service_id = web_employee_service.service_id AND web_employee_service.status="approved" AND client_service.status=5 AND client_service.employee="'.$user_id.'"';
	
	$s=$conn->prepare($sql);
	
	$s->bind_result($amount);
	
	$s->execute();
	
	$s->store_result();
	
	while($s->fetch()){
	
		$total_amount+=$amount;
		
	}
	
	$s->close();
	
	if(empty($total_amount)){
		$total_amount=0;
	}
	
	
	$sql='SELECT SUM(`amount`) FROM `web_user_payment` WHERE status="Active" AND `user_id`="'.$user_id.'"';
	
	$s=$conn->prepare($sql);
	
	$s->bind_result($paid_amount);
	
	$s->execute();
	
	$s->fetch();
	
	$s->close();
	
	if(empty($paid_amount)){
		$paid_amount=0;
	}
	
	

	return $total_amount - $paid_amount;
}

function cafe_comission($conn,$user_id){

	$amount=0;
	
	$sql='SELECT SUM(`commission`) FROM `client_service` WHERE `cby`="'.$user_id.'"';
	
	$s=$conn->prepare($sql);
	
	$s->bind_result($amount);
	
	$s->execute();
	
	$s->fetch();
	
	$s->close();
	
	if(empty($amount)){
		$amount=0;
	}
	
	
	$sql='SELECT SUM(`amount`) FROM `web_user_payment` WHERE status="Active" AND `user_id`="'.$user_id.'"';
	
	$s=$conn->prepare($sql);
	
	$s->bind_result($paid_amount);
	
	$s->execute();
	
	$s->fetch();
	
	$s->close();
	
	if(empty($paid_amount)){
		$paid_amount=0;
	}

	return $amount - $paid_amount;
}
?>

