<?php 
include "config.php";
session_start();

if(isset($_SESSION['admin'])){
    echo "<script> window.location.href = 'index.php' </script>";
}


if(isset($_POST['login'])){
$email = $_POST['email'];
$password = $_POST['password'];

$query = "SELECT * FROM `admin` WHERE `email` = '$email' AND `password` = '$password' ";
$res = mysqli_query($conn,$query);

if(mysqli_num_rows($res) == 1 ){
$admin = mysqli_fetch_assoc($res);
$adminEmail = $admin['email'];
$adminName = $admin['name'];

// Values Stored in Session Storage.
$_SESSION['admin'] = $adminName;
$_SESSION['email'] = $adminEmail;

echo "<script> alert('login successfull') </script>";
echo "<script> window.location.href = 'index.php' </script>";

}else{
    echo "<script> alert('Your Email or Password is incorrect!') </script>";
    echo "<script> window.location.href = 'adminlogin.php' </script>";
}



}



?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
     integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <title>Document</title>
</head>
<body>
<section class=" bg-success bg-gradient">
  <div class="container py-5 h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-12 col-md-8 col-lg-6 col-xl-5">
        <div class="card bg-dark text-white" style="border-radius: 1rem;">
          <div class="card-body p-5 text-center">

            <div class="mb-md-5 mt-md-4 pb-5">

            <form method="post" action="adminlogin.php">
              <h2 class="fw-bold mb-2 text-uppercase">Admin Login</h2>
              <p class="text-white-50 mb-5">Please enter your login and password!</p>

              <div class="form-outline form-white mb-4">
                <input type="email" name="email" value="<?php echo @$_POST['email'] ?>" id="typeEmailX" class="form-control form-control-lg" />
                <label class="form-label" for="typeEmailX">Email</label>
              </div>

              <div class="form-outline form-white mb-4">
                <input type="password" name="password" id="typePasswordX" class="form-control form-control-lg" />
                <label class="form-label" for="typePasswordX">Password</label>
              </div>

              <p class="small mb-5 pb-lg-2"><a class="text-white-50" href="#!">Forgot password?</a></p>

              <button class="btn btn-outline-success text-light btn-lg px-5" name="login" type="submit">Login</button>
              </form>
            </div>

            <div>
              </p>
            </div>

          </div>
        </div>
      </div>
    </div>
  </div>
</section>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" 
integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
</body>
</html>