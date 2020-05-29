// Declare constant
const e = 2.71828;
// Declare Solar power function
function calSolar(ghi) {
    var Ep, Ha, S, K1, K2, K3, K4;
    K4 = 0.9742;
    K3 = 0.9;
    K2 = -9 * Math.pow(10, -17) * Math.pow(ghi, 6) + 3 * Math.pow(10, -13) * Math.pow(ghi, 5) - 5 * Math.pow(10, -10) * Math.pow(ghi, 4) + 5 * Math.pow(10, -7) * Math.pow(ghi, 3) - 0.0003 * Math.pow(ghi, 2) + 0.104 * ghi + 83.268;
    K1 = 0.1927;
    S = 1.7992;
    Ha = ghi;
    Ep = Ha * S * K1 * 0.01 * K2 * K3 * K4 * 3;
    return Math.round(Ep * 9);
}
// Declare Wind power function
function calWind(wind_spd) {
    var Power;
    if (wind_spd < 2) {
        Power = 0;
    } else if (wind_spd >= 2 && wind_spd < 5) {
        Power = -0.0833 * Math.pow(wind_spd, 4) + 3.9167 * Math.pow(wind_spd, 3) - 0.1667 * Math.pow(wind_spd, 2) - 22.667 * wind_spd + 19;
    } else {
        Power = -13.056 * Math.pow(wind_spd, 3) + 320.17 * Math.pow(wind_spd, 2) - 2073.8 * wind_spd + 4344.3;
    }
    return Math.round(Power);
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
var charts = echarts.init(document.getElementById('charts'));
var solar_chart = echarts.init(document.getElementById('solar_chart'));
var wind_chart = echarts.init(document.getElementById('wind_chart'));
charts.showLoading();
solar_chart.showLoading();
wind_chart.showLoading();
// Add listener to resize events
window.addEventListener("resize", () => {
    this.charts.resize();
    this.solar_chart.resize();
    this.wind_chart.resize();
});
// Display empty charts
// Overall charts
charts.setOption({
    title: {
        text: 'New Energy 48hours',
        subtext: 'Energy calculated in hourly period',
        left: 'center',
        itemGap: 0,
        top: '2%'
    },
    tooltip: {
        trigger: 'axis',
        axisPointer: {
            animation: false
        }
    },
    legend: {
        left: '77%',
        bottom: '5%',
        data: ['Red light', 'Yellow light', 'Green light']
    },
    grid: {
        top: '25%',
        left: '5%',
        right: '35%'
    },
    xAxis: {
        type: 'category',
        name: 'Time',
        data: [],
        axisLabel: {
            show: false
        }
    },
    yAxis: {
        type: 'value',
        name: "Energy (KWh)",
        splitLine: {
            show: false
        },
        axisLabel: {
            show: false
        }
    },
    series: [{
        name: 'Energy (KWh)',
        type: 'bar',
        data: [],
        itemStyle: {
            normal: {
                color: function (params) {
                    if (params.value >= 0 && params.value < 0.9 * calSolar(375) + 0.1 * calWind(2.78)) {
                        return "#a52a2a";
                    } else if (params.value >= 0.9 * calSolar(375) + 0.1 * calWind(2.78) && params.value < 0.9 * calSolar(625) + 0.1 * calWind(5.23)) {
                        return "#daa520";
                    }
                    return "#8fbc8f";
                }
            }
        },
        animationDelay: function (idx) {
            return idx * 20 + 100;
        }
    }, {
        name: 'Ratio',
        type: 'pie',
        data: [],
        center: ['85%', '50%'],
        radius: ['30%', '50%'],
        roseType: 'area',
        label: {
            position: 'outer',
            alignTo: 'labelLine',
            show: false
        },
        emphasis: {
            label: {
                show: true
            }
        },
        legendHoverLink: true,
        tooltip: {
            trigger: 'item',
            formatter: '{c} hours ({d}%)'
        }
    }],
    animationEasing: 'elasticOut'
});
// Solar chart
solar_chart.setOption({
    title: {
        text: 'Solar Energy',
        left: 'center',
    },
    tooltip: {
        trigger: 'axis',
        axisPointer: {
            animation: false
        }
    },
    legend: {
        data: ['Energy (KWh)', 'GHI (W/m^2)'],
        selected: {
            'GHI (W/m^2)': false
        },
        bottom: "3%",
        left: '8%'
    },
    xAxis: {
        type: 'category',
        data: [],
        show: false
    },
    yAxis: [{
        type: 'value',
        name: "Energy (KWh)",
        max: 10000,
        interval: 2000,
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
        name: 'Energy (KWh)',
        type: 'bar',
        yAxisIndex: 0,
        data: [],
        itemStyle: {
            normal: {
                color: function (params) {
                    if (params.value > 0 && params.value < calSolar(375)) {
                        return "#a52a2a";
                    } else if (params.value >= calSolar(375) && params.value < calSolar(625)) {
                        return "#daa520";
                    }
                    return "#8fbc8f";
                }
            }
        },
        animationDelay: function (idx) {
            return idx * 20 + 100;
        }
    }, {
        name: 'GHI (W/m^2)',
        type: 'line',
        yAxisIndex: 1,
        data: []
    }],
    animationEasing: 'elasticOut'
});
// Wind chart
wind_chart.setOption({
    title: {
        text: 'Wind Energy',
        left: 'center',
    },
    tooltip: {
        trigger: 'axis',
        axisPointer: {
            animation: false
        }
    },
    legend: {
        data: ['Energy (KWh)', 'Wind speed (m/s)'],
        selected: {
            'Wind speed (m/s)': false
        },
        bottom: "3%",
        left: '8%'
    },
    xAxis: {
        type: 'category',
        data: [],
        show: false
    },
    yAxis: [{
        type: 'value',
        name: "Energy (KWh)",
        max: 500,
        interval: 100,
        splitLine: {
            show: false
        },
        show: false,
    }, {
        type: 'value',
        name: "Wind speed (m/s)",
        max: 8,
        interval: 1.6,
        splitLine: {
            show: false
        },
        show: false
    }],
    series: [{
        name: 'Energy (KWh)',
        type: 'bar',
        yAxisIndex: 0,
        data: [],
        itemStyle: {
            normal: {
                color: function (params) {
                    if (params.value > 0 && params.value < calWind(2.78)) {
                        return "#a52a2a";
                    } else if (params.value >= calWind(2.78) && params.value < calWind(5.23)) {
                        return "#daa520";
                    }
                    return "#8fbc8f";
                }
            }
        },
        animationDelay: function (idx) {
            return idx * 20 + 100;
        }
    }, {
        name: 'Wind speed (m/s)',
        type: 'line',
        yAxisIndex: 1,
        data: []
    }],
    animationEasing: 'elasticOut'
});
// Declare ajax settings
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "https://weatherbit-v1-mashape.p.rapidapi.com/forecast/hourly?lang=en&hours=48&lat=53.87&lon=10.69",
    "method": "GET",
    "headers": {
        "x-rapidapi-host": "weatherbit-v1-mashape.p.rapidapi.com",
        "x-rapidapi-key": "7d66317eadmshc37b41f504ff1c7p1f42d9jsneee75038948b"
    }
}
// Attain asynchronous data
$.ajax(settings).done(function (response) {
    var arr_ghi = [];
    var arr_spd = [];
    var arr_ene_sol = [];
    var arr_ene_win = [];
    var arr_ene_ttl = [];
    var arr_end = [];
    var amt_red = 0, // Amount of certain lights
        amt_yel = 0,
        amt_gre = 0;
    // Store data
    for (i in response.data) {
        arr_ghi.push(Math.round(response.data[i].solar_rad));
        arr_spd.push(response.data[i].wind_spd.toFixed(2));
        arr_ene_sol.push(calSolar(response.data[i].solar_rad));
        arr_ene_win.push(calWind(response.data[i].wind_spd));
        arr_ene_ttl.push(calWind(response.data[i].wind_spd) + calSolar(response.data[i].solar_rad));
        arr_end.push(transDate(response.data[i].timestamp_utc));
    };
    // Calculate lights' amounts for pie chart
    for (i = 0; i < arr_ene_ttl.length; i++) {
        if (arr_ene_ttl[i] >= 0 && arr_ene_ttl[i] < 0.9 * calSolar(375) + 0.1 * calWind(2.78)) {
            amt_red++;
        } else if (arr_ene_ttl[i] >= 0.9 * calSolar(375) + 0.1 * calWind(2.78) && arr_ene_ttl[i] < 0.9 * calSolar(625) + 0.1 * calWind(5.23)) {
            amt_yel++;
        } else {
            amt_gre++;
        }
    };
    // console.log(arr_ghi);
    // Inject data in to the charts
    charts.hideLoading();
    solar_chart.hideLoading();
    wind_chart.hideLoading();
    charts.setOption({
        xAxis: {
            data: arr_end
        },
        series: [{
            name: 'Energy (KWh)',
            data: arr_ene_ttl
        }, {
            name: 'Ratio',
            data: [{
                name: 'Red light',
                value: amt_red,
                itemStyle: {
                    color: "#a52a2a"
                }
            }, {
                name: 'Yellow light',
                value: amt_yel,
                itemStyle: {
                    color: "#daa520"
                }
            }, {
                name: 'Green light',
                value: amt_gre,
                itemStyle: {
                    color: "#8fbc8f"
                }
            }]
        }]
    });
    solar_chart.setOption({
        xAxis: {
            data: arr_end
        },
        series: [{
            name: 'Energy (KWh)',
            data: arr_ene_sol
        }, {
            name: 'GHI (W/m^2)',
            data: arr_ghi
        }]
    });
    wind_chart.setOption({
        xAxis: {
            data: arr_end
        },
        series: [{
            name: 'Energy (KWh)',
            data: arr_ene_win
        }, {
            name: 'Wind speed (m/s)',
            data: arr_spd
        }]
    });
});