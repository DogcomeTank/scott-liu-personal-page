var log = console.log;

jQuery(document).ready(function () {
    // Line chart display
    displayChart();
    // Input new record or update record
    recordInput();

})


function displayChart(){

    var recordObj = JSON.parse(myAjax['user_record']);
    var labels = {};
    var dataSets =  {};
    var users = [];
    var recordObjL =  recordObj.length;


    // get list of users and date labels
    for(i = 0; i < recordObjL; i++){
        var record = recordObj[i];
        var thisRecordDate = record['record_date'];
        var thisRecordUser = record['user_nicename'];
        var thisRecordRecord = record['record'];

        if(!users.includes(thisRecordUser)){
            users.push(thisRecordUser);
        }

        if(!(thisRecordDate in labels)){
            labels[thisRecordDate]={}
            labels[thisRecordDate][thisRecordUser] = thisRecordRecord;
        }else{
            labels[thisRecordDate][thisRecordUser] = thisRecordRecord;
        }

    }

    // if user has no record, set to 0
    for(var singleDate in labels){
        // if user in Object of the date
        for(n=0;n<users.length;n++){
            var thisUser = users[n] 
            if(!(thisUser in labels[singleDate])){
                labels[singleDate][thisUser] = '0';
            }
        }
        labels[singleDate];
    }

    // set datasets template
    for(u=0;u<users.length;u++){
        var thisUser = users[u];
        dataSets[thisUser]={
            "label": thisUser,
            "data": [],
            "fill": false,
            "borderColor": getRandomColor(),
            "lineTension": 0.1
        }
    }

    // Add data to dataSets
    for(var singleDate in labels){

        var thisData = labels[singleDate];
        for(var singleUser in thisData){
            var userRecord = thisData[singleUser];
            dataSets[singleUser]['data'].push(userRecord);
        }

    }

    var user = {
        "label": "Scott",
        "data": [65, 59, 80, 81, 56, 55, 40],
        "fill": false,
        "borderColor": getRandomColor(),
        "lineTension": 0.1
    };

    log(labels);
    log(dataSets);

    var ctx = document.getElementById('doubleJumpRecordChart').getContext('2d');

    var labelsKeys = Object.keys(labels);

    var data = {
        "labels": labelsKeys,
        "datasets": Object.values(dataSets)
    };

    var options = {
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero: true
                }
            }]
        }
    };

    var myChart = new Chart(ctx, {
        type: 'line',
        data: data,
        options: options,
    });
}

function recordInput(){
    jQuery('.c-checkbox').on('change', function () {
        var record = jQuery('#double-record').val();
        if (!record == '') {
            jQuery.ajax({
                type: "post",
                dataType: "json",
                url: myAjax.ajaxurl,
                data: {
                    action: "jump_rope_party_record",
                    nonce: myAjax.nonce,
                    doubleRecord: record
                },
                success: function (response) {
                    console.log("success");
                },
                error: function (er) {
                    jQuery('.c-checkbox').prop('checked', true);
                    alert(er.responseText);
                }
            })
        }

    });

    jQuery("#doubleJumpRecordForm").on('submit', function (e) {
        e.preventDefault();
    });

}

function getRandomColor() {
    colors = ["f78259", "00bdaa", "ffa41b", "639a67", "f8dc88", "ffb2a7", "f5cab3", "65587f", "b7472a", "eab0d9", "678a74", "a7e9af"];
    var color = colors[Math.floor(Math.random() * colors.length)];
    return "#" + color;
}