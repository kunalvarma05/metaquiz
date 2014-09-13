jQuery(document).ready(function(){
    var data = {
        labels: ["Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday", "Sunday"],
        datasets: [
        {
            label: "Total Losses",
            fillColor: "rgba(255,255,255,0.1)",
            strokeColor: "#e12b2d",
            data: [58, 18, 40, 39, 76, 37, 30]
        }
        ]
    };
    var options = {
        scaleFontStyle: "bold",
        tooltipFillColor: "#2291d7",
        scaleShowGridLines: true,
        scaleGridLineColor: "rgba(255,255,255,0.1)",
        scaleGridLineWidth: 1,
        datasetStroke: false,
        pointDot : false,
        scaleFontColor: "#fff"

    };
    var chartElement = document.getElementById("total-losses-chart").getContext("2d");
    var totalLossesChart = new Chart(chartElement).Line(data, options);
});