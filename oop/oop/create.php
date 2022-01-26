<?php
require './classes/blogclass.php';


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
//code...
$title = $_POST['title'];
$content = $_POST['content'];
$imgName = $_FILES['image']['name'];
$blog=new blogs;
$blog->createblog($title,$content,$imgName);
if (isset($_SESSION['Message'])) {
    foreach ($_SESSION['Message'] as $key => $value) {
        # code...
        echo $value . '<br>';
    }
    unset($_SESSION['Message']);
}
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


        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post" enctype="multipart/form-data">

        


            <div class="form-group">
                <label for="exampleInputEmail">Title</label>
                <input type="text" class="form-control" id="exampleInputEmail1" name="title"
                    aria-describedby="emailHelp" placeholder="Enter email">
            </div>

            <div class="form-group">
                <label for="exampleInputPassword">Content</label>
                <input type="text" class="form-control" id="exampleInputPassword1" name="content"
                    placeholder="Password">
            </div>





            <div class="form-group">
                <label for="exampleInputName">blog image</label>
                <input type="file" class="form-control" id="exampleInputName" name="image" aria-describedby=""
                    placeholder="Enter Address">
            </div>


            <button type="submit" class="btn btn-primary">Submit</button>
        </form>

    </div>

</body>

</html>