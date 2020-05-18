// Initialize charts
var myChart = echarts.init(document.getElementById('charts'));
myChart.showLoading();
// Display empty charts
myChart.setOption({
    title: {
        text: 'SolarEnergyLevel'
    },
    xAxis: {
        data: []
    },
    yAxis: {},
    series: [{
        name: 'ghi',
        type: 'bar',
        data: []
    }]
});
// Declare variables to store asynchronous data
var arr_ghi = [];
var arr_end = [];
// Proxy to avoid Cross-domain issue
$.ajaxPrefilter(function (options) {
    if (options.crossDomain && jQuery.support.cors) {
        var http = (window.location.protocol === 'http:' ? 'http:' : 'https:');
        options.url = http + '//cors-anywhere.herokuapp.com/' + options.url;
    }
});
// Attain asynchronous data
$.ajax({
    url: 'https://api.solcast.com.au/world_radiation/forecasts?latitude=53.865467&longitude=10.686559&format=json&api_key=0ZP0PFQBzetZTCCl7W_M6I-VfGj-fGzy',
    type: 'GET',
    dataType: 'JSON',
    success: function (data) {
        for (i in data.forecasts) {
            arr_ghi.push(data.forecasts[i].ghi);
            arr_end.push(data.forecasts[i].period_end);
        };
        // console.log(arr_ghi);
        // Inject data in to the charts
        myChart.hideLoading();
        myChart.setOption({
            xAxis: {
                data: arr_end
            },
            series: [{
                name: 'ghi',
                data: arr_ghi
            }]
        });
    }
});