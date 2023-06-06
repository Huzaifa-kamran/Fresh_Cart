<?php 
// include "config.php";
include "header.php";

if(isset($_POST['updateCategory'])){
    $catID = $_POST['catID'];
    $catName = $_POST['name'];
    $catDate = $_POST['date'];
    $catDesc = $_POST['description'];
    $catStatus = $_POST['status'];
    $fileName = $_FILES['icon']['name'];
    $tmpName = $_FILES['icon']['tmp_name'];
    $type = $_FILES['icon']['type'];

    if ($type == 'image/svg+xml' || $type == 'image/png' || $type == 'image/jpeg' || $fileName == ""){

   if(empty($fileName)){
  $update = "UPDATE `categories` SET`categoryName`='$catName',`categoryDate`='$catDate',
  `categoryDesc`='$catDesc',`categoryStatus`='$catStatus' WHERE `categoryID`= '$catID'";
  $updateQuery = mysqli_query($conn, $update);
  if ($updateQuery) {
    echo "<script> alert('Category Update Successfully.') </script>";
    echo "<script> window.location.href = 'categories.php' </script>";
} else {
    echo "<script> alert('An error occurred while updating the Category.') </script>";
    echo "<script> window.location.href = 'update-category.php?updateid=$catID' </script>";
}
   }else{
    $update = "UPDATE `categories` SET`categoryName`='$catName',`categoryDate`='$catDate',
    `categoryDesc`='$catDesc',`categoryStatus`='$catStatus',`icon`='$fileName' WHERE `categoryID`= '$catID'";
    $updateQuery = mysqli_query($conn, $update);
    if ($updateQuery) {
        if (move_uploaded_file($tmpName, '../assets/images/icons/' . $fileName)) {
            echo "<script> alert('Category Update Successfully.') </script>";
            echo "<script> window.location.href = 'categories.php' </script>";
                }else {
                    echo "<script> alert('An error occurred while updating the Category.') </script>";
                    echo "<script> window.location.href = 'update-category.php?updateid=$catID' </script>";
              }
  }
   }
        // if(move_uploaded_file($tmpName, '../assets/images/icons/' . $fileName)){
    
        //     $query = "INSERT INTO `categories` ( `categoryName`, `categoryDate`, 
        //     `categoryDesc`, `categoryStatus`, `icon`) VALUES ( '$catName', '$catDate', 
        //     '$catDesc', '$catStatus', '$fileName')";
    
        //     if(mysqli_query($conn,$query)){
        //         echo "<script> alert('Category Added') </script>";
        //         echo "<script> window.location.href = 'categories.php' </script>";
        //     }
    
    
        // }
    }else{
        echo "<script> alert('Please use supported file format, image/svg+xml , PNG or JPEG') </script>";
        echo "<script> window.location.href = 'update-category.php?updateid=$catID' </script>";
    }
}

if(isset($_GET['updateid'])){
$id = $_GET['updateid'];
 
$query = "SELECT * FROM `categories` WHERE `categories`.`categoryID` = $id";
$res = mysqli_query($conn,$query);
$data = mysqli_fetch_assoc($res);
// print_r($data);

}

?>

               <!-- main -->
            <main class="main-content-wrapper">
                   <!-- container -->
                <div class="container">
                       <!-- row -->
                    <div class="row mb-8">
                        <div class="col-md-12">
                            <div class="d-md-flex justify-content-between align-items-center">
                                   <!-- page header -->
                                <div>
                                    <h2>Update Category</h2>
                                       <!-- breacrumb -->
                                    <nav aria-label="breadcrumb">
                                        <ol class="breadcrumb mb-0">
                                            <li class="breadcrumb-item"><a href="#" class="text-inherit">Dashboard</a></li>
                                            <li class="breadcrumb-item"><a href="#" class="text-inherit">Categories</a></li>
                                            <li class="breadcrumb-item active" aria-current="page">Add New Category</li>
                                        </ol>
                                    </nav>
                                </div>
                                <div>
                                    <a href="categories.php" class="btn btn-light">Back to Categories</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12 col-12">
                            <form action="update-category.php" method="post" enctype="multipart/form-data">
                            <input type="hidden" name="catID" value="<?php echo $data['categoryID'] ?>">
                            <!-- card -->
                            <div class="card mb-6 shadow border-0">
                                <!-- card body -->
                                <div class="card-body p-6 ">
                                    <h4 class="mb-5 h5">Category Image</h4>
                                    <div class="mb-4 d-flex">
                                        <div class="position-relative" >
                                            <img class="image  icon-shape icon-xxxl bg-light rounded-4" src="../assets/images/icons/bakery.svg" alt="Image">

                                            <div class="file-upload position-absolute end-0 top-0 mt-n2 me-n1">
                                                <input type="file" class="file-input" name="icon">
                                                <span class="icon-shape icon-sm rounded-circle bg-white">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" fill="currentColor" class="bi bi-pencil-fill text-muted" viewBox="0 0 16 16">
                                                    <path d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708l-3-3zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207l6.5-6.5zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.499.499 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11l.178-.178z"/>
                                                  </svg>
                                                </span>
                                              </div>
                                        </div>



                                    </div>
                                    <h4 class="mb-4 h5 mt-5">Category Information</h4>

                                    <div class="row">
                                        <!-- input -->
                                        <div class="mb-3 col-lg-6">
                                            <label class="form-label">Category Name</label>
                                            <input type="text" name="name" value="<?php echo $data['categoryName'] ?>" class="form-control" placeholder="Category Name"
                                                required>
                                        </div>
                                        <div class="mb-3 col-lg-6">
                                            <label class="form-label">Date</label>
                                            <input type="date" name="date" value="<?php echo $data['categoryDate'] ?>" class="form-control flatpickr" placeholder="Select Date">
                                        </div>

                                        <div>

                                        </div>
                                        <!-- input -->
                                        <div class="mb-3 col-lg-12 ">
                                            <label class="form-label">Descriptions</label>

                                            <!-- <div class="py-8" id="editor"></div> -->
                                        </div>
                                        <textarea name="description"  rows="10"><?php echo $data['categoryDesc'] ?></textarea>

                                        <!-- input -->
                                        <div class="mb-3 col-lg-12 ">
                                            <label class="form-label" id="productSKU">Status</label><br>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="status"
                                                    id="inlineRadio1" value="1" <?php if($data['categoryStatus']== 1){ echo "checked";}?>>
                                                <label class="form-check-label" for="inlineRadio1">Active</label>
                                            </div>
                                            <!-- input -->
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="status"
                                                    id="inlineRadio2" value="0" <?php if($data['categoryStatus']== 0){ echo "checked";}?>>
                                                <label class="form-check-label" for="inlineRadio2">Disabled</label>
                                            </div>
                                            <!-- input -->

                                        </div>
                                        <div class="col-lg-12">
                                            <button type="submit" name="updateCategory"  class="btn btn-primary">
                                                Update Category
                                              </button>
                                        
                                        </div>
                                    </div>
                                </div>
                            </div>
                            </form>
                        </div>


                    </div>
                </div>
            </main>

        </div>
  
    <script src="../assets/libs/flatpickr/dist/flatpickr.min.js"></script>
    <!-- Libs JS -->
<script src="../assets/libs/jquery/dist/jquery.min.js"></script>
<script src="../assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
<script src="../assets/libs/simplebar/dist/simplebar.min.js"></script>

<!-- Theme JS -->
<script src="../assets/js/theme.min.js"></script>
    <script src="../assets/libs/quill/dist/quill.min.js"></script>
    <script src="../assets/js/vendors/editor.js"></script>
    <script src="../assets/libs/dropzone/dist/min/dropzone.min.js"></script>


</body>


<!-- Mirrored from freshcart.codescandy.com/dashboard/add-category.php by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 31 Mar 2023 10:11:28 GMT -->
</html>