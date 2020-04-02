jQuery(function ($) {
    var ctx = document.getElementById('doubleJumpRecordChart').getContext('2d');
    // var ctx = $('#doubleJumpRecordChart').getContext('2d');

    var data = {
        "labels": ["January", "February", "March", "April", "May", "June", "July"],
        "datasets": [{
                "label": "Scott",
                "data": [65, 59, 80, 81, 56, 55, 40],
                "fill": false,
                "borderColor": "rgb(75, 192, 192)",
                "lineTension": 0.1
            },{
                "label": "D",
                "data": [25, 39, 86, 11, 96, 55, 40],
                "fill": false,
                "borderColor": "#679b9b",
                "lineTension": 0.1
            },
    
        ]
    };

    var myChart = new Chart(ctx, {
        type: 'line',
        data: data,
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true
                    }
                }]
            }
        }
    });




})