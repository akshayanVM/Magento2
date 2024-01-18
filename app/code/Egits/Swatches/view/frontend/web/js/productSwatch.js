// Define a global variable to store the selected product ID
var selectedProductId = null;

require(["jquery"], function ($) {
    $(document).ready(function () {
        $(" .final.swatch-option.color").click(function (e) {
            e.preventDefault();
            let swatchIdFinal = $(this).data("swatch-data-id-final");
            let formKeyFinal = $(this).data("swatch-form-key-final");
            let colorFinal = $(this).data("swatch-color");
            let swatchPrice = $(this).data("swatch-price");
            // get the element used for the click event and store it
            var swatchElement = $(this);
            // use the stored element and find the closest element and change the image
            var productImage = swatchElement
                .closest(".product-item")
                .find(".product-image-photo");

            var priceContainer = swatchElement
                .closest(".product-item")
                .find(".price-wrapper");

            // var productPrice = swatchElement.closest(".product-item").find
            // var formKeyTest = $('input[name="form_key"]').val();
            console.log(swatchIdFinal);
            console.log(formKeyFinal);
            console.log(colorFinal);
            console.log(swatchPrice);

            // store the selected swatch ID into the global variable

            selectedProductId = swatchIdFinal;
            console.log(selectedProductId);

            $.ajax({
                // url: "http://test.magento2.com/index.php/wishlist/index/add/", // Replace with your controller URL
                url:
                    "/swatches/ajax/media/?product_id=" +
                    swatchIdFinal +
                    "&isAjax=true",
                type: "GET",
                dataType: "json",
                data: { product_id: swatchIdFinal, form_key: formKeyFinal },
                success: function (response) {
                    // console.log(response);
                    var swatchImage = response.large;
                    console.log(swatchImage);

                    productImage.attr("src", swatchImage);
                    priceContainer.find(".price").text(swatchPrice);
                    // window.location.href = "/wishlist/index/index";

                    // var selectedProductPrice =
                    //     getPriceForProduct(selectedProductId);
                    // priceContainer.find(".price").text(selectedProductPrice);
                },
                error: function (xhr, status, error) {
                    console.error("AJAX Error:", status, error);
                    // alert("Error occurred while sending value.");
                },
            });
        });

        // add to cart
        // $(" .final.action.tocart.primary").click(function (e) {
        //     e.preventDefault();
        //     // Check if a product is selected
        //     if (selectedProductId !== null) {
        //         // Construct the URL to add the product to the cart using selectedProductId
        //         var addToCartUrl =
        //             "/checkout/cart/add/product/" + selectedProductId + "/";

        //         // Redirect to the cart or perform any other action
        //         // window.location.href = addToCartUrl;
        //         console.log(addToCartUrl);
        //     } else {
        //         // Handle the case where no product is selected
        //         console.error("No product selected!");
        //     }

        //     $.ajax({
        //         // url: "http://test.magento2.com/index.php/wishlist/index/add/", // Replace with your controller URL
        //         url: addToCartUrl,
        //         type: "POST",
        //         // dataType: "json",
        //         data: { productId: productId, form_key: formKey }, // it wasnt working because the data name was supposed to be 'form_key'
        //         success: function (response) {
        //             console.log(response);
        //             window.location.href = "/checkout/cart";
        //             // if (response.success) {
        //             //     alert("Value sent successfully!");
        //             // } else {
        //             //     alert("Failed to send value.");
        //             // }
        //         },
        //         error: function (xhr, status, error) {
        //             console.error("AJAX Error:", status, error);
        //             // alert("Error occurred while sending value.");
        //         },
        //     });
        // });
        $(".final.action.tocart.primary").click(function (e) {
            if (selectedProductId === null) {
                e.preventDefault();
                // alert("Please select a product");
                $(this)
                    .closest(".product-item-actions")
                    .find(".error-message")
                    .show();

                setTimeout(function () {
                    $(".error-message").hide();
                }, 5000);
                return; // Stop further execution
            }

            // Check if a product is selected
            // if (selectedProductId !== null) {
            // Construct the URL to add the product to the cart using selectedProductId
            var addToCartUrl =
                "/checkout/cart/add/product/" + selectedProductId + "/";
            console.log("Add to Cart URL:", addToCartUrl);

            // Your AJAX call to add product to cart
            $.ajax({
                url: addToCartUrl,
                type: "POST",
                data: { form_key: $('input[name="form_key"]').val() }, // Make sure you get the correct form key value
                success: function (response) {
                    console.log("Response:", response);
                    // Redirect to cart or perform other actions upon successful addition
                    // if (selectedProductId !== null) {
                    //     window.location.href = "/checkout/cart";
                    // }
                },
                error: function (xhr, status, error) {
                    console.error("AJAX Error:", status, error);
                },
            });
            // alert("test");
            // } else {
            // Handle the case where no product is selected
            // console.error("No product selected!");
            // // Display the error message div
            // $(this)
            //     .closest(".product-item-actions")
            //     .find(".error-message")
            //     .show();
            // // // Optionally, you can hide the error message after a few seconds using a setTimeout function
            // setTimeout(function () {
            //     $(".error-message").hide();
            // }, 5000); // This will hide the error message after 5 seconds (5000 milliseconds)

            // return;
            // }
        });
    });
});
