<?php
namespace Sise\Graficas;

/**
* @author Gerardo Adrián Gómez Ruiz
*/
class ConversorEvaluadosPendientesAreasPuntosHighcharts extends ConversorPuntos
{
	/**
	 * convertir la lista de evaluaciones pendientes en una gráfica de tipo columna
	 * se debe especificar la serie como un arreglo
	 * @param  array $listaDatos
	 * @return array
	 */
	public function convertir($listaDatos)
	{
		$listaFinal     = array();
		$listaSries     = array();
		$listaDrilldown = array(
			array(
				'id'            => 'direcciones',
				'name'          => 'Por Direcciones',
				'type'          => 'column',
				'data' => array(
					array(
						'name' => 'Médica-Toxicológica',
						'y'    => (int)$listaDatos[0]['no_entregados_falto_medico']
					),
					array(
						'name' => 'Psicología',
						'y'    => (int)$listaDatos[0]['no_entregados_falto_psicologia']
					),
					array(
						'name' => 'Inv. Socioeconómica',
						'y'    => (int)$listaDatos[0]['no_entregados_falto_socioeconomico']
					),
					array(
						'name' => 'Poligrafía',
						'y'    => (int)$listaDatos[0]['no_entregados_falto_poligrafia']
					)
				)
			),
			array(
				'id'            => 'archivo',
				'name'          => 'En archivo',
				'type'          => 'column',
				'data' => array(
					array(
						'name' => 'Entregó un área',
						'y'    => (int)$listaDatos[0]['en_archivo_entrego_un_area']
					),
					array(
						'name' => 'Expediente completo sin analizar',
						'y'    => (int)$listaDatos[0]['en_archivo_completos_sin_analizar']
					),
					array(
						'name' => 'Expediente completo sin analizar diferenciados',
						'y'    => (int)$listaDatos[0]['en_archivo_completos_sin_analizar_diferenciados']
					)
				)
			),
			array(
				'id'            => 'custodia',
				'name'          => 'Revisión custodia',
				'type'          => 'column',
				'data' => array(
					array(
						'name' => 'Revisión de analista',
						'y'    => (int)$listaDatos[0]['enRevisionAnalista']
					),
					array(
						'name' => 'Análisis de supervisor',
						'y'    => (int)$listaDatos[0]['analisisSupervisor']
					),
					array(
						'name' => 'Visto bueno de supervisor',
						'y'    => (int)$listaDatos[0]['vistoBuenoSupervisor']
					),
					array(
						'name' => 'Análisis de director de custodia',
						'y'    => (int)$listaDatos[0]['analisisDirectorCustodia']
					),
					array(
						'name' => 'Firma de director general',
						'y'    => (int)$listaDatos[0]['firmaDirectorGeneral']
					),
					array(
						'name' => 'Firmado y entregado a custodia',
						'y'    => (int)$listaDatos[0]['entregadoACustodia']
					)
				)
			)
		);

		$listaPuntos = array(
			array(
				'name'      => 'En analisis de custodia',
				'y'         => (int)$listaDatos[0]['entregados_en_proceso'],
				'drilldown' => 'custodia'
			),
			array(
				'name'      => 'En archivo',
				'y'         => (int)$listaDatos[0]['entregados_en_archivo'],
				'drilldown' => 'archivo'
			),
			array(
				'name'      => 'En direcciones',
				'y'         => (int)$listaDatos[0]['concluyo_no_entregados'],
				'drilldown' => 'direcciones'
			)
		);

		$listaSeries[] = array('name' => 'Pendientes', 'data' => $listaPuntos);
		// var_dump($listaPuntos);exit;
		// $listaSeries[]           = array('name' => 'En análisis de custodia', 'data' => array((int)$listaDatos[0]['entregados_en_proceso']));
		// $listaSeries[]           = array('name' => 'En archivo', 'data' => array((int)$listaDatos[0]['entregados_en_archivo']));
		// $listaSeries[]           = array('name' => 'En direcciones', 'data' => array(array('y' => (int)$listaDatos[0]['concluyo_no_entregados'], 'drilldown' => 'direcciones')));

		$listaFinal['series']    = $listaSeries;
		$listaFinal['drilldown'] = array(
			'drillUpButton' => array(
				'relativeTo'=> 'spacingBox'
			),
			'series'        => $listaDrilldown
		);

		return $listaFinal;
	}
}