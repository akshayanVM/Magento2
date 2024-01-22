require(["jquery"], function ($) {
    $(document).ready(function () {
        $(" .action.towishlist").click(function (e) {
            e.preventDefault();
            let productId = $(this).data("product-entity-id-final");
            let formKey = $(this).data("form-key-final");
            // var formKeyTest = $('input[name="form_key"]').val();
            console.log(productId);
            console.log("formkey:", formKey);
            $.ajax({
                // url: "http://test.magento2.com/index.php/wishlist/index/add/", // Replace with your controller URL
                url: "/wishlist/index/add/product/" + productId + "/",
                type: "POST",
                // dataType: "json",
                data: { productId: productId, form_key: formKey }, // it wasnt working because the data name was supposed to be 'form_key'
                success: function (response) {
                    console.log(response);
                    window.location.href = "/wishlist/index/index";
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