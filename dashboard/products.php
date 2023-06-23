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
  $products = "SELECT * FROM `products` INNER JOIN `categories` ON `products`.`catID` = `categories`.`categoryID`
   WHERE `proName` LIKE '%$search%' OR `categoryName` LIKE '%$search%' LIMIT $limit OFFSET $offset";
} else {
  $products = "SELECT * FROM `products` INNER JOIN `categories` ON `products`.`catID` = `categories`.`categoryID` LIMIT $limit OFFSET $offset";
}



$res = mysqli_query($conn, $products);


?>

    <!-- main -->
    <main class="main-content-wrapper">
      <div class="container">
        <div class="row mb-8">
          <div class="col-md-12">
            <!-- page header -->
            <div class="d-md-flex justify-content-between align-items-center">
              <div>
                <h2>Products</h2>
                  <!-- breacrumb -->
                  <nav aria-label="breadcrumb">
                  <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="#" class="text-inherit">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Products</li>
                  </ol>
                </nav>
              </div>
              <!-- button -->
              <div>
                <a href="add-product.php" class="btn btn-primary">Add Product</a>
              </div>
            </div>
          </div>
        </div>
        <!-- row -->
        <div class="row ">
          <div class="col-xl-12 col-12 mb-5">
            <!-- card -->
            <div class="card h-100 card-lg">
              <div class="px-6 py-6 ">
                <div class="row justify-content-between">
                  <!-- form -->
                  <div class="col-lg-4 col-md-6 col-12 mb-2 mb-lg-0">
                  <form class="d-flex" role="search" method="get" action="products.php">
                     <input class="form-control" type="search" id="search" name="search" placeholder="Search Category" aria-label="Search">
                    </form>

                  </div>
                  <!-- select option -->
                  <div class="col-lg-2 col-md-4 col-12">
                    <select class="form-select" id="filter">
                      <option value="*" selected>All</option>
                      <option value="1">Active</option>
                      <option value="0">Deactive</option>
                      <option value="2">Out of Stock</option>
                    </select>
                  </div>
                </div>
              </div>
              <!-- card body -->
              <div class="card-body p-0">
                <!-- table -->
                <div class="table-responsive" id="table">
                <?php 
                  if(mysqli_num_rows($res)>0){
                  ?>
                  <table class="table table-centered table-hover text-nowrap table-borderless mb-0 table-with-checkbox">
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
                    <tbody id="tableBody">
                  <?php 
                while($row = mysqli_fetch_assoc($res)){

                  ?>
                      <tr>
                        <td>
                          <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="productOne">
                            <label class="form-check-label" for="productOne">

                            </label>
                          </div>
                        </td>
                        <td>
                          <a href="#!"> <img src="../assets/images/products/<?php echo $row['proImg']?>" alt=""
                              class="icon-shape icon-md"></a>
                        </td>
                        <td><a href="#" class="text-reset"><?php echo $row['proName']?></a></td>
                        <td><?php echo $row['categoryName']?></td>

                        <td>
                          <?php if($row['inStock']  == 1){
                            if($row['proStatus'] == 1){
                              echo '<span class="badge bg-light-primary text-dark-primary">Active</span>';
                            }else{
                              echo '<span class="badge bg-light-danger text-dark-danger">Deactive</span>';
                            }
                            }else{

                            echo '<span class="badge bg-light-warning text-dark-warning">Out of Stock</span>';
                            }?>
                        </td>
                        <td>$<?php echo $row['proPrice']?></td>
                        <td><?php echo $row['createdAt']?></td>
                        <td>
                          <div class="dropdown">
                            <a href="#" class="text-reset" data-bs-toggle="dropdown" aria-expanded="false">
                              <i class="feather-icon icon-more-vertical fs-5"></i>
                            </a>
                            <ul class="dropdown-menu">
                              <li><a class="dropdown-item" href="delete-product.php?delID=<?php echo $row['proID']?>"><i class="bi bi-trash me-3"></i>Delete</a></li>
                              <li><a class="dropdown-item" href="update-product.php?uptID=<?php echo $row['proID']?>"><i class="bi bi-pencil-square me-3 "></i>Edit</a>
                              </li>
                            </ul>
                          </div>
                        </td>
                      </tr>
<?php }?>
                    </tbody>
                  </table>
<?php }else{
  echo "<h5 class='ms-5 ps-4'>No Result Found</h5>";
  }?>
                </div>
              </div>
              <?php 
   if (!isset($_GET['search'])) {
    $query2 = "SELECT COUNT(*) as total FROM `products`";
} else {
    $search = $_GET['search'];
    $query2 = "SELECT COUNT(*) as total FROM `products` INNER JOIN `categories` ON `products`.`catID` = `categories`.`categoryID` WHERE `proName` LIKE '%$search%' OR `categoryName` LIKE '%$search%'";
}

$res2 = mysqli_query($conn, $query2);
$data = mysqli_fetch_assoc($res2);
$totalRecords = $data['total'];
if($data['total']>0){
              ?>
              <div class=" border-top d-md-flex justify-content-between align-items-center px-6 py-6">
                <span><?php echo "Showing " .$offset+'1'." to " .min($offset + $limit, $data['total']) . " of " .$data['total'] ." entries";?> </span>
                <nav class="mt-2 mt-md-0">
                  <ul class="pagination mb-0 ">
                  <?php 
                    if($page > 1){
                      echo '<li class="page-item"><a class="page-link " href="products.php?page='.($page - 1).'">Previous</a></li>';
                    }
                     
                     if (mysqli_num_rows($res2) > 0) {
                       ;
                       $totalPages = ceil($totalRecords / $limit);
                     
                       for ($i = 1; $i <= $totalPages; $i++) {
                         $activeClass = ($i == $page) ? 'active' : '';
                         echo '<li class="page-item '.$activeClass.'"><a class="page-link" href="products.php?page='.$i.'">'.$i.'</a></li>';
                       }
                     }
                     if($totalPages>$page){
                      echo '<li class="page-item"><a class="page-link" href="products.php?page='.($page+1).'">Next</a></li>';
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
<script>
$(document).ready(function () {
  $("#search").on("keyup",function(){

  let searchVal = $(this).val();
  // console.log(searchVal) ;

$.ajax(
  {
    url:"ajax-search.php",
    type:"POST",
    data:{
      searchPro: searchVal,
    },
    success:function(data){
      $("#table").html(data);
    },
  }
)


  });

  // Filter Products 
  $("#filter").on("change",function(){
    filterValue = $(this).val();

    $.ajax(
  {

    url: "ajax-filter.php",
          type: "POST",
          data: {
            productStatus: filterValue
          },
success: function (data){

  $("#table").html(data)

}

  });

});

});

</script>

</body>
</html>