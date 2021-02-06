// // Themes begin
// am4core.useTheme(am4themes_material);
// am4core.useTheme(am4themes_animated);
// // Create chart instance
// let chart = am4core.create("chartdiv", am4charts.XYChart);
// chart.paddingRight = 20;

// am4core.ready(getData(69420));

let data = new Array();

function getData(sensorn){

    
    let toSend = JSON.stringify({
        sensorName: sensorn
    });
    let xmlhttp = new XMLHttpRequest();
    let readingsData = [];
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            rs = JSON.parse(this.responseText);
            for(let i = rs.length - 1; i >= 0; i--){

                data.push(
                    {
                        date: new Date(rs[i].readingTime),
                        visits: rs[i].temperatureC
                    }
                )
                
            }
            loadChart();
            // refreshChart();
            console.log(chart.data);
        }
    };
    xmlhttp.open("POST", "php/getData.php", false);
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xmlhttp.send(toSend);
}

function refreshChart() {

    let dateAxis = chart.xAxes.push(new am4charts.DateAxis());
    dateAxis.baseInterval = {
      "timeUnit": "minute",
      "count": 5
    };
    dateAxis.tooltipDateFormat = "yyyy.MM.dd 'at' HH:mm";

    let series = chart.series.push(new am4charts.LineSeries());
    series.dataFields.dateX = "date";
    series.dataFields.valueY = "visits";
    series.tooltipText = "[bold]{valueY}[/]°C";
    series.fillOpacity = 0.3;

    
    chart.cursor = new am4charts.XYCursor();
    chart.cursor.lineY.opacity = 0;
    chart.scrollbarX = new am4charts.XYChartScrollbar();
    chart.scrollbarX.series.push(series);

    dateAxis.start = 0.8;
    dateAxis.keepSelection = true;
}

am4core.ready(loadChart()); 
function loadChart() {

    // Themes begin
    am4core.useTheme(am4themes_material);
    am4core.useTheme(am4themes_animated);
    // Themes end
    
    // Create chart
    let chart = am4core.create("chartdiv", am4charts.XYChart);
    chart.paddingRight = 20;
    
    chart.data = [];
    chart.data = data;
    
    let dateAxis = chart.xAxes.push(new am4charts.DateAxis());
    dateAxis.baseInterval = {
      "timeUnit": "minute",
      "count": 5
    };
    dateAxis.tooltipDateFormat = "yyyy.MM.dd 'at' HH:mm";
    
    let valueAxis = chart.yAxes.push(new am4charts.ValueAxis());
    valueAxis.tooltip.disabled = true;
    valueAxis.title.text = "Temperature";
    
    let series = chart.series.push(new am4charts.LineSeries());
    series.dataFields.dateX = "date";
    series.dataFields.valueY = "visits";
    series.tooltipText = "[bold]{valueY}[/]°C";
    series.fillOpacity = 0.3;

    
    chart.cursor = new am4charts.XYCursor();
    chart.cursor.lineY.opacity = 0;
    chart.scrollbarX = new am4charts.XYChartScrollbar();
    chart.scrollbarX.series.push(series);


    dateAxis.start = 0.8;
    dateAxis.keepSelection = true;

    
    
}; // end am4core.ready()