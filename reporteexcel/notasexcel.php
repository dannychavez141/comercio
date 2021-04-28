<?php 
include '../control/cConexion.php';
require '../phpexcel/PHPExcel.php';
/*$server="localhost";
$user="root";
$pass="";
$bd="premiumc_premiumcollege";*/
if (isset($_POST['anio'])) {
    $anio=$_POST['anio'];
}else
    {
    $anio=0;
    }

/*$server="179.61.12.105";
$user="premiumc_premium";
$pass="Losloles54";
$bd="premiumc_premiumcollege";*/
    $conexion=new cConexion();
 $mysqli = $conexion->getBd();  
 //$mysqli = new mysqli("179.61.12.105","premiumc_premium","Losloles54","premiumc_premiumcollege");
    
    function codnota($nota,$modo){

    if ($modo==1 || $modo==3) {
        $notaletras='NE';
    if ($nota==0) {
        $notaletras='C';
    }
    if ($nota==1) {
        $notaletras='B';
    }
    if ($nota==2) {
        $notaletras='A';
    }
    if ($nota==3) {
        $notaletras='AD';

    }
}else{
    if ($nota<=-1) {
        $notaletras='NE';
    }else{$notaletras=$nota;}
}
    return $notaletras;
}
$hoja=0;
$fila=1;
$columna=0;
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

 $sql="SELECT * FROM tipogrado where est=1;";
$niveles=$mysqli->query($sql);
$cantidad= $niveles->num_rows;
        $contador=0;
while ( $nivel = $niveles->fetch_array()) {
$contador++;
    $objPHPExcel->setActiveSheetIndex($hoja);
$objPHPExcel->getActiveSheet()->setTitle('NOTAS '.$nivel[1]);

$objPHPExcel->getActiveSheet()->setCellValue($lfila[$columna].$fila, 'N°');
$columna++;
$objPHPExcel->getActiveSheet()->setCellValue($lfila[$columna].$fila, 'ALUMNO');
$columna++;
$objPHPExcel->getActiveSheet()->setCellValue($lfila[$columna].$fila, 'GRADO');
$columna++;
$objPHPExcel->getActiveSheet()->setCellValue($lfila[$columna].$fila, 'SECCION');
$columna++; 
$conexion=new cConexion();
$mysqli = $conexion->getBd();   
$sql1="SELECT distinct(cu.descr) FROM notasalumno na join competencias c on na.idComp=c.idComp join matricula m on na.idMatricula=m.idMatricula 
join cursos cu on c.idcurso=cu.idCursos  where cu.idtipogrado='$nivel[0]' and c.est=1 and c.est=1 order by concat(cu.idCursos,na.idComp) asc ;";
$cursos=$mysqli->query($sql1);
while ( $curso = $cursos->fetch_array()) { 
$objPHPExcel->getActiveSheet()->setCellValue($lfila[$columna].$fila, $curso[0] );
$columna++;
 }
 $columna=0;
$fila++;
$modo=1;
$sql2="SELECT idMatricula,al.apepa,al.apema,al.nomb,g.descr,s.descr,g.idGrado,g.idTipo FROM matricula m 
join alumnos al on m.dnialu=al.dni
join grado g on m.idGrado=g.idGrado 
join seccion s on m.idSeccion=s.idSeccion
where g.idTipo='$nivel[0]'and m.idAnioEscolar='$anio' and m.est='1' order by g.descr,s.descr,g.idTipo,al.apepa ;";
$matriculas=$mysqli->query($sql2);

while ( $matricula = $matriculas->fetch_array()) {
    $modo=$matricula[7];
if($matricula['idGrado']==7 || $matricula['idGrado']==8){
    $modo=1;
}
$tempcur="";
$nota1=0;
$nota2=0;
$nota3=0;
$nota4=0;
$suma1=0;
$suma2=0;
$suma3=0;
$suma4=0;
$prom=0;
$cont=0;
$objPHPExcel->getActiveSheet()->setCellValue($lfila[$columna].$fila, $matricula[0]);
$columna++;
$objPHPExcel->getActiveSheet()->setCellValue($lfila[$columna].$fila, $matricula[1]." ".$matricula[2]." ".$matricula[3]);
$columna++;
$objPHPExcel->getActiveSheet()->setCellValue($lfila[$columna].$fila, $matricula[4]);
$columna++;
$objPHPExcel->getActiveSheet()->setCellValue($lfila[$columna].$fila, $matricula[5]);
$columna++;
$conexion=new cConexion();
$mysqli = $conexion->getBd();  
    $sql3="call vernotas($matricula[0]);";
    $notas=$mysqli->query($sql3);

    while ( $nota = $notas->fetch_array()) {

if($modo==2){

if($tempcur!=$nota[0] ){
if($tempcur!=""){
$suma1=round($nota1/$cont);
$suma2=round($nota2/$cont);
$suma3=round($nota3/$cont);
$suma4=round($nota4/$cont);
$prom=round(($suma1+$suma2+$suma3+$suma4)/4);
$objPHPExcel->getActiveSheet()->setCellValue($lfila[$columna].$fila, codnota($prom,$modo));
$columna++;
$nota1=0;
$nota2=0;
$nota3=0;
$nota4=0;
$cont=0;
}
$tempcur=$nota[0];
$nota1=$nota1+$nota[2];
$nota2=$nota2+$nota[3];
$nota3=$nota3+$nota[4];
$nota4=$nota4+$nota[5];
$cont++;
}
else{
$nota1=$nota1+$nota[2];
$nota2=$nota2+$nota[3];
$nota3=$nota3+$nota[4];
$nota4=$nota4+$nota[5];
$cont++;
} 

}
else
{
    if($tempcur!=$nota[0] ){
if($tempcur!=""){
$suma1=$nota1;
$suma2=$nota2;
$suma3=$nota3;
$suma4=$nota4;
$prom=$suma4;
$objPHPExcel->getActiveSheet()->setCellValue($lfila[$columna].$fila, codnota($prom,$modo));
$columna++;
$nota1=0;
$nota2=0;
$nota3=0;
$nota4=0;
$cont=0;
}
$tempcur=$nota[0];
$nota1=$nota[2];
$nota2=$nota[3];
$nota3=$nota[4];
$nota4=$nota[5];
$cont++;
}
else{
$nota1=$nota[2];
$nota2=$nota[3];
$nota3=$nota[4];
$nota4=$nota[5];
$cont++;
}
}
}

if($modo==2){
if($tempcur!=$nota[0] ){
if($tempcur!=""){
$suma1=round($nota1/$cont);
$suma2=round($nota2/$cont);
$suma3=round($nota3/$cont);
$suma4=round($nota4/$cont);
$prom=round(($suma1+$suma2+$suma3+$suma4)/4);
$objPHPExcel->getActiveSheet()->setCellValue($lfila[$columna].$fila, codnota($prom,$modo));
$columna++;
$nota1=0;
$nota2=0;
$nota3=0;
$nota4=0;
$cont=0;
}
}  
}else
{
    if($tempcur!=$nota[0] ){
if($tempcur!=""){
$suma1=$nota1;
$suma2=$nota2;
$suma3=$nota3;
$suma4=$nota4;
$prom=$suma4;
$objPHPExcel->getActiveSheet()->setCellValue($lfila[$columna].$fila, codnota($prom,$modo));
$columna++;
$nota1=0;
$nota2=0;
$nota3=0;
$nota4=0;
$cont=0;
}

}

}
$columna=0;
$fila++;
}
if ($contador<$cantidad) {
 $objPHPExcel->createSheet();   
}
 
 $columna=0;
$fila=1;
$hoja++;
} 
$objPHPExcel->setActiveSheetIndex(0);
$nombre="Notas_Finales_".date('d-m-Y');
header("Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet");
header('Content-Disposition: attachment;filename="'.$nombre.'.xlsx"');
header('Cache-Control: max-age=0');
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$objWriter->save('php://output');

 ?>