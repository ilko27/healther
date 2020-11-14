function toChart(){
    Chart.platform.disableCSSInjection = true;
    var ctx = document.getElementById('tempChart').getContext('2d');
    var ctx2 = document.getElementById('humidityChart').getContext('2d');
    makeChart(ctx, timestamps, temp, 'Temperature', 'rgba(255, 115, 105, 0.5)');
    makeChart(ctx2, timestamps, humidity, 'Humidity', 'rgba(38, 71, 255, 0.5)');
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