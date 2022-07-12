
<?php
include ('dbconnect.php');
// <!-- ==================================================================================
// ================================SignUp Functions=======================================
// ================================================================================== -->

if(isset($_POST['signupbtn'])){
    $name = $_POST['name'];
    $email = $_POST['email'];
    $mobile = $_POST['mobile'];
    $password = $_POST['password'];
    $cpassword = $_POST['cpassword'];

   $sql = "select * from crud where email = '$email'";
   $result = mysqli_query($conn , $sql);
   $dupData = mysqli_num_rows($result);
   if($dupData > 0){
    echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
    <strong>Error!</strong> Email Already Registered....
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>';
   }
   else{
    if ($password == $cpassword){
        // $hash = password_hash($password, PASSWORD_DEFAULT);
         $sql2 = "INSERT INTO `crud`(`name`, `email`, `mobile`, `password`, `date`) VALUES ('$name' , '$email' ,'$mobile' , '$password' , current_timestamp())";
        $result2 = mysqli_query($conn , $sql2);

        if($result2){
            echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
    <strong>Success!</strong> Account Has Been  Registered Successfully....
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>';
        }
else{
    echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
    <strong>Error!</strong> in creating account, Please Try again...
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>';
}
    }
    else{
        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
    <strong>Error!</strong> Passwords donot match....
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>';
    }
   }
}


?>

    <!-- ==================================================================================
// ================================Login Functions=======================================
// ================================================================================== -->

<?php
include ('dbconnect.php');

if(isset($_POST['loginbtn'])){
    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "SELECT * from crud where email = '$email'";
    $result = mysqli_query($conn, $sql);
    $num = mysqli_num_rows($result);
    if ($num == 1) {
        while ($row = mysqli_fetch_assoc($result)) {
            // if(password_verify($password, $row['password'])) {
                if($password == $row['password']){
                session_start();
                $_SESSION['loggedin'] = true;
                $_SESSION['srno'] = $row['srno'];
                $_SESSION['name'] = $row['name'];
                $_SESSION['email'] = $row['email'];
                $_SESSION['mobile'] = $row['mobile'];
                $_SESSION['password'] = $row['password'];
                $_SESSION['date'] = $row['date'];
             
                echo "<script>window.open('afterindex.php','_self')</script>";

            } else {
                echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
    <strong>Error!</strong> No Such account FOund....
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>';
            }
        }
    } else {
        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Error!</strong> No Such account FOund....
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>';
    }
}
?>