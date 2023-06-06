<?php 
include "header.php";
$limit = 5;
if(isset($_GET['page'])){
$page = $_GET['page'];
}else{
  $page = 1;
}


$offset = ($page - 1) * $limit;

if (isset($_GET['search'])) {
  $search = $_GET['search'];
  $query = "SELECT * FROM `categories` WHERE `categoryName` LIKE '%$search%' LIMIT $limit OFFSET $offset";
} else {
  $query = "SELECT * FROM `categories` LIMIT $limit OFFSET $offset";
}


$res = mysqli_query($conn,$query);
?>

    <!-- main -->
    <main class="main-content-wrapper">
      <div class="container">
        <!-- row -->
        <div class="row mb-8">
          <div class="col-md-12">
            <div class="d-md-flex justify-content-between align-items-center">
              <!-- pageheader -->
              <div>
                <h2>Categories </h2>
                 <!-- breacrumb -->
                 <nav aria-label="breadcrumb">
                  <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="#" class="text-inherit">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Categories</li>
                  </ol>
                </nav>
              </div>
              <!-- button -->
              <div>
                <a href="add-category.php" class="btn btn-primary">Add New Category</a>
              </div>
            </div>
          </div>
        </div>
        <div class="row ">
          <div class="col-xl-12 col-12 mb-5">
            <!-- card -->
            <div class="card h-100 card-lg">
              <div class=" px-6 py-6 ">
                <div class="row justify-content-between">
                  <div class="col-lg-4 col-md-6 col-12 mb-2 mb-md-0">
                    <!-- form -->
                    <form class="d-flex" role="search" method="get" action="categories.php">
                     <input class="form-control" type="search" name="search" placeholder="Search Category" aria-label="Search">
                     <button class="btn btn-primary" type="submit">Search</button>
                    </form>

                  </div>
                  <!-- select option -->
                  <div class="col-xl-2 col-md-4 col-12">
                    <select class="form-select">
                      <option selected>Status</option>
                       <option value="Published">Published</a></option>
                      <option value="Unpublished">Unpublished</option>
                    </select>
                  </div>
                </div>
              </div>
              <!-- card body -->
              <div class="card-body p-0">
                <!-- table -->
                <div class="table-responsive ">
                  <?php 
                  if(mysqli_num_rows($res)>0){
                  ?>
                  <table class="table table-centered table-hover mb-0 text-nowrap table-borderless table-with-checkbox">
                    <thead class="bg-light">
                      <tr>
                        <th>
                          <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="checkAll">
                            <label class="form-check-label" for="checkAll">

                            </label>
                          </div>
                        </th>
                        <th>Icon</th>
                        <th> Name</th>
                        <th>Proudct</th>
                        <th>Status</th>

                        <th></th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php 
                      
                         while($row = mysqli_fetch_assoc($res)){
                           ?>
                      <tr>

                        <td>
                          <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="categoryOne">
                            <label class="form-check-label" for="categoryOne">

                            </label>
                          </div>
                        </td>
                        <td>
                          <a href="#!"> <img src="../assets/images/icons/<?php echo $row['icon'] ?>" alt=""
                              class="icon-shape icon-sm"></a>
                        </td>
                        <td><a href="#" class="text-reset"><?php echo $row['categoryName'] ?></a></td>
                        <?php 
                        $productCount = "SELECT `catID`,COUNT(`proID`) FROM `products` LEFT JOIN `categories` on 
                        `products`.`proID` = `categories`.`categoryID` WHERE `catID` = ".$row['categoryID']." GROUP BY `catID`;";
                        $countRes = mysqli_query($conn,$productCount);
                        $data = mysqli_fetch_assoc($countRes);
                        if(isset($data['COUNT(`proID`)'])){
                          echo "<td>" . $data['COUNT(`proID`)'] . "</td>";
                        }else{
                          echo "<td> 0 </td>";
                        }
                        ?>

                        <td>
                          <?php 
                          if($row['categoryStatus'] == 1){
                            echo '<span class="badge bg-light-primary text-dark-primary">Published</span>';
                          }else{
                            echo '<span class="badge bg-light-danger text-dark-danger">Unpublished</span>';
                          }
                          
                          ?>
                        </td>

                        <td>
                          <div class="dropdown">
                            <a href="#" class="text-reset" data-bs-toggle="dropdown" aria-expanded="false">
                              <i class="feather-icon icon-more-vertical fs-5"></i>
                            </a>
                            <ul class="dropdown-menu">
                              <li><a class="dropdown-item" href="delete-category.php?delid=<?php echo $row['categoryID'] ?>"><i class="bi bi-trash me-3"></i>Delete</a></li>
                              <li><a class="dropdown-item" href="update-category.php?updateid=<?php echo $row['categoryID'] ?>"><i class="bi bi-pencil-square me-3 "></i>Edit</a>
                              </li>
                            </ul>
                          </div>
                        </td>
                      </tr>
                     <?php 
                        }
                      
                     ?>
                    </tbody>
                  </table>
                  <?php 
                  }else{
                    echo "<h5 class='ms-5 ps-4'>No Result Found</h5>";
                   }
                  ?>

                </div>
              </div>
              <?php 
                   if (!isset($_GET['search'])) {
                    $query2 = "SELECT COUNT(*) as total FROM `categories`";
                } else {
                    $search = $_GET['search'];
                    $query2 = "SELECT COUNT(*) as total FROM `categories` WHERE `categoryName` LIKE '%$search%'";
                }
                
                $res2 = mysqli_query($conn, $query2);
                $data = mysqli_fetch_assoc($res2);
                $totalRecords = $data['total'];
                if($data['total'] > 0){
                ?>
              <div class="border-top d-md-flex justify-content-between align-items-center  px-6 py-6">
                
              <span>
                <?php echo "Showing " .$offset+'1'." to " .min($offset + $limit, $data['total']) . " of " .$data['total'] ." entries";?> 
              </span>
                <nav class="mt-2 mt-md-0">
                  <ul class="pagination mb-0 ">
                
                  
                    <?php 
                    if($page > 1){
                      echo '<li class="page-item"><a class="page-link " href="categories.php?page='.($page - 1).'">Previous</a></li>';
                    }
                     $query2 = "SELECT COUNT(*) as total FROM `categories`";
                     $res2 = mysqli_query($conn, $query2);
                     
                     if (mysqli_num_rows($res2) > 0) {
                       $data = mysqli_fetch_assoc($res2);
                       $totalRecords = $data['total'];
                       $totalPages = ceil($totalRecords / $limit);
                     
                       for ($i = 1; $i <= $totalPages; $i++) {
                         $activeClass = ($i == $page) ? 'active' : '';
                         echo '<li class="page-item '.$activeClass.'"><a class="page-link" href="categories.php?page='.$i.'">'.$i.'</a></li>';
                       }
                     }
                     if($totalPages>$page){
                      echo '<li class="page-item"><a class="page-link" href="categories.php?page='.($page+1).'">Next</a></li>';
                    }
                  
                    ?>
                   
                  </ul>
                </nav>
              </div>
              <?php }?>
            </div>
          </div>
        </div>
      </div>
    </main>
  </div>


  <!-- Libs JS -->
<script src="../assets/libs/jquery/dist/jquery.min.js"></script>
<script src="../assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
<script src="../assets/libs/simplebar/dist/simplebar.min.js"></script>

<!-- Theme JS -->
<script src="../assets/js/theme.min.js"></script>

</body>


<!-- Mirrored from freshcart.codescandy.com/dashboard/categories.php by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 31 Mar 2023 10:11:11 GMT -->
</html>