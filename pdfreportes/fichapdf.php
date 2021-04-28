<?php

include '../control/cConexion.php';
include '../modelo/mficha.php';
require '../phpexcel/PHPExcel.php';

function marcar($m) {
    if ($m == '1') {
        return 'X';
    } else {
        return ' ';
    }
}

function verdad($m) {
    if ($m == '1') {
        return 'SI';
    } else {
        return 'NO';
    }
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $hoja = 0;
    $fila = 3;
    $columna = 1;
    $lfila = array('A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z', 'AA');
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
    $contador = 0;
    $inicio = "";
    $fin = "";
    $datosdocente = "";
    $ficha = new mficha();
    $cabecera = $ficha->verunaFicha($id);
    $competencias = json_decode($ficha->verFichaComp($id), true);
    $sheet = $objPHPExcel->getActiveSheet();
    $contador++;
    $objPHPExcel->setActiveSheetIndex($hoja);
    $objPHPExcel->getActiveSheet()->setTitle('FICHA DE CONTROL');
    $inicio = $lfila[$columna] . $fila;
    $objPHPExcel->getActiveSheet()->setCellValue($lfila[$columna] . $fila, 'DOCENTE');

    $columna++;
    $objPHPExcel->getActiveSheet()->getColumnDimension($lfila[$columna])->setAutoSize(true);
    $objPHPExcel->getActiveSheet()->setCellValue($lfila[$columna] . $fila, $cabecera['apepa'] . ' ' . $cabecera['apema'] . ' ' . $cabecera['nomb']);

    $fila++;
    $columna--;
    $objPHPExcel->getActiveSheet()->getColumnDimension($lfila[$columna])->setAutoSize(true);
    $objPHPExcel->getActiveSheet()->setCellValue($lfila[$columna] . $fila, 'GRADO Y SECCION');
    $columna++;
    $objPHPExcel->getActiveSheet()->setCellValue($lfila[$columna] . $fila, $cabecera['grado'] . ' ' . $cabecera['seccion'] . ' ' . $cabecera['nivel'] . ' ' . $cabecera['anio']);
    $fila++;
    $columna--;
    $objPHPExcel->getActiveSheet()->setCellValue($lfila[$columna] . $fila, 'COMPETENCIAS');
    $columna++;
    foreach ($competencias as $competencia) {
        $objPHPExcel->getActiveSheet()->getColumnDimension($lfila[$columna])->setAutoSize(true);
        $objPHPExcel->getActiveSheet()->setCellValue($lfila[$columna] . $fila, "*" . $competencia['competencia']);
        $fila++;
    }
    $columna--;
    $objPHPExcel->getActiveSheet()->getColumnDimension($lfila[$columna])->setAutoSize(true);
    $objPHPExcel->getActiveSheet()->setCellValue($lfila[$columna] . $fila, 'SESION');
    $columna++;
    $objPHPExcel->getActiveSheet()->getColumnDimension($lfila[$columna])->setAutoSize(true);
    $objPHPExcel->getActiveSheet()->setCellValue($lfila[$columna] . $fila, $cabecera['nsesion']);
    $fila++;
    $columna--;
    $objPHPExcel->getActiveSheet()->getColumnDimension($lfila[$columna])->setAutoSize(true);
    $objPHPExcel->getActiveSheet()->setCellValue($lfila[$columna] . $fila, 'SEMANA');
    $columna++;
    $objPHPExcel->getActiveSheet()->setCellValue($lfila[$columna] . $fila, $cabecera['nsemana']);
    $fila++;
    $columna--;
    $objPHPExcel->getActiveSheet()->setCellValue($lfila[$columna] . $fila, 'FECHA');
    $columna++;
    $objPHPExcel->getActiveSheet()->setCellValue($lfila[$columna] . $fila, $cabecera['fecha']);
    $columna--;
    $fin = $lfila[$columna] . $fila;
    $fila++;
    $objPHPExcel->getActiveSheet()->getStyle($inicio . ':' . $fin)->getFill()
            ->setFillType(PHPExcel_Style_Fill::FILL_SOLID)
            ->getStartColor()->setARGB('FFDF80');
   
    $fila++;
    $alumnos = json_decode($ficha->verFichaAlum($id), true);
    $i = 1;
     $inicio = $lfila[$columna] . $fila;
    $columna = 1;
    $objPHPExcel->getDefaultStyle()->getAlignment()->setWrapText(true);
    $objPHPExcel->getActiveSheet()->getRowDimension(1)->setRowHeight(-1);
    $objPHPExcel->getActiveSheet()->setCellValue($lfila[$columna] . $fila, 'N° de Orden');
    $columna++;
    $objPHPExcel->getActiveSheet()->setCellValue($lfila[$columna] . $fila, "APELLIDOS Y NOMBRES");
    $columna++;
    $sheet->getStyle($lfila[$columna])->getAlignment()->applyFromArray(
            array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,)
    );
    $objPHPExcel->getActiveSheet()->getColumnDimension($lfila[$columna])->setWidth(20);
    $objPHPExcel->getActiveSheet()->setCellValue($lfila[$columna] . $fila, "PARTICIPÓ DE LA SESIÓN (SÍ/NO)");
    $columna++;

    $sheet->getStyle($lfila[$columna])->getAlignment()->applyFromArray(
            array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,)
    );
    $objPHPExcel->getActiveSheet()->getColumnDimension($lfila[$columna])->setWidth(15);
    $objPHPExcel->getActiveSheet()->setCellValue($lfila[$columna] . $fila, "ZOOM");
    $columna++;
    $sheet->getStyle($lfila[$columna])->getAlignment()->applyFromArray(
            array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,)
    );
    $objPHPExcel->getActiveSheet()->getColumnDimension($lfila[$columna])->setWidth(15);
    $objPHPExcel->getActiveSheet()->setCellValue($lfila[$columna] . $fila, "CLASSROOM");
    $columna++;
    $sheet->getStyle($lfila[$columna])->getAlignment()->applyFromArray(
            array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,)
    );
    $objPHPExcel->getActiveSheet()->getColumnDimension($lfila[$columna])->setWidth(15);
    $objPHPExcel->getActiveSheet()->setCellValue($lfila[$columna] . $fila, "WHATSAPP");
    $columna++;
    $sheet->getStyle($lfila[$columna])->getAlignment()->applyFromArray(
            array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,)
    );
    $objPHPExcel->getActiveSheet()->getColumnDimension($lfila[$columna])->setWidth(20);
    $objPHPExcel->getActiveSheet()->setCellValue($lfila[$columna] . $fila, "¿SE DEJÓ ACTIVIDADES A TRAVÉS DE CLASSROM Y/OZOOM? (SÍ/NO)");
    $columna++;
    $sheet->getStyle($lfila[$columna])->getAlignment()->applyFromArray(
            array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,)
    );
    $objPHPExcel->getActiveSheet()->getColumnDimension($lfila[$columna])->setWidth(20);
    $objPHPExcel->getActiveSheet()->setCellValue($lfila[$columna] . $fila, "EL DOCENTE SE COMUNICO CON LOS ESTUDIANTES  (SI/NO) SI ra respuesta es NO ¿Por qué?");
    $columna++;
    $sheet->getStyle($lfila[$columna])->getAlignment()->applyFromArray(
            array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,)
    );
    $objPHPExcel->getActiveSheet()->getColumnDimension($lfila[$columna])->setWidth(20);
    $objPHPExcel->getActiveSheet()->setCellValue($lfila[$columna] . $fila, "EL DOCENTE SE COMUNICO CON LOS padres(SI/NO) ¿Por qué?");
    $columna++;
    $sheet->getStyle($lfila[$columna])->getAlignment()->applyFromArray(
            array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,)
    );
    $objPHPExcel->getActiveSheet()->getColumnDimension($lfila[$columna])->setWidth(20);
    $objPHPExcel->getActiveSheet()->setCellValue($lfila[$columna] . $fila, "CELURAR DEL PADRE O ESTUDIANTE  PARA COMUNICARSE.");
    $fin = $lfila[$columna] . $fila;
    $columna++;
    $columna = 1;
    $fila++;
    foreach ($alumnos as $alumno) {
        $objPHPExcel->getActiveSheet()->setCellValue($lfila[$columna] . $fila, $i);
        $columna++;
        $objPHPExcel->getActiveSheet()->setCellValue($lfila[$columna] . $fila, $alumno['apepa'] . ' ' . $alumno['apema'] . ' ' . $alumno['nomb']);
        $columna++;
        $objPHPExcel->getActiveSheet()->setCellValue($lfila[$columna] . $fila, verdad($alumno['participacion']));
        $columna++;
        $objPHPExcel->getActiveSheet()->setCellValue($lfila[$columna] . $fila, marcar($alumno['zoom']));
        $columna++;
        $objPHPExcel->getActiveSheet()->setCellValue($lfila[$columna] . $fila, marcar($alumno['classroom']));
        $columna++;
        $objPHPExcel->getActiveSheet()->setCellValue($lfila[$columna] . $fila, marcar($alumno['celular']));
        $columna++;
        $objPHPExcel->getActiveSheet()->setCellValue($lfila[$columna] . $fila, verdad($alumno['actividad']));
        $columna++;
        // $objPHPExcel->getActiveSheet()->getColumnDimension($lfila[$columna])->setAutoSize(true);
        $objPHPExcel->getActiveSheet()->setCellValue($lfila[$columna] . $fila, verdad($alumno['chcmAlu']) . "/" . $alumno['cmAlum']);
        $columna++;
        // $objPHPExcel->getActiveSheet()->getColumnDimension($lfila[$columna])->setAutoSize(true);
        $objPHPExcel->getActiveSheet()->setCellValue($lfila[$columna] . $fila, verdad($alumno['chcmDoc']) . "/" . $alumno['cmDoc']);
        $columna++;
        // $objPHPExcel->getActiveSheet()->getColumnDimension($lfila[$columna])->setAutoSize(true);
        $objPHPExcel->getActiveSheet()->setCellValue($lfila[$columna] . $fila, $alumno['telf']);
        $columna++;
        $i++;
        $columna = 1;
        $fila++;
    }
     
     $objPHPExcel->getActiveSheet()->getStyle($inicio . ':' . $fin)->getFill()
            ->setFillType(PHPExcel_Style_Fill::FILL_SOLID)
            ->getStartColor()->setARGB('FFDF80');
    $fila = 2;
    $hoja++;

    $objPHPExcel->setActiveSheetIndex(0);
    $nombre = "Asistencias_" . date('d-m-Y');
    header("Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet");
    header('Content-Disposition: attachment;filename="' . $nombre . '.xlsx"');
    header('Cache-Control: max-age=0');
    $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
    $objWriter->save('php://output');
} else {
    echo "Atributo no recibido ";
    
}