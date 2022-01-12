<?php   
require "dbconnection.php";
$errors=[];
if ($_SERVER["REQUEST_METHOD"] == "POST") {


  $name =cleanData($_POST['name']);
  $email =cleanData($_POST['email']);
  $tittle =cleanData($_POST['tittle']);
  $content =cleanData($_POST['content']);
  $uploadImage= $_FILES['image'];

  

  //inilize the error array


  //validation name 
  if (empty($name)) {
    $errors['name']='name is requried';
  }elseif(!filter_var($name,FILTER_SANITIZE_STRING)){

    $errors['name']='must be string';

  }elseif (strlen($name)<5) {
    $errors['name']='name must greater than 5';
  }
   //validation Email 
  if (empty($email)) {
    $errors['email']='email is requried';
  }elseif(!filter_var($email,FILTER_VALIDATE_EMAIL)){
    $errors['email']='must be email';
  }

  //validation Tittle 
  if (empty($tittle)) {
    $errors['tittle']='tittle is requried';
  }elseif(!filter_var($tittle,FILTER_SANITIZE_STRING)){

    $errors['tittle']='must be string';

  }elseif (strlen($name)<5) {
    $errors['tittle']='tittle must greater than 5';
  }

  //validation content
  if (empty($content)) {
    $errors['content']='content is requried';
  }elseif (strlen($name) < 10 ) {
    $errors['content']='content must greater than 50';
  }

  

  if(!empty($_FILES['image'])){
 
    $imgName     = $_FILES['image']['name'];
    $imgTempPath = $_FILES['image']['tmp_name'];
    $imagSize    = $_FILES['image']['size'];
    $imgType     = $_FILES['image']['type'];
  
  
  
     $imgExtensionDetails = explode('.',$imgName);
     $imgExtension        = strtolower(end($imgExtensionDetails));
        //var_dump($uploadImage);
     $allowedExtensions   = ['png','jpg','jpeg'];
  
        if(in_array($imgExtension ,$allowedExtensions)){
              // upload code ..... 
           
            $finalName = rand().time().'.'.$imgExtension;
              
            $disPath = './images/'.$finalName;
              //var_dump($disPath);
         if(move_uploaded_file($imgTempPath,$disPath)){
              echo 'Image Uploaded'; 
             
         }else{
             /* echo 'Error Try Again'; */
             $errors['image']='Error Try Again';
         }
  
        }else{
            /* echo 'Extension Not Allowed'; */
            $errors['image']='Extension Not Allowed';
        }
  
  
    }
    //define sql function and connections
  if (count($errors) > 0) {
    foreach ($errors as $key => $value) {
       
        echo '* ' . $key . ' : ' . $value . '<br>';
    }
} else {
    $password = md5($password);

    # store data ......
    $sql = "insert into bloger (name,email,tittle,content) values ('$name','$email','$tittle','$content')";

    $op = mysqli_query($con, $sql);

    if ($op) {
        $Message = 'Raw Inserted';
    } else {
        $Message = 'Error try Again : ' . mysqli_error($con);
    }

    $_SESSION['Message'] = $Message;
    header('Location: showdata.php');
  }
}





?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="main.css" class="css">
  <title>task file</title>
</head>
<body>

<div class="aaaa">
  <form action="" method="POST" enctype="multipart/form-data">
  <div class="row">
    <div class="col-25">
      <label for="fname">name</label>
    </div>
    <div class="col-75">
      <input type="text" id="fname" name="name" >
      <span><?php if(isset($errors['name']))echo $errors['name']; ?></span><br>
    </div>
  </div>


  <div class="row">
    <div class="col-10">
      <label for="tittle">tittle</label>
    </div>
    <div class="col-45">
      <input type="text" id="tittle" name="tittle" >
      <span><?php if(isset($errors['tittle']))echo $errors['tittle']; ?></span><br>
      
    </div>
  </div>

  <div class="row">
    <div class="col-10">
      <label for="email">email</label>
    </div>
    <div class="col-45">
      <input type="text" id="email" name="email" >
      <span><?php if(isset($errors['email']))echo $errors['email']; ?></span><br>
    </div>
  </div>

  <div class="row">
    <div class="col-10">
      <label for="subject">content</label>
    </div>
    <div class="col-45">
      <textarea id="subject" name="content" placeholder="Write something.." style="height:200px"></textarea>
      <span><?php if(isset($errors['content']))echo $errors['content']; ?></span><br>
    </div>
  </div>
  <br>

  <div class="row">
    <div class="col-10">
      <label for="exampleInputEmail1">Upload Image</label>
    </div>

    <div class="col-75">
      <input type="file" name="image" class="form-control" id="exampleInputname" aria-describedby=""><br>
      <span><?php if(isset($errors['image']))echo $errors['image']; ?></span><br>
    
    </div>
  </div>
  

  <div class="row">
    <input type="submit" name="submit" value="Submit">
  </div>

  </form>

</div>

</body>
</html>
