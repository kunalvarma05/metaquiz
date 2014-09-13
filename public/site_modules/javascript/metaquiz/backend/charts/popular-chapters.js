jQuery(document).ready(function(){
    var data = [
    {
        value: 300,
        color:"BLUEVIOLET",
        highlight: "BLUEVIOLET",
        label: "Web Programming"
    },
    {
        value: 50,
        color: "orangered",
        highlight: "orangered",
        label: "Introduction to Digital Electronics"
    },
    {
        value: 100,
        color: "deepskyblue",
        highlight: "deepskyblue",
        label: "Office Automation Tools"
    }
    ];
    var options = {
        tooltipFillColor: "rgba(0,0,0,0.6)",
         segmentStrokeColor : "rgba(0,0,0,0)"
    };
    var chartElement = document.getElementById("popular-chapters-chart").getContext("2d");
    var popularSubjectsChart = new Chart(chartElement).Doughnut(data, options);
    jQuery('.popular-chapters-chart .widget-footer').html(popularSubjectsChart.generateLegend());
});