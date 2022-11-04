function SubmitLogin(urlroot){
    var email = $("#login_email").val();
    var password = $("#login_password").val();

    // check if all the input fields are validated
    if(email === "" && password === ""){
        $("#login_email").addClass("is-invalid");
        $("#login_password").addClass("is-invalid");
    }

    // check if the email and password is set
    if(email === ""){
        $("#login_email").addClass("is-invalid");
        return false;
    }else{
        $("#login_email").removeClass("is-invalid");
        $("#login_email").addClass("is-valid");
    }

    if(password === ""){
        $("#login_password").addClass("is-invalid");
        return false;
    }else{
        $("#login_password").removeClass("is-invalid");
        $("#login_password").addClass("is-valid");
    }

    // display the loader
    $('.loader_div').css('display', 'block');

    $.ajax(`${urlroot}/home/SubmitLogin`, {
        type: 'post',
        data: {email: email, password: password},
        success: function(data){
            // based on the response
            if(data === "invalid_request"){
                $(".notification-container").append(RenderNotificationToast("Invalid Request", "Your Request is invalid by Server.", "danger"));
            }else if(data === "params_missing"){
                $(".notification-container").append(RenderNotificationToast("Parameters Missing", "The Required Parameters are missing", "danger"));
            }else if(data === "login_credentials_invalid"){
                // empty all the fields
                $("#login_email").val("");
                $("#login_password").val("");

                // remvove all the is-valid classes
                $("#login_email").removeClass("is-valid");
                $("#login_password").removeClass("is-valid");

                // add all the invalid classes
                $("#login_email").addClass("is-invalid");
                $("#login_password").addClass("is-invalid");

                // generate the notification
                $(".notification-container").append(RenderNotificationToast("Login Failed", "Invalid Login Credentials provided.", "danger"));

                // close the modal
                loginmodalinstance.hide();
            }else if(data === "login_success"){
                // close the modal
                loginmodalinstance.hide();
                // pop up notification
                $(".notification-container").append(RenderNotificationToast("Login Successful", "Your Session is Created successfully! WELCOME.", "primary"));
                window.location.reload();
            }
            // display none the loader
            $('.loader_div').css('display', 'none');

            // show all the toasts
            $('.toast').toast('show');
        }
    });
}