<?php

function MyTime($input){
    return date("h a",strtotime("$input:00"));
}
?>

