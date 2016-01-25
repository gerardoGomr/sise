<?php

namespace Sise\Http\Controllers\Archivo;

use Illuminate\Http\Request;
use Response;
use File;
use Sise\Http\Requests;
use Sise\Http\Controllers\Controller;


use Illuminate\Pagination\LengthAwarePaginator as Paginator;
use Illuminate\Support\Collection;

use Sise\Archivo\ConversorReportePuntosHighcharts;
use Sise\Archivo\ConversorReporteEnArchivoPuntosHighcharts;
use Sise\Archivo\ConversorReporteEnProcesoPuntosHighcharts;
use Sise\Archivo\ConversorIngresosPuntosHighcharts;

use Sise\Catalogos\CatalogoRepositorioInterface;
use Sise\Archivo\ReportesRepositorioInterface;
use View;
use COM;


class LaravelArchivoController extends Controller
{	
    protected $archivoReporteRepositorio;
    
    protected $catalogoRepositorio;
	

    public function __construct(ReportesRepositorioInterface $archivoReporteRepositorio,
        
        CatalogoRepositorioInterface $catalogoRepositorio)
    {        
        $this->archivoReporteRepositorio = $archivoReporteRepositorio;
        
        $this->catalogoRepositorio = $catalogoRepositorio;
    }

    public function getDatosGraficaNoEntregados(Request $request)
    {
        $anio =(int)$request->get('anio');
                
        $dashboard = $this->archivoReporteRepositorio->obtenerDatosIngresos($anio);
       /* $conversor = new ConversorReportePuntosHighcharts();
        $dashboard = $conversor->convertir($dashboard);
        */
        //return View::make('archivo.reporte_no_entregados_detalle', array('dashboard'=>$dashboard));
        return Response::json(View::make('archivo.reporte_no_entregados_detalle', array('dashboard' => $dashboard))
            ->render());
    }

    public function getDaTosGraficaEnArchivo(Request $request)
    {
        $anio =(int)$request->get('anio');
        
        $dashboard = $this->archivoReporteRepositorio->obtenerDatosIngresos($anio);
        /*$conversor = new ConversorReporteEnArchivoPuntosHighcharts();
        $dashboard = $conversor->convertir($dashboard);
        
        return View::make('archivo.reporte_en_archivo_grafica', array('chart'=>$dashboard));*/
        return Response::json(View::make('archivo.reporte_en_archivo_detalle', array('dashboard' => $dashboard))
            ->render());
    }

    public function getDaTosGraficaEnProceso(Request $request)
    {
        $anio =(int)$request->get('anio');
        
        $dashboard = $this->archivoReporteRepositorio->obtenerDatosIngresos($anio);
        $conversor = new ConversorReporteEnProcesoPuntosHighcharts();
        $dashboard = $conversor->convertir($dashboard);
       
        return View::make('archivo.dashboard_grafica', array('chart'=>$dashboard));
        //return Response::json(View::make('archivo.reporte_en_proceso_detalle', array('dashboard' => $dashboard))
          //  ->render());
    }

    public function index($anio_selecionado=null)
    {
        $anio = $this->catalogoRepositorio->obtenerCatalogo('anio');

        $seleccionado=$anio_selecionado;

        return View::make('archivo.dashboard', array('anio'=>$anio))
        ->with(compact('seleccionado'));
    }
    
    public function expedientesCustodia(Request $request)
    {
        $anio = (int)$request->get('anio');
                
        $listaDatos = $this->archivoReporteRepositorio->obtenerDatosIngresos($anio);
        $conversor = new ConversorIngresosPuntosHighcharts();
        $listaFinal = $conversor->convertir($listaDatos);
        
        return View::make('archivo.dashboard_grafica', array('chart'=>$listaFinal));
    }

    public function getDatosTotales(Request $request){
        $anio = (int)$request->get('anio');
                
        $listaDatos = $this->archivoReporteRepositorio->obtenerDatosIngresos($anio);        
        
        return Response::json(View::make('archivo.dashboard_totales', array('totales' => $listaDatos))->render());
    }

    public function reporteTotalesIndex($anio_selecionado=null)
    {        
        $anio = $this->catalogoRepositorio->obtenerCatalogo('anio');
         
        $estatus = $this->catalogoRepositorio->obtenerCatalogo('estatus_custodia_completo');
        $estatus=array('8'=>'Todos')+$estatus;   

        $tipo = $this->catalogoRepositorio->obtenerCatalogo('evaluacion');
        $tipo=array('T'=>'Todos')+$tipo;      
        

        $opciones = array('T'=>'Todos', 
            'EE'=>'Entrego Area-Entrego Custodia (EE)', 
            'EN'=>'Entrego Area-No Entrego Custodia (EN)', 
            'NE'=>'No Entrego Area-Entrego Custodia (NE)', 
            'NN'=>'No Entrego Area-No Entrego Custodia (NN)');    

        $diferenciada = array('T'=>'Todos', 'SI'=>'Si', 'NO'=>'No');
        
        $concluyo= array('T'=>'Todos', 'SI'=>'Si', 'NO'=>'No');

        $seleccionado=$anio_selecionado;

        return View::make('archivo.reporte_totales', array('anio'=>$anio, 
            'estatus'=>$estatus,'opciones'=>$opciones, 'diferenciada'=>$diferenciada,
            'concluyo'=>$concluyo, 'tipo'=>$tipo))
            ->with(compact('seleccionado'));
    }

    public function getDatosReporteTotales(Request $request)
    {
        $anio = (int)$request->get('anio');
        $estatus = $request->get('estatus');
        $concluyo = $request->get('concluyo');
        $diferenciada = $request->get('diferenciada');
        $tipo = $request->get('tipo');  

        $medico = $request->get('medico');
        $psicologia = $request->get('psicologia');
        $socioeconomico = $request->get('socioeconomico');
        $poligrafia = $request->get('poligrafia');  
             
        $listaEvaluados = $this->archivoReporteRepositorio->obtenerDatosTotales($anio,$estatus, $concluyo, $diferenciada, $tipo, $medico, $psicologia, $socioeconomico, $poligrafia);
             
        $results = array(
            "sEcho" => 1,
            "iTotalRecords" => count($listaEvaluados),
            "iTotalDisplayRecords" => count($listaEvaluados),
            "aaData"=>$listaEvaluados);

        return json_encode($results); 
    }

    public function reporteNoEntregadosIndex($anio_selecionado=null)
    {        
        $anio = $this->catalogoRepositorio->obtenerCatalogo('anio');
                  
        $opciones = array('Todos'=>'Todos', 'Entrego'=>'Entrego', 'No entrego'=>'No entrego');
        
        $seleccionado=$anio_selecionado;

        return View::make('archivo.reporte_no_entregados', array('anio'=>$anio, 'opciones'=>$opciones))
            ->with(compact('seleccionado'));
    }
        
    public function getDatosReporteNoEntregados(Request $request)
    {
        $anio = (int)$request->get('anio');
        $medico = $request->get('medico');
        $psicologia = $request->get('psicologia');
        $socioeconomico = $request->get('socioeconomico');
        $poligrafia = $request->get('poligrafia');
        $pagina = $request->get('page');
        
        $listaEvaluados = $this->archivoReporteRepositorio->obtenerDatosReporteNoEntregados($anio, $medico, $psicologia, $socioeconomico, $poligrafia);
             
        $results = array(
            "sEcho" => 1,
            "iTotalRecords" => count($listaEvaluados),
            "iTotalDisplayRecords" => count($listaEvaluados),
            "aaData"=>$listaEvaluados);

        return json_encode($results); 
    }

    public function getReporteNoEntregados(Request $request)
    {
        $anio = (int)$request->get('anio');
        $medico = $request->get('medico');
        $psicologia = $request->get('psicologia');
        $socioeconomico = $request->get('socioeconomico');
        $poligrafia = $request->get('poligrafia');

        // rutas para la apertura de reporte y para el guardado en una ubicación del servidor
        $my_report = "C:\\wamp\\www\\sise\\resources\\assets\\reportes\\reportes_expedientes_no_entregados.rpt"; // Ruta fisica al reporte en el servidor
        
        $exp_pdf = "C:\\wamp\\www\\sise\\public\\reportes\\reportes_expedientes_no_entregados.pdf"; // ruta fisica donde se guardara el PDF resultado en el servidor
        
        // Instancio el Object Factory de Crystal Reports
        try
        {

            $ObjectFactory = New COM("CrystalReports.ObjectFactory");
            // Creo una instancia del Componente de Diseñador de Crystal Reports
            try
            {
                $crapp = $ObjectFactory->CreateObject("CrystalDesignRuntime.Application");
                // Mando abrir mi reporte
                $creport = $crapp->OpenReport($my_report, 1);
            }
            catch(Exception $e)
            {
                return $e->getMessage()."<br />";
                //print_r($e->getTrace());
                //exit();
            }

            // Conexion a la base de datos
            // $creport->Database->Tables(1)->SetLogOnInfo("10.10.100.24", "Integral", "sa", "Theesco10");
            $creport->Database->Tables(1)->SetLogOnInfo("(local)", "Integral", "sa", "102938");

            //Con Enable Parameter Promting evito que lanze el formulario de captura de parametros ya que el browser del usuario no puede interactuar con el escritorio o el componente que crea el formulario.
            $creport->EnableParameterPrompting = 0;

            //limpiar caché
            $creport->DiscardSavedData;
            // $creport->ReadRecords();
           
           //obetener la lista de parámetros necesarios para la apertura del cristal report
            $param = $creport->ParameterFields;
            
            //asignación de valores para los parámetros:
            //1 = curp; 2 = num evaluacion; 3 = usuario evaluador
                       
            $param->Item(1)->AddCurrentValue(intval($anio));
            $param->Item(2)->AddCurrentValue(strtoupper($medico));
            $param->Item(3)->AddCurrentValue(strtoupper($psicologia));
            $param->Item(4)->AddCurrentValue(strtoupper($socioeconomico));
            $param->Item(5)->AddCurrentValue(strtoupper($poligrafia));
            
            //opciones de exportación
            $creport->ExportOptions->DiskFileName = $exp_pdf;
            $creport->ExportOptions->PDFExportAllPages = true;
            $creport->ExportOptions->DestinationType = 1;
            $creport->ExportOptions->FormatType = 31;
              
            // Exporto el reporte
            $creport->Export(false);
           
        }
        catch (Exception $e)
        {
            return $e->getMessage()."<br />";           
        }

        // Limpiar objetos
        $creport = null;
        $crapp = null;
        $ObjectFactory = null;
        $param = null;


        if (File::isFile($exp_pdf))
        {
            $file = File::get($exp_pdf);
            //$content = View::make('archivo.archivo_reporte');
            $response = Response::make($file, 200);
            // using this will allow you to do some checks on it (if pdf/docx/doc/xls/xlsx)
            $response->header('Content-Type', 'application/pdf');

            return $response; //"/reportes/archivo_reporte.pdf";
        }
    }
    
    public function reporteEnArchivoIndex($anio_selecionado=null)
    {        
        $anio = $this->catalogoRepositorio->obtenerCatalogo('anio');
                  
        $opciones = array('Todos'=>'Todos', 'Entrego'=>'Entrego', 'No entrego'=>'No entrego');

        $area = array('Todos'=>'Todos', 'medico'=>'Medico', 'psicologia'=>'Psicologia', 'socioeconomico'=>'Socioeconomico', 'poligrafia'=>'Poligrafia');

        $estatus = array('5'=>'Todos', '4'=>'Completos', '3'=>'Incompletos');

        $es_diferenciada = array('2'=>'Todos', '1'=>'Diferenciadas', '0'=>'No Diferenciadas');
        
        $numero_entregados = array('5'=>'Todos', '1'=>'1 area', '2'=>'2 areas', '3'=>'3 areas');
        
        $seleccionado=$anio_selecionado;

        return View::make('archivo.reporte_en_archivo', array('anio'=>$anio, 'opciones'=>$opciones, 
            'estatus'=>$estatus, 'es_diferenciada'=>$es_diferenciada, 'area'=>$area, 'numero_entregados'=>$numero_entregados))
            ->with(compact('seleccionado'));
    }

    public function getDatosReporteEnArchivo(Request $request)
    {
        $anio = (int)$request->get('anio');
        $medico = $request->get('medico');
        $psicologia = $request->get('psicologia');
        $socioeconomico = $request->get('socioeconomico');
        $poligrafia = $request->get('poligrafia');        
        $es_diferenciada = $request->get('estatus_diferenciadas');
        $estatus_expediente = $request->get('estatus_expediente');
        $filtro_por_numero = $request->get('filtro');
        $no_areas = $request->get('no_area');

        //Todos
        if($estatus_expediente=='5'){
            $no_areas_inicial = 5;
            $no_areas_final = 5;

            $medico = 'TODOS';
            $psicologia = 'TODOS';
            $socioeconomico = 'TODOS';
            $poligrafia = 'TODOS';
           
        }

        //Incompletos Diferenciados
        if($estatus_expediente=='3' && $es_diferenciada==1){
            $no_areas_inicial = 0;
            $no_areas_final = 2;            
        }

        //Incompletos No Diferenciados
        if($estatus_expediente=='3' && $es_diferenciada==0){
            $no_areas_inicial = 0;
            $no_areas_final = 3;            
        }

         //Incompletos Todos
        if($estatus_expediente=='3' && $es_diferenciada==2){
            $no_areas_inicial = 2;
            $no_areas_final = 3;            
        }

        //Completos Diferenciados
        if($estatus_expediente=='4' && $es_diferenciada==1){
            $no_areas_inicial = 3;
            $no_areas_final = 3;
        }

        //Completos NO Diferenciados
        if($estatus_expediente=='4' && $es_diferenciada==0){
            $no_areas_inicial = 4;
            $no_areas_final = 4;
        }

        //Completos Todos
        if($estatus_expediente=='4' && $es_diferenciada==2){
            $no_areas_inicial = 3;
            $no_areas_final = 4;
        }

        if($filtro_por_numero=='si'){
            //$es_diferenciada=1;
            $estatus_expediente=6;
            $no_areas_inicial = $no_areas;
            $no_areas_final = $no_areas;

            $medico = 'TODOS';
            $psicologia = 'TODOS';
            $socioeconomico = 'TODOS';
            $poligrafia = 'TODOS';
        }

        

        $pagina = $request->get('page');
        
        $listaEvaluados = $this->archivoReporteRepositorio->obtenerDatosReporteEnArchivo($anio, $medico, $psicologia, $socioeconomico, $poligrafia, $es_diferenciada, $no_areas_inicial, $no_areas_final, $estatus_expediente);
        

        $results = array(
            "sEcho" => 1,
            "iTotalRecords" => count($listaEvaluados),
            "iTotalDisplayRecords" => count($listaEvaluados),
            "aaData"=>$listaEvaluados);

        return json_encode($results); 
    }

    public function getReporteEnArchivo(Request $request)
    {
        $anio = (int)$request->get('anio');
        $medico = $request->get('medico');
        $psicologia = $request->get('psicologia');
        $socioeconomico = $request->get('socioeconomico');
        $poligrafia = $request->get('poligrafia');

        $diferenciada = $request->get('diferenciada');
        $inicial = $request->get('inicial');
        $final = $request->get('final');

        // rutas para la apertura de reporte y para el guardado en una ubicación del servidor
        $my_report = "C:\\wamp\\www\\sise\\resources\\assets\\reportes\\reportes_expedientes_en_archivo.rpt"; // Ruta fisica al reporte en el servidor
        
        $exp_pdf = "C:\\wamp\\www\\sise\\public\\reportes\\reporte_expedientes_en_archivo.pdf"; // ruta fisica donde se guardara el PDF resultado en el servidor
        
        // Instancio el Object Factory de Crystal Reports
        try
        {

            $ObjectFactory = New COM("CrystalReports.ObjectFactory");
            // Creo una instancia del Componente de Diseñador de Crystal Reports
            try
            {
                $crapp = $ObjectFactory->CreateObject("CrystalDesignRuntime.Application");
                // Mando abrir mi reporte
                $creport = $crapp->OpenReport($my_report, 1);
            }
            catch(Exception $e)
            {
                return $e->getMessage()."<br />";
                //print_r($e->getTrace());
                //exit();
            }

            // Conexion a la base de datos
            // $creport->Database->Tables(1)->SetLogOnInfo("10.10.100.24", "Integral", "sa", "Theesco10");
            $creport->Database->Tables(1)->SetLogOnInfo("(local)", "Integral", "sa", "102938");

            //Con Enable Parameter Promting evito que lanze el formulario de captura de parametros ya que el browser del usuario no puede interactuar con el escritorio o el componente que crea el formulario.
            $creport->EnableParameterPrompting = 0;

            //limpiar caché
            $creport->DiscardSavedData;
            // $creport->ReadRecords();
           
           //obetener la lista de parámetros necesarios para la apertura del cristal report
            $param = $creport->ParameterFields;
            
            //asignación de valores para los parámetros:
            //1 = curp; 2 = num evaluacion; 3 = usuario evaluador
                       
            $param->Item(1)->AddCurrentValue(intval($anio));
            $param->Item(2)->AddCurrentValue(strtoupper($medico));
            $param->Item(3)->AddCurrentValue(strtoupper($psicologia));
            $param->Item(4)->AddCurrentValue(strtoupper($socioeconomico));
            $param->Item(5)->AddCurrentValue(strtoupper($poligrafia));
            
            $param->Item(6)->AddCurrentValue(intval($diferenciada));
            $param->Item(7)->AddCurrentValue(intval($inicial));
            $param->Item(8)->AddCurrentValue(intval($final));

            //opciones de exportación
            $creport->ExportOptions->DiskFileName = $exp_pdf;
            $creport->ExportOptions->PDFExportAllPages = true;
            $creport->ExportOptions->DestinationType = 1;
            $creport->ExportOptions->FormatType = 31;
              
            // Exporto el reporte
            $creport->Export(false);
           
        }
        catch (Exception $e)
        {
            return $e->getMessage()."<br />";           
        }

        // Limpiar objetos
        $creport = null;
        $crapp = null;
        $ObjectFactory = null;
        $param = null;


        if (File::isFile($exp_pdf))
        {
            $file = File::get($exp_pdf);
            //$content = View::make('archivo.archivo_reporte');
            $response = Response::make($file, 200);
            // using this will allow you to do some checks on it (if pdf/docx/doc/xls/xlsx)
            $response->header('Content-Type', 'application/pdf');

            return $response; //"/reportes/archivo_reporte.pdf";
        }
    }
    
    public function reporteEnProcesoIndex($anio_selecionado=null)
    {
        $anio = $this->catalogoRepositorio->obtenerCatalogo('anio');                
        
        $estatus = $this->catalogoRepositorio->obtenerCatalogo('estatus_custodia');
            
        $estatus=array('8'=>'Todos')+$estatus;        

        $seleccionado=$anio_selecionado;

        return View::make('archivo.reporte_en_proceso', array('anio'=>$anio,'estatus'=>$estatus))
            ->with(compact('seleccionado'));

    }

    public function getDatosReporteEnProceso(Request $request)
    {
        $anio = (int)$request->get('anio');
        $estatus = $request->get('estatus');
        
        $pagina = $request->get('page');
        
        $listaEvaluados = $this->archivoReporteRepositorio->obtenerDatosReporteEnProceso($anio, $estatus);
          
         $results = array(
            "sEcho" => 1,
            "iTotalRecords" => count($listaEvaluados),
            "iTotalDisplayRecords" => count($listaEvaluados),
            "aaData"=>$listaEvaluados);

        return json_encode($results);    
    }

     public function getReporteEnProceso(Request $request)
    {
        $anio = (int)$request->get('anio');
        $estatus = $request->get('estatus');
        
        // rutas para la apertura de reporte y para el guardado en una ubicación del servidor
        $my_report = "C:\\wamp\\www\\sise\\resources\\assets\\reportes\\reportes_expedientes_en_proceso.rpt"; // Ruta fisica al reporte en el servidor
        
        $exp_pdf = "C:\\wamp\\www\\sise\\public\\reportes\\reportes_expedientes_en_proceso.pdf"; // ruta fisica donde se guardara el PDF resultado en el servidor
        
        // Instancio el Object Factory de Crystal Reports
        try
        {

            $ObjectFactory = New COM("CrystalReports.ObjectFactory");
            // Creo una instancia del Componente de Diseñador de Crystal Reports
            try
            {
                $crapp = $ObjectFactory->CreateObject("CrystalDesignRuntime.Application");
                // Mando abrir mi reporte
                $creport = $crapp->OpenReport($my_report, 1);
            }
            catch(Exception $e)
            {
                return $e->getMessage()."<br />";
                //print_r($e->getTrace());
                //exit();
            }

            // Conexion a la base de datos
            // $creport->Database->Tables(1)->SetLogOnInfo("10.10.100.24", "Integral", "sa", "Theesco10");
            $creport->Database->Tables(1)->SetLogOnInfo("(local)", "Integral", "sa", "102938");

            //Con Enable Parameter Promting evito que lanze el formulario de captura de parametros ya que el browser del usuario no puede interactuar con el escritorio o el componente que crea el formulario.
            $creport->EnableParameterPrompting = 0;

            //limpiar caché
            $creport->DiscardSavedData;
            // $creport->ReadRecords();
           
           //obetener la lista de parámetros necesarios para la apertura del cristal report
            $param = $creport->ParameterFields;
            
            //asignación de valores para los parámetros:
            //1 = curp; 2 = num evaluacion; 3 = usuario evaluador
                       
            $param->Item(1)->AddCurrentValue(intval($anio));
            $param->Item(2)->AddCurrentValue(intval($estatus));
           
            
            //opciones de exportación
            $creport->ExportOptions->DiskFileName = $exp_pdf;
            $creport->ExportOptions->PDFExportAllPages = true;
            $creport->ExportOptions->DestinationType = 1;
            $creport->ExportOptions->FormatType = 31;
              
            // Exporto el reporte
            $creport->Export(false);
           
        }
        catch (Exception $e)
        {
            return $e->getMessage()."<br />";           
        }

        // Limpiar objetos
        $creport = null;
        $crapp = null;
        $ObjectFactory = null;
        $param = null;


        if (File::isFile($exp_pdf))
        {
            $file = File::get($exp_pdf);
            //$content = View::make('archivo.archivo_reporte');
            $response = Response::make($file, 200);
            // using this will allow you to do some checks on it (if pdf/docx/doc/xls/xlsx)
            $response->header('Content-Type', 'application/pdf');

            return $response; 
        }
    }



}