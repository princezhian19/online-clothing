<?php
session_start();
if (!isset($_SESSION["userid"])) {
    header("Location: index.php");
    exit();
}
if ($_SESSION["verifiedAt"] == null) {
    header("Location: verification.php");
    exit();
}
if (!isset($_SESSION["userid"])) {
    $style = "style='display:none;'";
    $toggle = "";
} else {
    $style = "style='display:inline;'";
    $toggle = "data-toggle='dropdown'";

    include "classes/connectiondb.php";
    include "classes/viewproductModel.php";

    $count = new viewproducts();
    $cartCount = $count->cartCount($_SESSION["userid"]);
}
$viewCart = new viewproducts();
$cart = $viewCart->getcartItems();

if ($cart->rowCount() == 0) {
    header('Location: customerPage.php');
}
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
    <link rel="icon" href="assets/logo.png" type="image/ico">

    <!-- Custom styles for this template -->
    <link href="dashboard/css/sb-admin-2.min.css" rel="stylesheet">

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
</head>
<style>
    #a {
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
                    <a class="dropdown-item" href="#">
                        <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                        Profile
                    </a>
                    <a class="dropdown-item" href="#">
                        <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                        Settings
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
    <div class="py-3 bg-light">
        <div class="container mt-1">
            <h6 class="text-white">
                <a href="customerPage.php" class="text-secondary">
                    Home
                </a>
                <a class="text-secondary">
                    /
                </a>
                <a href="cart.php" class="text-secondary">
                    Cart
                </a>
                <a class="text-secondary">
                    /
                </a>
                <a href="checkout.php" class="text-secondary">
                    Checkout
                </a>


            </h6>
        </div>
    </div>

    <style>
        input::-webkit-outer-spin-button,
        input::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        input[type=number] {
            -moz-appearance: textfield;
        }
    </style>
    <div class="row">
        <div class="py-3">
            <div class="container">
                <div class="card card-body shadow">

                    <form action="includes/placeorderInclude.php" method="POST">
                        <div class="row">
                            <div class="col-md-7">
                                <h3>User Details</h3>
                                <hr class="bg-secondary">
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label class="fw-bold">Name</label>
                                        <input value="<?php echo $_SESSION["fname"];
                                                        echo ' ';
                                                        echo $_SESSION["lname"]; ?>" type="text" required name="name" placeholder="Enter your full name" class="form-control">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="fw-bold">E-mail</label>
                                        <input value="<?php echo $_SESSION["usermail"]; ?>" type="email" required name="email" placeholder="Enter your email" class="form-control">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="fw-bold">Phone</label>
                                        <input type="number" required name="phone" placeholder="Enter your phone number" class="form-control" >
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="fw-bold">Zip Code</label>
                                        <input type="number" required name="pincode" placeholder="Enter your pin code" class="form-control">
                                    </div>
                                    <div class="col-md-12 mb-3">
                                        <label class="fw-bold">Address</label>
                                        <textarea type="address" required name="address" placeholder="Enter your address" class="form-control"></textarea>
                                    </div>

                                </div>
                            </div>
                            <div class="col-md-5">
                                <h3>Order Details</h3>
                                <hr class="bg-secondary">

                                <?php
                                $viewCart = new viewproducts();
                                $cart = $viewCart->getcartItems();

                                $totalprice = 0;


                                foreach ($cart as $items) {
                                ?>

                                    <div class="mb-1 border">
                                        <div class="row align-items-center">
                                            <div class="col-md-2">
                                                <img src="uploads/<?= $items['image']; ?>" alt="Image" width="50px">
                                            </div>
                                            <div class="col-md-3">
                                                <h5><?= $items['name']; ?></h5>
                                            </div>
                                            <div class="col-md-3">
                                                <h5>P <?= $items['price']; ?></h5>
                                            </div>
                                            <div class="col-md-2">
                                                <h5>x<?= $items['prod_qty']; ?></h5>
                                            </div>
                                            <div class="col-md-2">
                                                <h5><?= $items['size']; ?></h5>
                                            </div>

                                        </div>
                                    </div>


                                <?php

                                    $totalprice += $items['price'] * $items['prod_qty'];
                                }
                                ?>
                                <hr class="bg-secondary">
                                <h5>Total Price: <span class="float-end fw-bold">Php <?= $totalprice ?></span></h5>
                                <div class="">
                                    <input type="hidden" name="payment_mode" value="COD">
                                    <button tpye="submit" name="placeorderBtn" class="btn btn-primary w-100">Confirm and Place Order | COD</button>
                                </div>


                            </div>
                        </div>
                    </form>
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
</body>

</html>