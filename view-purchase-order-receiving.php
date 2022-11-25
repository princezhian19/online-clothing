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
include "classes/connectiondb.php";
include "classes/viewsupplieritemModel.php";
include "classes/viewsupplierModel.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Add Item</title>
    <link rel="icon" href="assets/logo.png" type="image/ico">

    <!-- Custom fonts for this template -->
    <link href="vendors/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">


    <!-- Custom styles for this template -->
    <link href="dashboard/css/sb-admin-2.min.css" rel="stylesheet">

    <!-- Custom styles for this page -->
    <link href="vendors/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
    <script src="https://kit.fontawesome.com/yourcode.js" crossorigin="anonymous"></script>
    <script src="script/addProduct.js"></script>
    <script src="script/storage.js"></script>
    <script src="script/table.js"></script>
    <script src="js/alertify.min.js"></script>
    <?php if(!defined('base_url')) define('base_url','http://localhost/online-clothing/'); ?>
    <script>
        var _base_url_ = '<?php echo base_url ?>';
    </script>
    <link rel="stylesheet" href="styles/addProduct.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css">
    <link rel="stylesheet" href="styles/viewProduct.css">
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css" />

</head>

<body id="page-top" onload="init()">


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
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
                    <i class="fa-brands fa-dropbox"></i>
                    <span>Products</span>
                </a>
                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Products:</h6>
                        <a class="collapse-item" href="add-product.php">Add Products</a>
                        <a class="collapse-item" href="view-products.php">View Products</a>
                    </div>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapse3" aria-expanded="true" aria-controls="collapse3">
                    <i class="fa-brands fa-dropbox"></i>
                    <span>Suppliers</span>
                </a>
                <div id="collapse3" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Products:</h6>
                        <a class="collapse-item" href="add-supplier.php">Add Supplier</a>
                        <a class="collapse-item" href="view-suppliers.php">View Suppliers</a>
                    </div>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapse4" aria-expanded="true" aria-controls="collapse4">
                    <i class="fa-brands fa-dropbox"></i>
                    <span>Items </span>
                </a>
                <div id="collapse4" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Items:</h6>
                        <a class="collapse-item" href="add-supplier-item.php">Add Items</a>
                        <a class="collapse-item" href="view-suppliers.php">View items</a>
                    </div>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapse5" aria-expanded="true" aria-controls="collapse4">
                    <i class="fa-brands fa-dropbox"></i>
                    <span>Purchase Order </span>
                </a>
                <div id="collapse5" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Purchase Order:</h6>
                        <a class="collapse-item" href="add-purchase-order.php">Add PO</a>
                        <a class="collapse-item" href="view-purchase-order.php">View PO</a>
                    </div>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities" aria-expanded="true" aria-controls="collapseUtilities">
                    <i class="fas fa-fw fa-wrench"></i>
                    <span>Orders</span>
                </a>
                <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Orders</h6>
                        <a class="collapse-item" href="orders.php">View orders</a>

                    </div>
                </div>
            </li>



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
                        <?php
                        $views = new viewsupplieritems();
                        $prods = $views->getAllQuantity("supplier_products");
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
                                $view = new viewsuppliers();
                                $prod = $view->getAllQuantity("purchase_orders");

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
                <?php
                                $view = new viewsuppliers();
                                $suppliers = $view->getAll("purchase_orders");

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
                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800">Purchase Order Receiving</h1>
                    <div class="card-body">
                        <form action="includes/addsupplieritemInclude.php" method="POST" onsubmit="addsuccess()">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="status" class="control-label">Supplier </label>
                                            <?php 
                                                $view = new viewsuppliers();
                                                $pos = $view->getByCode('purchase_orders', $_GET['poId']);
                                                $pos = $pos->fetchAll(PDO::FETCH_ASSOC);
                                            ?>
                                                <?php if($pos) { ?>
                                                    <input type="hidden" required name="unit" id="supplierIdZ" value="<?= $pos[0]['supplier_id'] ?>" class="form-control mb-2" >
                                                    <input type="text" required name="unit" id="supplierId" class="form-control mb-2" >
                                                <?php } ?>
                                           
                                    </div>
                                </div>
                            
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-dark">Suppliers table</h6>
                        </div>

                        
                        <div class="card-body" id="products_table">
                            <div class="table-responsive">
                                <table id="" class="table table-striped table-bordered" style="width:100%">
                                    <thead class="">
                                        <tr>
                                            <th>Unit</th>
                                            <th>Quantity</th>
                                            <th>Item</th>
                                            <th>Cost</th>
                                            <th>Total</th>
                                        </tr>
                                    </thead>
                                    <tbody id="orders">
                                    <?php 
                                        $view = new viewsuppliers();
                                        $po_items = $view->getByCode('purchase_orders', $_GET['poId']);
                                        $po = $po_items->fetchAll(PDO::FETCH_ASSOC);
                                            foreach ($po as $po_item) {
                                    ?>           
                                            <tr>
                                                <td><?= $po_item['unit'] ?> </td>  
                                                <td><?= $po_item['quantity'] ?> </td>
                                                <td><script>document.write(storage.getItemNameById("<?= $po_item['supplier_product_id'] ?>"));</script></td>
                                                <td><?= $po_item['cost'] ?> </td>  
                                                <td><?= $po_item['cost'] *  $po_item['quantity'] ?> </td>  
                                            </tr>
                                        <?php 
                                        }
                                    
                                    ?>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>Unit</th>
                                            <th>Quantity</th>
                                            <th>Item</th>
                                            <th>Cost</th>
                                            <th>Total</th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                                </div>
                            </div>
                            <button type="button" name="save_orders_btn" class="form-control btn btn-success mb-2">receive</button>
                        </form>

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
                                                        
        <script>
            <?php if (isset($_SESSION['message'])) { ?>

                alertify.set('notifier', 'position', 'top-right');
                alertify.success('<?= $_SESSION['message']; ?>');
            <?php }
            unset($_SESSION['message']);
            ?>
                // const onSupplierChange = () => {
                //     var selectSupplierEl = document.getElementById("select-supplier");
                //     var id = selectSupplierEl.value
                //     $.ajax({
                //     url:_base_url_+"api/purchaseorder/index.php?get_supplier_by_id=true&supplier_id="+id,
                //     cache: false,
                //     contentType: false,
                //     processData: false,
                //     method: 'GET',
                //     type: 'GET',
                //     dataType: 'json',
                //     success: (resp) => {
                //         var selectItemEl = document.getElementById("selectItemEl");
                //         $('#selectItemEl').empty()
                //         resp.map(item => {
                //             console.log(item)
                //             let newOption = new Option(item.name,item.id);
                //             console.log(newOption)
                //             selectItemEl.add(newOption,undefined);
                //         })
                //     }
                //     })
                // }
                
                function addNewItem() {
                    var ordersTable = document.getElementById("orders");
                    var row = table.insertRow(0);
                    var cell1 = row.insertCell(0);
                    var cell2 = row.insertCell(1);
                    cell1.innerHTML = "NEW CELL1";
                    cell2.innerHTML = "NEW CELL2";
                }
                function add() {
                    var selectSupplierEl = document.getElementById("select-supplier");
                    var selectItemEl = document.getElementById("selectItemEl");
                    var supplier_id = selectSupplierEl.value;
                    var item_id = selectItemEl.value;
                    var unit = document.getElementById("unit").value;
                    var quantity = document.getElementById("quantity").value;
                    console.log({
                        supplier_id,item_id,unit,quantity
                    })
                    var itemList = storage.getItems('suppliers_items');
                    var item = itemList.find(it => it.id == item_id);



                    storage.addItem('tableItems',{
                        supplier_product_id: item.id,
                        item_id,
                        supplier_id,
                        item_id,unit,
                        quantity,
                        name: item.name, 
                        cost: item.cost, 
                        total: Number(quantity) * Number(item.cost)
                    });
                    storage.loadTableItems();                    
                } 
        </script>
        <script>
            loadItems();
            function loadDatas() {
                const poId = document.getElementById('supplierIdZ').value;
                const suppliers = storage.getItems('suppliers');
                const supplier = suppliers.find(sup => sup.id == poId);
                if(supplier) {
                    document.getElementById('supplierId').value = supplier.name;
                }
            }
            function init() {
                // onSupplierChange();
                // storage.loadTableItems();
                loadDatas();
            }
            // function loadTableItems() {
            //     const currentOrders = storage.getItems('tableItems');
            //     tbl.clear('orders');
            //     currentOrders.map((item) => {
            //         tbl.addRow('orders', {
            //             item_id: item.item_id,
            //             unit: item.unit, quantity: item.quantity, name: item.name, cost: item.cost, total: item.total
            //         })
            //     })
            // }
        </script>





</body>

</html>