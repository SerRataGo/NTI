<?php 
if ($_SERVER["REQUEST_METHOD"] == "POST") {


  $name =cleanData($_POST['name']);
  $email =cleanData($_POST['email']);
  $tittle =cleanData($_POST['tittle']);
  $content =cleanData($_POST['content']);
  $uploadImage= $_FILES['image'];

  
  //var_dump($uploadImage);

  //inilize the error array
  $errors=[];

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
             /* echo 'Image Uploaded'; */
             $errors['image']='Image Uploaded';
         }else{
             /* echo 'Error Try Again'; */
             $errors['image']='Error Try Again';
         }
  
        }else{
            /* echo 'Extension Not Allowed'; */
            $errors['image']='Extension Not Allowed';
        }
  
  
    }else{
        /* echo 'Image Field Required'; */
        $errors['image']='Image Field Required';
  }
  $myfile = fopen("text.txt", "w") or die("Unable to open file!");

  $userdata="the user name is ". $name ." and his email is ".$email."his blog tittle is ".$tittle." with the content is " .$content ;

  fwrite($myfile,$userdata);

  $userImageDetails="the image details is ".$uploadImage; 

  fwrite($myfile,$userImageDetails);

  fclose($myfile);
}




function cleanData($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
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

<h2>Responsive Form</h2>
<p>Resize the browser window to see the effect. When the screen is less than 600px wide,
   make the two columns stack on top of each other instead of next to each other.</p>

<div class="container">
  <form action="" method="POST" enctype="multipart/form-data">

  <div class="row">
    <div class="col-25">
      <label for="fname">name</label>
    </div>
    <div class="col-75">
      <input type="text" id="fname" name="name" placeholder="Your name..">
      <span><?php echo $errors['name']; ?></span><br>
    </div>
  </div>


  <div class="row">
    <div class="col-25">
      <label for="lname">tittle</label>
    </div>
    <div class="col-75">
      <input type="text" id="lname" name="tittle" placeholder="Your tittle here..">
      <span><?php echo $errors['tittle']; ?></span><br>
    </div>
  </div>

  <div class="row">
    <div class="col-25">
      <label for="email">email</label>
    </div>
    <div class="col-75">
      <input type="text" id="email" name="email" placeholder="Your tittle here..">
      <span><?php echo $errors['email']; ?></span><br>
    </div>
  </div>

  <div class="row">
    <div class="col-25">
      <label for="subject">content</label>
    </div>
    <div class="col-75">
      <textarea id="subject" name="content" placeholder="Write something.." style="height:200px"></textarea>
      <span><?php echo $errors['content']; ?></span><br>
    </div>
  </div>
  <br>

  <div class="row">
    <div class="col-25">
      <label for="exampleInputEmail1">Upload Image</label>
    </div>

    <div class="col-75">
      <input type="file" name="image" class="form-control" id="exampleInputname" aria-describedby=""><br>
      <span><?php echo $errors['image']; ?></span><br>
      <span>  </span><br>
    </div>
  </div>
  <br>

  <div class="row">
    <input type="submit" name="submit" value="Submit">
  </div>

  </form>

</div>

</body>
</html>
