require(['jquery'], function ($) {
    $(document).ready(function () {
        // Your button click event
        $('#yourButtonId').click(function () {
           const button_Data = $('#yourButtonId').data('test-id');
           // console.log(button_Data);
            // Your AJAX request
            $.ajax({
                url: '/ajaxmodule/index/ajaxcontroller', // Update with your controller route
                type: 'POST',
                dataType: 'json',
                showLoader: false,
                data: {buttonData: button_Data },
                success: function (data) {
                    // Handle the response from the controller
                    alert(data.message + 'Test ID:' + data.test_id_passed);
                },
                error: function (error) {
                    alert(error.message);
                }
            });
        });
    });
});
