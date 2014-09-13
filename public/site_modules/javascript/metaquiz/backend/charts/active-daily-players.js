jQuery(document).ready(function(){
    var data = {
        labels: ["Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday", "Sunday"],
        datasets: [
        {
            label: "Active Players",
            fillColor: "rgba(255,255,255,0.1)",
            strokeColor: "#1E90FF",
            pointColor: "#64cb3d",
            pointStrokeColor: "#64cb3d",
            pointHighlightFill: "#64cb3d",
            pointHighlightStroke: "#64cb3d",
            data: [28, 48, 40, 19, 86, 27, 90]
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
        scaleFontColor: "#fff",
        datasetStrokeWidth : 4

    };
    var chartElement = document.getElementById("active-daily-players-chart").getContext("2d");
    var activePlayersChart = new Chart(chartElement).Line(data, options);
});