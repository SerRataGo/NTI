<?php 
session_start();
$server="localhost";
$dbname="datauser";
$dbuser="root";
$dbpassword="";

$con=mysqli_connect($server,$dbuser,$dbpassword,$dbname);
if ($con) {
   echo "connected";

}else{
    die("error for connecting data base ".mysqli_connect_errno());
}


?>