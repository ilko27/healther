// Themes begin
am4core.useTheme(am4themes_material);
am4core.useTheme(am4themes_animated);
// Create chart instance
let chart = am4core.create("chartdiv", am4charts.XYChart);

am4core.ready(getData(69420));


function getData(sensorn){
    
    var toSend = JSON.stringify({
        sensorName: sensorn
    });
    var xmlhttp = new XMLHttpRequest();
    let readingsData = [];
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            rs = JSON.parse(this.responseText);
            for(let i = rs.length - 1; i >= 0; i--){

                // chart.data.push(
                //     {
                //         // "date": rs[i].readingTime,
                //         // "value": rs[i].temperatureC
                //         "date": rs[i].readingTime,
                //         "value": rs[i].temperatureC
                //     }
                // )
                
            }
                loadChart();
            console.log(chart.data);
            // toChart(); // old charts
        }
    };
    xmlhttp.open("POST", "php/getData.php", false);
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xmlhttp.send(toSend);
}
// let ctx = document.getElementById('tempChart').getContext('2d');
// let ctx2 = document.getElementById('humidityChart').getContext('2d');
// let tChart = makeChart(ctx, timestamps, temp, 'Temperature', 'rgba(255, 115, 105, 0.5)');
// let hChart = makeChart(ctx2, timestamps, humidity, 'Humidity', 'rgba(38, 71, 255, 0.5)');

// am4core.ready(
    
function loadChart() {

    

    // Create chart
    chart.paddingRight = 20;

    chart.data = generateChartData();
    
    var dateAxis = chart.xAxes.push(new am4charts.DateAxis());
    dateAxis.baseInterval = {
      "timeUnit": "minute",
      "count": 1
    };
    dateAxis.tooltipDateFormat = "yyyy.MM.dd 'at' HH:mm:ss";
    
    var valueAxis = chart.yAxes.push(new am4charts.ValueAxis());
    valueAxis.tooltip.disabled = true;
    valueAxis.title.text = "Unique visitors";
    
    var series = chart.series.push(new am4charts.LineSeries());
    series.dataFields.dateX = "date";
    series.dataFields.valueY = "Temperatue";
    series.tooltipText = "Temperature: [bold]{valueY}[/]";
    series.fillOpacity = 0.3;
    
    
    chart.cursor = new am4charts.XYCursor();
    chart.cursor.lineY.opacity = 0;
    chart.scrollbarX = new am4charts.XYChartScrollbar();
    chart.scrollbarX.series.push(series);
    
    
    dateAxis.start = 0.8;
    dateAxis.keepSelection = true;
    
    
    
    function generateChartData() {
        var chartData = [];
        // current date
        var firstDate = new Date();
        // now set 500 minutes back
        firstDate.setMinutes(firstDate.getDate() - 500);
    
        // and generate 500 data items
        var visits = 50000;
        for (var i = 0; i < visits; i++) {
            var newDate = new Date(firstDate);
            // each time we add one minute
            newDate.setMinutes(newDate.getMinutes() + i);
            // some random number
            visits += Math.round((Math.random()<0.5?1:-1)*Math.random()*10);
            // add data item to the array
            chartData.push({
                date: '2021-01-01 '+i+':45:30',
                visits: visits
            });
        }
        console.log(chartData);
        return chartData;
    }
    
}; // end am4core.ready()