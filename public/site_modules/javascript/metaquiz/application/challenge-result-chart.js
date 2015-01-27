var challengeResultChart = function(chartLabels, chartData){

    console.log(chartData);

    var datasets = [];

    var colors = ['#08c06a','#1EA6E8','#F0C40F','#CA4FBD','#F46A0F'];

    var getColor = function(colors, prevColor){
        var num = Math.floor(Math.random()*colors.length);
        var newColor = colors[num];

        return newColor;
    };

    var lastColor = colors[0];

    //Generate dataset
    chartData.forEach(function(cData){
        var color = getColor(colors, lastColor);
        var points = cData['points'];
        var label = cData['label'];
        var item = {
            label: label,
            fillColor: "rgba(255,255,255,0.1)",
            strokeColor: color,
            pointColor: color,
            pointStrokeColor: color,
            pointHighlightFill: "#fff",
            pointHighlightStroke: color,
            data: points
        };
        datasets.push(item);
        lastColor = color;
    });

    var data = {
        labels: chartLabels,
        datasets: datasets
    };
    var options = {
        scaleBeginAtZero: true,
        scaleFontStyle: "bold",
        tooltipFillColor: "#eee",
        tooltipFontColor: "#666",
        tooltipTitleFontColor: "#666",
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
    var html = quizResultChart.generateLegend();

    jQuery('#quiz-result-chart').parent().append(html);

    return quizResultChart;
};