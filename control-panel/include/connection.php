<?php
date_default_timezone_set('Asia/Kolkata');
$servername = "localhost";
// $username = "mclinpll_sanityinvestorsiq_user";
// $password = "HN5lM@31lzIX";
// $dbname = "mclinpll_sanityinvestorsiq_db";

$username = "root";
$password = "";
$dbname = "aadishakti";

$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
else
{  
}?>