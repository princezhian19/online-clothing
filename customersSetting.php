<?php
session_start();
//if (!isset($_SESSION["userid"])) {
//    header("Location: index.php");
//    exit();
//}

//    if ($_SESSION["verifiedAt"] == null) {
//        header("Location: verification.php");
//       exit();
//    }


if (!isset($_SESSION["userid"])) {
    include "classes/connectiondb.php";
    include "classes/viewproductModel.php";
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

    <!-- Custom styles for this template -->
    <link href="styles/owl.carousel.min.css" rel="stylesheet">
    <link href="styles/owl.theme.default.min.css" rel="stylesheet">

    <link rel="icon" href="assets/logo.png" type="image/ico">


    <link href="dashboard/css/sb-admin-2.min.css" rel="stylesheet">
    <link href="styles/customer.css" rel="stylesheet">
    <link href="styles/card.css" rel="stylesheet">
    <link href="styles/newcard.css" rel="stylesheet">
    <link href="styles/settings.css" rel="stylesheet">


    <style>
        .alertify-notifier .ajs-message.ajs-success {
            color: white;
            border-radius: 5px;
        }
    </style>

    <!-- Custom styles for this page -->
    <link href="vendors/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
    <script src="https://kit.fontawesome.com/yourcode.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css">
</head>
<style>
    #a {
        text-decoration: none;
    }
</style>

<body>


    <nav class="navbar navbar-expand navbar-light bg-dark  static-top ">

        <!-- Sidebar Toggle (Topbar) -->


        <!-- Topbar Search -->

        <a href="customerPage.php">
            <i class="fas fa-tshirt text-white"></i>
            <span class="mr-2 d-none d-lg-inline text-white large ">GraphiteeShirt</span>

        </a>
        <!--<div class="d-flex flex-row justify-content-center">
            <div class="p-2 text-white">Home</div>
            <div class="p-2 text-white">About</div>
            <div class="p-2 text-white">Contact</div>-->
        </div>
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



            <!-- Nav Item - Messages -->
            <li class="nav-item dropdown no-arrow mx-1">
                <div <?php echo $style; ?>>
                    <a class="nav-link dropdown-toggle" href="cart.php" id="messagesDropdown" role="button" aria-haspopup="true" aria-expanded="false">
                        <i class="fa fa-shopping-cart me-2 text-white"></i>
                        <!-- Counter - Messages -->
                        <span class="badge badge-danger badge-counter" <?php echo $style; ?>> <?php echo $cartCount; ?></span>
                    </a>
                </div>
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
                <a class="nav-link dropdown-toggle" href="index.php" id="userDropdown" role="button" <?php echo $toggle; ?> aria-haspopup="true" aria-expanded="false">
                    <span class="mr-2 d-none d-lg-inline text-white small"><?php
                                                                            if (isset($_SESSION["userid"])) {
                                                                                echo $_SESSION["usernameid"];
                                                                            } else {
                                                                                echo "Login";
                                                                            }



                                                                            ?></span>
                    <i class="fa-solid fa-user text-white" <?php echo $style ?>></i>
                </a>
                <!-- Dropdown - User Information -->
                <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in " aria-labelledby="userDropdown">
                    <a class="dropdown-item" href="customersSetting.php">
                        <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                        Profile
                    </a>

                    <a class="dropdown-item" href="my-orders.php">
                        <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                        My Orders
                    </a>

                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                        <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                        <?php
                        if (!isset($_SESSION["userid"])) {
                            echo  "Login";
                        } else {
                            echo "Logout";
                        }
                        ?>

                    </a>
                </div>
            </li>

        </ul>

    </nav>




    </div>

    </nav>





    <div class="py-2">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="row">
                        <section class="py-5 my-5">
                            <div class="container">
                                <h1 class="mb-5">Account Settings</h1>
                                <div class="bg-white shadow rounded-lg d-block d-sm-flex">
                                    <div class="profile-tab-nav border-right">
                                        <div class="p-4">

                                            <h4 class="text-center"><?php echo $_SESSION["fname"] ?></h4>
                                        </div>
                                        <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                                            <a class="nav-link active" id="account-tab" data-toggle="pill" href="#account" role="tab" aria-controls="account" aria-selected="true">
                                                <i class="fa fa-home text-center mr-1"></i>
                                                Account
                                            </a>
                                            <a class="nav-link" id="password-tab" data-toggle="pill" href="#password" role="tab" aria-controls="password" aria-selected="false">
                                                <i class="fa fa-key text-center mr-1"></i>
                                                Password
                                            </a>
                                         
                                        </div>
                                    </div>
                                    <div class="tab-content p-4 p-md-5" id="v-pills-tabContent">
                                        <div class="tab-pane fade show active" id="account" role="tabpanel" aria-labelledby="account-tab">
                                            <h3 class="mb-4">Account Settings</h3>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>First Name</label>
                                                        <input type="text" class="form-control" value="<?php echo $_SESSION["fname"] ?>">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Last Name</label>
                                                        <input type="text" class="form-control" value="<?php echo $_SESSION["lname"] ?>">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Email</label>
                                                        <input type="text" class="form-control" value="<?php echo $_SESSION["usermail"] ?>">
                                                    </div>
                                                </div>
                                          
                                            </div>
                                            <div>
                                                <button class="btn btn-primary">Update</button>
                                                <button class="btn btn-light">Cancel</button>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="password" role="tabpanel" aria-labelledby="password-tab">
                                            <h3 class="mb-4">Password Settings</h3>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Old password</label>
                                                        <input type="password" class="form-control">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>New password</label>
                                                        <input type="password" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Confirm new password</label>
                                                        <input type="password" class="form-control">
                                                    </div>
                                                </div>
                                            </div>
                                            <div>
                                                <button class="btn btn-primary">Update</button>
                                                <button class="btn btn-light">Cancel</button>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="security" role="tabpanel" aria-labelledby="security-tab">
                                            <h3 class="mb-4">Security Settings</h3>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Login</label>
                                                        <input type="text" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Two-factor auth</label>
                                                        <input type="text" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox" value="" id="recovery">
                                                            <label class="form-check-label" for="recovery">
                                                                Recovery
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div>
                                                <button class="btn btn-primary">Update</button>
                                                <button class="btn btn-light">Cancel</button>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="application" role="tabpanel" aria-labelledby="application-tab">
                                            <h3 class="mb-4">Application Settings</h3>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox" value="" id="app-check">
                                                            <label class="form-check-label" for="app-check">
                                                                App check
                                                            </label>
                                                        </div>
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox" value="" id="defaultCheck2">
                                                            <label class="form-check-label" for="defaultCheck2">
                                                                Lorem ipsum dolor sit.
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div>
                                                <button class="btn btn-primary">Update</button>
                                                <button class="btn btn-light">Cancel</button>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="notification" role="tabpanel" aria-labelledby="notification-tab">
                                            <h3 class="mb-4">Notification Settings</h3>
                                            <div class="form-group">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" value="" id="notification1">
                                                    <label class="form-check-label" for="notification1">
                                                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolorum accusantium accusamus, neque cupiditate quis
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" value="" id="notification2">
                                                    <label class="form-check-label" for="notification2">
                                                        hic nesciunt repellat perferendis voluptatum totam porro eligendi.
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" value="" id="notification3">
                                                    <label class="form-check-label" for="notification3">
                                                        commodi fugiat molestiae tempora corporis. Sed dignissimos suscipit
                                                    </label>
                                                </div>
                                            </div>
                                            <div>
                                                <button class="btn btn-primary">Update</button>
                                                <button class="btn btn-light">Cancel</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>

                    </div>
                </div>
            </div>
        </div>
    </div>



    <div class="py-5 bg-dark">
        <div class="container">
            <div class="row">
                <div class="col-md-3">
                    <h4 class="text-white">GraphiteeShirt</h4>
                    <div class="underline mb-2"></div>
                    <a href="customerPage.php" class="text-white"><i class="fa fa-angle-right"></i> Home</a><br>
                    <a href="#aboutus" class="text-white"><i class="fa fa-angle-right"></i> About us</a><br>
                    <a href="cart.php" class="text-white"><i class="fa fa-angle-right"></i> Cart</a>
                </div>
                <div class="col-md-3">
                    <h4 class="text-white">Adddress</h4>
                    <p class="text-white">
                        Nat’l Hi-way Brgy. Paciano Rizal,
                        Calamba, Laguna, Philippines.
                    </p>
                    <a href="tel:+639995602388" class="text-white"><i class="fa fa-phone"></i> +639995602388 </a><br>
                    <a href="mailto:graphiteeshirt@gmail.com" class="text-white"><i class="fa fa-envelope"></i> graphiteeshirt@gmail.com </a>
                </div>
                <div class="col-md -6">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d15470.61447039833!2d121.12587147802438!3d14.21504889078182!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x33bd63ad17b62cf1%3A0xfa93a2543527b80b!2sPaciano%20Rizal%2C%20Calamba%2C%204027%20Laguna!5e0!3m2!1sen!2sph!4v1666824671452!5m2!1sen!2sph" class="w-100" height="250" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
            </div>
        </div>
    </div>
    <div class="py-2 bg-danger">
        <div class="text-center">
            <p class="text-white mb-0">All rights reserved. Copyright @ GraphiteeShirt - <?= date('Y') ?> </p>
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