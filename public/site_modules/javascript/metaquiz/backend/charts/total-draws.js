jQuery(document).ready(function(){
    var data = {
        labels: ["Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday", "Sunday"],
        datasets: [
        {
            label: "Total Draws",
            fillColor: "rgba(255,255,255,0.1)",
            strokeColor: "darkorange",
            data: [10, 21, 30, 39, 46, 17, 12]
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
    var chartElement = document.getElementById("total-draws-chart").getContext("2d");
    var totalDrawsChart = new Chart(chartElement).Line(data, options);
});