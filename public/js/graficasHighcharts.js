Highcharts.setOptions({
    lang: {
        drillUpText: '<< Regresar a {series.name}'
    }
});

function grafica (dibujarEn, tipo, ancho, alto, titulo, tituloXAxis, tituloYAxis, series, drilldown) {
	var opcionesGrafica = {
	    chart: {
	        renderTo: dibujarEn,
	        type:     tipo,
            width:    ancho,
            height:   alto
	    },
        credits: {
            enabled: false
        },
	    title: {
	    	text: titulo
	    },
	    xAxis: {
            type:  'category',
            labels: {
                autoRotation: [-10, -20, -30, -40, -50, -60, -70, -80, -90],
                style: {
                    fontFamily: 'Verdana, sans-serif'
                }
            },
            title: {
                text: tituloXAxis
            },
            categories: []
        },
        yAxis: {
            title: {
                text: tituloYAxis
            }
        },
        plotOptions: {
		    series: {
                borderWidth: 0,
                dataLabels: {
                    enabled: true
                },
                allowPointSelect: true,
                cursor: 'pointer'
            }
		},
		series:    series
	};

    if(drilldown !== null) {
        opcionesGrafica.drilldown = drilldown;
    }

	var graficaHighcharts = new Highcharts.Chart(opcionesGrafica);
}

function graficaMixta(dibujarEn, ancho, alto,  titulo, tituloXAxis, tituloYAxis, series, drilldown) {
	var opcionesGrafica = {
	    chart: {
	        renderTo: dibujarEn,
            width:    ancho,
            height:   alto
	    },
        credits: {
            enabled: false
        },
	    title: {
	    	text: titulo
	    },
	    xAxis: {
	    	type:  'category',
            labels: {
                autoRotation: [-10, -20, -30, -40, -50, -60, -70, -80, -90],
                style: {
                    fontFamily: 'Verdana, sans-serif'
                }
            },
            title: {
                text: tituloXAxis
            },
            categories: []
        },
        yAxis: {
            title: {
                text: tituloYAxis
            }
        },
        plotOptions: {
		     series: {
                borderWidth: 0,

                allowPointSelect: true,
                cursor: 'pointer'
            }
		},
		series:    series,
		drilldown: drilldown
	};

	var graficaHighcharts = new Highcharts.Chart(opcionesGrafica);
}