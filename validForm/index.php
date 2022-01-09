<?php 

/* Create a form with the following inputs (name, email, password, address, gender, linkedin url) 
Validate inputs then return message to user . 
* validation rules ... 
name  = [required , string]
email = [required,email]
password = [required,min = 6]
address = [required,length = 10 chars]
gender = [required]
linkedin url = [reuired | url]
Profile image
*/

?>




<?php 


if ($_SERVER["REQUEST_METHOD"] == "POST") {


  $name =cleanData($_POST['name']);
  $email =cleanData($_POST['email']);
  $address =cleanData($_POST['address']);
  $gender =cleanData($_POST['gender']);
  $password =cleanData($_POST['password']);
  $linkedin =cleanData($_POST['linkedin']);
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
  }elseif(!filter_var($name,FILTER_VALIDATE_EMAIL)){
    $errors['email']='must be email';
  }
  //validation password
  if (empty($password)) {
    $errors['password']='password is requried';
  }elseif (strlen($name)<5) {
    $errors['password']='password must greater than 5';
  }
  //validation address
  if (empty($address)) {
    $errors['address']='address is requried';
  }elseif (strlen($address)< 10 ) {
    $errors['address']='address must greater than 5';
  }
  //validation LinkedIn
  if (empty($linkedin)) {
    $errors['linkedin']='linkedin is requried';
  }elseif (!filter_var($linkedin,FILTER_VALIDATE_URL)) {
    $errors['linkedin']='linkedin must BE URL'; 
  }

  if(!empty($_FILES['image'])){
 
    $imgName     = $_FILES['image']['name'];
    $imgTempPath = $_FILES['image']['tmp_name'];
    $imagSize    = $_FILES['image']['size'];
    $imgType     = $_FILES['image']['type'];
  
  
  
     $imgExtensionDetails = explode('.',$imgName);
     $imgExtension        = strtolower(end($imgExtensionDetails));
        
     $allowedExtensions   = ['png','jpg'];
  
        if(in_array($imgExtension ,$allowedExtensions)){
            // upload code ..... 
           
            $finalName = rand().time().'.'.$imgExtension;
              
            $disPath = './images/'.$finalName;
            var_dump($disPath);
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
  <title>Document</title>
</head>
<body>

<br><br><br><br>
<h3>valid form using php</h3>

<div>
  <form id="form" action="" method="POST" 
         enctype="multipart/form-data" >

    <label for="name">name</label>
    <input type="text"  name="name" placeholder="Your name..">
    <span><?php echo $errors['name']; ?></span><br><br>
          

    <label for="email">email</label>
    <input type="email"  name="email" placeholder="Your Email..">
    <span><?php echo $errors['email']; ?></span><br><br>

    <label for="address">address</label>
    <input type="text"  name="address" placeholder="Your address..">
    <span><?php echo $errors['address']; ?></span><br><br>

    <label for="linkedin">Linkedin</label>
    <input type="text"  name="linkedin" placeholder="Your Linkedin url..">
    <span><?php echo $errors['linkedin']; ?></span><br><br>

    <label for="gender">Gender</label>
    <select  name="gender">
      <option value="male" selected>male</option>
      <option value="female" >female</option>
    </select>

    <label for="password">password</label>
    <input type="text" id="pass"  name="password" placeholder="enter your password ..." >
    <span><?php echo $errors['password']; ?></span><br><br>

    <label for="exampleInputEmail1">Upload Image</label>
    <input type="file" name="image" class="form-control" id="exampleInputname" aria-describedby=""><br>
    <span><?php echo $errors['image']; ?></span><br>

    <input type="submit" value="Submit" name="submit">

  </form>
</div>

</body>
</html>
