<?php 
session_start();
$server="localhost";
$dbname="blogs";
$dbuser="root";
$dbpassword="";

$con=mysqli_connect($server,$dbuser,$dbpassword,$dbname);
if ($con) {
   echo "connected";

}else{
    die("error for connecting data base ".mysqli_connect_errno());
}



  
function cleanData($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }
  
  
?>