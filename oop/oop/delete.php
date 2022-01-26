<?php 

require './classes/blogclass.php';
 
$id = $_GET['id'];
$obj=new blogs;
$obj->deleteBlog($id);

   #   Set Session 
   $_SESSION['Message'] = $Message;

   header("location: index.php");


   
?>