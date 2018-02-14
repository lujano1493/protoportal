$( document ).ready(function() {
    
/* Grafica BONO */
Math.easeOutBounce = function (pos) {
    if ((pos) < (1 / 2.75)) {
        return (7.5625 * pos * pos);
    }
    if (pos < (2 / 2.75)) {
        return (7.5625 * (pos -= (1.5 / 2.75)) * pos + 0.75);
    }
    if (pos < (2.5 / 2.75)) {
        return (7.5625 * (pos -= (2.25 / 2.75)) * pos + 0.9375);
    }
    return (7.5625 * (pos -= (2.625 / 2.75)) * pos + 0.984375);
};                            
var chart = Highcharts.chart('ContainerBono', {
    title: {
        text: ''
    },
     plotOptions: {
            column: {
                borderRadius: 5
            },
         series: {
                animation: {
                    duration: 2000,
                    easing: 'easeOutBounce'
                }
            }
        },
    chart: {
            inverted: true,
        },
    subtitle: {
        text: ''
    },
    xAxis: {
        categories: ['1er S', '2da S', '3er S', '4ta S'],
        title: {
                text: 'Semana'
            }
    },
     yAxis: {
            title: {
                text: '%'
            }
        },
    colors: ['#23819C', '#25A0C5', '#29AFD6', '#4FBDDD'],
    series: [{
        type: 'column',
        colorByPoint: true,
        data: [25,20,10,5],
        showInLegend: false,
        dataLabels: {
                enabled: true,
                format: '{y}%',
            }}]
    });

/* Grafica Distribucion */
Highcharts.chart('container', {
    chart: {
        plotBackgroundColor:null,
        plotBorderWidth: null,
        plotShadow: false,
        type: 'pie'
    },
    title: {
        text: 'FONDOS RECAUDADOS'
    },
    tooltip: {
        pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
    },
    plotOptions: {
        pie: {
            allowPointSelect: true,
            cursor: 'pointer',
            dataLabels: {
                enabled: false
            },
            showInLegend: true
        }
    },
    series: [{
        name: 'Porción',
        colorByPoint: true,
        data: [{
            name: 'CAPITAL DE INVERSIÓN',
            y: 60,
            sliced: true,
            selected: true
        }, {
            name: 'DESARROLLO DE PLATAFORMA Y OPERACIONES',
            y: 20,

        }, {
            name: 'MARKETING Y PUBLICIDAD',
            y: 10
        }, {
            name: 'LEGAL Y ADMINISTRACION',
            y: 5
        }, {
            name: 'EQUIPO Y FUNDADORES',
            y: 5
        }]
    }]
});

Highcharts.chart('container2', {
    chart: {
        plotBackgroundColor:null,
        plotBorderWidth: null,
        plotShadow: false,
        type: 'pie'
    },
    title: {
        text: 'DISTRIBUCION DE TOKENS'
    },
    tooltip: {
        pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
    },
    plotOptions: {
        pie: {
            allowPointSelect: true,
            cursor: 'pointer',
            dataLabels: {
                enabled: false
            },
            showInLegend: true
        }
    },
    series: [{
        name: 'Porción',
        colorByPoint: true,
        data: [{
            name: 'RETENIDOS PARA EL EQUIPO',
            y: 20,
            sliced: true,
            selected: true
        }, {
            name: 'RETENIDOS PARA FUTUROS TENEDORES',
            y: 20,

        }, {
            name: 'PARA BONUS ',
            y: 3
        }, {
            name: 'OPERACIÓN, PUBLICIDAD INICIAL y EMERGENCIAS',
            y: 2
        }, {
            name: 'PARA ASESORES',
            y: 5
        }, {
            name: 'PUBLICO INVERSIONISTA DURANTE LA VENTA INICIAL',
            y: 50
        }]
    }]
});

});