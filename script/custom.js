$(document).ready(function () {

    $(document).on('click', '.deleteProduct', function (e) {
        e.preventDefault();


        var id = $(this).val();
        //alert(id);
        swal({
            title: "Are you sure?",
            text: "Once deleted, you will not be able to recover this product",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
            .then((willDelete) => {
                if (willDelete) {
                    $.ajax({
                        method: "POST",
                        url: "includes/deleteproductInclude.php",
                        data: {
                            'prodid': id,
                            'deleteSupplierProduct': true
                        },
                        success: function (response) {

                            if (response == 200) {
                                swal("Success!", "Product Deleted Successfully!", "success");
                                $("#products_table").load(location.href + " #products_table");
                            }
                            else if (response == 500) {
                                swal("Error!", "Something went wrong", "error");
                            }

                        }
                    });
                }
            });

    });
    $(document).on('click', '.deleteSupplierProduct', function (e) {
        e.preventDefault();


        var id = $(this).val();
        //alert(id);
        swal({
            title: "Are you sure?",
            text: "Once deleted, you will not be able to recover this product",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
            .then((willDelete) => {
                if (willDelete) {
                    $.ajax({
                        method: "POST",
                        url: "includes/deleteproductInclude.php",
                        data: {
                            'prodid': id,
                            'deleteSupplierProduct': true
                        },
                        success: function (response) {

                            if (response == 200) {
                                swal("Success!", "Product Deleted Successfully!", "success");
                                $("#products_table").load(location.href + " #products_table");
                            }
                            else if (response == 500) {
                                swal("Error!", "Something went wrong", "error");
                            }

                        }
                    });
                }
            });

    });

});



$(document).ready(function () {


    $(document).on('click','.increment_btn', function (e){

        e.preventDefault();
        if(!shouldIncrease) {
            shouldIncrease = true;
            return;
        }
        var qty = $(this).closest('.product_data').find('.qty_input').val();

        var value = parseInt(qty, 10);
        value = isNaN(value) ? 0 : value;
        // if (value < 10) {
            value++;

            $(this).closest('.product_data').find('.qty_input').val(value);
        // }

    });

    $(document).on('click','.decerement_btn', function (e){

        e.preventDefault();

        var qty = $(this).closest('.product_data').find('.qty_input').val();

        var value = parseInt(qty, 10);
        value = isNaN(value) ? 0 : value;
        if (value > 1) {
            value--;

            $(this).closest('.product_data').find('.qty_input').val(value);
        }

    });

    $(document).on('click','.addtocartBtn', function (e){
        e.preventDefault();

        var qty = $(this).closest('.product_data').find('.qty_input').val();
        var size = $(this).closest('.product_data').find('.sizes').val();
        var color = $(this).closest('.product_data').find('.color').val();
        var code = $(this).closest('.product_data').find('.code').val();
        var prod_id = $(this).val();
        var data = {
            prod_id: prod_id,
            prod_qty: qty,
            code: code,
            sizes: size,
            color: color,
            scope: "add"
        }
        console.log(data)
        $.ajax({
            method: "POST",
            url: "includes/cartIncludes.php",
            data: data,

            success: function (response) {
                if (response == 401) {
                    alertify.success("Login to continue!");
                }
                else if (response.includes('existing')) {
                    alertify.success("Product already in cart");

                }
                else if(response.includes('Available stocks')) {
                    alertify.success(response);
                }
                else if(response.includes('Color not available') || response.includes('Color/Size not available')) {
                    alertify.warning(response);
                }
                else if (response == 201) {
                    alertify.success("Product Added to cart!");
                    window.location.href = './customerPage.php';
                }

                else if (response == 'Color/Size not available') {
                    alertify.success(response);
                    window.location.href = './customerPage.php';
                }
                
                else if (response == 500) {
                    alertify.success("Something went wrong!");
                }
                

            }
        });


    });
    $(document).on('click','.addtocartBtnCustom', function (e){
        e.preventDefault();
        $('#form1').submit()
    });
    var isZero = false;
    
    $("form[name='uploader']").on("submit", function(ev) {
        ev.preventDefault(); // Prevent browser default submit.
        var small2 = $('#small2').val();
        var medium2 = $('#medium2').val();
        var large2 = $('#large2').val();
        var userid = $('#userid').val();
        var c = document.getElementById('image_reply');
        var i = large2 > 0?1:0;
        var base64 = c.getElementsByTagName('canvas')[isZero?0:1].toDataURL("image/jpeg");
        isZero = !isZero;
        // var formData = new FormData(this);
        // formData.append('add_custom_product_btn', true);
        console.log(base64);
        $.ajax({
          url: "includes/addproductInclude.php",
          method: 'POST',
        type: 'POST',
          data: {
            add_custom_product_btn: true,
            base64: base64,
            sizes: 'S',
            prod_id: 'S',
            prod_qty: small2,
            user_id: userid,
            scope: 'add'
          },
          success: function (msg) {
            alertify.success("Product Added to cart!");
          },
        });
          
    });
    function saveC(size, qty) {
        $.ajax({
            method: "POST",
            url: "includes/cartIncludes.php",
            data: {
                // "prod_id": prod_id,
                "prod_id": 6,
                "prod_qty": qty,
                "sizes":size,
                "scope": "add"
            },

            success: function (response) {
                if (response == 401) {
                    alertify.success("Login to continue!");
                }
                else if (response == "existing") {
                    alertify.success("Product already in cart");

                }
                else if (response == 201) {
                    alertify.success("Product Added to cart!");
                }


                else if (response == 500) {
                    alertify.success("Something went wrong!");

                }


            }
        });
    }
    var shouldIncrease = true;
    $(document).on('click', '.updateQty', function () {

        var qty = $(this).closest('.product_data').find('.qty_input').val();

        var prod_id = $(this).closest('.product_data').find('.prodID').val();

        
        // var size = $(this).closest('.product_data').find('.sizes').val();
        // var color = $(this).closest('.product_data').find('.color').val();
        // var code = $(this).closest('.product_data').find('.code').val();

alert('a');

        $.ajax({
            method: "POST",
            url: "includes/cartIncludes.php",
            data: {
                "prod_id": prod_id,
                "prod_qty": qty,
                "scope": "update"
            },
            success: function (response) {
                if(response.includes('Stock available is only')) {
                    alertify.warning(response);
                    shouldIncrease = false;
                    $('#pqty').val(1);
                }else {
                    shouldIncrease = true;
                }
            }
        });


    });

    $(document).on('click','.deleteCart', function () {

        var cart_id = $(this).val();
       // alert(cart_id);
       $.ajax({
        method: "POST",
        url: "includes/cartIncludes.php",
        data: {
            "cart_id": cart_id,
            "scope": "delete"
        },
        success: function (response) {

            if (response == 200) {
                alertify.success("Item Deleted to successfully!");
                $('#myCart').load(location.href + " #myCart");
            }
            else
            {
                alertify.success(response);
            }
            
        }
    });
       
        
    });

});