<?php

require './classes/blogclass.php';

$id = $_GET['id'];
$db=new db();
$sql = "select * from blogs where id = $id";
$op = $db->doQuery($sql);

if (mysqli_num_rows($op) == 1) {
    // code .....
    $BlogData = mysqli_fetch_assoc($op);
}
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
//code...
$title = $_POST['title'];
$content = $_POST['content'];
$imgName = $_FILES['image']['name'];
$blog=new blogs;
$blog->editblog($title,$content,$imgName);
}

?>



<!DOCTYPE html>
<html lang="en">

<head>
    <title>Blog</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>

<body>

    <div class="container">
        <h2>Blog</h2>


        <form action="edit.php?id=<?php echo $BlogData['id']; ?>" method="post" enctype="multipart/form-data">

        


            <div class="form-group">
                <label for="exampleInputEmail">Title</label>
                <input type="text" class="form-control" id="exampleInputEmail1" name="title"
                    aria-describedby="emailHelp" value="<?php echo $BlogData['title'];  ?>">
            </div>

            <div class="form-group">
                <label for="exampleInputPassword">Content</label>
                <input type="text" class="form-control" id="exampleInputPassword1" name="content"
               value=" <?php echo $BlogData['content']; ?>">
            </div>





            <div class="form-group">
                <label for="exampleInputName">blog image</label>
                <input type="file" class="form-control" id="exampleInputName" name="image" aria-describedby="">
                <img src="./uploads/<?php echo $BlogData['image']; ?>" alt="" height="50px" width="50px"> <br>
            </div>


            <button type="submit" class="btn btn-primary">Edit</button>
        </form>

    </div>

</body>

</html>