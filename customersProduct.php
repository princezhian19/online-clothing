<?php
session_start();
//if (!isset($_SESSION["userid"])) {
//    header("Location: index.php");
//    exit();
//}
if (isset($_SESSION["userid"])) {
    if ($_SESSION["verifiedAt"] == null) {
        header("Location: verification.php");
        exit();
    }
}
if (!isset($_SESSION["userid"])) {
    $style = "style='display:none;'";
    $toggle = "";
    include "classes/connectiondb.php";
    include "classes/viewproductModel.php";
} else {
    $style = "style='display:inline;'";
    $toggle = "data-toggle='dropdown'";
    include "classes/connectiondb.php";
    include "classes/viewproductModel.php";

    $count = new viewproducts();
    $cartCount = $count->cartCount($_SESSION["userid"]);
}
include_once './config.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GraphiteeShop</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <link href="vendors/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <link href="styles/owl.carousel.min.css" rel="stylesheet">
    <link href="styles/owl.theme.default.min.css" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="dashboard/css/sb-admin-2.min.css" rel="stylesheet">
    <link rel="icon" href="assets/logo.png" type="image/ico">
    <link href="styles/review.css" rel="stylesheet">

    <!-- Custom styles for this page -->
    <link href="vendors/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
    <script src="https://kit.fontawesome.com/yourcode.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css">
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css" />

    <style>
        .alertify-notifier .ajs-message.ajs-success {
            color: white;
            border-radius: 5px;
        }
    </style>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>


</head>
<style>
    #a{
        text-decoration: none;
    }
</style>

<body>


    <nav class="navbar navbar-expand navbar-light bg-dark static-top ">

        <!-- Sidebar Toggle (Topbar) -->


        <!-- Topbar Search -->

        <a id="a" href="customerPage.php">

            <i class="fas fa-tshirt text-white"></i>
            <span class="mr-2 d-none d-lg-inline text-white large">GraphiteeShirt</span>


        </a>

        <!--<div class="d-flex flex-row justify-content-center">
            <div class="p-2 text-white">Home</div>
            <div class="p-2 text-white">About</div>
            <div class="p-2 text-white">Contact</div>
        </div> -->

        <!-- Topbar Navbar -->
        <ul class="navbar-nav ml-auto">

            <!-- Nav Item - Search Dropdown (Visible Only XS) -->
            <li class="nav-item dropdown no-arrow d-sm-none">
                <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-search fa-fw"></i>
                </a>
                <!-- Dropdown - Messages -->
                <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in" aria-labelledby="searchDropdown">
                    <form class="form-inline mr-auto w-100 navbar-search">
                        <div class="input-group">
                            <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
                            <div class="input-group-append">
                                <button class="btn btn-primary" type="button">
                                    <i class="fas fa-search fa-sm"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </li>


            <!-- Dropdown - Alerts -->
            <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="alertsDropdown">
                <h6 class="dropdown-header">
                    Alerts Center
                </h6>
                <a class="dropdown-item d-flex align-items-center" href="#">
                    <div class="mr-3">
                        <div class="icon-circle bg-primary">
                            <i class="fas fa-file-alt text-white"></i>
                        </div>
                    </div>
                    <div>
                        <div class="small text-gray-500">December 12, 2019</div>
                        <span class="font-weight-bold">A new monthly report is ready to download!</span>
                    </div>
                </a>
                <a class="dropdown-item d-flex align-items-center" href="#">
                    <div class="mr-3">
                        <div class="icon-circle bg-success">
                            <i class="fas fa-donate text-white"></i>
                        </div>
                    </div>
                    <div>
                        <div class="small text-gray-500">December 7, 2019</div>
                        $290.29 has been deposited into your account!
                    </div>
                </a>
                <a class="dropdown-item d-flex align-items-center" href="#">
                    <div class="mr-3">
                        <div class="icon-circle bg-warning">
                            <i class="fas fa-exclamation-triangle text-white"></i>
                        </div>
                    </div>
                    <div>
                        <div class="small text-gray-500">December 2, 2019</div>
                        Spending Alert: We've noticed unusually high spending for your account.
                    </div>
                </a>
                <a class="dropdown-item text-center small text-gray-500" href="#">Show All Alerts</a>
            </div>
            </li>

            <!-- Nav Item - Messages -->
            <li class="nav-item dropdown no-arrow mx-1">
                <a class="nav-link dropdown-toggle" href="cart.php" id="messagesDropdown" role="button" aria-haspopup="true" aria-expanded="false">
                    <i class="fa fa-shopping-cart me-2 text-white" <?php echo $style; ?>></i>
                    <!-- Counter - Messages -->
                    <span class="badge badge-danger badge-counter" <?php echo $style; ?>><?php echo $cartCount; ?></span>
                </a>
                <!-- Dropdown - Messages -->
                <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="messagesDropdown">
                    <h6 class="dropdown-header">
                        Message Center
                    </h6>
                    <a class="dropdown-item d-flex align-items-center" href="#">
                        <div class="dropdown-list-image mr-3">
                            <img class="rounded-circle" src="img/undraw_profile_1.svg" alt="...">
                            <div class="status-indicator bg-success"></div>
                        </div>
                        <div class="font-weight-bold">
                            <div class="text-truncate">Hi there! I am wondering if you can help me with a
                                problem I've been having.</div>
                            <div class="small text-gray-500">Emily Fowler · 58m</div>
                        </div>
                    </a>
                    <a class="dropdown-item d-flex align-items-center" href="#">
                        <div class="dropdown-list-image mr-3">
                            <img class="rounded-circle" src="img/undraw_profile_2.svg" alt="...">
                            <div class="status-indicator"></div>
                        </div>
                        <div>
                            <div class="text-truncate">I have the photos that you ordered last month, how
                                would you like them sent to you?</div>
                            <div class="small text-gray-500">Jae Chun · 1d</div>
                        </div>
                    </a>
                    <a class="dropdown-item d-flex align-items-center" href="#">
                        <div class="dropdown-list-image mr-3">
                            <img class="rounded-circle" src="img/undraw_profile_3.svg" alt="...">
                            <div class="status-indicator bg-warning"></div>
                        </div>
                        <div>
                            <div class="text-truncate">Last month's report looks great, I am very happy with
                                the progress so far, keep up the good work!</div>
                            <div class="small text-gray-500">Morgan Alvarez · 2d</div>
                        </div>
                    </a>
                    <a class="dropdown-item d-flex align-items-center" href="#">
                        <div class="dropdown-list-image mr-3">
                            <img class="rounded-circle" src="https://source.unsplash.com/Mv9hjnEUHR4/60x60" alt="...">
                            <div class="status-indicator bg-success"></div>
                        </div>
                        <div>
                            <div class="text-truncate">Am I a good boy? The reason I ask is because someone
                                told me that people say this to all dogs, even if they aren't good...</div>
                            <div class="small text-gray-500">Chicken the Dog · 2w</div>
                        </div>
                    </a>
                    <a class="dropdown-item text-center small text-gray-500" href="#">Read More Messages</a>
                </div>
            </li>

            <div class="topbar-divider d-none d-sm-block"></div>

            <!-- Nav Item - User Information -->
            <li class="nav-item dropdown no-arrow">
                <a class="nav-link dropdown-toggle" href="index.php" id="userDropdown" role="button" <?php echo $toggle; ?>aria-haspopup="true" aria-expanded="false">
                    <span class="mr-2 d-none d-lg-inline text-white small"><?php
                                                                            if (isset($_SESSION["userid"])) {
                                                                                echo $_SESSION["usernameid"];
                                                                            } else {
                                                                                echo "Login";
                                                                            }


                                                                            ?></span>
                    <i class="fa-solid fa-user text-white" <?php echo $style; ?>></i>
                </a>
                <!-- Dropdown - User Information -->
                <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                    <a class="dropdown-item" href="customersSetting.php">
                        <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                        Profile
                    </a>

                    <a class="dropdown-item" href="my-orders.php">
                        <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                        My orders
                    </a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                        <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                        Logout
                    </a>
                </div>
            </li>

        </ul>

    </nav>



    <div class="row">
        <?php

        $conn1 = new connection();                                                                            
        $view = new viewproducts();
        $prod = $view->getAll("products");
        if (isset($_GET['product'])) {
            $product_slug = $_GET['product'];
            $prodSlug = $view->getSlug("products", $product_slug);
            $prod = $prodSlug->fetchAll(PDO::FETCH_ASSOC);

            $ViewProducts = new viewproducts();
            $getProductSizesResult = $ViewProducts->getProductSizes("products", $prod[0]['code']);
            $productSizes = $getProductSizesResult->fetchAll(PDO::FETCH_ASSOC);
            if ($prod) {
        ?>
                <div class="py-3 bg-light">
                    <div class="container mt-1">
                        <h6 class="text-white">
                            <a href="customerPage.php" class="text-secondary">
                                Home
                            </a>
                            <a class="text-secondary">
                                / <?= $prod[0]['name']; ?>
                            </a>

                        </h6>
                    </div>
                </div>

                <div class="py-2">
                    <div class="container product_data mt-3">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="shadow">
                                    <img src="uploads/<?= $prod[0]['image']; ?>" alt="Product Image" class="w-100">
                                </div>
                            </div>
                            <div class="col-md-8">
                                <h4 class="fw-bold"><?= $prod[0]['name']; ?></h4>
                                <hr>
                                <h6 class="fw-bold">Product Description:</h6>
                                <p><?= $prod[0]['description']; ?></p>
                                <hr>
                                <div class="row">

                                    <div class="col-md-6">

                                        <h6 class="fw-bold">Product Price:</h6>
                                        <h5>Php <?= $prod[0]['price']; ?> </h5>
                                    </div>

                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="input-group mb-3" style="width:130px">
                                            <button class="input-group-text decerement_btn">-</button>
                                            <input type="number" class="form-control text-center qty_input bg-white" disabled value="1">
                                            <button class="input-group-text increment_btn">+</button>
                                        </div>
                                    </div>
                                </div>
                                <!-- Show the available sizes and stocks -->
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="input-group mb-12" style="width:130px">

                                        <?php  $view_query = mysqli_query($mysqli, "SELECT * FROM products where slug = '$product_slug' "); $row = mysqli_fetch_array($view_query);
                                            if ( $row['size'] == 'S' ) {
                                                if ($row['quantity'] > 4){

                                                    echo "S - "."<p>".$row['quantity']."</p>";
                                                }
                                                else if ($row['quantity'] == 0 ){
                                                    echo "S - "."<p style='color:red;'>"."   Out of Stocks"."</p>";
                                                }
                                                else if ($row['quantity'] <= 4 ){
                                                    echo "S - "."<p style='color:red;'>"."Only ".$row['quantity']." Stocks Left"."</p>";
                                                }
                                                
                                            }
                                            else if ( $row['size'] == 'M' ) {
                                                if ($row['quantity'] > 4){

                                                    echo "M - "."<p>".$row['quantity']."</p>";
                                                }
                                                else if ($row['quantity'] == 0 ){
                                                    echo "M - "."<p style='color:red;'>"."   Out of Stocks"."</p>";
                                                }
                                                else if ($row['quantity'] <= 4 ){
                                                    echo "M - "."<p style='color:red;'>"."Only ".$row['quantity']." Stocks Left"."</p>";
                                                }
                                                
                                            }
                                           else  if ( $row['size'] == 'L' ) {
                                                if ($row['quantity'] > 4){

                                                    echo "L - "."<p>".$row['quantity']."</p>";
                                                }
                                                else if ($row['quantity'] == 0 ){
                                                    echo "L - "."<p style='color:red;'>"."   Out of Stocks"."</p>";
                                                }
                                                else if ($row['quantity'] <= 4 ){
                                                    echo "L - "."<p style='color:red;'>"."Only ".$row['quantity']." Stocks Left"."</p>";
                                                }
                                                
                                            }
                                            
                                            ?>
                                            
                                          
                                        </div>
                                    </div>
                                </div>

                                 <!-- Show the available sizes and stocks -->
                                <div class="row">
                                    <h6 class="fw-bold">Product Size:</h6>
                                    <div class="col-md-4">

                                        <select class="form-select sizes" aria-label="Default select example">
                                            <?php foreach($productSizes as $prodSize) { ?> 
                                                <option value="<?= $prodSize['size'] ?>"><?= $prodSize['size'] ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-md-6">
                                        <button class="btn btn-primary px-4 addtocartBtn" value=" <?= $prod[0]['id']; ?>"><i class="fa fa-shopping-cart me-2"></i>Add to Cart</button>
                                    </div>
                                    <!--  <div class="col-md-6">
                                        <button class="btn btn-danger px-4"><i class="fa fa-heart me-2"></i>Add to Wishlist</button>
                                    </div> -->
                                </div>
                            </div>

                        </div>

                    </div>
                </div>
                <div class="container">
                    <div class="row">
                        <div class="col-sm-4 text-center m-auto">
                            <h1><span id="avg_rating">0.0</span>/5.0</h1>
                            <div>
                                <i class="fa fa-star star-light main_star mr-1"></i>
                                <i class="fa fa-star star-light main_star mr-1"></i>
                                <i class="fa fa-star star-light main_star mr-1"></i>
                                <i class="fa fa-star star-light main_star mr-1"></i>
                                <i class="fa fa-star star-light main_star mr-1"></i>
                            </div>
                            <span id="total_review">0</span> Reviews
                        </div>
                        <div class="col-sm-4 progressSection">
                            <div class='holder'>
                                <div>
                                    <div class="progress-label-left">
                                        <b>5</b> <i class="fa fa-star mr-1 text-warning"></i>
                                    </div>
                                    <div class="progress-label-right">
                                        <span id="total_five_star_review"> 0 </span> Reviews
                                    </div>

                                </div>

                                <div class="progress">
                                    <div class="progress-bar bg-warning" id='five_star_progress'>

                                    </div>
                                </div>
                            </div>
                            <div class='holder'>
                                <div>
                                    <div class="progress-label-left">
                                        <b>4</b> <i class="fa fa-star mr-1 text-warning"></i>
                                    </div>
                                    <div class="progress-label-right">
                                        <span id="total_four_star_review"> 0 </span> Reviews
                                    </div>
                                </div>
                                <div class="progress">
                                    <div class="progress-bar bg-warning" id='four_star_progress'>

                                    </div>
                                </div>
                            </div>
                            <div class='holder'>
                                <div>
                                    <div class="progress-label-left">
                                        <b>3</b> <i class="fa fa-star mr-1 text-warning"></i>
                                    </div>
                                    <div class="progress-label-right">
                                        <span id="total_three_star_review"> 0 </span> Reviews
                                    </div>
                                </div>
                                <div class="progress">
                                    <div class="progress-bar bg-warning" id='three_star_progress'>

                                    </div>
                                </div>
                            </div>
                            <div class='holder'>
                                <div>
                                    <div class="progress-label-left">
                                        <b>2</b> <i class="fa fa-star mr-1 text-warning"></i>
                                    </div>
                                    <div class="progress-label-right">
                                        <span id="total_two_star_review"> 0 </span> Reviews
                                    </div>
                                </div>
                                <div class="progress">
                                    <div class="progress-bar bg-warning" id='two_star_progress'>

                                    </div>
                                </div>
                            </div>
                            <div class='holder'>
                                <div>
                                    <div class="progress-label-left">
                                        <b>1</b> <i class="fa fa-star mr-1 text-warning"></i>
                                    </div>
                                    <div class="progress-label-right">
                                        <span id="total_one_star_review"> 0 </span> Reviews
                                    </div>
                                </div>
                                <div class="progress">
                                    <div class="progress-bar bg-warning" id='one_star_progress'>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4 text-center m-auto">
                            <button class="btn-primary" id='add_review' value="" <?php echo $style ?>> Add Review </button>
                        </div>
                    </div>

                    <div id="display_review">

                    </div>
                </div>
                <!-- The Modal -->
                <div class="modal" id="myModal">
                    <div class="modal-dialog">
                        <div class="modal-content">

                            <!-- Modal Header -->
                            <div class="modal-header">
                                <h4 class="modal-title">Write your Review</h4>
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                            </div>

                            <!-- Modal body -->
                            <div class="modal-body text-center">
                                <h4>
                                    <i class="fa fa-star star-light submit_star  mr-1 " id='submit_star_1' data-rating='1'></i>
                                    <i class="fa fa-star star-light submit_star  mr-1 " id='submit_star_2' data-rating='2'></i>
                                    <i class="fa fa-star star-light submit_star   mr-1 " id='submit_star_3' data-rating='3'></i>
                                    <i class="fa fa-star star-light submit_star  mr-1 " id='submit_star_4' data-rating='4'></i>
                                    <i class="fa fa-star star-light submit_star  mr-1 " id='submit_star_5' data-rating='5'></i>
                                </h4>
                                <div class="form-group">

                                    <input type="hidden" class="form-control" id='userName' name='userName' value='<?php echo $_SESSION["usernameid"] ?>' readonly>
                                    <input type="hidden" class="form-control" id='prod_id' name='prod_id' value='<?php echo $prod[0]['id'] ?>' readonly>
                                    <input type="hidden" class="form-control" id='prod_slug' name='prod_slug' value='<?php echo $product_slug ?>' readonly>



                                </div>
                                <div class="form-group">
                                    <textarea name="userMessage" id="userMessage" class="form-control" placeholder="Enter message"></textarea>
                                </div>
                                <div class="form-group">
                                    <button class="btn-primary" id='sendReview'>Submit</button>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

        <?php

            } else {
                echo "Product not found";
            }
        } else {
            echo "Something went wrong";
        }
        ?>

        <hr>
        <div class="py-5">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <h4>Available Shirt</h4>
                        <div class="owl-carousel">
                            <?php
                            $view = new viewproducts();
                            $prod = $view->getAll("products");

                            if ($prod->rowCount() > 0) {
                                foreach ($prod as $items) {
                            ?>


                                    <div class="item">
                                        <a href="customersProduct.php?product=<?= $items['slug']; ?>">

                                            <div class="card shadow">
                                                <div class="card-body">
                                                    <img src="uploads/<?= $items['image']; ?>" alt="Products Image" class="w-100" height="230px">
                                                    <h6 class="text-center"><?= $items['name']; ?></h6>
                                                </div>
                                            </div>

                                        </a>
                                    </div>



                            <?php
                                }
                            } else {
                                echo "no products available";
                            }

                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>









        <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                        <a class="btn btn-danger" href="includes/logoutInclude.php">Logout</a>
                    </div>
                </div>
            </div>
        </div>

        <script src="script/review.js"></script>

        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
        <script src="script/jquery-3.6.1.min.js"></script>
        <script src="script/custom.js"></script>
        <!-- Bootstrap core JavaScript-->

        <script src="vendors/jquery/jquery.min.js"></script>
        <script src="vendors/bootstrap/js/bootstrap.bundle.min.js"></script>

        <!-- Core plugin JavaScript-->
        <script src="vendors/jquery-easing/jquery.easing.min.js"></script>

        <!-- Custom scripts for all pages-->
        <script src="dashboard/js/sb-admin-2.min.js"></script>

        <!-- Page level plugins -->
        <script src="vendors/datatables/jquery.dataTables.min.js"></script>
        <script src="vendors/datatables/dataTables.bootstrap4.min.js"></script>

        <!-- Page level custom scripts -->
        <script src="dashboard/js/demo/datatables-demo.js"></script>
        <script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>
        <script>
            alertify.set('notifier', 'position', 'top-right');
            <?php if (isset($_SESSION['message'])) { ?>


                alertify.success('<?= $_SESSION['message']; ?>');
            <?php }
            unset($_SESSION['message']);
            ?>
        </script>
        <script src="script/owl.carousel.min.js"></script>
        <script>
            $(document).ready(function() {
                $('.owl-carousel').owlCarousel({
                    loop: true,
                    margin: 10,
                    nav: true,
                    responsive: {
                        0: {
                            items: 1
                        },
                        600: {
                            items: 3
                        },
                        1000: {
                            items: 5
                        }
                    }
                })
            });
        </script>

</body>

</html>