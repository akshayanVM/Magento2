require(["jquery"], function ($) {
    $(document).ready(function () {
        $(" .action.tocart.primary").click(function (e) {
            e.preventDefault();
            let productId = $(this).data("product-cart-entity-id");
            let formKey = $(this).data("cart-form-key");
            // var formKeyTest = $('input[name="form_key"]').val();
            console.log(productId);
            // console.log(formKeyTest);
            $.ajax({
                // url: "http://test.magento2.com/index.php/wishlist/index/add/", // Replace with your controller URL
                url: "/checkout/cart/add/product/" + productId + "/",
                type: "POST",
                // dataType: "json",
                data: { productId: productId, form_key: formKey }, // it wasnt working because the data name was supposed to be 'form_key'
                success: function (response) {
                    console.log(response);
                    window.location.href = "/checkout/cart";
                    // if (response.success) {
                    //     alert("Value sent successfully!");
                    // } else {
                    //     alert("Failed to send value.");
                    // }
                },
                error: function (xhr, status, error) {
                    console.error("AJAX Error:", status, error);
                    // alert("Error occurred while sending value.");
                },
            });
        });
    });
});

//generate the form key
