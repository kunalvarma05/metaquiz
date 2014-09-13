jQuery(document).ready(function(){
    var data = {
        labels: ["Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday", "Sunday"],
        datasets: [
        {
            label: "Total Plays",
            fillColor: "rgba(255,255,255,0.1)",
            strokeColor: "blueviolet",
            data: [80, 118, 120, 159, 136, 171, 130]
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
    var chartElement = document.getElementById("total-plays-chart").getContext("2d");
    var totalPlaysChart = new Chart(chartElement).Line(data, options);
});