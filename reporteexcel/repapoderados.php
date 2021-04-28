<?php 
include '../control/cConexion.php';
include '../modelo/dboApoderado.php';
require '../phpexcel/PHPExcel.php';

if (isset($_GET['anio'])) {
     $anio=$_GET['anio'];
$hoja=0;
$fila=2;
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

    $objPHPExcel->setActiveSheetIndex($hoja);
$objPHPExcel->getActiveSheet()->setTitle('REGISTRO DE APODERADOS');
$inicio=$lfila[$columna].$fila;
$objPHPExcel->getActiveSheet()->setCellValue($lfila[$columna].$fila, 'NRO');
$columna++;
$objPHPExcel->getActiveSheet()->getColumnDimension($lfila[$columna])->setAutoSize(true);
$objPHPExcel->getActiveSheet()->setCellValue($lfila[$columna].$fila, 'DNI ALUMNO');
$columna++;
$objPHPExcel->getActiveSheet()->getColumnDimension($lfila[$columna])->setAutoSize(true);
$objPHPExcel->getActiveSheet()->setCellValue($lfila[$columna].$fila, 'NOMBRES Y APELLIDOS DEL ALUMNO');
$columna++;
$objPHPExcel->getActiveSheet()->getColumnDimension($lfila[$columna])->setAutoSize(true);
$objPHPExcel->getActiveSheet()->setCellValue($lfila[$columna].$fila, 'DNI APODERADO');
$columna++;
$objPHPExcel->getActiveSheet()->getColumnDimension($lfila[$columna])->setAutoSize(true);
$objPHPExcel->getActiveSheet()->setCellValue($lfila[$columna].$fila, 'NOMBRES Y APELLIDOS DEL APODERADO');
$columna++;
$objPHPExcel->getActiveSheet()->getColumnDimension($lfila[$columna])->setAutoSize(true);
$objPHPExcel->getActiveSheet()->setCellValue($lfila[$columna].$fila, 'NIVEL EDUCATIVO');
$columna++;
$objPHPExcel->getActiveSheet()->getColumnDimension($lfila[$columna])->setAutoSize(true);
$objPHPExcel->getActiveSheet()->setCellValue($lfila[$columna].$fila, 'GRADO Y SECCION');
$columna++;
$objPHPExcel->getActiveSheet()->getColumnDimension($lfila[$columna])->setAutoSize(true);
$objPHPExcel->getActiveSheet()->setCellValue($lfila[$columna].$fila, 'TELEFONO');
$columna++;
$objPHPExcel->getActiveSheet()->getColumnDimension($lfila[$columna])->setAutoSize(true);
$objPHPExcel->getActiveSheet()->setCellValue($lfila[$columna].$fila, 'DIRECCION');
$columna++;
$objPHPExcel->getActiveSheet()->getColumnDimension($lfila[$columna])->setAutoSize(true);
$objPHPExcel->getActiveSheet()->setCellValue($lfila[$columna].$fila, 'EXPORTACION');
$fin=$lfila[$columna].$fila;
$columna++; 
$objPHPExcel->getActiveSheet()->getStyle($inicio.':'.$fin)->getFill()
->setFillType(PHPExcel_Style_Fill::FILL_SOLID)
->getStartColor()->setARGB('FFDF80');
$apoderadosbd=new dboApoderado();
$apoderados=$apoderadosbd->datosApoderadosMatricula($anio);
$cont=0;
foreach ($apoderados as $asistencia) {
   $fila++;
   $cont++;
$columna=1; 
$objPHPExcel->getActiveSheet()->setCellValue($lfila[$columna].$fila, $cont);
$columna++;
$objPHPExcel->getActiveSheet()->setCellValue($lfila[$columna].$fila, $asistencia[0]);
$columna++;
$objPHPExcel->getActiveSheet()->setCellValue($lfila[$columna].$fila, $asistencia[1]);
$columna++;
$objPHPExcel->getActiveSheet()->setCellValue($lfila[$columna].$fila, $asistencia[2]);
$columna++;
$objPHPExcel->getActiveSheet()->setCellValue($lfila[$columna].$fila, $asistencia[3]);
$columna++;
$objPHPExcel->getActiveSheet()->setCellValue($lfila[$columna].$fila, $asistencia[7]);
$columna++; 
$objPHPExcel->getActiveSheet()->setCellValue($lfila[$columna].$fila, $asistencia[6]);
$columna++; 
$objPHPExcel->getActiveSheet()->setCellValue($lfila[$columna].$fila, $asistencia[5]);
$columna++; 
$objPHPExcel->getActiveSheet()->setCellValue($lfila[$columna].$fila, $asistencia[4]);
$columna++; 
$objPHPExcel->getActiveSheet()->setCellValue($lfila[$columna].$fila, 'PPC'.$asistencia[3].','.$asistencia[3].',,,,,,,,,,,,,,,,,,,,,,,,,,,* myContacts,Mobile,'.$asistencia[5]);
$columna++; 
$datosdocente=$anio;
}
 
$objPHPExcel->setActiveSheetIndex(0);
$nombre="Reporte_Apoderados_".$datosdocente."_".date('d-m-Y');
header("Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet");
header('Content-Disposition: attachment;filename="'.$nombre.'.xlsx"');
header('Cache-Control: max-age=0');
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$objWriter->save('php://output');
}