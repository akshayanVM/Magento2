require(["jquery"], function ($) {
    $(document).ready(function () {
        $(" .final.swatch-option.color").click(function (e) {
            e.preventDefault();
            let swatchIdFinal = $(this).data("swatch-data-id-final");
            let formKeyFinal = $(this).data("swatch-form-key-final");
            let colorFinal = $(this).data("swatch-color");
            var swatchElement = $(this);
            var productImage = swatchElement
                .closest(".product-item")
                .find(".product-image-photo");
            // var formKeyTest = $('input[name="form_key"]').val();
            console.log(swatchIdFinal);
            console.log(formKeyFinal);
            console.log(colorFinal);
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
                    // window.location.href = "/wishlist/index/index";
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
