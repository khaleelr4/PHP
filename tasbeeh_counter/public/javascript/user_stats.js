// Change Status Function 
function ChangeStatsFunction(id, count_number){
    $(`#ayat_count_${id}`).html(count_number > 0 ? count_number : 0);
}

function GetStatsResponse(){
    $.ajax(`${urlroot}/home/GetAllStatsUserResponse`, {
        type: 'get',
        cache: false,
        success: function(data){
            var ayat_list = JSON.parse(data);
            ayat_list.forEach(ayat_obj => {
                ChangeStatsFunction(ayat_obj['id'], ayat_obj['ayat_counts']['ayat_counts']);
            });
        }
    });
}

$(document).ready(function(){
    // on dom content loaded
    setInterval(GetStatsResponse, 100);
});