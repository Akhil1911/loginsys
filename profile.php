<?php
session_start();
if(!isset($_SESSION['loggedin'])){
  header("Location:index.php");
}
?>

<?php
include ('partials/dbconnect.php');
?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">

    <title>Login System</title>
  </head>
  <body>


  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo03"
    aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <a class="navbar-brand" href="afterindex.php">RegiSys</a>

  <div class="collapse navbar-collapse" id="navbarTogglerDemo03">
    <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
      <li class="nav-item active">
        <a class="nav-link" href="afterindex.php">Home <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="profile.php">Update Profile</a>
      </li>

    </ul>
    <ul class="navbar-nav ms-auto mb-2 mb-lg-0">

      <li class="nav-item">
        <a class="nav-link nav-link-ltr" aria-current="page" href="logout.php">Logout</a>
      </li>
      <li class="nav-item">
        <a class="nav-link nav-link-ltr" aria-current="page" href="#">Welcome
          <?php
              $semail = $_SESSION['email'];
              $sql = "select * from crud where email = '$semail'";
    $result = mysqli_query($conn, $sql);
    while ($row = mysqli_fetch_assoc($result)) {
          $name = $row['name'];
    }
    echo $name;
          ?>
        </a>
      </li>

    </ul>
  </div>
</nav>


<!-- =============================================================================================== -->
<?php
$semail = $_SESSION['email'];
$sql = "select * from crud where email = '$semail'";
$result = mysqli_query($conn,$sql);
while ($row = mysqli_fetch_assoc($result)) {
  echo '
  <div class="container mt-4">
  <form action="profile.php" method="post">
      <div class="form-group">
      <label for="name">Enter Name</label>
      <input type="text" class="form-control" value = "'. $row['name'] .'" id="name" name="name"> 
      </div>
      <div class="form-group">
      <label for="email">Enter Email</label>
      <input type="email" class="form-control" value = "'. $row['email'] .'" id="email" name="email">
      </div>
      <div class="form-group">
        <label for="name">Enter Mobile</label>
        <input type="number" class="form-control" value = "'. $row['mobile'] .'" id="mobile" name="mobile">
        </div>
        <div class="form-group">
        <label for="password">Enter Password</label>
        <input type="text" class="form-control" value = "'. $row['password'] .'" id="password" name="password">
        </div>
        
        <button type="submit" name="updatedata" class="btn btn-primary">Update Data</button>
        <button type="submit" name="deletedata" class="btn btn-primary">Delete Account</button>
        
        </form>
        </div>
        
        ';
      }
      ?>

<div class="container">
</div>


<!-- ==================================================Update============================================= -->
<?php

if(isset($_POST['updatedata'])){
$username = $_POST['name'];
$uemail = $_POST['email'];
$umobile = $_POST['mobile'];
$upassword = $_POST['password'];

$sql = "UPDATE crud set name = '$username' , email = '$uemail' , mobile = '$umobile' , password = '$upassword' where email = '$uemail'";
$result = mysqli_query($conn , $sql);
if($result){
echo "<script>  window.open('profile.php' , '_self');  </script>";
}
else{
  echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
<strong>Error!</strong> Error in updating data, Please try again....
<button type="button" class="close" data-dismiss="alert" aria-label="Close">
<span aria-hidden="true">&times;</span>
</button>
</div>';
}
}

?>

<!-- ==================================================Delete============================================= -->
<?php

if(isset($_POST['deletedata'])){
   
  $uemail = $_POST['email'];
    $sql = "delete from crud where email = '$uemail'";
    $result = mysqli_query($conn , $sql);
    if($result){
       echo "<script> window.open('logout.php', '_self');  </script>";
    }
    else{
      echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
      <strong>Error!</strong> Error in deleteting account, Please try again....
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
      </button>
      </div>';
    }
}

?>



<!-- ======================Script================================ -->
<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous"></script>

  </body>
</html>