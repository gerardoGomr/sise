function grafica (dibujarEn, tipo, titulo, tituloXAxis, tituloYAxis, series) {
	var opcionesGrafica = {
	    chart: {
	        renderTo: dibujarEn,
	        type:     tipo
	    },
	    title: {
	    	text: titulo
	    },
	    xAxis: {
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
		    line: {
		        dataLabels: {
		            enabled: true
		        }
		    }
		},
		series: series
	};

	var graficaHighcharts = new Highcharts.Chart(opcionesGrafica);
}

function graficaMixta(dibujarEn, titulo, tituloXAxis, tituloYAxis, series) {
	var opcionesGrafica = {
	    chart: {
	        renderTo: dibujarEn
	    },
	    title: {
	    	text: titulo
	    },
	    xAxis: {
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
		    line: {
		        dataLabels: {
		            enabled: true
		        }
		    }
		},
		series: series
	};

	var graficaHighcharts = new Highcharts.Chart(opcionesGrafica);
}