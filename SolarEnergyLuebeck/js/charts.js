// Declare constant
const e = 2.71828;
// Declare Energy estimation function
function calculate(ghi) {
    var Ep, Ha, S, K1, K2, K3, K4;
    K4 = 0.9742;
    K3 = 0.9;
    K2 = -9 * Math.pow(10, -17) * Math.pow(ghi, 6) + 3 * Math.pow(10, -13) * Math.pow(ghi, 5) - 5 * Math.pow(10, -10) * Math.pow(ghi, 4) + 5 * Math.pow(10, -7) * Math.pow(ghi, 3) - 0.0003 * Math.pow(ghi, 2) + 0.104 * ghi + 83.268;
    K1 = 0.1927;
    S = 1.7992;
    Ha = ghi * 0.5;
    Ep = Ha * S * K1 * 0.01 * K2 * K3 * K4;
    return Math.round(Ep);
}
// Declare Date handler
function transDate(date) {
    var month, day, time;
    switch (date.substring(5, 7)) {
        case '01':
            month = 'Jan';
            break;
        case '02':
            month = 'Feb';
            break;
        case '03':
            month = 'Mar';
            break;
        case '04':
            month = 'Apr';
            break;
        case '05':
            month = 'May';
            break;
        case '06':
            month = 'Jun';
            break;
        case '07':
            month = 'Jul';
            break;
        case '08':
            month = 'Aug';
            break;
        case '09':
            month = 'Sep';
            break;
        case '10':
            month = 'Oct';
            break;
        case '11':
            month = 'Nov';
            break;
        case '12':
            month = 'Dec';
            break;
    }
    day = date.substring(8, 10);
    time = date.substring(11, 16);
    date_good = day + '. ' + month + ': ' + time;
    return date_good;
}
// console.log("2017-01-30T05:00:00.0000000Z");
// Initialize charts
var Charts = echarts.init(document.getElementById('charts'));
Charts.showLoading();
// Display empty charts
Charts.setOption({
    title: {
        text: 'Status Forecasts 48hours',
        subtext: 'Energy calculated in 30mins period',
        left: 'center',
        padding: 40,
    },
    tooltip: {
        trigger: 'axis',
        axisPointer: {
            animation: false
        }
    },
    legend: {
        data: ['GHI (W/m^2)', 'Energy (Wh)'],
        top: "18%",
        left: 100
    },
    grid: {
        top: "15%",
        bottom: "30%",
        left: 100,
        right: "50%"
    },
    xAxis: {
        type: 'category',
        data: [],
        show: false
    },
    yAxis: [{
        type: 'value',
        name: "Energy (Wh)",
        max: 160,
        interval: 32,
        splitLine: {
            show: false
        },
        show: false,
    }, {
        type: 'value',
        name: "GHI (W/m^2)",
        max: 900,
        interval: 180,
        splitLine: {
            show: false
        },
        show: false
    }],
    series: [{
        name: 'Energy (Wh)',
        type: 'bar',
        yAxisIndex: 0,
        data: []
    }, {
        name: 'GHI (W/m^2)',
        type: 'line',
        yAxisIndex: 1,
        data: []
    }]
});
window.onresize = Charts.resize;
// Declare variables to store asynchronous data
var arr_ene = [];
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
            arr_ene.push(calculate(data.forecasts[i].ghi));
            arr_ghi.push(data.forecasts[i].ghi);
            arr_end.push(transDate(data.forecasts[i].period_end));
        };
        // console.log(arr_ghi);
        // Inject data in to the charts
        Charts.hideLoading();
        Charts.setOption({
            xAxis: {
                data: arr_end
            },
            series: [{
                name: 'Energy (Wh)',
                data: arr_ene
            }, {
                name: 'GHI (W/m^2)',
                data: arr_ghi
            }]
        });
    }
});