<?php

function dashboardCounter($conn,$miniSql,$table_name){
    $sql="select count(id) from $table_name where 1 $miniSql";
    $s=$conn->prepare($sql);
    $s->bind_result($count);
    if($s->execute()){
        while ($s->fetch()){
            
        }
    }
    return $count;
}

