function submitcontactform(urlroot){
    var name = $("#full_name").val();
    var email = $("#email").val();
    var phone = $("#phone").val();
    var message = $("#message").val();

    if(name === "" && email === "" && phone === "" && message === ""){
        $("#full_name").addClass("is-invalid");
        $("#email").addClass("is-invalid");
        $("#phone").addClass("is-invalid");
        $("#message").addClass("is-invalid");
        return false;
    }

    // if name is empty
    if(name === ""){
        $("#full_name").addClass("is-invalid");
        return false;
    }else{
        $("#full_name").removeClass("is-invalid");
        $("#full_name").addClass("is-valid");
    }

    // if email is empty
    if(email === ""){
        $("#email").addClass("is-invalid");
        return false;
    }else{
        $("#email").removeClass("is-invalid");
        // check if the email is valid
        if(emailRegexPattern.test(email) === true){
            $("#email").addClass("is-valid");
        }else{
            $("#email").addClass("is-invalid");
            return false;
        }
    }

    // if the phone is empty
    if(phone === ""){
        $("#phone").addClass("is-invalid");
        return false;
    }else{
        $("#phone").removeClass("is-invalid");
        // validate the phone number for now {temperoray solution}
        $("#phone").addClass("is-valid");
    }

    if(message === ""){
        $("#message").addClass("is-invalid");
        return false;
    }else{
        $("#message").removeClass("is-invalid");
        $("#message").addClass("is-valid");
    }

    // display the loader
    $('.loader_div').css('display', 'block');

    // send the call to ajax
    $.ajax(`${urlroot}/contact/SubmitContactData`, {
        type: 'POST', // http method
        data: {fullname: name, email: email, phone: phone, message: message},
        success: function(data){
            // append the content to the notification container
            if(data === "contact_inserted"){
                $(".notification-container").append(RenderNotificationToast("Message Send", "Your Message is send to the team! We'll get back to you as soon.", "success"));
                
                // empty all the fields
                $("#full_name").val("");
                $("#email").val("");
                $("#phone").val("");
                $("#message").val("");

                // remove all the validation classes
                $("#full_name").removeClass("is-valid");
                $("#email").removeClass("is-valid");
                $("#phone").removeClass("is-valid");
                $("#message").removeClass("is-valid");

                // show all the toasts
                $('.toast').toast('show');
            }else if(data === "contact_insertion_fail"){
                $(".notification-container").append(RenderNotificationToast("Message Not Send", "Your Message was not send due to some problem.", "danger"));
                // show all the toasts
                $('.toast').toast('show');
            }else if(data === "incomplete_params"){
                $(".notification-container").append(RenderNotificationToast("Invalid Parameters Send", "Invalid Parameters Send to the Server.", "danger"));
                // show all the toasts
                $('.toast').toast('show');
            }else if(data === "invalid_email"){
                $(".notification-container").append(RenderNotificationToast("Invalid Email Address", "Your Email Address is Invalid.", "danger"));
                // show all the toasts
                $('.toast').toast('show');
            }else if(data === "invalid_request"){
                $(".notification-container").append(RenderNotificationToast("Invalid Request", "Your Request is Invalid.", "danger"));
                // show all the toasts
                $('.toast').toast('show');
            }

            // display none the loader
            $('.loader_div').css('display', 'none');
        }
    });
}