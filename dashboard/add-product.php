<?php 
include 'header.php';

$categories = "SELECT * FROM `categories`";
$res = mysqli_query($conn,  $categories);

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
                        <h2>Add New Product</h2>
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
                <form action="add-product.php" method="post" enctype="multipart/form-data">
                    <!-- card -->
                    <div class="card mb-6 card-lg">
                        <!-- card body -->
                        <div class="card-body p-6 ">
                            <h4 class="mb-4 h5">Product Information</h4>
                            <div class="row">
                                <!-- input -->
                                <div class="mb-3 col-lg-6">
                                    <label class="form-label">Title</label>
                                    <input type="text" name="name" class="form-control" placeholder="Product Name" required>
                                </div>
                                <!-- input -->
                                <div class="mb-3 col-lg-6">
                                    <label class="form-label">Product Category</label>
                                    <select class="form-select" name="catID">
                                        <option selected>Product Category</option>
                                        <?php while ($row = mysqli_fetch_assoc($res)) {
                                        ?>
                                            <option value="<?php echo $row['categoryID'] ?>"><?php echo $row['categoryName'] ?></option>



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

                                        <!-- input -->
                                        <!-- <form action="#" class="d-block dropzone border-dashed rounded-2 "> -->
                                        <div class="fallback">
                                            <input name="img" type="file">
                                        </div>
                                        <!-- </form> -->
                                    </div>
                                </div>
                                <!-- input -->
                                <div class="mb-3 col-lg-12 mt-5">
                                    <h4 class="mb-3 h5">Product Descriptions</h4>
                                    <textarea name="description" cols="60" rows="10"></textarea>
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
                            <input class="form-check-input" type="checkbox" name="stock" role="switch" id="flexSwitchStock" checked>
                            <label class="form-check-label" for="flexSwitchStock">In Stock</label>
                        </div>
                        <!-- input -->
                        <div>

                            <!-- input -->

                            <!-- input -->
                            <div class="mb-3">
                                <label class="form-label" id="productSKU">Status</label><br>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="status" id="inlineRadio1" value="1" checked>
                                    <label class="form-check-label" for="inlineRadio1">Active</label>
                                </div>
                                <!-- input -->
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="status" id="inlineRadio2" value="0">
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
                            <input type="text" name="price" class="form-control" placeholder="$0.00">
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
                    <button type="submit" name="addProduct" class="btn btn-primary">
                        Create Product
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