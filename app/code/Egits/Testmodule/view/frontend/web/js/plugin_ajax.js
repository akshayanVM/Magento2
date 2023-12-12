require(["jquery"], function ($) {
    $(document).ready(function () {
        // Your button click event
        $("#product-addtocart-button").click(function () {
            // const button_Data = $("#product-addtocart-button").data("test-id");
            // console.log(button_Data);
            // Your AJAX request
            $.ajax({
                url: "/ajaxmodule/plugin/addtocartafterplugin", // Update with your controller route
                type: "POST",
                dataType: "json",
                showLoader: false,
                data: { buttonData: button_Data },
                success: function (data) {
                    // Handle the response from the controller
                    alert("Success");
                },
                error: function (error) {
                    alert("Rival Field Messenger Error");
                },
            });
        });
    });
});

// this JS is called inside the head section of the default.xml
