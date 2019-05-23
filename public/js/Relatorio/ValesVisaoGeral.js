var jsonEstatisticasPhp = $('#dadosEstatisticos').text();
var estatisticasPhp = JSON.parse(jsonEstatisticasPhp);
// console.log(estatisticasPhp);

var pct_analise = estatisticasPhp['qtd_solicitacoes_analise'] * 100 / estatisticasPhp['qtd_solicitacoes'];
var pct_aprovada = estatisticasPhp['qtd_solicitacoes_aprovadas'] * 100 / estatisticasPhp['qtd_solicitacoes'];
var pct_reprovada = estatisticasPhp['qtd_solicitacoes_reprovadas'] * 100 / estatisticasPhp['qtd_solicitacoes'];

let theme1 = {
    colors: ['#faef6f', '#3CB371', '#ff4d5c'],
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

let options1 = {
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
        text: 'Status'
    },
    tooltip: {
        pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
    },
    plotOptions: {
        pie: {
            cursor: 'pointer',
            dataLabels: {
                enabled: false
            },
            showInLegend: true
        }
    },
    series: [{
        name: 'Porcentagem',
        colorByPoint: true,
        data: [{
            name: 'Em Análise',
            y: pct_analise
        }, {
            name: 'Aprovados',
            y: pct_aprovada
        }, {
            name: 'Reprovados',
            y: pct_reprovada
        }]
    }]
};

let chart1 = new Highcharts.Chart('container1', Highcharts.merge(options1, theme1));



