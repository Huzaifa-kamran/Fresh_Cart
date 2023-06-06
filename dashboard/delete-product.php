<?php 

include "config.php";
session_start();
if(!isset($_SESSION['admin'])){


    echo "<script> window.location.href = 'adminlogin.php' </script>";

}
if(isset($_GET['delID'])){
$id = $_GET['delID'];


$query = "DELETE FROM `products` WHERE `products`.`proID` = $id";
if(mysqli_query($conn , $query)){
    echo "<script> alert('Product deleted') </script>";
    echo "<script> window.location.href = 'products.php' </script>";
    }

}



?>