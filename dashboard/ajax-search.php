<?php 
include "config.php";
session_start();
if(!isset($_SESSION['admin'])){
    echo "<script> window.location.href = 'adminlogin.php' </script>";

}

$searchPro = $_POST['searchPro'];


$products = "SELECT * FROM `products` INNER JOIN `categories` ON `products`.`catID` = `categories`.`categoryID`
WHERE `proName` LIKE '%$searchPro%' OR `categoryName` LIKE '%$searchPro%'";

$res = mysqli_query($conn, $products);

$output= "";


 if(mysqli_num_rows($res)>0){

    $output .=  '<table class="table table-centered table-hover text-nowrap table-borderless mb-0 table-with-checkbox">
      <thead class="bg-light">
        <tr>
          <th>
            <div class="form-check">
              <input class="form-check-input" type="checkbox" value="" id="checkAll">
              <label class="form-check-label" for="checkAll">

              </label>
            </div>
          </th>
          <th>Image</th>
          <th>Proudct Name</th>
          <th>Category</th>
          <th>Status</th>
          <th>Price</th>
          <th>Create at</th>
          <th></th>
        </tr>
      </thead>
      <tbody id="tableBody">';
    
  while($row = mysqli_fetch_assoc($res)){
    $output .= '<tr>
    <td>
      <div class="form-check">
        <input class="form-check-input" type="checkbox" value="" id="productOne">
        <label class="form-check-label" for="productOne">

        </label>
      </div>
    </td>
    <td>
      <a href="#!"> <img src="../assets/images/products/'.$row["proImg"].'" alt=""
          class="icon-shape icon-md"></a>
    </td>
    <td><a href="#" class="text-reset">'.$row["proName"].'</a></td>
    <td>'.$row["categoryName"].'</td>

    <td>';
       if($row['inStock']  == 1){
        if($row['proStatus'] == 1){
          $output .= '<span class="badge bg-light-primary text-dark-primary">Active</span>';
        }else{
          $output .= '<span class="badge bg-light-danger text-dark-danger">Deactive</span>';
        }
        }else{

          $output .= '<span class="badge bg-light-warning text-dark-warning">Out of Stock</span>';
        }


  $output .=  '</td>
    <td>$'.$row["proPrice"].'</td>
    <td>'.$row["createdAt"].'</td>
    <td>
      <div class="dropdown">
        <a href="#" class="text-reset" data-bs-toggle="dropdown" aria-expanded="false">
          <i class="feather-icon icon-more-vertical fs-5"></i>
        </a>
        <ul class="dropdown-menu">
          <li><a class="dropdown-item" href="delete-product.php?delID='.$row["proID"].'"><i class="bi bi-trash me-3"></i>Delete</a></li>
          <li><a class="dropdown-item" href="update-product.php?uptID='.$row["proID"].'"><i class="bi bi-pencil-square me-3 "></i>Edit</a>
          </li>
        </ul>
      </div>
    </td>
  </tr>';
     }
     $output .= '</tbody>
                 </table>';
                 echo $output;
 }else{
    $output .= "<h5 class='ms-5 ps-4'>No Result Found</h5>";
    echo $output;
 }
?>