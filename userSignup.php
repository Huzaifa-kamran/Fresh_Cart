<?php 
include "dashboard/config.php";
if(isset($_POST['register'])){
  $userName = $_POST['name'];
  $userContact = $_POST['phoneNum'];
  $userEmail = $_POST['email'];
  $userPassword = $_POST['password'];
  $userAddress = $_POST['address'];
  $userCity = $_POST['city'];
  $userGender = $_POST['gender'];

  if ($userName == "" || $userContact == "" || $userEmail == "" || $userPassword == "" || $userAddress == "" || $userCity == "" || $userGender == "") {
    echo "<script> alert('please fill all the form fields') </script>";
    echo "<script> window.location.href = 'userSignup.php' </script>";
  }else{

  $query = "INSERT INTO `userinfo` ( `userName`, `userContact`, `userEmail`, `userPassword`, 
  `userAddress`, `userCity`, `userGender`) VALUES ( '$userName', '$userContact', '$userEmail', '$userPassword',
   '$userAddress', '$userCity', '$userGender')";

   $res = mysqli_query($conn,$query);
   if($res){
      echo "<script> alert('Sign Up successfull') </script>";
      echo "<script> window.location.href = 'index.php' </script>";
   }else{
    echo "<script> alert('error') </script>";
    echo "<script> window.location.href = 'userSignup.php' </script>";
   }
  }
  // print_r($_POST);
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
<section class=" bg-success">
  <div class="container py-5 h-100">
    <div class="row justify-content-center align-items-center h-100">
      <div class="col-12 col-lg-9 col-xl-7">
        <div class="card shadow-2-strong card-registration" style="border-radius: 15px;">
          <div class="card-body p-4 p-md-5">
            <img src="assets/images/logo/freshcart-logo.svg" class="mb-2" style="margin: auto;margin-left: 33%;" alt="">
            <h3 class="mb-4 pb-2 pb-md-0 mb-md-5 text-center">Sign Up</h3>
            <form action="userSignup.php" method="post">

              <div class="row">
                <div class="col-md-6 mb-4">

                  <div class="form-outline">
                    <input type="text" id="Name" name="name" class="form-control form-control-lg" required/>
                    <label class="form-label" for="Name">Name</label>
                  </div>

                </div>
                <div class="col-md-6 mb-4">

                  <div class="form-outline">
                    <input type="tel" id="number" name="phoneNum" class="form-control form-control-lg" required/>
                    <label class="form-label" for="number">Phone Number</label>
                  </div>

                </div>
              </div>
              <div class="row">
                <div class="col-md-6 mb-4 pb-2">

                  <div class="form-outline">
                    <input type="email" id="emailAddress" name="email" class="form-control form-control-lg" required/>
                    <label class="form-label" for="emailAddress">Email</label>
                  </div>

                </div>
                <div class="col-md-6 mb-4 pb-2">

                  <div class="form-outline">
                    <input type="password" id="password" name="password" class="form-control form-control-lg" required/>
                    <label class="form-label" for="password">Password</label>
                  </div>

                </div>
              </div>

              <div class="row">
                <div class="col-12">

                <div class="form-outline">
                    <input type="text" id="address" name="address" class="form-control form-control-lg" required/>
                    <label class="form-label" for="address">Address</label>
                  </div>
                </div>
              </div>
              <div class="row mt-3">
                <div class="col-md-6 mb-4 ">
                  
                <h6 class="mb-2 pb-1">City: </h6>
                <select class="select form-control-lg" name="city" required>
                    <option >Select City</option>
                    <option value="khi">Karachi</option>
                    <option value="lhr">Lahore</option>
                    <option value="isb">Islamabad</option>
                  </select>


                </div>
                <div class="col-md-6 mb-4">

                  <h6 class="mb-2 pb-1">Gender: </h6>
                  
                  <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="gender" id="maleGender"
                      value="male" required/>
                    <label class="form-check-label" for="maleGender">Male</label>
                  </div>

                  <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="gender" id="femaleGender"
                      value="female" />
                    <label class="form-check-label" for="femaleGender">Female</label>
                  </div>


                  <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="gender" id="otherGender"
                      value="other" />
                    <label class="form-check-label" for="otherGender">Other</label>
                  </div>

                </div>
              </div>

              <div class="mt-1 d-lg-flex justify-content-center">
                <button class="btn btn-success " style="width: 35%;" type="submit" name="register">Register</button>
              </div>
              
              <div class="mt-2 pt-2 d-lg-flex justify-content-center">
                <p>Already Have An Account? <a href="userlogin.php" class="fw-bold">Sign In</a> </p>
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