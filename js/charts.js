function toChart(timest, temperature, humidity){
    tChart.destroy();
    hChart.destroy();
    Chart.platform.disableCSSInjection = true;
    tChart = makeChart(ctx, timest, temperature, 'Temperature', 'rgba(255, 115, 105, 0.5)');
    hChart = makeChart(ctx2, timest, humidity, 'Humidity', 'rgba(38, 71, 255, 0.5)');
}
function toAverage(arr, spanToPlace, charToAdd){
    var sum = 0;
    for( var i = 0; i < arr.length; i++ ){
        sum += parseInt( arr[i], 10 );
    }

    var avg = sum/arr.length;
    document.getElementById(spanToPlace).innerHTML = avg.toFixed(2) + charToAdd;
}
function makeChart(ctxi, timestampsarr, dataarr, label, color){
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