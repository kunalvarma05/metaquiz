jQuery(document).ready(function(){
    var data = {
        labels: ["Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday", "Sunday"],
        datasets: [
        {
            label: "Total Wins",
            fillColor: "rgba(255,255,255,0.1)",
            strokeColor: "#64cb3d",
            data: [18, 28, 40, 29, 56, 77, 70]
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
    var chartElement = document.getElementById("total-wins-chart").getContext("2d");
    var totalWinsChart = new Chart(chartElement).Line(data, options);
});