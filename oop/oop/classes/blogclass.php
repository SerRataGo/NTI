<?php
session_start();
require 'dbconnectionclass.php';
require 'functions.php';
class blogs{
private $title;
private $content;
private $imgName;
public function createblog($title,$content,$imgName){


//validation
$validator =new helpers();
//clean..
$this->title=$validator->clean($title);
$this->content=$validator->clean($content);
$this->imgName=$validator->clean($imgName);

$errors=[];

//validate title
if(!$validator->validate($title,1)){
  $errors['title'] ='field required';
}
elseif (!$validator->Validate($title,5)) {
    $errors['title']='title must be string';
    # code...
}
///validate description
if (!$validator->Validate($content,1)) {
    $errors['content']='field required';
    # code...
}elseif (!$validator->Validate($content,2)) {
    $errors['content']='content must be greater than 50';
    # code...
}
//validation image
if (!$validator->Validate($imgName,1)) {
    $errors['image']='field required';
    # code...
}else{
    $imgTempPath = $_FILES['image']['tmp_name'];
    $imgName = $_FILES['image']['name'];
    $extArray = explode('.', $imgName);
    $ImageExtension = strtolower(end($extArray));

    if (!$validator->Validate($ImageExtension, 4)) {
        $errors['Image'] = 'Invalid Extension';
    } else {
        $finalName = time() . rand() . '.' . $ImageExtension;
        $disPath = './uploads/'.$finalName;
          
        if(move_uploaded_file($imgTempPath,$disPath)){
            echo 'Image Uploaded';
        }else{
            echo 'Error Try Again';
        }

    }


}
if (count($errors)>0) {
    $Message=$errors;  
}
else{
$db=new db();
$sql="insert into blogs(title,content,image)values('$title','$content','$finalName')";
$op  = $db->doQuery($sql);

if($op){
    $Message = ['Raw Inserted'];
}else{
    $Message = ['Error Try Again !!!!!'];
}

}
$_SESSION['Message']=$Message;

}


////class edit....
public function editBlog($title,$content,$imgName){
    $validator =new helpers();
//clean..
$this->title=$validator->clean($title);
$this->content=$validator->clean($content);
$this->imgName=$validator->clean($imgName);

$errors=[];
$id = $_GET['id'];
$db=new db();
$sql = "select * from blogs where id = $id";
$op = $db->doQuery($sql);

if (mysqli_num_rows($op) == 1) {
    // code .....
    $BlogData = mysqli_fetch_assoc($op);
}
//validate title
if(!$validator->validate($title,1)){
  $errors['title'] ='field required';
}
elseif (!$validator->Validate($title,5)) {
    $errors['title']='title must be string';
    # code...
}
///validate description
if (!$validator->Validate($content,1)) {
    $errors['content']='field required';
    # code...
}elseif (!$validator->Validate($content,2)) {
    $errors['content']='content must be greater than 50';
    # code...
}
  # Validate Image
  if ($validator->Validate($_FILES['image']['name'], 1)) {
    $ImgTempPath = $_FILES['image']['tmp_name'];
    $ImgName = $_FILES['image']['name'];

    $extArray = explode('.', $ImgName);
    $ImageExtension = strtolower(end($extArray));

    if (!$validator->Validate($ImageExtension, 7)) {
        $errors['Image'] = 'Invalid Extension';
    } else {
        $FinalName = time() . rand() . '.' . $ImageExtension;
    }
}

if (count($errors) > 0) {
    $Message = $errors;
} else {
    // DB CODE .....

    if ($validator->Validate($_FILES['image']['name'], 1)) {
        $disPath = '../uploads/' . $FinalName;

        if (!move_uploaded_file($ImgTempPath, $disPath)) {
            $Message['Message'] ='Error  in uploading Image  Try Again ';
        } else {
            unlink('../uploads/' . $BlogData['image']);
        }
    } else {
        $FinalName = $BlogData['image'];
    }

    if (count($Message) == 0) {
        
        $sql = "update blogs set title='$title' , content='$content'  , image ='$FinalName' where id = $id";

        $op = $db->doQuery( $sql);

        if ($op) {
            $Message = ['Message' => 'Raw Updated'];
        } else {
            $Message = ['Message' => 'Error Try Again ' ];
        }
    }
    # Set Session ......
    $_SESSION['Message'] = $Message;
    header('Location: index.php');

}
$_SESSION['Message'] = $Message;


    

}

function deleteBlog($id){
    # Fetch Id .... 

$db=new db;

$sql = "select * from blogs where id = $id";
$op  =$db->doQuery($sql);

$data = mysqli_fetch_assoc($op);

# Check If Count == 1 
if(mysqli_num_rows($op) == 1){

    // delete code ..... 
   $sql = "delete from blogs where id = $id";
   $op  =$db->doQuery($sql);

   if($op){

    unlink('./uploads/'.$data['image']);

       $Message = ["Message" => "Raw Removed"];
   }else{
       $Message = ["Message" => "Error try Again"];
   }


}else{
    $Message = ["Message" => "Invalid Id "];
}
}
}

?>