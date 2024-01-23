require(["jquery"], function ($) {
    $(document).ready(function () {
        $(" .action.towishlist").click(function (e) {
            e.preventDefault();
            let earphoneId = $(this).data("earphone-final-entity-id");
            let earphoneFormKey = $(this).data("earphone-key");
            // var formKeyTest = $('input[name="form_key"]').val();
            console.log(earphoneId);
            console.log(earphoneFormKey);
            $.ajax({
                // url: "http://test.magento2.com/index.php/wishlist/index/add/", // Replace with your controller URL
                url: "/wishlist/index/add/product/" + earphoneId + "/",
                type: "POST",
                // dataType: "json",
                data: { productId: earphoneId, form_key: earphoneFormKey }, // it wasnt working because the data name was supposed to be 'form_key'
                success: function (response) {
                    console.log(response);
                    window.location.href = "/wishlist/index/index";
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
