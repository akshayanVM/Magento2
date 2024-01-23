// Define a global variable to store the selected product ID
var selectedProductId = null;

require(["jquery"], function ($) {
    $(document).ready(function () {
        $(" .final.earphone.swatch-option.color").click(function (e) {
            e.preventDefault();
            let swatchIdFinal = $(this).data("earphone-swatch-data-id-final");
            let formKeyFinal = $(this).data("earphone-swatch-form-key-final");
            let colorFinal = $(this).data("earphone-swatch-color");
            let swatchPrice = $(this).data("earphone-swatch-price");
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
                    var swatchImage = response.large;
                    console.log(swatchImage);

                    productImage.attr("src", swatchImage);
                    priceContainer.find(".price").text(swatchPrice);
                },
                error: function (xhr, status, error) {
                    console.error("AJAX Error:", status, error);
                },
            });
        });

        $(".final.earphone.action.tocart.primary").click(function (e) {
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
                    window.location.href = "/checkout/cart";
                },
                error: function (xhr, status, error) {
                    console.error("AJAX Error:", status, error);
                },
            });
        });
    });
});
