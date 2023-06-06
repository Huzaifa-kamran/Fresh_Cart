<?php 
include 'header.php';

$categories = "SELECT * FROM `categories`";
$res = mysqli_query($conn,  $categories);

if(isset($_GET['uptID'])){
    $id = $_GET['uptID'];
     
$product = "SELECT * FROM `products` INNER JOIN `categories` ON `products`.`catID` = `categories`.`categoryID` WHERE `proID` = $id";
$productRes = mysqli_query($conn, $product);
$data = mysqli_fetch_assoc($productRes);
}



if(isset($_POST['updateProduct'])){
    $proID = $_POST['proID'];
    $name = $_POST['name'];
    $desc = $_POST['description'];
    $status = $_POST['status'];
    $price = $_POST['price'];
    $catID = $_POST['catID'];
    $fileName = $_FILES['img']['name'];
    $tmpName = $_FILES['img']['tmp_name'];
    $type = $_FILES['img']['type'];
    if (isset($_POST['stock'])) {

        $stock = 1;
    } else {

        $stock = 0;
    }

    
    if ($type == 'image/jpg' || $type == 'image/png' || $type == 'image/jpeg' || empty($fileName)) {
        if (empty($fileName)) {
            $update = "UPDATE `products` SET  `proName` = '$name',
            `proDesc` = '$desc', `catID` = '$catID', `proStatus` = '$status',
             `proPrice` = '$price', `inStock` = '$stock' WHERE `products`.`proID` = $proID";

          $updateQuery = mysqli_query($conn, $update);
          if ($updateQuery) {
            echo "<script> alert('Product Update Successfully.') </script>";
            echo "<script> window.location.href = 'products.php' </script>";
        } else {
            echo "<script> alert('An error occurred while updating the Product.') </script>";
            echo "<script> window.location.href = 'update-product.php?uptID=$id' </script>";
        }
           }else{
            $update = "UPDATE `products` SET  `proName` = '$name',
            `proDesc` = '$desc', `catID` = '$catID', `proStatus` = '$status',
             `proPrice` = '$price', `proImg` = '$fileName', `inStock` = '$stock' WHERE `products`.`proID` = $proID";

               $updateQuery = mysqli_query($conn,$update);
               if($updateQuery){
                if (move_uploaded_file($tmpName, '../assets/images/products/' . $fileName)) {
                  echo "<script> alert('Data Update Successfully.') </script>";
                          echo "<script> window.location.href = 'products.php' </script>";
                      }else {
                        echo "<script> alert('An error occurred while updating the student information.') </script>";
                        echo "<script> window.location.href = 'update-product.php?uptID=$id' </script>";
                    }
               }
           }

    } else {
        echo "<script> alert('Please use supported file format, JPG , JPEG or PNG') </script>";
    }
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
                        <h2>Edit Product</h2>
                        <!-- breacrumb -->
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb mb-0">
                                <li class="breadcrumb-item"><a href="#" class="text-inherit">Dashboard</a></li>
                                <li class="breadcrumb-item"><a href="#" class="text-inherit">Products</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Add New Product</li>
                            </ol>
                        </nav>
                    </div>
                    <!-- button -->
                    <div>
                        <a href="products.php" class="btn btn-light">Back to Product</a>
                    </div>
                </div>

            </div>
        </div>
        <!-- row -->
        <div class="row">

            <div class="col-lg-8 col-12">
                <form action="update-product.php" method="post" enctype="multipart/form-data">
                    <!-- card -->
                    <div class="card mb-6 card-lg">
                        <!-- card body -->
                        <div class="card-body p-6 ">
                            <h4 class="mb-4 h5">Product Information</h4>
                            <div class="row">
                                <!-- input -->
                                <div class="mb-3 col-lg-6">
                                    <label class="form-label">Title</label>
                                    <input type="hidden" name="proID" value="<?php echo $data['proID'] ?>">
                                    <input type="text" name="name" value="<?php echo $data['proName'] ?>" class="form-control" placeholder="Product Name">
                                </div>
                                <!-- input -->
                                <div class="mb-3 col-lg-6">
                                    <label class="form-label">Product Category</label>
                                    <select class="form-select" name="catID">
                                        <option selected>Product Category</option>
                                        <?php while ($row = mysqli_fetch_assoc($res)) {
                                        ?>
                                            <option value="<?php echo $row['categoryID'] ?>" <?php if($data['categoryID'] == $row['categoryID']){ echo "selected";}?>><?php echo $row['categoryName'] ?></option>



                                        <?php } ?>
                                    </select>
                                </div>
                                <!-- input -->
                                <!-- <div class="mb-3 col-lg-6">
                                    <label class="form-label">Weight</label>
                                    <input type="text" class="form-control" placeholder="Weight" required>
                                </div> -->
                                <!-- input -->

                                <div>
                                    <div class="mb-3 col-lg-12 mt-5">
                                        <!-- heading -->
                                        <h4 class="mb-3 h5">Product Images</h4>
                                        <span>Image:  <?php echo $data['proImg'] ?></span>
                                        <!-- input -->
                                        <!-- <form action="#" class="d-block dropzone border-dashed rounded-2 "> -->
                                        <div class="fallback">
                                            <input name="img" value="<?php echo $data['proImg'] ?>" type="file">
                                        </div>
                                        <!-- </form> -->
                                    </div>
                                </div>
                                <!-- input -->
                                <div class="mb-3 col-lg-12 mt-5">
                                    <h4 class="mb-3 h5">Product Descriptions</h4>
                                    <textarea name="description" cols="60" rows="10"><?php echo $data['proDesc'] ?></textarea>
                                </div>
                            </div>
                        </div>

                    </div>

            </div>
            <div class="col-lg-4 col-12">
                <!-- card -->
                <div class="card mb-6 card-lg">
                    <!-- card body -->
                    <div class="card-body p-6">
                        <!-- input -->
                        <div class="form-check form-switch mb-4">
                            <input class="form-check-input" type="checkbox" name="stock" role="switch" id="flexSwitchStock" <?php if($data['inStock'] == 1){ echo "checked";}?>>
                            <label class="form-check-label" for="flexSwitchStock">In Stock</label>
                        </div>
                        <!-- input -->
                        <div>

                            <!-- input -->

                            <!-- input -->
                            <div class="mb-3">
                                <label class="form-label" id="productSKU">Status</label><br>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input"  type="radio" name="status" id="inlineRadio1" value="1" <?php if($data['proStatus'] == 1){ echo "checked";}?>>
                                    <label class="form-check-label" for="inlineRadio1">Active</label>
                                </div>
                                <!-- input -->
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="status" id="inlineRadio2" value="0" <?php if($data['proStatus'] == 0){ echo "checked";}?>>
                                    <label class="form-check-label" for="inlineRadio2">Disabled</label>
                                </div>
                                <!-- input -->

                            </div>

                        </div>
                    </div>
                </div>
                <!-- card -->
                <div class="card mb-6 card-lg">
                    <!-- card body -->
                    <div class="card-body p-6">
                        <h4 class="mb-4 h5">Product Price</h4>
                        <!-- input -->
                        <div class="mb-3">
                            <label class="form-label">Regular Price</label>
                            <input type="text" value="<?php echo $data['proPrice'] ?>" name="price" class="form-control" placeholder="$0.00">
                        </div>
                        <!-- input -->
                        <!-- <div class="mb-3">
                            <label class="form-label">Sale Price</label>
                            <input type="text" class="form-control" placeholder="$0.00">
                        </div> -->

                    </div>
                </div>
                <!-- card -->

                <!-- button -->
                <div class="d-grid">
                    <button type="submit" name="updateProduct" class="btn btn-primary">
                        Update Product
                    </button>
                </div>
                </form>
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
<script src="../assets/libs/quill/dist/quill.min.js"></script>
<script src="../assets/js/vendors/editor.js"></script>
<script src="../assets/libs/dropzone/dist/min/dropzone.min.js"></script>

</body>


<!-- Mirrored from freshcart.codescandy.com/dashboard/add-product.php by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 31 Mar 2023 10:11:27 GMT -->

</html>

<?php

if (isset($_POST['addProduct'])) {


    $name = $_POST['name'];
    $desc = $_POST['description'];
    $status = $_POST['status'];
    $price = $_POST['price'];
    $catID = $_POST['catID'];
    $fileName = $_FILES['img']['name'];
    $tmpName = $_FILES['img']['tmp_name'];
    $type = $_FILES['img']['type'];
    if (isset($_POST['stock'])) {

        $stock = 1;
    } else {

        $stock = 0;
    }

    // print_r($_POST);

    // echo $type;

    if ($type == 'image/jpg' || $type == 'image/png' || $type == 'image/jpeg') {

        if (move_uploaded_file($tmpName, '../assets/images/products/' . $fileName)) {


            $product = "INSERT INTO `products` 
            ( `proName`, `proDesc`, `catID`, `proStatus`, `proPrice`, `createdAt`, `proImg`, `inStock`) 
            VALUES ( '$name', '$desc', '$catID', '$status', '$price', current_timestamp(), '$fileName', '$stock')";

            $res =  mysqli_query($conn, $product);
            if ($res) {

                echo "<script> alert('Product Added') </script>";
                echo "<script> window.location.href = 'products.php' </script>";
            }
        }
    } else {
        echo "<script> alert('Please use supported file format, JPG , JPEG or PNG') </script>";
    }
}







?>