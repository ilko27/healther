
// Chart themes
am4core.useTheme(am4themes_material);
am4core.useTheme(am4themes_animated);
// Create chart instance
let chart = am4core.create("chartdiv", am4charts.XYChart);
chart.paddingRight = 20;
// Initiate chart
am4core.ready(loadChart());

let storeData = new Array();

function getData(sensorn){

    
    let toSend = JSON.stringify({
        sensorName: sensorn
    });
    let xmlhttp = new XMLHttpRequest();
    let readingsData = [];
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            rs = JSON.parse(this.responseText);
            storeData = [];
            for(let i = rs.length - 1; i >= 0; i--){
                storeData.push(
                    {
                        date: new Date(rs[i].readingTime),
                        temp: rs[i].temperatureC
                    }
                )
            }
            chart.data = [];
            chart.data = storeData;
        }
    };
    xmlhttp.open("POST", "php/getData.php", false);
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xmlhttp.send(toSend);
}

function loadChart() {
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
    series.dataFields.valueY = "temp";
    series.tooltipText = "[bold]{valueY}[/]°C";
    series.fillOpacity = 0.3;

    chart.cursor = new am4charts.XYCursor();
    chart.cursor.lineY.opacity = 0;
    chart.scrollbarX = new am4charts.XYChartScrollbar();
    chart.scrollbarX.series.push(series);

    dateAxis.start = 0.8;
    dateAxis.keepSelection = true;  
};