<?php

require 'dbConnection.php';

$id = $_GET['id'];

# Check if Id ex ...
$sql = "select * from form where id = $id ";
$data = mysqli_query($con, $sql);

if (mysqli_num_rows($data) == 1) {
    # fetch data
    $Userdata = mysqli_fetch_assoc($data);
} else {
    $Message = 'Invalid Id ';
    $_SESSION['Message'] = $Message;
    header('Location: edit.php');
}

 function Clean($input){

    return  trim(strip_tags(stripslashes($input)));
  }

if($_SERVER['REQUEST_METHOD'] == "POST"){

$name     = Clean($_POST['name']);
$email    = Clean($_POST['email']);


 $errors = [];



 if(count($errors) > 0){
     foreach ($errors as $key => $value) {
         # code...
         echo '* '.$key.' : '.$value.'<br>';
     }
 }else{

    $sql = "update form set name='$name' , email = '$email' where id  = $id"; 

    $op  = mysqli_query($con,$sql);

    if($op){
        $Message = "Raw Updated";
    }else{
        $Message = "Error Try Again ".mysqli_error($con) ;
    }

    $_SESSION['Message'] = $Message;
    header("Location: index.php");

}

}

?>



<!DOCTYPE html>
<html lang="en">

<head>
    <title>Update Account</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>

<body>

    <div class="container">
        <h2>Update</h2>


        <form action="edit.php?id=<?php echo $Userdata['id']; ?>" method="post">

            
            <div class="form-group">
                <label for="exampleInputName">Name</label>
                <input type="text" class="form-control" id="exampleInputName" name="name" value="<?php echo $Userdata['name']; ?>"
                    aria-describedby="" placeholder="Enter Name">
            </div>


            <div class="form-group">
                <label for="exampleInputEmail">Email address</label>
                <input type="email" class="form-control" id="exampleInputEmail1" name="email"
                    value="<?php echo $Userdata['email']; ?>" aria-describedby="emailHelp" placeholder="Enter email">
            </div>


            <div class="form-group">
                <label for="exampleInputEmail"> address</label>
                <input type="text" class="form-control" id="exampleInputEmail1" name="address"
                    value="<?php echo $Userdata['address']; ?>" aria-describedby="emailHelp" placeholder="Enter adress">
            </div>



            <button type="submit" class="btn btn-primary">Edit</button>
        </form>



</body>

</html>