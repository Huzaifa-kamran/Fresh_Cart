<?php 

include "config.php";
session_start();
if(!isset($_SESSION['admin'])){


    echo "<script> window.location.href = 'adminlogin.php' </script>";

}
if(isset($_GET['delid'])){
$id = $_GET['delid'];


$query = "DELETE FROM `categories` WHERE `categories`.`categoryID` = $id";
if(mysqli_query($conn , $query)){
    echo "<script> alert('Category deleted') </script>";
    echo "<script> window.location.href = 'categories.php' </script>";
    }

}



?>