// Declare constant
const e = 2.71828;
// Declare PV estimation function
function calculate(ghi) {
    var Ep, Ha, S, K1, K2, K3, K4;
    K4 = 0.9742;
    K3 = 0.9;
    K2 = -9 * Math.pow(10, -17) * Math.pow(ghi, 6) + 3 * Math.pow(10, -13) * Math.pow(ghi, 5) - 5 * Math.pow(10, -10) * Math.pow(ghi, 4) + 5 * Math.pow(10, -7) * Math.pow(ghi, 3) - 0.0003 * Math.pow(ghi, 2) + 0.104 * ghi + 83.268;
    K1 = 0.1927;
    S = 1.7992;
    Ha = ghi * 0.5;
    Ep = Ha * S * K1 * 0.01 * K2 * K3 * K4;
    return Ep;
}
// Initialize charts
var Charts = echarts.init(document.getElementById('charts'));
Charts.showLoading();
// Display empty charts
Charts.setOption({
    title: {
        text: 'StatusForecasts(48hrs)'
    },
    grid: {
        top: '15%'
    },
    xAxis: {
        data: []
    },
    yAxis: [{
        type: 'value',
        name: "PV",
        max: 160,
        interval: 32,
        splitLine: {
            show: false
        }
    }, {
        type: 'value',
        name: "GHI",
        max: 900,
        interval: 180,
        splitLine: {
            show: false
        }
    }],
    series: [{
        name: 'PV',
        type: 'bar',
        yAxisIndex: 0,
        data: []
    }, {
        name: 'ghi',
        type: 'line',
        yAxisIndex: 1,
        data: []
    }]
});
// Declare variables to store asynchronous data
var arr_pv = [];
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
            arr_pv.push(calculate(data.forecasts[i].ghi));
            arr_ghi.push(data.forecasts[i].ghi);
            arr_end.push(data.forecasts[i].period_end);
        };
        // console.log(arr_ghi);
        // Inject data in to the charts
        Charts.hideLoading();
        Charts.setOption({
            series: [{
                name: 'PV',
                data: arr_pv
            }, {
                name: 'ghi',
                data: arr_ghi
            }]
        });
    }
});