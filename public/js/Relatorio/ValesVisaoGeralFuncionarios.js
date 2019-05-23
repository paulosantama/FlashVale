var jsonDadosPhp = $('#dadosPhp').text();
var dadosFunc = JSON.parse(jsonDadosPhp);
// console.log(dadosFunc);

var jsonEstatisticasPhp = $('#dadosEstatisticos').text();
var estatisticasPhp = JSON.parse(jsonEstatisticasPhp);
console.log(estatisticasPhp);

var processed_json = new Array();
// Populate series
for (i = 0; i < dadosFunc.length; i++) {
    pct = parseInt(dadosFunc[i].qtd) * 100 / estatisticasPhp['qtd_solicitacoes'];
    processed_json.push([dadosFunc[i].nome, parseFloat(pct.toFixed(1))]);
}
processed_json.sort(function (a, b) {
    if (a[1] < b[1]) {
        return 1;
    }
    if (a[1] > b[1]) {
        return -1;
    }
    // a must be equal to b
    return 0;
});
console.log(processed_json);

let theme2 = {
    colors: ['#2f7ed8', '#0d233a', '#8bbc21', '#910000', '#1aadce',
        '#492970', '#f28f43', '#77a1e5', '#c42525', '#a6c96a', '#FA18EF'],
    chart: {
        backgroundColor: null,
        style: {
            fontFamily: 'Dosis, sans-serif'
        }
    },
    title: {
        style: {
            fontSize: '16px',
            fontWeight: 'bold',
            textTransform: 'uppercase'
        }
    },
    tooltip: {
        borderWidth: 0,
        backgroundColor: 'rgba(219,219,216,0.8)',
        shadow: false
    },
    legend: {
        itemStyle: {
            fontWeight: 'bold',
            fontSize: '13px'
        }
    },
    xAxis: {
        gridLineWidth: 1,
        labels: {
            style: {
                fontSize: '12px'
            }
        }
    },
    yAxis: {
        minorTickInterval: 'auto',
        title: {
            style: {
                textTransform: 'uppercase'
            }
        },
        labels: {
            style: {
                fontSize: '12px'
            }
        }
    },
    plotOptions: {
        candlestick: {
            lineColor: '#404048'
        }
    },


    // General
    background2: '#F0F0EA'

};

let options2 = {
    exporting: {
        chartOptions: { // specific options for the exported image
            plotOptions: {
                series: {
                    dataLabels: {
                        enabled: true
                    }
                }
            }
        },
        fallbackToExportServer: false
    },
    chart: {
        plotBackgroundColor: null,
        plotBorderWidth: null,
        plotShadow: false,
        type: 'pie'
    },
    title: {
        text: 'Funcionários'
    },
    tooltip: {
        pointFormat: '<b>{point.percentage:.1f}%</b>'
        // pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
    },
    plotOptions: {
        pie: {
            allowPointSelect: true,
            cursor: 'pointer',
            dataLabels: {
                enabled: false,
                format: '<b>{point.name}</b>: {point.percentage:.1f} %',
                style: {
                    color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
                }
            },
            showInLegend: false
        }
    },
    series: [{
        name: 'Porcentagem',
        colorByPoint: true,
        data: processed_json
    }]
};

let options3 = {
    chart: {
        type: 'bar'
    },
    title: {
        text: 'Funcionários',
    },
    subtitle: {
        text: 'Participação dos funcionários nas solicitações de vale.'
    },
    xAxis: {
        type: 'category',
        title: {
            text: null
        }
    },
    yAxis: {
        min: 0,
        max: 100,
        title: {
            text: '%',
            align: 'high'
        },
        labels: {
            overflow: 'justify'
        }
    },
    tooltip: {
        valueSuffix: '%',
        pointFormat: '<b>{point.y}</b>'
    },
    plotOptions: {
        bar: {
            allowPointSelect: true,
            cursor: 'pointer',
            dataLabels: {
                enabled: false
            },
            showInLegend: false
        }
    },
    credits: {
        enabled: false
    },
    series: [{
        colorByPoint: true,
        data: processed_json
    }]
};

let chart2 = new Highcharts.Chart('container2', Highcharts.merge(theme2, options3));



