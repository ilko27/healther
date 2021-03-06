// Chart themes
am4core.useTheme(am4themes_material);
am4core.useTheme(am4themes_animated);
// Create chart instance
let tChart = am4core.create("t_chartdiv", am4charts.XYChart);
tChart.paddingRight = 20;
let hChart = am4core.create("h_chartdiv", am4charts.XYChart);
hChart.paddingRight = 20;
let aqiChart = am4core.create("aqi_chartdiv", am4charts.XYChart);
aqiChart.paddingRight = 20;


// Initiate charts
am4core.ready(
    loadChart(aqiChart, 1),
    loadChart(tChart, 2),
    loadChart(hChart, 3)
);

let storeTData = new Array();
let storeHData = new Array();
let storeAQIData = new Array();

function getData(sensorn, sensor_u_name){

    // console.log(sensor_u_name);
    document.getElementById('staticBackdropLabel').innerHTML = sensor_u_name;
    
    let toSend = JSON.stringify({
        sensorName: sensorn
    });
    let xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            rs = JSON.parse(this.responseText);
            // console.log(rs);
            storeTData = [];
            storeHData = [];
            storeAQIData = [];
            for(let i = rs.length - 1; i >= 0; i--){
                storeTData.push(
                    {
                        date: new Date(rs[i].readingTime),
                        temp: rs[i].temperatureC
                    }
                )
                storeHData.push(
                    {
                        date: new Date(rs[i].readingTime),
                        hum: rs[i].humidity
                    }
                )
                storeAQIData.push(
                    {
                        date: new Date(rs[i].readingTime),
                        aqi: rs[i].aqi/100
                    }
                )
            }
            tChart.data = [];
            tChart.data = storeTData.reverse();
            hChart.data = [];
            hChart.data = storeHData.reverse();
            aqiChart.data = [];
            aqiChart.data = storeAQIData.reverse();
            
            // console.log(tChart.data);
        }
    };
    xmlhttp.open("POST", "php/getData.php", false);
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xmlhttp.send(toSend);
}

function loadChart(chart, n) {
    let title_text;
    let dataFields_valueY;
    let tooltip_Text;

    if (n == 1) {
        // console.log(1);
        title_text = dictionary['concentration'][language];
        dataFields_valueY = 'aqi';
        tooltip_Text = '[bold]{valueY}[/] μg/m³';
    } else if (n == 2) {
        // console.log(2);
        title_text = dictionary['temperature'][language];
        dataFields_valueY = 'temp';
        tooltip_Text = '[bold]{valueY}[/] °C';
    } else {
        // console.log(3);
        title_text = dictionary['humidity'][language];
        dataFields_valueY = 'hum';
        tooltip_Text = '[bold]{valueY}[/] %';
    }

    // console.log(title_text);

    let dateAxis = chart.xAxes.push(new am4charts.DateAxis());
    dateAxis.baseInterval = {
      "timeUnit": "second",
      "count": 1
    };
    dateAxis.tooltipDateFormat = "yyyy.MM.dd 'at' HH:mm:ss";
    
    let valueAxis = chart.yAxes.push(new am4charts.ValueAxis());
    // valueAxis.tooltip.disabled = true;
    valueAxis.title.text = title_text;
    
    let series = chart.series.push(new am4charts.LineSeries());
    series.dataFields.dateX = "date";
    series.dataFields.valueY = dataFields_valueY;
    series.tooltipText = tooltip_Text;
    series.fillOpacity = 0.3;

    chart.cursor = new am4charts.XYCursor();
    chart.cursor.lineY.opacity = 0;
    chart.scrollbarX = new am4charts.XYChartScrollbar();
    chart.scrollbarX.series.push(series);

    dateAxis.start = 0.8;
    dateAxis.keepSelection = true;

};
getData(chartId, chartName);