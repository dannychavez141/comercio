<?php 
include '../control/cConexion.php';
include '../modelo/dbotipoasistencia.php';
include '../modelo/dboAsistenciaDocente.php';
require '../phpexcel/PHPExcel.php';

if (isset($_GET['doc'])) {
    $doc=$_GET['doc'];
     $anio=$_GET['anio'];
      $fecha=$_GET['fecha'];
$hoja=0;
$fila=3;
$columna=1;
$lfila= array('A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z','AA' );
$objPHPExcel = new PHPExcel();
$objPHPExcel->getProperties()
        ->setCreator("Premium College")
        ->setLastModifiedBy("Premium College")
        ->setTitle("Excel en PHP")
        ->setSubject("Documento de prueba")
        ->setDescription("Documento generado con PHPExcel")
        ->setKeywords("excel phpexcel php")
        ->setCategory("Ejemplos");

 //  
$tiposbd=new dbotipoasistencia();
$tipos=$tiposbd->vertipos();
$cantidad= count($tipos);
$contador=0;
$inicio="";
$fin="";
$datosdocente="";
foreach ($tipos as $tipo) {
$contador++;
    $objPHPExcel->setActiveSheetIndex($hoja);
$objPHPExcel->getActiveSheet()->setTitle('REGISTRO DE '.$tipo[1].'S');
$inicio=$lfila[$columna].$fila;
$objPHPExcel->getActiveSheet()->setCellValue($lfila[$columna].$fila, 'DNI');
$columna++;
$objPHPExcel->getActiveSheet()->getColumnDimension($lfila[$columna])->setAutoSize(true);
$objPHPExcel->getActiveSheet()->setCellValue($lfila[$columna].$fila, 'DOCENTE O PERSONAL');
$columna++;
$objPHPExcel->getActiveSheet()->setCellValue($lfila[$columna].$fila, 'TIPO');
$columna++;
$objPHPExcel->getActiveSheet()->getColumnDimension($lfila[$columna])->setAutoSize(true);
$objPHPExcel->getActiveSheet()->setCellValue($lfila[$columna].$fila, 'FECHA');
$objPHPExcel->getActiveSheet()->getColumnDimension($lfila[$columna])->setAutoSize(true);
$columna++;
$objPHPExcel->getActiveSheet()->setCellValue($lfila[$columna].$fila, 'HORA');
$fin=$lfila[$columna].$fila;
$columna++; 
$objPHPExcel->getActiveSheet()->getStyle($inicio.':'.$fin)->getFill()
->setFillType(PHPExcel_Style_Fill::FILL_SOLID)
->getStartColor()->setARGB('FFDF80');
$asitenciasbd=new dboAsistenciaDocente();
$asistencias=$asitenciasbd->verAsistenciaDocenteExcel($doc, $fecha, $tipo[0], $anio);
foreach ($asistencias as $asistencia) {
   $fila++;
$columna=1; 
$objPHPExcel->getActiveSheet()->setCellValue($lfila[$columna].$fila, $asistencia[8]);
$columna++;
$objPHPExcel->getActiveSheet()->setCellValue($lfila[$columna].$fila, $asistencia[9].' '.$asistencia[10].' '.$asistencia[11]);
$columna++;
$objPHPExcel->getActiveSheet()->setCellValue($lfila[$columna].$fila, $asistencia[23]);
$columna++;
$objPHPExcel->getActiveSheet()->setCellValue($lfila[$columna].$fila, $asistencia[4]);
$columna++;
$objPHPExcel->getActiveSheet()->setCellValue($lfila[$columna].$fila, $asistencia[5]);
$columna++; 
$datosdocente=$asistencia[9].' '.$asistencia[10].' '.$asistencia[11];
}

if ($contador<$cantidad) {
 $objPHPExcel->createSheet();   
}
 
 $columna=1;
$fila=2;
$hoja++;
} 
$objPHPExcel->setActiveSheetIndex(0);
$nombre="Asistencias_".$datosdocente."_".date('d-m-Y');
header("Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet");
header('Content-Disposition: attachment;filename="'.$nombre.'.xlsx"');
header('Cache-Control: max-age=0');
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$objWriter->save('php://output');
}