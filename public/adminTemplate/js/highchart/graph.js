var count = 480;
$.get("https://min-api.cryptocompare.com/data/histominute?fsym=BTC&tsym=USD&limit=" + count + "&aggregate=3&e=CCCAGG", function(data, status) {
    var datarec = [];
    var data_time = [];

    for (var i = 0; i < data.Data.length; i++) {
        var ts = Date.UTC(data.Data[i].time);
        var d = new Date(data.Data[i].time * 1000)          
        var test = [Date.parse(d), data.Data[i].close];
        datarec.push(test)
    }

    Highcharts.chart('btc-container', {
        chart: {
            zoomType: 'x'
        },
        title: {
            text: 'BTC Current Value'
        },            
        xAxis: {
            type: 'datetime'
        },
        yAxis: {
            title: {
                text: 'BTC rate'
            }
        },
        legend: {
            enabled: false
        },
        plotOptions: {
            area: {
                fillColor: {
                    linearGradient: {
                    x1: 0,
                    y1: 0,
                    x2: 0,
                    y2: 1
                    },
                    stops: [
                        [0, '#F69619'],
                        [1, 'rgba(246,150,25, 0.50)']
                    ]
                },
                marker: {
                    radius: 2
                },
                lineWidth: 0,
                states: {
                    hover: {
                    lineWidth: 1
                    }
                },
                threshold: null
            }
        },

        series: [{
            type: 'area',
            name: 'BTC Rate',
            data: datarec
        }]
    });        
});

$.get("https://min-api.cryptocompare.com/data/histominute?fsym=ETH&tsym=USD&limit=" + count + "&aggregate=3&e=CCCAGG", function(data, status) {
    var datarec = [];
    var data_time = [];

    for (var i = 0; i < data.Data.length; i++) {
        var ts = Date.UTC(data.Data[i].time);
        var d = new Date(data.Data[i].time * 1000)          
        var test = [Date.parse(d), data.Data[i].close];
        datarec.push(test)
    }

    Highcharts.chart('eth-container', {
        chart: {
            zoomType: 'x'
        },
        title: {
            text: 'ETH Current Value'
        },            
        xAxis: {
            type: 'datetime'
        },
        yAxis: {
            title: {
                text: 'ETH rate'
            }
        },
        legend: {
            enabled: false
        },
        plotOptions: {
            area: {
                fillColor: {
                    linearGradient: {
                    x1: 0,
                    y1: 0,
                    x2: 0,
                    y2: 1
                    },
                    stops: [
                        [0, "#8c8c8c"],
                        [1, "rgba(140, 140, 140, 0.30)"]
                    ]
                },
                marker: {
                    radius: 2
                },
                lineWidth: 0,
                states: {
                    hover: {
                    lineWidth: 1
                    }
                },
                threshold: null
            }
        },

        series: [{
            type: 'area',
            name: 'ETH Rate',
            data: datarec
        }]
    });        
});
$.get("https://min-api.cryptocompare.com/data/histominute?fsym=BNB&tsym=USD&limit=" + count + "&aggregate=3&e=CCCAGG", function(data, status) {
    var datarec = [];
    var data_time = [];

    for (var i = 0; i < data.Data.length; i++) {
        var ts = Date.UTC(data.Data[i].time);
        var d = new Date(data.Data[i].time * 1000)          
        var test = [Date.parse(d), data.Data[i].close];
        datarec.push(test)
    }

    Highcharts.chart('bnb-container', {
        chart: {
            zoomType: 'x'
        },
        title: {
            text: 'BNB Current Value'
        },            
        xAxis: {
            type: 'datetime'
        },
        yAxis: {
            title: {
                text: 'BNB rate'
            }
        },
        legend: {
            enabled: false
        },
        plotOptions: {
            area: {
                fillColor: {
                    linearGradient: {
                    x1: 0,
                    y1: 0,
                    x2: 0,
                    y2: 1
                    },
                    stops: [
                        [0, "#8c8c8c"],
                        [1, "rgba(140, 140, 140, 0.30)"]
                    ]
                },
                marker: {
                    radius: 2
                },
                lineWidth: 0,
                states: {
                    hover: {
                    lineWidth: 1
                    }
                },
                threshold: null
            }
        },

        series: [{
            type: 'area',
            name: 'BNB Rate',
            data: datarec
        }]
    });        
});
$.get("https://min-api.cryptocompare.com/data/histominute?fsym=MATIC&tsym=USD&limit=" + count + "&aggregate=3&e=CCCAGG", function(data, status) {
    var datarec = [];
    var data_time = [];

    for (var i = 0; i < data.Data.length; i++) {
        var ts = Date.UTC(data.Data[i].time);
        var d = new Date(data.Data[i].time * 1000)          
        var test = [Date.parse(d), data.Data[i].close];
        datarec.push(test)
    }

    Highcharts.chart('matic-container', {
        chart: {
            zoomType: 'x'
        },
        title: {
            text: 'MATIC Current Value'
        },            
        xAxis: {
            type: 'datetime'
        },
        yAxis: {
            title: {
                text: 'MATIC rate'
            }
        },
        legend: {
            enabled: false
        },
        plotOptions: {
            area: {
                fillColor: {
                    linearGradient: {
                    x1: 0,
                    y1: 0,
                    x2: 0,
                    y2: 1
                    },
                    stops: [
                        [0, "#8c8c8c"],
                        [1, "rgba(140, 140, 140, 0.30)"]
                    ]
                },
                marker: {
                    radius: 2
                },
                lineWidth: 0,
                states: {
                    hover: {
                    lineWidth: 1
                    }
                },
                threshold: null
            }
        },

        series: [{
            type: 'area',
            name: 'MATIC Rate',
            data: datarec
        }]
    });        
});
$.get("https://min-api.cryptocompare.com/data/histominute?fsym=LTC&tsym=USD&limit=" + count + "&aggregate=3&e=CCCAGG", function(data, status) {
    var datarec = [];
    var data_time = [];

    for (var i = 0; i < data.Data.length; i++) {
        var ts = Date.UTC(data.Data[i].time);
        var d = new Date(data.Data[i].time * 1000)          
        var test = [Date.parse(d), data.Data[i].close];
        datarec.push(test)
    }

    Highcharts.chart('ltc-container', {
        chart: {
            zoomType: 'x'
        },
        title: {
            text: 'LTC Current Value'
        },            
        xAxis: {
            type: 'datetime'
        },
        yAxis: {
            title: {
                text: 'LTC rate'
            }
        },
        legend: {
            enabled: false
        },
        plotOptions: {
            area: {
                fillColor: {
                    linearGradient: {
                    x1: 0,
                    y1: 0,
                    x2: 0,
                    y2: 1
                    },
                    stops: [
                        [0, "#315D9E"],
                        [1, "rgba(49, 93, 158, 0.30)"]
                    ]
                },
                marker: {
                    radius: 2
                },
                lineWidth: 0,
                states: {
                    hover: {
                    lineWidth: 1
                    }
                },
                threshold: null
            }
        },

        series: [{
            type: 'area',
            name: 'LTC Rate',
            data: datarec
        }]
    });        
});
$.get("https://min-api.cryptocompare.com/data/histominute?fsym=XRP&tsym=USD&limit=" + count + "&aggregate=3&e=CCCAGG", function(data, status) {
    var datarec = [];
    var data_time = [];

    for (var i = 0; i < data.Data.length; i++) {
        var ts = Date.UTC(data.Data[i].time);
        var d = new Date(data.Data[i].time * 1000)          
        var test = [Date.parse(d), data.Data[i].close];
        datarec.push(test)
    }

    Highcharts.chart('xrp-container', {
        chart: {
            zoomType: 'x'
        },
        title: {
            text: 'XRP Current Value'
        },            
        xAxis: {
            type: 'datetime'
        },
        yAxis: {
            title: {
                text: 'XRP rate'
            }
        },
        legend: {
            enabled: false
        },
        plotOptions: {
            area: {
                fillColor: {
                    linearGradient: {
                    x1: 0,
                    y1: 0,
                    x2: 0,
                    y2: 1
                    },
                    stops: [
                        [0, "#0A85E9"],
                        [1, "rgba(10, 133, 233, 0.30)"]
                    ]
                },
                marker: {
                    radius: 2
                },
                lineWidth: 0,
                states: {
                    hover: {
                    lineWidth: 1
                    }
                },
                threshold: null
            }
        },

        series: [{
            type: 'area',
            name: 'XRP Rate',
            data: datarec
        }]
    });        
});