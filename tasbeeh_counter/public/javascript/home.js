var globalAyatId = 0;
var globalCounter = 0;

$(document).ready(function(){
    $('.ayat_selector').ddslick();
});

$("#tasbeeh_counter").click(function(){
    // init the value of the button 
    var count = Number.parseInt($("#tasbeeh_counter").text());
    count = count + 1;
    globalCounter = count;
    SendCounterData();
    // set the value to the counter in preincrement
    $("#tasbeeh_counter").text(count);
});

$(".ayat_selector").ddslick({
    onSelected: function(data){
        const ayatid = data.selectedData.value;
        globalAyatId = ayatid;
        GetCounterData();
        // call the function to send the request to the server to fetch the data
        GetAyatBinaryData(ayatid);
    }
});

function GetCounterData(){
    $.ajax(`${urlroot}/home/GetAyatData`, {
        type: 'post',
        cache: false,
        data: {ayatid: globalAyatId},
        success: function(data){
            const jsonData = JSON.parse(data);
            if(jsonData != false){
                $("#tasbeeh_counter").text(jsonData['counts']);
            }else{
                $("#tasbeeh_counter").text(0);
            }
        }
    });
}

function SendCounterData(){
    $.ajax(`${urlroot}/home/SendAyatData`, {
        type: 'post',
        cache: false,
        data:{ayatid: globalAyatId, counter_data: globalCounter},
        success: function(data){
            if (data !== "success"){
                $("#tasbeeh_counter").text(--globalCounter);
                $(".notification-container").append(RenderNotificationToast("Counter Failed", "Counter failed, Please count again!", "danger"));
                $('.toast').toast('show');
            }
        }
    });
}


function GetAyatBinaryData(id){
    $('.loader_div').css('display', 'block');
    $.ajax(`${urlroot}/home/GetAyatDataById`, {
        type: 'post',
        data: {id: id},
        success: function(data){
            const jsondata = JSON.parse(data);
            $('#image_placeholder').attr('src', `data:image/jpg;charset=utf8;base64,${jsondata['image']}`);
            $('#ayat_audio').attr('src', `data:audio/mp3;base64,${jsondata['audio']}`);
            // unload the loader
            $('.loader_div').css('display', 'none');
        }
    });
}