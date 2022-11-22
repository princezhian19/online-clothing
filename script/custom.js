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
                            'deleteProduct': true
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

        var qty = $(this).closest('.product_data').find('.qty_input').val();

        var value = parseInt(qty, 10);
        value = isNaN(value) ? 0 : value;
        if (value < 10) {
            value++;

            $(this).closest('.product_data').find('.qty_input').val(value);
        }

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
        var prod_id = $(this).val();
        $.ajax({
            method: "POST",
            url: "includes/cartIncludes.php",
            data: {
                "prod_id": prod_id,
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


    });

    $(document).on('click', '.updateQty', function () {

        var qty = $(this).closest('.product_data').find('.qty_input').val();

        var prod_id = $(this).closest('.product_data').find('.prodID').val();

        $.ajax({
            method: "POST",
            url: "includes/cartIncludes.php",
            data: {
                "prod_id": prod_id,
                "prod_qty": qty,
                "scope": "update"
            },
            success: function (response) {
                
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