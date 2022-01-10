<?php 
session_start();


/* var_dump($_POST); */

/*
//to delete the session in the specific time

// 2 hours in seconds
$inactive = 7200; 
//decalr varaible with the time
$session_life = time() - $_session['testing'];

if($session_life > $inactive)
{  
 session_destroy(); 
}

$_session['testing']=time();
echo $_SESSION['testing']; //prints NOTHING?
  */  

if (isset($_POST['Delete'])) {
  session_destroy();
}

?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8" />
    <title>Student card</title>
    <link rel="stylesheet" href="style.css" />
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
  </head>
  <body>

    <h1>Student Informatio</h1>
    <div class="container">
      <div class="wrapper">
        <a href="#">
          <img
          src="images/<?php echo $_SESSION['finalName'] ?>"
          
            alt=""
          />
        </a>
        <div class="title"><?php echo $_SESSION['name']; ?></div>
        <div class="place"><?php echo $_SESSION['email']; ?></div>
        <div class="content">
          <p>
            <?php echo $_SESSION['address']; ?>
          </p>
          <div class="inputs">
          <form method="post">
            <div class="inpt">
            <input type="submit" name="delete"
                value="Delete"/>
            </div>
          </form>
          </div>
        </div>
        <div class="icons">
          <li>
            <a href="#"><span class="fab fa-whatsapp"></span></a>
          </li>
          <li>
            <a href="#"><span class="fab fa-twitter"></span></a>
          </li>
          <li>
            <a href="#"><span class="fab fa-instagram"></span></a>
          </li>
          <li>
            <a href="#"><span class="fab fa-github"></span></a>
          </li>
        </div>
      </div>
    </div>

    <script>
      const img = document.querySelector("img");
      console.log(img);

      img.addEventListener("click", () => {
        console.log("Hello");
        img.classList.toggle("active");
      });
    </script>
  </body>
</html>
