var quizResultChart = function(chartLabels, chartData){
    var data = {
        labels: chartLabels,
        datasets: [
        {
            label: "XP earned per question",
            fillColor: "rgba(255,255,255,0.1)",
            strokeColor: "#1E90FF",
            pointColor: "#64cb3d",
            pointStrokeColor: "#64cb3d",
            pointHighlightFill: "#64cb3d",
            pointHighlightStroke: "#64cb3d",
            data: chartData
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
        datasetStrokeWidth : 4,
        tooltipTemplate: "<%= value %>"
    };
    var element = document.getElementById("quiz-result-chart");
    var chartElement = element.getContext("2d");
    var quizResultChart = new Chart(chartElement).Line(data, options);
    return quizResultChart;
};