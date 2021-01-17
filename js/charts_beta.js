function toChart(selection) {
    bChart.destroy();
    // add more destroy for more charts
    Chart.platform.disableCSSInjection = true;
    if (selection == 'temp') {
        bChart = makeChart(ctx, timestamps, temp, 'Temperature', 'rgba(255, 115, 105, 0.5)');
    } else if (selection == 'humidity') {
        bChart = makeChart(ctx, timestamps, humidity, 'Humidity', 'rgba(38, 71, 255, 0.5)');
    // } else if (selection = 'airQI') {
    //     bChart = makeChart(ctx2, timestamps, ??, 'Air Quality Index', 'rgba(38, 71, 255, 0.5)');
    // } else if (selection = 'pressure') {
    //     bChart = makeChart(ctx2, timestamps, ??, 'Air Pressure', 'rgba(38, 71, 255, 0.5)');
    } else {
        alert('did u forget that we have no such data?');
    }
    
}
function toAverage(arr) {
    var sum = 0;
    for( var i = 0; i < arr.length; i++ ){
        sum += parseInt( arr[i], 10 );
    }

    var avg = sum/arr.length;
    return avg.toFixed(2);;
}
function makeChart(ctxi, timestampsarr, dataarr, label, color) {
    var graph = new Chart(ctxi, {
    type: 'line',
        data: {
            labels: timestampsarr,
            datasets: [{
                label: label,
                data: dataarr,
                backgroundColor: color,
                borderColor: color,
                borderWidth: 5
            }]

        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: false
                    }
                }]
            }
        }
    });
    return graph
}