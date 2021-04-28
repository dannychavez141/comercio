<?php
	/* Empezamos con una matriz de datos que puede proceder de cualquier fuente
	(p.e. una lectura de base de datos) */
	$matrizDeObras = array(
		array(
			"obra"=>"Construcción de aparcamiento en el centro",
			"fecha_de_inicio"=>"10/02/2015",
			"fecha_de_finalizacion"=>"31/10/2016",
			"contratista"=>"Actuaciones Urbanas",
			"miembros_tecnicos"=>"3",
			"personal_tecnico"=>array(
				"arquitecto"=>"Pedro Steven De Gloria",
				"aparejador"=>"Manuela Gracia Salmerón", 
				"supervisor"=>"Andrés Garrido Fuentes"
			),
			"presupuesto"=>"20.000.000"
		),
		array(
			"obra"=>"Adaptación de estación suburbana",
			"fecha_de_inicio"=>"06/08/2016",
			"fecha_de_finalizacion"=>"01/11/2016",
			"contratista"=>"Obras del Norte",
			"miembros_tecnicos"=>"4",
			"personal_tecnico"=>array(
				"arquitecto"=>"Manuel Alarcón Rodríguez",
				"aparejador"=>"Carlos Torres Fuentes", 
				"director_de_tunelacion"=>"María García Pérez",
				"jefe_de_compras"=>"Antonia Bisonette Tristán"
			),
			"presupuesto"=>"6.500.000"
		),
		array(
			"obra"=>"Electrificación de zona restringida",
			"fecha_de_inicio"=>"02/02/2014",
			"fecha_de_finalizacion"=>"26/05/2017",
			"contratista"=>"Iluminación y Electricidad, SA",
			"miembros_tecnicos"=>"2",
			"personal_tecnico"=>array(
				"jefe_de_electricistas"=>"Laura De la Iglesia Cifuentes",
				"responsable_de_control"=>"Yolanda Torres Torres"
			),
			"presupuesto"=>"7.800.000"
		)
	);
 
	// Convertimos la matriz a una cadena con formato XML.
	$textoXML = '<?xml version="1.0" encoding="UTF-8"?>';
	$textoXML .= "\n";
	$textoXML .= '<obras>';
	$textoXML .= "\n";
	foreach ($matrizDeObras as $obra){
		$textoXML .= "\t";
		$textoXML .= '<obra inicio="'.$obra["fecha_de_inicio"].'" ';
		$textoXML .= 'final="'.$obra["fecha_de_finalizacion"].'" ';
		$textoXML .= 'contratista="'.$obra["contratista"].'" ';
		$textoXML .= 'presupuesto="'.$obra["presupuesto"].'">';
		$textoXML .= "\n";
		$textoXML .= "\t\t";
		$textoXML .= $obra["obra"];
		$textoXML .= "\n";
		$textoXML .= "\t\t";
		$textoXML .= '<personal_tecnico miembros="'.$obra["miembros_tecnicos"].'">';
		$textoXML .= "\n";
		foreach ($obra["personal_tecnico"] as $keyMiembro=>$miembro){
			$textoXML .= "\t\t\t";
			$textoXML .= '<miembro cargo="'.$keyMiembro.'">';
			$textoXML .= "\n";
			$textoXML .= "\t\t\t\t";
			$textoXML .= $miembro;
			$textoXML .= "\n";
			$textoXML .= "\t\t\t";
			$textoXML .= '</miembro>';
			$textoXML .= "\n";
		}
		$textoXML .= "\t\t";
		$textoXML .= '</personal_tecnico>';
		$textoXML .= "\n";
		$textoXML .= "\t";
		$textoXML .= '</obra>';
		$textoXML .= "\n";
	}
	$textoXML .= '</obras>';
 
	// Nos aseguramos de que la cadena que contiene el XML esté en UTF-8
	$textoXML = mb_convert_encoding($textoXML, "UTF-8");
 
	// Grabamos el XML en el servidor como un fichero plano, para
	// poder ser leido por otra aplicación.
	$gestor = fopen("obras.xml", 'w');
	fwrite($gestor, $textoXML);
	fclose($gestor);
?>