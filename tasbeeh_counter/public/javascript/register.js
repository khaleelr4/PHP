function SubmitRegister(urlroot){
    var fullname = $('#fullname').val();
    var email = $('#email').val();
    var phone = $('#phone').val();
    var password = $('#password').val();
    var confirm_password = $('#confirm_password').val();

    if(fullname === "" && email === "" && phone === "" && password === "" && confirm_password === ""){
        $("#fullname").addClass("is-invalid");
        $("#email").addClass("is-invalid");
        $("#phone").addClass("is-invalid");
        $("#password").addClass("is-invalid");
        $("#confirm_password").addClass("is-invalid");
        return false;
    }

    // if name is empty
    if(fullname === ""){
        $("#fullname").addClass("is-invalid");
        return false;
    }else{
        $("#fullname").removeClass("is-invalid");
        $("#fullname").addClass("is-valid");
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

    if(password === ""){
        $('#password').addClass("is-invalid");
        return false;
    }else{
        $('#password').removeClass("is-invalid");
        $('#password').addClass("is-valid");
    }

    if(confirm_password === ""){
        $('#confirm_password').addClass("is-invalid");
        return false;
    }else{
        $('#confirm_password').removeClass("is-invalid");
        $('#confirm_password').addClass("is-valid");
    }

    // apply the check for if the password and confirm_password are equal and generate the toast 
    // if not equal

    if(password !== confirm_password){
        // invalidate the relevant fields
        $("#password").addClass("is-invalid");
        $("#confirm_password").addClass("is-invalid");
        $(".notification-container").append(RenderNotificationToast("Error", "Please Check your Password again! They are not matched.", "danger"));
        $('.toast').toast('show');
        return false;
    }

    // display the loader
    $('.loader_div').css('display', 'block');

    // send the post call to the registration
    $.ajax(`${urlroot}/home/SubmitRegister`, {
        type: 'post',
        data: {name: fullname, email: email, phone: phone, password: password},
        success: function(data){
            // based on the response display the appropriate message
            if(data === "not_enough_params_received"){
                $(".notification-container").append(RenderNotificationToast("Missing Params", "Parameters not provided completely", "danger"));
            }else if(data === "invalid_email_provided"){
                $("#email").removeClass("is-valid");
                $("#email").addClass("is-invalid");
                $(".notification-container").append(RenderNotificationToast("Invalid Email", "The email you provided is not a valid email format", "danger"));
            }else if(data === "user_not_inserted" || data === "user_not_updated"){
                $(".notification-container").append(RenderNotificationToast("Error", "Registration Failed, due to some Server Error!", "danger"));
            }else if(data === "user_inserted" || data === "user_updated"){
                // remove all the fields
                $('#fullname').val("");
                $('#email').val("");
                $('#phone').val("");
                $('#password').val("");
                $('#confirm_password').val("");

                // remove all the validation classes from the fields
                $('#fullname').removeClass("is-valid");
                $('#email').removeClass("is-valid");
                $('#phone').removeClass("is-valid");
                $('#password').removeClass("is-valid");
                $('#confirm_password').removeClass("is-valid");

                $(".notification-container").append(RenderNotificationToast("Registration Completed", "Congratulations! You are Registered with Madani Beacon.", "success"));
            }else if(data === "invalid_request"){
                $(".notification-container").append(RenderNotificationToast("Invalid Request", "Your Request is invalid by Server.", "danger"));
            }else if(data === "email_already_exists"){
                $("#email").removeClass("is-valid");
                $("#email").addClass("is-invalid");
                $(".notification-container").append(RenderNotificationToast("User Already exists", "The User already exists in our system.", "danger"));
            }else if(data === "cross_device_register"){
                // remove all the is-valid class classes
                $("#fullname").removeClass("is-valid");
                $("#email").removeClass("is-valid");
                $("#phone").removeClass("is-valid");
                $("#password").removeClass("is-valid");
                $("#confirm_password").removeClass("is-valid");
                // generate the notification
                $(".notification-container").append(RenderNotificationToast("Cross Device Data Breach", "Your Device is already registered!", "warning"));
            }

            // display none the loader
            $('.loader_div').css('display', 'none');

            // show all the toasts
            $('.toast').toast('show');
        }
    });
}