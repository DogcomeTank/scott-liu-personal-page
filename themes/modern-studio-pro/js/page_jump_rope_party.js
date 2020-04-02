jQuery(function ($) {
    var ctx = document.getElementById('doubleJumpRecordChart').getContext('2d');
    var data = {
        "labels": ["January", "February", "March", "April", "May", "June", "July"],
        "datasets": [{
                "label": "Scott",
                "data": [65, 59, 80, 81, 56, 55, 40],
                "fill": false,
                "borderColor": getRandomColor(),
                "lineTension": 0.1
            },{
                "label": "D",
                "data": [25, 39, 86, 11, 96, 55, 40],
                "fill": false,
                "borderColor": getRandomColor(),
                "lineTension": 0.1
            },
    
        ]
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

});

jQuery(document).ready( function() {
    jQuery("#doubleJumpRecordForm").on('submit', function(e){
        e.preventDefault(); 
        jQuery.ajax({
           type : "post",
           dataType : "json",
           url : myAjax.ajaxurl,
           data : {action: "jump_rope_party_record",nonce: myAjax.nonce},
           success: function(response) {
                console.log(response);
           },
           error: function(er){
                console.log(er);
           }
        })   
    });

 })


function getRandomColor(){
    colors = ["f78259","00bdaa","ffa41b", "639a67", "f8dc88", "ffb2a7", "f5cab3", "65587f", "b7472a", "eab0d9", "678a74", "a7e9af"];
    var color = colors[Math.floor(Math.random() * colors.length)];
    return "#"+color;
}