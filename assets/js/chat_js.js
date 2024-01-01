$(document).ready(function() {

    $(".messages").animate({
        scrollTop: $(document).height()
    }, "fast");

    $("#profile-img").click(function() {
        $("#status-options").toggleClass("active");
    });

    $(".expand-button").click(function() {
        $("#profile").toggleClass("expanded");
        $("#contacts").toggleClass("expanded");
    });

    $("#status-options ul li").click(function() {
        $("#profile-img").removeClass();
        $("#status-online").removeClass("active");
        $("#status-away").removeClass("active");
        $("#status-busy").removeClass("active");
        $("#status-offline").removeClass("active");
        $(this).addClass("active");
        
        if ($("#status-online").hasClass("active")) {
            $("#profile-img").addClass("online");
        } else if ($("#status-away").hasClass("active")) {
            $("#profile-img").addClass("away");
        } else if ($("#status-busy").hasClass("active")) {
            $("#profile-img").addClass("busy");
        } else if ($("#status-offline").hasClass("active")) {
            $("#profile-img").addClass("offline");
        } else {
            $("#profile-img").removeClass();
        };
    
        $("#status-options").removeClass("active");
    });

    function newMessage() {
        message = $(".message-input input").val();
        if ($.trim(message) == '') {
            return false;
        }
        
        $('<li class="replies"><img src="http://emilcarlsson.se/assets/mikeross.png" alt="" /><p>' + message + '</p></li>').appendTo($('.messages ul'));
        $('.message-input input').val(null);
        $('.contact.active .preview').html('<span>You: </span>' + message);
        
        $(".messages").animate({
            scrollTop: $(document).height()
        }, "fast");
    };

    $('.submit').click(function() {
        sendMessage();
    });
    
    function sendMessage(){
        // Get the message from the input field
        var message = $('.message-input input').val();
        var currentPic = $('#currentPic').attr("src");
        var currentID = $('#currentID').val();
        var currentName = $('#currentName').text();
        var payload = {
            message: message,
            user_id: currentID,
            user_name: currentName,
            user_img: currentPic,
        };
        console.log("payload=>", payload);
          // AJAX request to send the message
        $.ajax({
            url: '/chat-send-msg', // Replace with your server-side script URL
            method: 'POST', // Use POST method to send data
            data: payload, // Data to be sent
            dataType: 'html',
            success: function(response) {
                // window.location.href="chat/"+currentID;
                window.location.href="";
                // Handle success
                console.log('Message sent successfully:', response);
                
                //   location.reload(); 
                // setInterval('location.reload()', 1000);        // Using .reload() method.
                // Optionally, do something with the response from the server
            },
            error: function(xhr, status, error) {
                // Handle errors
                console.error('Error sending message:', error);
                // Optionally, handle the error condition
            }
        });
        newMessage();
    }
    

    $(window).on('keydown', function(e) {
        if (e.which == 13) {
            sendMessage();
            // newMessage();
            return false;
        }
    });
});