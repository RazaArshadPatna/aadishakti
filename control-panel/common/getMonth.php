<?php

function getMonth(){
   return $months = array(
         'Apr',
         'May',
         'Jun',
         'Jul',
         'Aug',
         'Sep',
         'Oct',
         'Nov',
         'Dec',
         'Jan',
         'Feb',
         'Mar',
   );
}
function getsalMonth(){
      return $months = array(
            '1'=>'Jan',
            '2'=>'Feb',
            '3'=>'Mar',
            '4'=>'Apr',
            '5'=>'May',
            '6'=>'Jun',
            '7'=>'Jul',
            '8'=>'Aug',
            '9'=>'Sep',
            '10'=>'Oct',
            '11'=>'Nov',
            '12'=>'Dec'
      );
   }
function getSession(){
      return $session = array('1920'=>'2019-2020',
                              '2021'=>'2020-2021',
                              '2122'=>'2021-2022',
                              '2223'=>'2022-2023',
                              '2324'=>'2023-2024',
                              '2425'=>'2024-2025',
                              '2526'=>'2025-2026',
                              '2627'=>'2026-2027',
                              '2728'=>'2027-2028',
                              '2829'=>'2028-2029',
                              '2930'=>'2029-2030'
);
}
function getCSession(){
      if(date('m')<=03){
            $sess_code1 = date('y')+1;
            $sess_code2 = date('y')+2;
            $session = date('Y')+1;
        }else{
            $sess_code1 = date('y');
            $sess_code2 = date('y')+1;
            $session = date('Y');
        }
        return $sess_code1.$sess_code2;
}
function adm_date($rid,$session,$conn){
 $sqldt = "SELECT `adm_date` FROM `master_student` WHERE `registration_id`='".$rid."' AND `session`='".$session."'";
 $st =$conn->prepare($sqldt);
 $st->bind_result($adm_date);
 $st->execute();
 $st->fetch();
 $st->close();
 if(!empty($adm_date)){
      return $adm_date;
 }else{
       $year = date('Y');
       return $year.'-04-'.'01';
 }
}
?>
