require(["jquery"], function ($) {
    $(document).ready(function () {
        $("#testbutton").click(function (e) {
            e.preventDefault();
            let productId = $(this).data("test-id");
            console.log(productId);
            // $.ajax({
            //     url: "http://test.magento2.com/index.php/wishlist/index/add/", // Replace with your controller URL
            //     type: "POST",
            //     dataType: "json",
            //     data: { productId: productId },
            //     success: function (response) {
            //         if (response.success) {
            //             alert("Value sent successfully!");
            //         } else {
            //             alert("Failed to send value.");
            //         }
            //     },
            //     error: function () {
            //         alert("Error occurred while sending value.");
            //     },
            // });
        });
    });
});
