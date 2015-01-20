var quizResultChart = function(chartLabels, chartData){
    var data = {
        labels: chartLabels,
        datasets: [
        {
            label: "XP earned per question",
            fillColor: "rgba(8, 192, 106, 0.1)",
            strokeColor: "#08c06a",
            pointColor: "#fff",
            pointStrokeColor: "#08c06a",
            pointHighlightFill: "#fff",
            pointHighlightStroke: "#08c06a",
            data: chartData
        }
        ]
    };
    var options = {
        scaleFontStyle: "bold",
        tooltipFillColor: "#4b4b74",
        scaleShowGridLines: true,
        scaleGridLineColor: "rgba(0,0,0,0.1)",
        scaleGridLineWidth: 1,
        datasetStroke: false,
        scaleFontColor: "rgba(0,0,0,0.6)",
        datasetStrokeWidth : 2,
        tooltipTemplate: "<%= value %> XP"
    };
    var element = document.getElementById("quiz-result-chart");
    var chartElement = element.getContext("2d");
    var quizResultChart = new Chart(chartElement).Line(data, options);
    return quizResultChart;
};