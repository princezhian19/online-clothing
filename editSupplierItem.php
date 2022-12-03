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
if (isset($_SESSION["userid"])) {
    if ($_SESSION['userrole'] == 0) {
        header("Location: customerPage.php");
        exit();
    }
}
if ($_SESSION['userrole'] == 1) {
    $styleOrder = "style='display:none;'";
}

include 'classes/connectiondb.php';
include "classes/viewsupplieritemModel.php";
include 'classes/viewsupplierModel.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Edit Supplier item</title>

    <!-- Custom fonts for this template -->
    <link href="vendors/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">


    <!-- Custom styles for this template -->
    <link href="dashboard/css/sb-admin-2.min.css" rel="stylesheet">

    <!-- Custom styles for this page -->
    <link href="vendors/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
    <link rel="stylesheet" href="styles/addProduct.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css">
    <link rel="stylesheet" href="styles/viewProduct.css">
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css" />
    <link rel="icon" href="assets/logo.png" type="image/ico">

</head>

<body id="page-top">
    <div class="alert" id="alertprod2">
        <span>Supplier Updated Successfully!</span>
    </div>

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
                        $views = new viewsupplieritems();
                        $sups = $views->getAllQuantity("supplier_products");
                        $low = $sups->rowCount();


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
                                $view = new viewsupplieritems();
                                $prod = $view->getAllQuantity("supplier_products");

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
                                    Activity Log
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
                    <h1 class="h3 mb-2 text-gray-800">Edit suppliers item</h1>


                    <?php


                    if (isset($_GET['myid'])) {


                        $id = ($_GET['myid']);
                        $supplier = new viewsupplieritems();
                        $sup = $supplier->getbyId("supplier_products", $id);

                        if ($sup->rowCount() > 0) {
                            foreach ($sup as $items) {

                    ?>
                                <div class="card-body">
                                    <form action="includes/editsupplieritemInclude.php" method="POST">
                                        <div class="row">
                                        <input id="supitemid" type="hidden" name="supitemid" value="<?= $items['id']; ?>">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="status" class="control-label">Supplier</label>
                                                    <select name="supplier_id" id="status" class="custom-select selevt">
                                                        <?php 
                                                            $view = new viewsuppliers();
                                                            $suppliers = $view->getAll("suppliers");
                                                            if ($suppliers->rowCount() > 0) {
                                                                foreach ($suppliers as $supplier) {  
                                                        ?>
                                                                    <option value="<?= $supplier['id'] ?>"  <?php if($supplier['id'] == $items['supplier_id']) echo 'selected'; ?>><?= $supplier['name']; ?></option>
                                                                <?php } ?>
                                                            <?php } ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <label class="mb-0">Name</label>
                                                <input type="text" required name="name" placeholder="Enter item name" class="form-control mb-2" value="<?= $items['name']; ?>">
                                            </div>
                                            <div class="col-md-6">
                                                <label class="mb-0">Slug</label>
                                                <input type="text" required name="slug" placeholder="Enter slug name" class="form-control mb-2" value="<?= $items['slug']; ?>">
                                            </div>
                                            <div class="col-md-6">
                                                <label class="mb-0">Size</label>
                                                <select name="size" id="size" class="custom-select selevt" >
                                                    <option value="S" <?php if($items['size'] =='S') echo 'selected'; ?>>Small</option>
                                                    <option value="M" <?php if($items['size'] == 'M') echo 'selected'; ?>>Medium</option>
                                                    <option value="L" <?php if($items['size'] == 'L') echo 'selected'; ?>>Large</option>
                                                </select>
                                            </div>
                                            
                                            <div class="col-md-6">
                                                <label class="mb-0">Color</label>
                                                <select name="color" id="color" class="custom-select selevt">
                                                    <option value="black" <?php if($items['color'] =='black') echo 'selected'; ?>>Black</option>
                                                    <option value="white" <?php if($items['color'] =='white') echo 'selected'; ?>>White</option>
                                                    <option value="red" <?php if($items['color'] =='red') echo 'selected'; ?>>Red</option>
                                                    <option value="green" <?php if($items['color'] =='green') echo 'selected'; ?>>Green</option>
                                                    <option value="orange" <?php if($items['color'] =='orange') echo 'selected'; ?>>Orange</option>
                                                    <option value="yellow" <?php if($items['color'] =='yellow') echo 'selected'; ?>>Yellow</option>
                                                    <option value="pink" <?php if($items['color'] =='pink') echo 'selected'; ?>>Pink</option>
                                                    <option value="brown" <?php if($items['color'] =='brown') echo 'selected'; ?>>Brown</option>
                                                </select>
                                            </div>
                                            <div class="col-md-12">
                                                <label class="mb-0">Description</label>
                                                <textarea rows="3" type="text" required name="description" placeholder="Enter description" class="form-control mb-2"><?= $items['description']; ?></textarea>
                                            </div>
                                            <div class="col-md-6">
                                                <label class="mb-0">Cost</label>
                                                <input type="text" required name="cost" description="cost" placeholder="Enter item price" class="form-control mb-2" value="<?= $items['cost']; ?>">
                                            </div>
                                            <div class="col-md-6">
                                                <label class="mb-0">Status</label>
                                                <select name="status" id="status" class="custom-select selevt">
                                                    <option value="1" <?php if($items['status'] == 1) echo 'selected'; ?> >active</option>
                                                    <option value="0" <?php if($items['status'] == 0) echo 'selected'; ?> >inactive</option>
                                                </select>
                                            </div>
                                            
                                            <div class="col-md-12">
                                                <button type="submit" name="update_supplieritem_btn" class="btn btn-success" id="update_button">Save</button>
                                            </div>

                                        </div>
                                    </form>

                                </div>
                    <?php
                            }
                        } else {
                            echo "Product not found for given ID";
                        }
                    } else {
                        echo "ID missing from url";
                    }
                    ?>

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
        <script src="https://kit.fontawesome.com/yourcode.js" crossorigin="anonymous"></script>
        <script src="script/addProduct.js"></script>
        <script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>



        <script>
            <?php if (isset($_SESSION['message'])) { ?>

                alertify.set('notifier', 'position', 'top-right');
                alertify.success('<?= $_SESSION['message']; ?>');
            <?php }
            unset($_SESSION['message']);
            ?>
        </script>





</body>

</html>