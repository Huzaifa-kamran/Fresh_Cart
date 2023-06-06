<?php 
include "dashboard/config.php";

if(isset($_POST['userlogin'])){
    $userEmail = $_POST['email'];
    $userPassword = $_POST['password'];

    $query = "SELECT * FROM `userInfo` WHERE `userEmail` = '$userEmail' AND `userPassword` = '$userPassword' ";
    $res = mysqli_query($conn,$query);
 
    if(mysqli_num_rows($res) == 1 ){
        echo "<script> alert('Login Successfull !') </script>";
        echo "<script> window.location.href = 'index.php' </script>";
        
}else{
    echo "<script> alert('Please Insert Correct Email or Password') </script>";

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
<body class=" bg-success">
<section >
  <div class="container py-5 h-100">
    <div class="row justify-content-center align-items-center h-100 mt-lg-5">
      <div class="col-12 col-lg-9 col-xl-7">
        <div class="card shadow-2-strong card-registration" style="border-radius: 15px;">
          <div class="card-body p-4 p-md-5">
            <img src="assets/images/logo/freshcart-logo.svg" class="mb-2" style="margin: auto;margin-left: 33%;" alt="">
            <h3 class="mb-4 pb-2 pb-md-0 mb-md-5 text-center">Log In</h3>


            <form action="userlogin.php" method="post">

              <div class="row">
                <div class="col-12">
                <div class="form-outline">
                    <label class="form-label" for="email">Email</label>
                    <input type="email" id="email" name="email" class="form-control form-control-lg" required/>
                  </div>
                </div>
              </div>

              
              <div class="row mt-3">
                <div class="col-12">
                <div class="form-outline">
                    <label class="form-label" for="password">Password</label>
                    <input type="password" id="password" name="password" class="form-control form-control-lg" required/>
                  </div>
                </div>
              </div>

              <div class="mt-5 d-lg-flex justify-content-center">
                <button class="btn btn-success " style="width: 35%;" type="submit" name="userlogin">Log In</button>
              </div>
              
              <div class="mt-2 pt-2 d-lg-flex justify-content-center">
                <p>Not Registered? <a href="userlogin.php" class="fw-bold">Create An Account</a> </p>
              </div>
              
            </form>
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