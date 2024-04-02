$(function () {

    $('#order-form').validator();
    $('#order-form').on('submit', function (e) {
        if (!e.isDefaultPrevented()) {
            var url = require("../php/order.php");
            var s = 
            $.ajax({
                type: "POST",
                url: url,
                data: $(this).serialize(),
                success: function (data)
                {
                    var messageAlert = 'alert-' + data.type;
                    var messageText = data.message;
                    var alertBox = '<div class="alert ' + messageAlert + ' alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>' + messageText + '</div>';
                    if (messageAlert && messageText) {
                        $('#order-form').find('.messages').html(alertBox);
                        $('#order-form')[0].reset();
                    }
                }
            });
            return false;
        }
    })
});