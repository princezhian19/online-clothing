<?php
session_start();
//if (!isset($_SESSION["userid"])) {
//    header("Location: index.php");
//    exit();
//}
//if ($_SESSION["verifiedAt"] == null) {
//    header("Location: verification.php");
//    exit();
//}
include "classes/connectiondb.php";
include "classes/viewproductModel.php";
if (isset($_GET['t'])) {
    $tracking_no = $_GET['t'];
    $checkTrackingID = new viewproducts();
    $result = $checkTrackingID->checkTrackingA($tracking_no);

    if ($result->rowCount() < 0) {
?>
        <h4>Something went wrong</h4>
    <?php
        die();
    }
} else {
    ?>
    <h4>Something went wrong</h4>
<?php
    die();
}
$data = $result->fetchAll(PDO::FETCH_ASSOC);
if ($_SESSION['userrole'] == 1) {
    $styleOrder = "style='display:none;'";
}
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>View Products</title>

    <!-- Custom fonts for this template -->
    <link href="vendors/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="dashboard/css/sb-admin-2.min.css" rel="stylesheet">

    <!-- Custom styles for this page -->
    <link href="vendors/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
    <script src="https://kit.fontawesome.com/yourcode.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css">
    <link rel="stylesheet" href="styles/viewProduct.css">
    <link rel="icon" href="assets/logo.png" type="image/ico">


</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="adminDashboard.php">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fa-solid fa-shirt"></i>
                </div>
                <div class="sidebar-brand-text mx-3">Graphitee <sup>Shirt</sup></div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item">
                <a class="nav-link" href="adminDashboard.php">
                    <i class="fa-solid fa-shirt"></i>
                    <span>Dashboard</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Interface
            </div>

            <!-- Nav Item - Pages Collapse Menu -->
            
            <?php include 'template/navitem.php'; ?>



            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->




            <!-- Divider -->


            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <form class="form-inline">
                        <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                            <i class="fa fa-bars"></i>
                        </button>
                    </form>



                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <?php
                        $views = new viewproducts();
                        $prods = $views->getAllQuantity("products");
                        $low = $prods->rowCount();


                        if ($low == 0) {
                            $none = "style='display:none;'";
                        } else {
                            $none = "";
                            $shake = "fa-shake";
                        }

                        ?>

                        <li class="nav-item dropdown no-arrow mx-1">
                            <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-bell fa-fw <?php echo $shake ?>"></i>
                                <!-- Counter - Alerts -->
                                <span <?php echo $none ?> class="badge badge-danger badge-counter"> <?php echo $low ?> </span>
                            </a>

                            <!-- Dropdown - Alerts -->
                            <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="alertsDropdown">
                                <h6 class="dropdown-header">
                                    Alerts Center
                                </h6>
                                <?php
                                $view = new viewproducts();
                                $prod = $view->getAllQuantity("products");

                                if ($prod->rowCount() > 0) {
                                    foreach ($prod as $items) {

                                ?>
                                        <a class="dropdown-item d-flex align-items-center" href="#">
                                            <div class="mr-3">
                                                <div class="icon-circle bg-warning">
                                                    <i class="fas fa-exclamation-triangle text-white"></i>
                                                </div>
                                            </div>
                                            <div>
                                                <div class="small text-gray-500"><?php echo date('F Y'); ?></div>
                                                Low stocks on <span><?= $items['name']; ?></span>
                                            </div>
                                        </a>




                                <?php
                                    }
                                } else {
                                    echo "No alert messages";
                                }

                                ?>


                                <a class="dropdown-item text-center small text-gray-500" href="#">Show All Alerts</a>
                            </div>
                        </li>




                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?php echo $_SESSION["usernameid"]; ?></span>
                                <i class="fa-solid fa-user"></i>
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
                                <a class="dropdown-item" href="#" <?php echo $styleOrder ?>>
                                    <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                                    My Orders
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
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800">Orders</h1>
                    <p class="mb-4">View Orders</p>

                    <!-- DataTales Example -->
                    <div class="py-5">
                        <div class="container">
                            <div class="card">
                                <div class="row">
                                    <div class="col-md-12">

                                        <div class="card-header">
                                            Orders
                                            <a href="orders.php" class="btn btn-sm float-right"><i class="fa fa-reply"></i> Back</a>
                                        </div>
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <h4>Delivery Details</h4>
                                                    <hr>
                                                    <div class="row">
                                                        <div class="col-md-12 mb-2">
                                                            <label class="fw-bold">Name</label>
                                                            <div class="border p-1">
                                                                <?= $data[0]["name"]; ?>
                                                            </div>

                                                        </div>
                                                        <div class="col-md-12 mb-2">
                                                            <label class="fw-bold">Email</label>
                                                            <div class="border p-1">
                                                                <?= $data[0]["email"]; ?>
                                                            </div>

                                                        </div>
                                                        <div class="col-md-12 mb-2">
                                                            <label class="fw-bold">Phone</label>
                                                            <div class="border p-1">
                                                                <?= $data[0]["phone"]; ?>
                                                            </div>

                                                        </div>

                                                        <div class="col-md-12 mb-2">
                                                            <label class="fw-bold">Address</label>
                                                            <div class="border p-1">
                                                                <?= $data[0]["address"]; ?>
                                                            </div>

                                                        </div>
                                                        <div class="col-md-12 mb-2">
                                                            <label class="fw-bold">Pincode</label>
                                                            <div class="border p-1">
                                                                <?= $data[0]["pincode"]; ?>
                                                            </div>
                                                        </div>
                                                        <?php if($data[0]["payment_mode"] === 'GCASH') { ?>                               
                                                            <div class="col-md-12 mb-2">
                                                                <label class="fw-bold">
                                                                    Proof of payment
                                                                </label>
                                                                <div class="border p-1">
                                                                    <img src="uploads/<?= $data[0]['proof_of_payment']; ?>" width="300px" height="500px" alt="<?= 'proof of payment'; ?>">
                                                                </div>
                                                            </div>
                                                        <?php } ?>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <h4>Order Details</h4>
                                                    <hr>
                                                    <table class="table">
                                                        <thead>
                                                            <tr>
                                                                <th>Product</th>
                                                                <th>Price</th>
                                                                <th>Quantity</th>
                                                                <th>Size</th>

                                                            </tr>
                                                        </thead>
                                                        <tbody>


                                                            <?php
                                                            $order = new viewproducts();
                                                            $userId = $data[0]['user_id'];
                                                            $orderItems = $order->displayOrderA($tracking_no, $userId);

                                                            if ($orderItems->rowCount() > 0) {
                                                                foreach ($orderItems as $items) {

                                                            ?>
                                                                    <tr>
                                                                        <td class="align-middle">
                                                                            <img src="uploads/<?= $items['image']; ?>" width="50px" height="50px" alt="<?= $items['name']; ?>">
                                                                            <?= $items['name']; ?>
                                                                        </td>
                                                                        <td class="align-middle">
                                                                            ??? <?= $items['price']; ?>
                                                                        </td>
                                                                        <td class="align-middle">
                                                                            <?= $items['qty']; ?>
                                                                        </td>
                                                                        <td class="align-middle">
                                                                            <?= $items['size']; ?>
                                                                        </td>

                                                                    </tr>
                                                            <?php
                                                                }
                                                            }
                                                            ?>
                                                        </tbody>
                                                    </table>

                                                    <hr>

                                                    <h4>Total Price: <span class="float-end">???<?= $data[0]['total_price']; ?></span></h4>
                                                    <hr>
                                                    <label class="fw-bold">Payment Mode:</label>
                                                    <div class="border p-1 mb-3">

                                                        <?= $data[0]['payment_mode']; ?>
                                                    </div>
                                                    <label class="fw-bold">Status:</label>
                                                    <div class="mb-3">
                                                        <form action="includes/updatestatusInclude.php" method="POST">
                                                            <input type="hidden" name="tracking_no" value="<?= $data[0]['tracking_id'] ?>">
                                                            <select name="order_status" id="" class="form-select w-100 mb-3">
                                                                <option value="0" <?= ($data[0]['status'] == 0 ? "selected" : "") ?>>Under Process</option>
                                                                <option value="1" <?= ($data[0]['status'] == 1 ? "selected" : "") ?>>Completed</option>
                                                                <option value="2" <?= ($data[0]['status'] == 2 ? "selected" : "") ?>>Cancelled</option>
                                                            </select>
                                                            <button name="updateStatus" type="submit" class="btn btn-primary">Update Status</button>
                                                        </form>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>







                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; GraphiteeShirt 2022</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">??</span>
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





</body>

</html>