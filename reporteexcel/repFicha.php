<?php
error_reporting(0);
include '../control/cConexion.php';
include '../modelo/mficha.php';
require"../vendor/autoload.php";

use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Style\Fill;


if (isset($_GET['id'])) {
    
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
function cellColor($cells,$color){
    global $hoja;

    $hoja->getStyle($cells)->applyFromArray([
    'fill' => [
            'fillType' => Fill::FILL_SOLID,
            'startColor' => [
                'argb' => $color,
            ]           
    ],
]);
}
  $id = $_GET['id'];
$col = 1;
$fila = 3;
$lFila = array('A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z', 'AA');
$styleArray = array(
    'borders' => array(
        'outline' => array(
            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK,
            'color' => array('argb' => '00000000'),
        ),
    ),
);
$fontStyle = [
    'font' => [
        'size' => 30
    ]
];
$fontStyle2 = [
    'font' => [
        'size' => 20
    ]
];

$documento = new Spreadsheet();
$documento
        ->getProperties()
        ->setCreator("Aquí va el creador, como cadena")
        ->setLastModifiedBy('Parzibyte') // última vez modificado por
        ->setTitle('Mi primer documento creado con PhpSpreadSheet')
        ->setSubject('El asunto')
        ->setDescription('Este documento fue generado para parzibyte.me')
        ->setKeywords('etiquetas o palabras clave separadas por espacios')
        ->setCategory('La categoría');
$hoja = $documento->getActiveSheet();
$hoja->setTitle("FICHA DE CONTROL");
$ficha = new mficha();
$cabecera = $ficha->verunaFicha($id);
$documento->getDefaultStyle()->getAlignment()->setWrapText(true);
$competencias = json_decode($ficha->verFichaComp($id), true);
$titulo=$cabecera['curso'].'_' . $cabecera['grado'].'_' . $cabecera['seccion'] . '_' . $cabecera['nivel'] . '_' . $cabecera['fecha'];
$hoja->setCellValue($lFila[2] . ($fila - 1), "PREMIUM COLLEGE");
cellColor($lFila[2] . ($fila - 1), 'FF5733');
$ini=$lFila[$col] . $fila;
$hoja->getStyle($lFila[2] . ($fila - 1))->applyFromArray($fontStyle);
$hoja->setCellValue($lFila[$col] . $fila, "DOCENTE");
$inicio=$lFila[$col] . $fila;
$hoja->setCellValue($lFila[$col + 1] . $fila, $cabecera['apepa'] . ' ' . $cabecera['apema'] . ' ' . $cabecera['nomb']);
$hoja->getStyle($lFila[$col] . $fila)->applyFromArray($styleArray);
$hoja->getStyle($lFila[$col + 1] . $fila)->applyFromArray($styleArray);
$fila++;
$hoja->setCellValue($lFila[$col] . $fila, "GRADO Y SECCION");
$hoja->setCellValue($lFila[$col + 1] . $fila, $cabecera['grado'] . ' ' . $cabecera['seccion'] . ' ' . $cabecera['nivel'] . ' ' . $cabecera['anio']);
$hoja->getStyle($lFila[$col] . $fila)->applyFromArray($styleArray);
$hoja->getStyle($lFila[$col + 1] . $fila)->applyFromArray($styleArray);
$fila++;
$hoja->setCellValue($lFila[$col] . $fila, "CURSO");
$hoja->setCellValue($lFila[$col + 1] . $fila, $cabecera['curso']);
$hoja->getStyle($lFila[$col] . $fila)->applyFromArray($styleArray);
$hoja->getStyle($lFila[$col + 1] . $fila)->applyFromArray($styleArray);
$fila++;
$hoja->setCellValue($lFila[$col] . $fila, "COMPETENCIAS");
$inicio = $lFila[$col] . $fila;
$inicio2 = $lFila[$col + 1] . $fila;
foreach ($competencias as $competencia) {
    $hoja->setCellValue($lFila[$col + 1] . $fila, "*" . $competencia['competencia']);

   
    $fin2 = $lFila[$col + 1] . $fila;
    $fila++;
}
 $fin = $lFila[$col] . ($fila-1);
 $fin2 = $lFila[$col + 1] . ($fila-1);
$hoja->getStyle($inicio . ":" . $fin)->applyFromArray($styleArray);
$hoja->getStyle($inicio2 . ":" . $fin2)->applyFromArray($styleArray);
$hoja->setCellValue($lFila[$col] . $fila, "SESION");
$hoja->setCellValue($lFila[$col + 1] . $fila, $cabecera['nsesion']);
$hoja->getStyle($lFila[$col] . $fila)->applyFromArray($styleArray);
$hoja->getStyle($lFila[$col + 1] . $fila)->applyFromArray($styleArray);
$fila++;
$hoja->setCellValue($lFila[$col] . $fila, "SEMANA");
$hoja->setCellValue($lFila[$col + 1] . $fila, $cabecera['nsemana']);
$hoja->getStyle($lFila[$col] . $fila)->applyFromArray($styleArray);
$hoja->getStyle($lFila[$col + 1] . $fila)->applyFromArray($styleArray);
$fila++;
$hoja->setCellValue($lFila[$col] . $fila, "FECHA");
$hoja->setCellValue($lFila[$col + 1] . $fila, $cabecera['fecha']);
$hoja->getStyle($lFila[$col] . $fila)->applyFromArray($styleArray);
$hoja->getStyle($lFila[$col + 1] . $fila)->applyFromArray($styleArray);
$fin=$lFila[$col] . $fila;
cellColor($ini.":".$fin, 'F7C855');
$fila++;
$fila++;
$hoja->getColumnDimension($lFila[$col])->setAutoSize(true);
$hoja->getColumnDimension($lFila[$col+1])->setAutoSize(true);
$fila++;


$inicio=$lFila[$col] . ($fila-1);
$hoja->setCellValue($lFila[$col] . $fila, "N° de Orden");
$hoja->getStyle($lFila[$col] . $fila)->applyFromArray($styleArray);
cellColor($lFila[$col] . $fila, 'F7E855');
$col++;
$hoja->setCellValue($lFila[$col] . $fila, "APELLIDOS Y NOMBRES");
$hoja->getStyle($lFila[$col] . $fila)->applyFromArray($styleArray);
$fin=$lFila[$col] .($fila-1);
$hoja->mergeCells($inicio.':'.$fin);
cellColor($lFila[$col] . $fila, '3C81E4');
cellColor($inicio.':'.$fin, 'E4883C');
$hoja->setCellValue($inicio, "DATOS DE ALUMNOS");
$hoja->getStyle($inicio)->applyFromArray($styleArray);
$hoja->getStyle($fin)->applyFromArray($styleArray);

$col++;
$inicio=$lFila[$col] . ($fila-1);
$ini=$lFila[$col] . ($fila);
$hoja->setCellValue($lFila[$col] . $fila, "PARTICIPÓ DE LA SESIÓN (SÍ/NO)");
$hoja->getStyle($lFila[$col] . $fila)->applyFromArray($styleArray);
$hoja->getStyle($lFila[$col] . ($fila-1))->applyFromArray($styleArray);
$hoja->getColumnDimension($lFila[$col])->setWidth(20);
$col++;
$hoja->setCellValue($lFila[$col] . $fila, "G.MEET");
$hoja->getStyle($lFila[$col] . $fila)->applyFromArray($styleArray);
$hoja->getStyle($lFila[$col] . ($fila-1))->applyFromArray($styleArray);
$hoja->getColumnDimension($lFila[$col])->setWidth(15);
$col++;
$hoja->setCellValue($lFila[$col] . $fila, "CLASSROOM");
$hoja->getStyle($lFila[$col] . $fila)->applyFromArray($styleArray);
$hoja->getStyle($lFila[$col] . ($fila-1))->applyFromArray($styleArray);
$hoja->getColumnDimension($lFila[$col])->setWidth(17);
$col++;
$hoja->setCellValue($lFila[$col] . $fila, "WHATSAPP");
$hoja->getStyle($lFila[$col] . $fila)->applyFromArray($styleArray);
$hoja->getStyle($lFila[$col] . ($fila-1))->applyFromArray($styleArray);
$hoja->getColumnDimension($lFila[$col])->setWidth(15);

$col++;
//$hoja->getColumnDimension($lFila[$col])->setAutoSize(true);
$hoja->getColumnDimension($lFila[$col])->setWidth(20);
$hoja->getStyle($lFila[$col] . $fila)->applyFromArray($styleArray);
$hoja->getStyle($lFila[$col] . ($fila-1))->applyFromArray($styleArray);
$hoja->setCellValue($lFila[$col] . $fila, "¿SE DEJÓ ACTIVIDADES A TRAVÉS DE CLASSROM Y/O MEET? (SÍ/NO)");
$fnin=$lFila[$col] . ($fila);
cellColor($ini.':'.$fnin, 'F9F756');
$col++;
$ini=$lFila[$col] . ($fila);
$hoja->setCellValue($lFila[$col] . $fila, "EL DOCENTE SE COMUNICO CON LOS ESTUDIANTES  (SI/NO) SI ra respuesta es NO ¿Por qué?");
$hoja->getStyle($lFila[$col] . $fila)->applyFromArray($styleArray);
$hoja->getStyle($lFila[$col] . ($fila-1))->applyFromArray($styleArray);
$hoja->getColumnDimension($lFila[$col])->setWidth(20);
$col++;
$hoja->setCellValue($lFila[$col] . $fila, "EL DOCENTE SE COMUNICO CON LOS padres(SI/NO) ¿Por qué?");
$hoja->getStyle($lFila[$col] . $fila)->applyFromArray($styleArray);
$hoja->getStyle($lFila[$col] . ($fila-1))->applyFromArray($styleArray);
$hoja->getColumnDimension($lFila[$col])->setWidth(20);
$col++;
$hoja->setCellValue($lFila[$col] . $fila, "CELURAR DEL PADRE O ESTUDIANTE  PARA COMUNICARSE.");
$hoja->getStyle($lFila[$col] . $fila)->applyFromArray($styleArray);
$hoja->getColumnDimension($lFila[$col])->setWidth(20);
$fin=$lFila[$col] .($fila-1);
$fnin=$lFila[$col] . ($fila);
cellColor($ini.':'.$fnin, 'E4883C');
$hoja->mergeCells($inicio.':'.$fin);
cellColor($inicio.':'.$fin, 'F68655');
$hoja->setCellValue($inicio, "DESARROLLO DE SESION");
$hoja->getStyle($inicio)->applyFromArray($styleArray);
$hoja->getStyle($fin)->applyFromArray($styleArray);
$col=1;
$fila++;
 $alumnos = json_decode($ficha->verFichaAlum($id), true);
    $i = 1;
foreach ($alumnos as $alumno) {

$hoja->setCellValue($lFila[$col] . $fila, $i);
$hoja->getStyle($lFila[$col] . $fila)->applyFromArray($styleArray);
$col++;
$hoja->setCellValue($lFila[$col] . $fila, utf8_decode($alumno['24'] . ' ' . $alumno['25'] . ' ' . $alumno['23']));
$hoja->getStyle($lFila[$col] . $fila)->applyFromArray($styleArray);
$col++;

$hoja->setCellValue($lFila[$col] . $fila, verdad($alumno['participacion']));
$hoja->getStyle($lFila[$col] . $fila)->applyFromArray($styleArray);

$hoja->getColumnDimension($lFila[$col])->setWidth(20);
$col++;
$hoja->setCellValue($lFila[$col] . $fila, marcar($alumno['zoom']));
$hoja->getStyle($lFila[$col] . $fila)->applyFromArray($styleArray);

$hoja->getColumnDimension($lFila[$col])->setWidth(15);
$col++;
$hoja->setCellValue($lFila[$col] . $fila, marcar($alumno['classroom']));
$hoja->getStyle($lFila[$col] . $fila)->applyFromArray($styleArray);

$hoja->getColumnDimension($lFila[$col])->setWidth(17);
$col++;
$hoja->setCellValue($lFila[$col] . $fila, marcar($alumno['celular']));
$hoja->getStyle($lFila[$col] . $fila)->applyFromArray($styleArray);

$hoja->getColumnDimension($lFila[$col])->setWidth(15);
$col++;
$hoja->getColumnDimension($lFila[$col])->setWidth(20);
$hoja->getStyle($lFila[$col] . $fila)->applyFromArray($styleArray);
$hoja->setCellValue($lFila[$col] . $fila, verdad($alumno['actividad']));
$col++;
$hoja->setCellValue($lFila[$col] . $fila, verdad($alumno['chcmAlu']) . "/" . $alumno['cmAlum']);
$hoja->getStyle($lFila[$col] . $fila)->applyFromArray($styleArray);
$hoja->getColumnDimension($lFila[$col])->setWidth(20);
$col++;
$hoja->setCellValue($lFila[$col] . $fila, verdad($alumno['chcmDoc']) . "/" . $alumno['cmDoc']);
$hoja->getStyle($lFila[$col] . $fila)->applyFromArray($styleArray);
$hoja->getColumnDimension($lFila[$col])->setWidth(20);
$col++;
$hoja->setCellValue($lFila[$col] . $fila, $alumno['telf']);
$hoja->getStyle($lFila[$col] . $fila)->applyFromArray($styleArray);
$hoja->getColumnDimension($lFila[$col])->setWidth(20);

$col=1;
$fila++;
$i++;
}


$alignment_center = \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER;
foreach($hoja->getRowIterator() as $row) {
    foreach($row->getCellIterator() as $cell) {
        $cellCoordinate = $cell->getCoordinate();
        $hoja->getStyle($cellCoordinate)->getAlignment()->setHorizontal($alignment_center);
    }
}

$nombreDelDocumento = "FICHA_CONTROL_".$titulo.".xlsx";

header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="' . $nombreDelDocumento . '"');
header('Cache-Control: max-age=0');

$writer = IOFactory::createWriter($documento, 'Xlsx');
$writer->save('php://output');
exit;
} else {
    echo "Atributo no recibido ";
}
