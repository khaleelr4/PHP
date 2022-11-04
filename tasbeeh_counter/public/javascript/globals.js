// Global Variables
const originurl = window.location.origin;
const project_name = "tasbeeh_counter";
const referenceURL = `${originurl}/${project_name}`;
const emailRegexPattern = new RegExp(/^[\w-\.]+@([\w-]+\.)+[\w-]{2,4}$/g);

// init the login modal instance on dom loaded
var loginmodalinstance = undefined;
$(document).ready(function(){
    // init the login modal instance
    loginmodalinstance = new bootstrap.Modal(document.getElementById("login_modal"));
});

// Global Functions
function GetColorHexCode(type){
    if(type === "primary"){
        return '#0d6efd';
    }else if(type === "danger"){
        return '#dc3545';
    }else if(type === "secondary"){
        return '#6c757d';
    }else if(type === "success"){
        return '#198754';
    }else if(type === "warning"){
        return '#ffc107';
    }else if(type === "info"){
        return '#0dcaf0';
    }else if(type === "dark"){
        return '#212529';
    }else if(type === "light"){
        return '#f8f9fa';
    }else{
        // return white
        return '#fff';
    }
}

function RenderNotificationToast(title, description, type){
    // init the border color to the provided type param
    var border_color = GetColorHexCode(type);

    // render the notification toast
    const renderedtoast = `<div class="toast" role="alert" aria-live="assertive" aria-atomic="true">
                                <div class="toast-header">
                                    <img src="${referenceURL}/public/img/tabicon.png" style="border: 2px solid ${border_color}" width="20" height="20" class="rounded me-2" alt="notification_icon">
                                    <strong class="me-auto">${title}</strong>
                                    <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                                </div>
                                <div class="toast-body">
                                    ${description}
                                </div>
                           </div>`;
    return renderedtoast;
}