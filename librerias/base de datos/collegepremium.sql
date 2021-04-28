-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 18-09-2019 a las 04:44:25
-- Versión del servidor: 5.5.40
-- Versión de PHP: 5.5.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `collegepremium`
--

DELIMITER $$
--
-- Procedimientos
--
DROP PROCEDURE IF EXISTS `vercompetencia`$$
CREATE PROCEDURE `vercompetencia`(id int)
BEGIN
SELECT * FROM competencias where idcurso=id and est=1;
END$$

DROP PROCEDURE IF EXISTS `vermatricula`$$
CREATE PROCEDURE `vermatricula`(bus varchar(50),anio int,grad int,secc int)
BEGIN
SELECT m.idMatricula,a.dni,concat(a.nomb,' ',a.apepa,' ',a.apema) as alu,ap.dni,concat(ap.nomb,' ',ap.apepa,' ',ap.apema)as apo,
tg.idTipo,tg.descr,ae.idAnioEscolar,ae.descr,g.idGrado,g.descr,s.idSeccion,s.descr,m.fecha,u.idUsuario,concat(u.nomb,' ',u.apepa,' ',u.apema) as usu,m.est,e.descr
FROM matricula m 
join alumnos a on m.dnialu=a.dni 
join apoderado ap on a.dniapo=ap.dni 
join grado g on m.idGrado=g.idGrado
join tipogrado tg on g.idTipo=tg.idTipo
join seccion s on m.idSeccion=s.idSeccion 
join anioescolar ae on m.idAnioEscolar=ae.idAnioEscolar
join usuario u on m.idUsuario=u.idUsuario
join estados e on m.est=e.idestados
where concat(a.dni,a.nomb,a.apepa,a.apema) like concat('%',bus,'%')  and m.idAnioEscolar=anio and m.idGrado=grad and m.idSeccion=secc;
END$$

DROP PROCEDURE IF EXISTS `vernotas`$$
CREATE  PROCEDURE `vernotas`(id int)
BEGIN
SELECT cu.descr,c.descr,na.nota1,na.nota2,na.nota3,na.nota4,na.recu FROM notasalumno na join competencias c on na.idComp=c.idComp join matricula m on na.idMatricula=m.idMatricula 
join cursos cu on c.idcurso=cu.idCursos   where na.idMatricula=id and c.est=1 and c.est=1;
END$$

DROP PROCEDURE IF EXISTS `vernotasfamilia`$$
CREATE PROCEDURE `vernotasfamilia`(bus varchar(50),id int, anio int)
BEGIN
SELECT m.idMatricula,a.dni,concat(a.nomb,' ',a.apepa,' ',a.apema) as alu,ap.dni,concat(ap.nomb,' ',ap.apepa,' ',ap.apema)as apo,
tg.idTipo,tg.descr,ae.idAnioEscolar,ae.descr,g.idGrado,g.descr,s.idSeccion,s.descr,m.fecha,u.idUsuario,concat(u.nomb,' ',u.apepa,' ',u.apema) as usu,m.est,e.descr
FROM matricula m 
join alumnos a on m.dnialu=a.dni 
join apoderado ap on a.dniapo=ap.dni 
join grado g on m.idGrado=g.idGrado
join tipogrado tg on g.idTipo=tg.idTipo
join seccion s on m.idSeccion=s.idSeccion 
join anioescolar ae on m.idAnioEscolar=ae.idAnioEscolar
join usuario u on m.idUsuario=u.idUsuario
join estados e on m.est=e.idestados
where concat(a.dni,a.nomb,a.apepa,a.apema) like concat('%',bus,'%')  and m.idAnioEscolar=anio and ap.idApoderado=id;
END$$

DROP PROCEDURE IF EXISTS `verunaalumno`$$
CREATE PROCEDURE `verunaalumno`( id int)
BEGIN
SELECT * FROM alumnos a 
join apoderado ap on a.dniapo=ap.dni 
join apoderado a1 on a.dnipadre=a1.dni 
join apoderado a2 on a.dnimadre=a2.dni 
join tipoapoderado t on ap.idtipoApoderado=t.idtipoApoderado 
join estados e  on    a.est=e.idestados 
join sexo s on a.idsex=s.idsexo  where  a.idAlumnos=id;
END$$

DROP PROCEDURE IF EXISTS `verunadocente`$$
CREATE PROCEDURE `verunadocente`( id int)
BEGIN
SELECT * FROM docente d 
join sexo s on d.idsex=s.idsexo
join estados e on d.est=e.idestados
join tipogrado t on d.idtipo=t.idTipo 
where  d.idDocente=id;
END$$

DROP PROCEDURE IF EXISTS `verunamatricula`$$
CREATE PROCEDURE `verunamatricula`( id int)
BEGIN
SELECT m.idMatricula,a.dni,concat(a.apepa,' ',a.apema,' ',a.nomb) as alu,a.ext,ap.dni,concat(ap.nomb,' ',ap.apepa,' ',ap.apema)as apo,
tg.idTipo,tg.descr,ae.idAnioEscolar,ae.descr,g.idGrado,g.descr,s.idSeccion,s.descr,m.fecha,u.idUsuario,concat(u.nomb,' ',u.apepa,' ',u.apema) as usu,m.est,e.descr
FROM matricula m 
join alumnos a on m.dnialu=a.dni 
join apoderado ap on a.dniapo=ap.dni 
join grado g on m.idGrado=g.idGrado
join tipogrado tg on g.idTipo=tg.idTipo
join seccion s on m.idSeccion=s.idSeccion 
join anioescolar ae on m.idAnioEscolar=ae.idAnioEscolar
join usuario u on m.idUsuario=u.idUsuario
join estados e on m.est=e.idestados
where m.idMatricula=id;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `alumnos`
--

DROP TABLE IF EXISTS `alumnos`;
CREATE TABLE IF NOT EXISTS `alumnos` (
`idAlumnos` int(11) NOT NULL,
  `dni` varchar(8) NOT NULL,
  `nomb` varchar(45) NOT NULL,
  `apepa` varchar(45) NOT NULL,
  `apema` varchar(45) NOT NULL,
  `fnac` date NOT NULL,
  `dniapo` varchar(8) NOT NULL,
  `dnipadre` varchar(8) DEFAULT NULL,
  `dnimadre` varchar(8) DEFAULT NULL,
  `ext` varchar(5) DEFAULT '0',
  `est` int(11) NOT NULL,
  `idsex` int(11) NOT NULL,
  `targeta` varchar(50) DEFAULT '',
  `saldo` double DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=200 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `alumnos`
--

INSERT INTO `alumnos` (`idAlumnos`, `dni`, `nomb`, `apepa`, `apema`, `fnac`, `dniapo`, `dnipadre`, `dnimadre`, `ext`, `est`, `idsex`, `targeta`, `saldo`) VALUES
(1, '77935796', 'JESHUA WALTER GABRIEL', 'ARMAS', 'JACINTO', '2012-12-08', '', '', '', '0', 1, 1, '', 0),
(2, '77865906', 'ALE MAIRA', 'AVENDAÃ‘O', 'MELGAREJO', '2012-10-15', '', '', '', '0', 1, 2, '', 0),
(3, '63693168', 'JOSIAS GABRIEL', 'BARTRA', 'SALAS', '2012-05-07', '', '', '', '0', 1, 1, '', 0),
(4, '63188596', 'THIAGO RADAMEL', 'CARHUAVILCA', 'COMUN', '2012-10-27', '', '', '', '0', 1, 1, '', 0),
(5, '63441955', 'MATHIAS JHOSUA', 'FASABI', 'MORENO', '2012-04-12', '', '', '', '0', 1, 1, '', 0),
(6, '81137474', 'ANGHELO GEROB', 'GONZALES', 'BARDALES', '2013-01-30', '', '', '', '0', 1, 1, '', 0),
(7, '81056216', 'LUHANA ANGELY', 'GONZALES', 'CASTRO', '2012-10-18', '', '', '', '0', 1, 2, '', 0),
(8, '63802336', 'BRIZA ALMAR', 'LEYVA', 'MARTINEZ', '2012-08-11', '', '', '', '0', 1, 2, '', 0),
(9, '77840120', 'AKEMY BRYHANNA', 'OJEDA', 'ZAGACETA', '2012-09-20', '', '', '', '0', 1, 2, '', 0),
(10, '81075624', 'SUOWI KEYSI', 'PINEDO', 'TORRES', '2012-08-20', '', '', '', '0', 1, 2, '', 0),
(11, '63693200', 'KATTY PIERINA', 'SALAZAR', 'CARDOZO', '2012-05-13', '', '', '', '0', 1, 2, '', 0),
(12, '77729457', 'TRACY ALEXANDRA', 'SALDA?A', 'VELA', '2012-04-27', '', '', '', '0', 1, 2, '', 0),
(13, '81137498', 'VALERY CAMILA', 'SANTOS', 'RIOS', '2013-02-12', '', '', '', '0', 1, 2, '', 0),
(14, '77631575', 'MAYKEL VALENTINO', 'SOTO', 'RIOS', '2012-04-28', '', '', '', '0', 1, 1, '', 0),
(15, '81137712', 'KENDRA VALENTINA', 'TORRES', 'FLORES', '2013-03-24', '', '', '', '0', 1, 2, '', 0),
(16, '63530752', 'SEBASTIAN CARLOS', 'TRUJILLO', 'ROJAS', '2013-01-29', '', '', '', '0', 1, 1, '', 0),
(17, '81102417', 'LUANA FERNANDA', 'URQUIZA', 'TUESTA', '2012-12-30', '', '', '', '0', 1, 2, '', 0),
(18, '77648457', 'DIRLEN FAVIO', 'VASQUEZ', 'GOMEZ', '2012-04-12', '', '', '', '0', 1, 1, '', 0),
(19, '80961445', 'ZOE CATALEYA', 'VELASQUEZ', 'GRANDEZ', '2012-08-07', '', '', '', '0', 1, 2, '', 0),
(20, '63793112', 'DAYSI YUMAR', 'ZAMORA', 'MALDONADO', '2012-07-24', '', '', '', '0', 1, 2, '', 0),
(21, '63692224', 'MATEO ADRIANO', 'ABENSUR', 'AREVALO', '2012-02-14', '', '', '', '0', 1, 1, '', 0),
(22, '77311115', 'LUANA ALESSANDRA', 'ALFARO', 'OROZCO', '2011-05-07', '', '', '', '0', 1, 2, '', 0),
(23, '77515059', 'LUCILA KAORI', 'ARELLANO', 'ESTEBAN', '2011-12-17', '', '', '', '0', 1, 2, '', 0),
(24, '62906125', 'CARLOS SEBASTIAN ADRIANO', 'AREVALO', 'RIOS', '2011-05-26', '', '', '', '0', 1, 1, '', 0),
(25, '63287681', 'JUAN JOSE', 'ARSAPALO', 'ROMERO', '2011-06-24', '', '', '', '0', 1, 1, '', 0),
(26, '77788779', 'BRITANY MICHELLE MARIA', 'CARDENAS', 'QUI?ONES', '2012-01-02', '', '', '', '0', 1, 2, '', 0),
(27, '78978558', 'CESAR', 'GONZALES', 'PE?A', '2009-04-27', '', '', '', '0', 1, 1, '', 0),
(28, '77519755', 'DANA CATALINA', 'LAY', 'RUIZ', '2012-01-01', '', '', '', '0', 1, 2, '', 0),
(29, '77189735', 'DANY VARELLY', 'MARAVI', 'WESCHE', '2011-07-05', '', '', '', '0', 1, 2, '', 0),
(30, '77523573', 'CARLOS JAVIER', 'MARCELO', 'TUESTA', '2012-01-16', '', '', '', '0', 1, 1, '', 0),
(31, '63111730', 'CHRISTOPHER SANTIAGO', 'MONGRUT', 'RIOS', '2011-12-04', '', '', '', '0', 1, 1, '', 0),
(32, '62906075', 'CLARA XOANA', 'MORI', 'VILLANES', '2011-06-22', '', '', '', '0', 1, 2, '', 0),
(33, '62465796', 'TESSIE ALESSANDRA', 'RENGIFO', 'PE?A', '2011-05-17', '', '', '', '0', 1, 2, '', 0),
(34, '77411361', 'JHANCER RUELDO', 'RIOS', 'AGUIRRE', '2011-05-27', '', '', '', '0', 1, 1, '', 0),
(35, '79338549', 'BRUSS BRAYAN', 'RIOS', 'TORRES', '2011-01-03', '', '', '', '0', 1, 1, '', 0),
(36, '36', 'RIHANA JULIETH', 'RIVEYRO', 'VIA', '2011-07-02', '', '', '', '0', 1, 2, '', 0),
(37, '63292237', 'ELIAS RAZIEL', 'RODRIGUEZ', 'ARAUJO', '2011-06-02', '', '', '', '0', 1, 1, '', 0),
(38, '77262864', 'LUCIANA CAMILA', 'ROJAS', 'SIFUENTES', '2011-08-24', '', '', '', '0', 1, 2, '', 0),
(39, '77112000', 'CARLOS MYKHAILO', 'RYZHALO', 'CARDENAS', '2011-06-12', '', '', '', '0', 1, 1, '', 0),
(40, '63112028', 'ADAN YUZE', 'TANG', 'VELASQUEZ', '2011-12-29', '', '', '', '0', 1, 1, '', 0),
(41, '63093366', 'JOSE JOAO', 'TRUJILLO', 'ANGULO', '2011-11-22', '', '', '', '0', 1, 1, '', 0),
(42, '77317262', 'HARRY NOWHERS', 'TUESTA', 'LOPEZ', '2011-09-14', '', '', '', '0', 1, 1, '', 0),
(43, '61918006', 'MATHIAS ANTONIO', 'ALEGRIA', 'SOTELO', '2010-01-12', '', '', '', '0', 1, 1, '', 0),
(44, '81054427', 'IAN MATIAS', 'BARDALES', 'CANAYO', '2011-02-14', '', '', '', '0', 1, 1, '', 0),
(45, '62715334', 'DANIEL ALBERTO', 'CARRASCO', 'RIVEYRO', '2011-03-08', '', '', '', '0', 1, 1, '', 0),
(46, '46', 'ZENYA RHAHDA', 'ESPINOZA', 'LOPEZ', '2010-04-18', '', '', '', '0', 1, 2, '', 0),
(47, '62718099', 'VALENTINO JHOSEPH', 'GOMEZ', 'MARQUEZ', '2010-11-15', '', '', '', '0', 1, 1, '', 0),
(48, '74341220', 'SHANIA MISHEL', 'INUMA', 'GASLA', '2010-06-27', '', '', '', '0', 1, 2, '', 0),
(49, '74783873', 'MISHEL CRISTAL', 'MAZA', 'DIAZ', '2010-09-26', '', '', '', '0', 1, 2, '', 0),
(50, '74796021', 'JOSE ANDRE', 'NAVARRO', 'REATEGUI', '2010-10-04', '', '', '', '0', 1, 1, '', 0),
(51, '62779889', 'EVAN AVRIL', 'PALOMINO', 'ESCOBEDO', '2010-05-19', '', '', '', '0', 1, 2, '', 0),
(52, '61918810', 'FARID ABDU', 'PANDURO', 'GAVIRIA', '2009-12-06', '', '', '', '0', 1, 1, '', 0),
(53, '62290014', 'JALI GIULIANO', 'ROQUE', 'VELA', '2011-01-13', '', '', '', '0', 1, 1, '', 0),
(54, '62737788', 'ARIANA CLARIVEL', 'RUIZ', 'MONTENEGRO', '2010-12-25', '', '', '', '0', 1, 2, '', 0),
(55, '62569715', 'MATEO SEBASTIAN', 'SALAZAR', 'CARDOZO', '2010-09-26', '', '', '', '0', 1, 1, '', 0),
(56, '78428229', 'PATRICIO VALENTINO', 'SANGAMA', 'MORI', '2010-09-20', '', '', '', '0', 1, 1, '', 0),
(57, '61787086', 'SEBASTIAN', 'TORREJON', 'HUAMANI', '2009-04-16', '', '', '', '0', 1, 1, '', 0),
(58, '62494046', 'VAYOLETH VALENTINA', 'TURCZINSKI', 'RIVEYRO', '2010-09-12', '', '', '', '0', 1, 2, '', 0),
(59, '62590133', 'RODERICK RODRIGO', 'VALDERRAMA', 'BARTRA', '2010-04-05', '', '', '', '0', 1, 1, '', 0),
(60, '77897239', 'LEONARDO', 'VIENA', 'MEDRANO', '2011-02-22', '', '', '', '0', 1, 1, '', 0),
(61, '62474045', 'JOSE MIGUEL', 'VILLANUEVA', 'BRAVO', '2010-12-05', '', '', '', '0', 1, 1, '', 0),
(62, '62589900', 'GIANFRANCO LIONEL', 'ALFARO', 'CARDENAS', '2010-04-11', '', '', '', '0', 1, 1, '', 0),
(63, '74263094', 'DUSTIN MATTEO', 'BOTTON', 'RODRIGUEZ', '2010-01-01', '', '', '', '0', 1, 1, '', 0),
(64, '61787395', 'JOSE MIGUEL', 'CALDERON', 'MATOS', '2009-05-01', '', '', '', '0', 1, 1, '', 0),
(65, '61962883', 'KENIA CRISTHELL', 'CASTELLARES', 'PEREZ', '2009-04-24', '', '', '', '0', 1, 2, '', 0),
(66, '73844164', 'JESUS ANAXIMANDRO', 'CHAVEZ', 'RONCAL', '2009-10-28', '', '', '', '0', 1, 1, '', 0),
(67, '62570481', 'BONNY VALERIA', 'CORDOVA', 'VELASCO', '2010-02-23', '', '', '', '0', 1, 2, '', 0),
(68, '62779692', 'JOSSEF EDUARDO', 'GARAY', 'RUFINO', '2009-08-25', '', '', '', '0', 1, 1, '', 0),
(69, '61851788', 'NICHOLAS AARON', 'JARAMA', 'PE?A', '2009-08-14', '', '', '', '0', 1, 1, '', 0),
(70, '61820416', 'STEPHANIE YULIANA', 'LUCHINE', 'ARRATEA', '2009-05-15', '', '', '', '0', 1, 2, '', 0),
(71, '61417777', 'FRANS EVANS', 'MACHER', 'TAFUR', '2008-06-13', '', '', '', '0', 1, 1, '', 0),
(72, '61555513', 'JHANMARCO HOMER', 'MARI?O', 'AVENDA?O', '2009-10-22', '', '', '', '0', 1, 1, '', 0),
(73, '62531055', 'LICURGO ALEXANDER', 'ORTIZ', 'TOLENTINO', '2009-12-24', '', '', '', '0', 1, 1, '', 0),
(74, '61874091', 'JANDY ABRAHAM', 'PEREZ', 'RAMIREZ', '2009-09-02', '', '', '', '0', 1, 1, '', 0),
(75, '61917637', 'JUNIOR JOSE', 'SANCHEZ', 'FABIAN', '2009-11-26', '', '', '', '0', 1, 1, '', 0),
(76, '61874140', 'RIHANNA COLEEN', 'SANCHEZ', 'PANDURO', '2009-05-26', '', '', '', '0', 1, 2, '', 0),
(77, '61899108', 'LUZIANA VALENTINA', 'URQUIZA', 'TUESTA', '2009-07-07', '', '', '', '0', 1, 2, '', 0),
(78, '61917376', 'GERDIL', 'VASQUEZ', 'GOMEZ', '2009-11-02', '', '', '', '0', 1, 1, '', 0),
(79, '73288733', 'ALBERTO AR?N', 'ZELADA', 'SANCHEZ', '2009-04-09', '', '', '', '0', 1, 1, '', 0),
(80, '77197002', 'RENZO NICANOR', 'AHUANARI', 'FLORES', '2008-10-06', '', '', '', '0', 1, 1, '', 0),
(81, '62035509', 'ALOANA', 'CARDENAS', 'MARIN', '2009-02-16', '', '', '', '0', 1, 2, '', 0),
(82, '61345519', 'FLOR DE BELEN EMA', 'ESCALANTE', 'GUTIERREZ', '2008-02-17', '', '', '', '0', 1, 2, '', 0),
(83, '61545944', 'ANGELLO DE JESUS IVAN', 'GAVIRIA', 'FRANCHINI', '2008-12-08', '', '', '', '0', 1, 1, '', 0),
(84, '61786731', 'JOE CARLO', 'GOMEZ', 'SANTILLAN', '2009-03-11', '', '', '', '0', 1, 1, '', 0),
(85, '61505650', 'KENJY ADRIEL', 'MANANITA', 'RENGIFO', '2009-02-13', '', '', '', '0', 1, 1, '', 0),
(86, '61430643', 'MARIA ISABEL', 'MERCADO', 'GREENWICH', '2008-08-01', '', '', '', '0', 1, 2, '', 0),
(87, '61820739', 'PAOLA ESTEFANIA', 'PANDURO', 'BARTRA', '2009-02-21', '', '', '', '0', 1, 2, '', 0),
(88, '61786771', 'ZARAHY VALENTINA', 'PEREZ', 'MONTECILLO', '2009-03-13', '', '', '', '0', 1, 2, '', 0),
(89, '77006735', 'JEAM PIERE', 'REATEGUI', 'MACEDO', '2008-10-06', '', '', '', '0', 1, 1, '', 0),
(90, '61723210', 'RENZO JOSEPH', 'REYNA', 'MACEDO', '2008-05-15', '', '', '', '0', 1, 1, '', 0),
(91, '61357706', 'FRANCISCO SEBASTIAN', 'RIVERA', 'ROQUE', '2008-04-12', '', '', '', '0', 1, 1, '', 0),
(92, '62035086', 'MATIAS NICOLAS', 'RODRIGUEZ', 'ARAUJO', '2009-01-18', '', '', '', '0', 1, 1, '', 0),
(93, '61379687', 'EMY ALEJANDRA', 'SALAS', 'HUAYTA', '2008-06-09', '', '', '', '0', 1, 2, '', 0),
(94, '61874442', 'DAYANNA ISABEL', 'SOTIL', 'CARBAJAL', '2008-10-13', '', '', '', '0', 1, 2, '', 0),
(95, '61380055', 'NAOMI NICOLL', 'TUCTO', 'ESTRADA', '2008-07-18', '', '', '', '0', 1, 2, '', 0),
(96, '62035166', 'ERIKA MILUZKA', 'ZU?IGA', 'HUARCAYA', '2009-01-15', '', '', '', '0', 1, 2, '', 0),
(97, '61218063', 'MARELY AYELEN', 'APAZA', 'ARI', '2007-10-27', '', '', '', '0', 1, 2, '', 0),
(98, '71159337', 'HECTOR FABRIZIO', 'BAUTISTA', 'AMBROSIO', '2008-01-12', '', '', '', '0', 1, 1, '', 0),
(99, '61134041', 'CHRISTOPHER LEONEL', 'HERRERA', 'CENEPO', '2007-08-15', '', '', '', '0', 1, 1, '', 0),
(100, '61133435', 'PEDRO FERNANDO', 'JIMENEZ', 'PUTAPA?A', '2007-07-02', '', '', '', '0', 1, 1, '', 0),
(101, '61398502', 'ARIANA VALENTINA', 'PANDURO', 'JAUREGUI', '2008-02-04', '', '', '', '0', 1, 2, '', 0),
(102, '61344111', 'PAUL NICOLAS', 'QUINTANA', 'MOJALOT', '2008-04-11', '', '', '', '0', 1, 1, '', 0),
(103, '61286099', 'DAYHANA GISELL', 'RAMOS', 'PISCONTE', '2008-01-24', '', '', '', '0', 1, 2, '', 0),
(104, '76899786', 'YESHUA RANDUM', 'TORRES', 'URBINA', '2008-02-18', '', '', '', '0', 1, 1, '', 0),
(105, '61245370', 'AMY SABRINA SAKAE', 'VELASQUEZ', 'GRANDEZ', '2007-11-02', '', '', '', '0', 1, 2, '', 0),
(106, '60755761', 'ARIANA JULIA', 'BARRERA', 'RUIZ', '2006-06-01', '', '', '', '0', 1, 2, '', 0),
(107, '61379596', 'INDIRA LUZ', 'CHAHUA', 'ESPINOZA', '2006-09-25', '', '', '', '0', 1, 2, '', 0),
(108, '60885570', 'JOEL ANGEL', 'CUELLAR', 'GABRIEL', '2006-11-13', '', '', '', '0', 1, 1, '', 0),
(109, '61122235', 'KRISTEN ATENAS', 'DEL CASTILLO', 'LINGUIS', '2007-06-09', '', '', '', '0', 1, 2, '', 0),
(110, '60885470', 'FABRICIO JARVIS', 'DIAZ', 'TINEO', '2006-10-26', '', '', '', '0', 1, 1, '', 0),
(111, '60956890', 'ANGELLO DIDIER', 'FLORES', 'PILCO', '2006-12-24', '', '', '', '0', 1, 1, '', 0),
(112, '60956538', 'CLAUDIO MATHIAS', 'GARCIA', 'GARCIA', '2006-12-18', '', '', '', '0', 1, 1, '', 0),
(113, '60832217', 'DIMITRI JESUS', 'MARTINEZ', 'PEREZ', '2006-09-07', '', '', '', '0', 1, 1, '', 0),
(114, '61730326', 'PIERO', 'MUNDACA', 'VARGAS', '2006-06-02', '', '', '', '0', 1, 1, '', 0),
(115, '62926820', 'LUCIANA JULIET', 'OZAMBELA', 'RIOS', '2007-01-04', '', '', '', '0', 1, 2, '', 0),
(116, '61040218', 'PAOLA NICOLE', 'PEREZ', 'MONTECILLO', '2007-03-30', '', '', '', '0', 1, 2, '', 0),
(117, '60956569', 'AYRAM VALENTINA', 'QUISPE', 'PATI?O', '2006-12-08', '', '', '', '0', 1, 2, '', 0),
(118, '61345891', 'LORENX LUI', 'SAAVEDRA', 'CABRERA', '2007-05-19', '', '', '', '0', 1, 1, '', 0),
(119, '61487832', 'EROS FABRICIO', 'SAAVEDRA', 'GONZALES', '2007-02-25', '', '', '', '0', 1, 1, '', 0),
(120, '60737416', 'MARICIELO ANJELY', 'TRUJILLO', 'ROJAS', '2006-07-15', '', '', '', '0', 1, 2, '', 0),
(121, '60996935', 'ANGEL GABRIEL', 'VENEGAS', 'GARCIA', '2007-04-26', '', '', '', '0', 1, 1, '', 0),
(122, '74748496', 'ALLYSON GEORGELYS', 'BARDALES', 'GUTIERREZ', '2005-09-07', '', '', '', '0', 1, 2, '', 0),
(123, '75960471', 'LIBIA JOSEFA', 'CAMPO', 'TAFUR', '2006-01-28', '', '', '', '0', 1, 2, '', 0),
(124, '74723915', 'CECILIA DE JESUS', 'CARTAGENA', 'CARDENAS', '2005-12-14', '', '', '', '0', 1, 2, '', 0),
(125, '76050122', 'JEAN FRANCO', 'CHACON', 'DIAZ', '2005-11-16', '', '', '', '0', 1, 1, '', 0),
(126, '76255774', 'DELY ANABEL', 'CHUMPITAZ', 'MORENO', '2005-12-18', '', '', '', '0', 1, 2, '', 0),
(127, '71055609', 'MIA ANTONELLA', 'DIAZ', 'PEREZ', '2006-02-15', '', '', '', '0', 1, 2, '', 0),
(128, '72370805', 'ANGELLO WILLIAM', 'ESPINOZA', 'VELA', '2005-04-05', '', '', '', '0', 1, 1, '', 0),
(129, '74724876', 'JOSEPH VALENTINO', 'FASABI', 'MORENO', '2005-05-26', '', '', '', '0', 1, 1, '', 0),
(130, '74048011', 'MILENA LUCIANA', 'FELIPE', 'ORTIZ', '2006-01-10', '', '', '', '0', 1, 2, '', 0),
(131, '63256332', 'DEBORA', 'JIMENEZ', 'SILVANO', '2005-01-24', '', '', '', '0', 1, 2, '', 0),
(132, '75812287', 'MARIA CRISTINA', 'LEON', 'CARBAJAL', '2004-08-11', '', '', '', '0', 1, 2, '', 0),
(133, '62969537', 'JENNIFER ALEXANDRA', 'MORON', 'UTIA', '2006-04-24', '', '', '', '0', 1, 2, '', 0),
(134, '74366144', 'CRISTOPHER KENNETH', 'OCAMPO', 'VASQUEZ', '2005-12-20', '', '', '', '0', 1, 1, '', 0),
(135, '60737947', 'JOSEPH ADRIAN', 'PACAYA', 'MACAHUACHI', '2006-07-05', '', '', '', '0', 1, 1, '', 0),
(136, '60738084', 'RACHEL CHANTAL', 'PEREZ', 'URREA', '2006-07-27', '', '', '', '0', 1, 2, '', 0),
(137, '60756281', 'ADRIEL ADOLFO', 'REYNA', 'REATEGUI', '2006-07-10', '', '', '', '0', 1, 1, '', 0),
(138, '63692306', 'DANIELA SAHOMI', 'RIOS', 'MOZOMBITE', '2006-03-02', '', '', '', '0', 1, 2, '', 0),
(139, '139', 'FRANCISCO ALEJANDRO', 'RIVEYRO', 'VIA', '2005-05-10', '', '', '', '0', 1, 1, '', 0),
(140, '72616511', 'FERNANDA ALEXANDRA', 'ROJAS', 'SIFUENTES', '2005-08-28', '', '', '', '0', 1, 2, '', 0),
(141, '73228103', 'AMY LUCILA', 'RUIZ', 'LACHE', '2005-12-31', '', '', '', '0', 1, 2, '', 0),
(142, '142', 'MIHAEL ELIAS', 'SANCHEZ', 'PANDURO', '2006-06-04', '', '', '', '0', 1, 1, '', 0),
(143, '60755764', 'ANIBAL SEBASTIAN', 'SANCHEZ', 'VARGAS', '2006-05-31', '', '', '', '0', 1, 1, '', 0),
(144, '60737907', 'FRANCIS NAOMI', 'SOTO', 'RABANAL', '2006-06-16', '', '', '', '0', 1, 2, '', 0),
(145, '145', 'LUCIANA FRANCESCA', 'TAVARA', 'OROZCO', '2005-06-28', '', '', '', '0', 1, 2, '', 0),
(146, '60756252', 'XIOMY VALENTINA', 'TUCTO', 'ESTRADA', '2005-10-19', '', '', '', '0', 1, 2, '', 0),
(147, '70782753', 'JUAN RODRIGO', 'VALDERRAMA', 'BARTRA', '2005-11-21', '', '', '', '0', 1, 1, '', 0),
(148, '60831660', 'GUILLERMO VALENTIN', 'ZEGARRA', 'HUARAG', '2006-07-28', '', '', '', '0', 1, 1, '', 0),
(149, '73947359', 'LUIS ADRIANO', 'ALFARO', 'CARDENAS', '2005-07-17', '', '', '', '0', 1, 1, '', 0),
(150, '76989789', 'CONY NICOLE', 'APOLINARIO', 'DIAZ', '2004-11-16', '', '', '', '0', 1, 2, '', 0),
(151, '71419460', 'JOSUE DAVID', 'CARLOS', 'UCHUYA', '2004-08-17', '', '', '', '0', 1, 1, '', 0),
(152, '74914668', 'DICK RODIL', 'CORAL', 'MONTES', '2003-06-08', '', '', '', '0', 1, 1, '', 0),
(153, '74218709', 'MILAGROS NAHOMI', 'CORDOVA', 'RAMIREZ', '2005-10-19', '', '', '', '0', 1, 2, '', 0),
(154, '73109784', 'CRISTELL', 'DE LA CRUZ', 'VASQUEZ', '2005-02-10', '', '', '', '0', 1, 2, '', 0),
(155, '75755543', 'AIDAN ESTEBAN', 'FLORES', 'ZAVALA', '2005-05-23', '', '', '', '0', 1, 1, '', 0),
(156, '72169784', 'KARLA JOSELYN', 'LAVAJOS', 'PACHECO', '2004-12-30', '', '', '', '0', 1, 2, '', 0),
(157, '75806330', 'PABLO EMMANUEL', 'LAZO', 'PEZO', '2005-06-10', '', '', '', '0', 1, 1, '', 0),
(158, '73086336', 'JHON ANTHONY', 'MENDOZA', 'TUEROS', '2004-09-14', '', '', '', '0', 1, 1, '', 0),
(159, '61345584', 'TREYCI', 'MEZA', 'RIOS', '2005-10-05', '', '', '', '0', 1, 2, '', 0),
(160, '74851271', 'ROCXETH SMITH', 'ORELLANA', 'URBINA', '2005-07-18', '', '', '', '0', 1, 2, '', 0),
(161, '161', 'JACQUELINE ANAYKA', 'ORTEGA', 'CASADO', '2005-03-30', '', '', '', '0', 1, 2, '', 0),
(162, '75338496', 'BIBI ANTONELLA', 'PE?A', 'SAMAME', '2004-12-14', '', '', '', '0', 1, 2, '', 0),
(163, '72973309', 'LUCIANA ALESSANDRA', 'PEREA', 'PICON', '2005-07-24', '', '', '', '0', 1, 2, '', 0),
(164, '79053233', 'MAREK ANDREI', 'PISETSKY', 'NEYRA', '2005-06-17', '', '', '', '0', 1, 1, '', 0),
(165, '75753849', 'FAVIO AARON', 'REATEGUI', 'CUEVA', '2004-03-26', '', '', '', '0', 1, 1, '', 0),
(166, '166', 'DAYANA MISHELL', 'RIVAS', 'HIDALGO', '2005-02-28', '', '', '', '0', 1, 2, '', 0),
(167, '61040306', 'LUIS ALBERTO', 'ROJAS', 'RUIZ', '2004-09-25', '', '', '', '0', 1, 1, '', 0),
(168, '75834547', 'IRIS AMPARO', 'TANANTA', 'GARCIA', '2004-09-18', '', '', '', '0', 1, 2, '', 0),
(169, '74370943', 'STEFANY VALERIA', 'VARGAS', 'SHAHUANO', '2005-04-07', '', '', '', '0', 1, 2, '', 0),
(170, '72909750', 'BRAYAN TITO', 'VASQUEZ', 'TORRES', '2004-10-08', '', '', '', '0', 1, 1, '', 0),
(171, '70880966', 'RIVAO RONALDI?O', 'VASQUEZ', 'VILLACREZ', '2005-01-08', '', '', '', '0', 1, 1, '', 0),
(172, '71980781', 'SONIA ISABEL', 'VIA', 'LOPEZ', '2004-08-29', '00086749', '00086749', '', '0', 1, 2, '', 0),
(173, '76275268', 'JEAN SEBASTIAN', 'ACHO', 'MENDEZ', '2003-05-18', '', '', '', '0', 1, 1, '', 0),
(174, '71997689', 'CLAUDIO MARTIN', 'AYOSA', 'GOMEZ', '2004-04-13', '', '', '', '0', 1, 1, '', 0),
(175, '75258273', 'ADRIANA ESCOY', 'BULLON', 'GONZALES', '2004-01-29', '', '', '', '0', 1, 2, '', 0),
(176, '77659750', 'MARICARMEN', 'DAZA', 'SALAS', '2003-05-05', '', '', '', '0', 1, 2, '', 0),
(177, '75889701', 'RAY WEIDER', 'DIAZ', 'TINEO', '2003-11-10', '', '', '', '0', 1, 1, '', 0),
(178, '76697021', 'JENNYFER NIKOL', 'GONZALES', 'PANDURO', '2004-04-06', '', '', '', '0', 1, 2, '', 0),
(179, '72172249', 'FREDY JUNIOR', 'HORNA', 'CHUQUI', '2004-06-28', '', '', '', '0', 1, 1, '', 0),
(180, '72672492', 'JULIA ALEXANDRA', 'JIMENEZ', 'PUTAPA?A', '2004-05-18', '', '', '', '0', 1, 2, '', 0),
(181, '71458726', 'DIEGO ALESSANDRO', 'MARTINEZ', 'PEREZ', '2004-01-18', '', '', '', '0', 1, 1, '', 0),
(182, '76035621', 'CARLOS JAVIER', 'OCHOA', 'TAFUR', '2004-05-08', '', '', '', '0', 1, 1, '', 0),
(183, '61430555', 'JUAN DE DIOS', 'RAFAEL', 'RAMIREZ', '2003-07-17', '', '', '', '0', 1, 1, '', 0),
(184, '73137821', 'TREYCI DE JESUS', 'RENGIFO', 'PEREZ', '2004-07-24', '', '', '', '0', 1, 2, '', 0),
(185, '75565739', 'JOHAN ERICK', 'RUIZ', 'RENGIFO', '2004-05-04', '', '', '', '0', 1, 1, '', 0),
(186, '74778142', 'KARLA DAFNE', 'RUPP', 'PRENTICE', '2003-09-15', '', '', '', '0', 1, 2, '', 0),
(187, '74383633', 'PERLA AALIYAH', 'VALDEZ', 'SALDA?A', '2003-12-12', '', '', '', '0', 1, 2, '', 0),
(188, '72759643', 'JOSE SAMUEL', 'VALQUE', 'IZQUIERDO', '2004-07-26', '', '', '', '0', 1, 1, '', 0),
(189, '72404947', 'GUSTAVO ADOLFO', 'CAVERO EGUSQUIZA', 'TUESTA', '2003-07-25', '', '', '', '0', 1, 1, '', 0),
(190, '75273167', 'JOSUE BRAYAN', 'ESCOBAR', 'HUAMANI', '2002-03-10', '', '', '', '0', 1, 1, '', 0),
(191, '71008396', 'ASTHRID MALENHA', 'FLORES', 'MACEDO', '2002-06-27', '', '', '', '0', 1, 2, '', 0),
(192, '74079637', 'JENNIFER', 'LUCHINE', 'ARRATEA', '2002-09-17', '', '', '', '0', 1, 2, '', 0),
(193, '75360379', 'LIDIA DEL ROSARIO', 'NAVARRO', 'REATEGUI', '2003-06-04', '', '', '', '0', 1, 2, '', 0),
(194, '75785623', 'CARLOS DANIEL', 'PALA', 'ESPINOZA', '2002-10-20', '', '', '', '0', 1, 1, '', 0),
(195, '73056902', 'MARIA BELEN', 'RAMIREZ', 'GAVIRIA', '2002-08-10', '', '', '', '0', 1, 2, '', 0),
(196, '70616601', 'DANNA ELIZABETH', 'RAMOS', 'QUINCAS', '2002-07-31', '', '', '', '0', 1, 2, '', 0),
(197, '72546865', 'TREICY SALOME', 'SERRANO', 'HIDALGO', '2002-09-02', '', '', '', '0', 1, 2, '', 0),
(198, '76215263', 'MARYCIELO', 'TANCHIVA', 'ZEVALLOS', '2002-11-16', '', '', '', '0', 1, 2, '', 0),
(199, '71020121', 'ANNY PRISCILA', 'VASQUEZ', 'TUESTA', '2003-08-20', '', '', '', '0', 1, 2, '', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `anioescolar`
--

DROP TABLE IF EXISTS `anioescolar`;
CREATE TABLE IF NOT EXISTS `anioescolar` (
`idAnioEscolar` int(11) NOT NULL,
  `descr` varchar(45) NOT NULL,
  `est` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `anioescolar`
--

INSERT INTO `anioescolar` (`idAnioEscolar`, `descr`, `est`) VALUES
(1, '2016', 2),
(2, '2017', 2),
(3, '2018', 2),
(4, '2019', 1),
(5, '2019 VACACIONES', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `apoderado`
--

DROP TABLE IF EXISTS `apoderado`;
CREATE TABLE IF NOT EXISTS `apoderado` (
`idApoderado` int(11) NOT NULL,
  `dni` varchar(8) NOT NULL,
  `nomb` varchar(45) NOT NULL,
  `apepa` varchar(45) NOT NULL,
  `apema` varchar(45) NOT NULL,
  `dir` varchar(150) NOT NULL,
  `telf` varchar(12) NOT NULL,
  `idtipoApoderado` int(11) NOT NULL,
  `est` int(11) NOT NULL DEFAULT '1',
  `pass` varchar(45) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `apoderado`
--

INSERT INTO `apoderado` (`idApoderado`, `dni`, `nomb`, `apepa`, `apema`, `dir`, `telf`, `idtipoApoderado`, `est`, `pass`) VALUES
(1, '00029200', 'LUZ ANGELICA', 'ESCOBAR', 'ALEGRIA', 'jr.alfonzo ungarte mz:N lt:3', '061596675', 3, 1, '00029200'),
(2, '09886003', 'CARLOS ALBERTO', 'LOPEZ', 'MARRUFO', 'pj.los naranjos', '965154211', 1, 1, '09886003'),
(3, '00086749', 'JOSE ELMO', 'VIA', 'MALPARTIDA', 'JR. IQUITOS #481', '948046469', 1, 1, '00086749'),
(4, '', 'DATOS', 'NO SE', 'REGISTRO', 'S/D', 'S/N', 1, 1, ''),
(5, '00123573', 'DANIA MARITA', 'HERRERA', 'ESCOBAR', 'jr.PomaRosa mz:F lt:3', '061596675', 2, 1, '00029200');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `asigdocente`
--

DROP TABLE IF EXISTS `asigdocente`;
CREATE TABLE IF NOT EXISTS `asigdocente` (
  `idDocente` int(11) NOT NULL,
  `idCursos` int(11) NOT NULL,
  `idGrado` int(11) NOT NULL,
  `idSeccion` int(11) NOT NULL,
  `idAnioEscolar` int(11) NOT NULL,
  `est` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `asigdocente`
--

INSERT INTO `asigdocente` (`idDocente`, `idCursos`, `idGrado`, `idSeccion`, `idAnioEscolar`, `est`) VALUES
(1, 11, 1, 1, 4, 1),
(1, 12, 1, 1, 4, 1),
(1, 13, 1, 1, 4, 1),
(1, 14, 1, 1, 4, 1),
(1, 15, 1, 1, 4, 1),
(1, 16, 1, 1, 4, 1),
(1, 17, 1, 1, 4, 1),
(1, 18, 1, 1, 4, 1),
(1, 19, 1, 1, 4, 1),
(2, 1, 7, 1, 4, 1),
(2, 1, 8, 1, 4, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `asistencia`
--

DROP TABLE IF EXISTS `asistencia`;
CREATE TABLE IF NOT EXISTS `asistencia` (
`idasistencia` int(11) NOT NULL,
  `idMatricula` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `hora` time NOT NULL,
  `est` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `competencias`
--

DROP TABLE IF EXISTS `competencias`;
CREATE TABLE IF NOT EXISTS `competencias` (
`idComp` int(11) NOT NULL,
  `idcurso` int(11) NOT NULL,
  `descr` varchar(200) NOT NULL,
  `est` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=61 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `competencias`
--

INSERT INTO `competencias` (`idComp`, `idcurso`, `descr`, `est`) VALUES
(1, 1, 'Resuelve problemas de cantidad', 1),
(2, 1, 'Resuelve problemas de regularidad, equivalencia y cambio', 1),
(3, 1, 'Resuelve problemas de forma, movimiento y localizacion', 1),
(4, 1, 'Resuelve problemas de gestiÃ³n de datos e incertidumbre', 1),
(5, 2, 'Se comunica oralmente en su lengua materna', 1),
(6, 2, 'Lee diversos tipos de textos escritos en su lengua  materna', 1),
(7, 2, 'Escribe diversos  tipos  de textos  en su lengua materna.', 1),
(8, 3, 'Se desenvelve  en forma  autonoma  a traves de su motricidad.', 1),
(9, 3, 'Asume una  vida  saludable.', 1),
(10, 3, 'Interactua  a  traves de sus habilidades  motrices.', 1),
(11, 4, 'Indaga, mediante mÃ©todos cientÃ­ficos,para construir sus conocimientos.', 1),
(12, 4, 'Explica el mundo fÃ­sico, basado en conocimientos sobre los seres vivos, materia y energia biodiversidad ,tierra y universo.', 1),
(13, 4, 'DiseÃ±a y construye soluciones  tecnologicas para resolver problemasde su entorno.', 1),
(14, 5, 'Construye interpretaciones historicas.', 1),
(15, 5, 'Gestiona responsablemente el espacio y el ambiente.', 1),
(16, 5, 'Gestiona responsablemente los  recursos economicos.', 1),
(17, 6, 'Aprecia de manera critica manifestaciones artistico culturales.', 1),
(18, 6, 'Crea proyectos desde los lenguajes artisticos.', 1),
(19, 7, 'Construye su identidad.', 1),
(20, 7, 'Construye y participa democraticaente en la busqueda del bien comun.', 1),
(21, 8, 'Gestiona proyectos de emprendimiento económico y social.', 1),
(22, 9, 'Se comunica oralmente en ingles como  lengua extranjera', 1),
(23, 9, 'Lee diversos tipos de textos escritos en ingles como lengua  extranjera', 1),
(24, 9, 'Escribe diversos  tipos  de textos  en ingles como lengua extranjera.', 1),
(25, 10, 'Construye  su identidad como persona humana, Amada  por Dios ,digna,libre y trascendente,comprendiendo la dogtrina de su propia religiÃ³n,abierta  al dialogo con las que son cercanas.', 1),
(26, 10, 'Asume la experiencia del encuentro personal y comunitario con Dios en su proyecto de vida en coherencia con su creencia religiosa.', 1),
(27, 16, 'ActÃºa y piensa matemÃ¡ticamente en situaciones de cantidad', 1),
(28, 16, 'ActÃºa y piensa matemÃ¡ticamente en situaciones de regularidad, equivalencia y cambio', 1),
(29, 16, 'ActÃºa y piensa matemÃ¡ticamente en situaciones de forma, movimiento y localizaciÃ³n', 1),
(30, 11, 'Afirma su identidad', 1),
(31, 11, 'Se desenvuelve Ã©ticamente', 1),
(32, 11, 'Convive respetÃ¡ndose a sÃ­ mismo y a los demÃ¡s', 1),
(33, 11, 'Participa en asuntos pÃºblicos para promover el bien comÃºn', 2),
(34, 11, 'Construye interpretaciones histÃ³ricas', 2),
(35, 11, 'ActÃºa responsablemente en el ambiente', 1),
(36, 11, 'ActÃºa responsablemente respecto a los recursos econÃ³micos', 1),
(37, 12, 'Comprende y valora el desarrollo del cuerpo y la salud', 1),
(38, 12, 'Comprende y valora el dominio corporal y la expresiÃ³n creativa', 1),
(39, 12, 'Valora y practica la convivencia e interacciÃ³n sociomotriz', 1),
(40, 13, 'Comprende textos orales', 1),
(41, 13, 'Se expresa oralmente', 1),
(42, 13, 'Comprende textos escritos', 1),
(43, 13, 'Produce textos escritos', 1),
(44, 14, 'ExpresiÃ³n artÃ­stica', 1),
(45, 14, 'ApreciaciÃ³n artÃ­stica', 1),
(46, 15, 'Comprende textos orales', 1),
(47, 15, 'Se expresa oralmente', 1),
(48, 15, 'Comprende textos escritos', 1),
(49, 15, 'Produce textos escritos', 2),
(50, 16, 'ActÃºa y piensa matemÃ¡ticamente en situaciones de gestiÃ³n de datos e incertidumbre', 2),
(51, 17, 'Indaga, mediante mÃ©todos cientÃ­ficos, situaciones que pueden ser investigadas por la ciencia', 1),
(52, 17, 'Explica el mundo fÃ­sico, basado en conocimientos cientÃ­ficos', 1),
(53, 17, 'DiseÃ±a y produce prototipos tecnolÃ³gicos para resolver problemas de su entorno', 1),
(54, 17, 'Construye una posiciÃ³n crÃ­tica sobre la ciencia y la tecnologÃ­a en sociedad', 1),
(55, 18, 'FormaciÃ³n de la conciencia moral cristiana', 1),
(56, 18, 'Testimonio de vida', 1),
(57, 19, 'Se comunica oralmente en InglÃ©s como lengua extranjera', 1),
(58, 19, 'Lee diversos tipos de textos en InglÃ©s como lengua extranjera', 1),
(59, 19, 'Escribe diversos tipos de textos InglÃ©s como lengua extranjera', 1),
(60, 0, '', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cursos`
--

DROP TABLE IF EXISTS `cursos`;
CREATE TABLE IF NOT EXISTS `cursos` (
`idCursos` int(11) NOT NULL,
  `descr` varchar(45) NOT NULL,
  `idtipogrado` varchar(45) NOT NULL,
  `est` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `cursos`
--

INSERT INTO `cursos` (`idCursos`, `descr`, `idtipogrado`, `est`) VALUES
(1, 'MATEMATICA', '2', 1),
(2, 'COMUNICACION', '2', 1),
(3, 'EDUCACION FISICA', '2', 1),
(4, 'CIENCIA, TECNOLOGÃA Y AMBIENTE', '2', 1),
(5, 'CIENCIAS SOCIALES', '2', 1),
(6, 'ARTE', '2', 1),
(7, 'DESARROLLO PERSONAL Y CIUDADANA ', '2', 1),
(8, 'EDUCACION PARA EL TRABAJO', '2', 1),
(9, 'INGLES', '2', 1),
(10, 'EDUCACIÃ“N RELIGIOSA', '2', 1),
(11, 'PERSONAL SOCIAL', '1', 1),
(12, 'EDUCACION FISICA', '1', 1),
(13, 'COMUNICACION LENGUA MATERNA', '1', 1),
(14, 'ARTE Y CULTURA', '1', 1),
(15, 'COMUNICACIÃ“N SEGUNDA LENGUA', '1', 1),
(16, 'MATEMATICA', '1', 1),
(17, 'CIENCIA Y TECNOLOGIA', '1', 1),
(18, 'EDUCACIÃ“N RELIGIOSA', '1', 1),
(19, 'INGLES', '1', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `deuda`
--

DROP TABLE IF EXISTS `deuda`;
CREATE TABLE IF NOT EXISTS `deuda` (
`idDeuda` int(11) NOT NULL,
  `idMatricula` int(11) NOT NULL,
  `idTipoDeuda` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `hora` time NOT NULL,
  `monto` double NOT NULL,
  `est` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB AUTO_INCREMENT=70 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `deuda`
--

INSERT INTO `deuda` (`idDeuda`, `idMatricula`, `idTipoDeuda`, `fecha`, `hora`, `monto`, `est`) VALUES
(6, 1, 1, '2019-09-04', '10:46:50', 150, 1),
(7, 2, 1, '2019-09-04', '20:57:58', 150, 1),
(8, 3, 1, '2019-09-04', '20:58:16', 150, 1),
(9, 4, 1, '2019-09-04', '20:58:37', 150, 1),
(10, 5, 1, '2019-09-04', '20:59:09', 150, 1),
(11, 6, 1, '2019-09-04', '20:59:28', 150, 1),
(12, 7, 1, '2019-09-04', '20:59:50', 150, 1),
(13, 8, 1, '2019-09-04', '21:00:08', 150, 1),
(14, 9, 1, '2019-09-04', '21:00:27', 150, 1),
(15, 10, 1, '2019-09-04', '21:00:45', 150, 1),
(16, 11, 1, '2019-09-04', '21:01:07', 150, 1),
(17, 12, 1, '2019-09-04', '21:01:33', 150, 1),
(18, 13, 1, '2019-09-04', '21:02:12', 150, 1),
(19, 14, 1, '2019-09-04', '21:02:34', 150, 1),
(20, 15, 1, '2019-09-04', '21:02:56', 150, 1),
(21, 16, 1, '2019-09-04', '21:03:13', 150, 1),
(22, 17, 1, '2019-09-04', '21:03:48', 150, 1),
(23, 18, 1, '2019-09-12', '01:55:01', 150, 1),
(24, 19, 1, '2019-09-12', '01:55:37', 150, 1),
(25, 20, 1, '2019-09-12', '01:55:55', 150, 1),
(26, 21, 1, '2019-09-12', '01:57:47', 150, 1),
(27, 22, 1, '2019-09-12', '01:58:15', 150, 1),
(28, 23, 1, '2019-09-12', '01:58:41', 150, 1),
(29, 24, 1, '2019-09-12', '01:59:08', 150, 1),
(30, 25, 1, '2019-09-12', '01:59:31', 150, 1),
(31, 26, 1, '2019-09-12', '01:59:49', 150, 1),
(32, 27, 1, '2019-09-12', '02:00:14', 150, 1),
(33, 28, 1, '2019-09-12', '02:00:36', 150, 1),
(34, 29, 1, '2019-09-12', '02:08:05', 150, 1),
(35, 30, 1, '2019-09-12', '02:08:27', 150, 1),
(36, 31, 1, '2019-09-12', '02:08:53', 150, 1),
(37, 32, 1, '2019-09-12', '02:09:36', 150, 1),
(38, 33, 1, '2019-09-12', '02:09:55', 150, 1),
(39, 34, 1, '2019-09-12', '02:10:20', 150, 1),
(40, 35, 1, '2019-09-12', '02:11:41', 150, 1),
(41, 36, 1, '2019-09-12', '02:12:07', 150, 1),
(42, 37, 1, '2019-09-12', '02:12:27', 150, 1),
(43, 38, 1, '2019-09-12', '02:13:07', 150, 1),
(44, 39, 1, '2019-09-12', '02:13:27', 150, 1),
(45, 40, 1, '2019-09-12', '02:13:44', 150, 1),
(46, 41, 1, '2019-09-12', '02:15:15', 150, 1),
(47, 42, 1, '2019-09-12', '02:15:41', 150, 1),
(48, 43, 1, '2019-09-12', '02:16:21', 150, 1),
(49, 44, 1, '2019-09-12', '02:16:39', 150, 1),
(50, 45, 1, '2019-09-12', '09:32:56', 150, 1),
(51, 46, 1, '2019-09-12', '09:33:12', 150, 1),
(52, 47, 1, '2019-09-12', '09:33:33', 150, 1),
(53, 48, 1, '2019-09-12', '09:33:47', 150, 1),
(54, 49, 1, '2019-09-12', '09:33:58', 150, 1),
(55, 50, 1, '2019-09-12', '09:34:13', 150, 1),
(56, 51, 1, '2019-09-12', '09:34:35', 150, 1),
(57, 52, 1, '2019-09-12', '09:35:02', 150, 1),
(58, 53, 1, '2019-09-12', '09:35:15', 150, 1),
(59, 54, 1, '2019-09-12', '09:35:41', 150, 1),
(60, 55, 1, '2019-09-12', '09:36:09', 150, 1),
(61, 56, 1, '2019-09-12', '09:36:30', 150, 1),
(62, 57, 1, '2019-09-12', '09:36:47', 150, 1),
(63, 58, 1, '2019-09-12', '09:37:09', 150, 1),
(64, 59, 1, '2019-09-12', '09:37:22', 150, 1),
(65, 60, 1, '2019-09-12', '09:37:38', 150, 1),
(66, 61, 1, '2019-09-12', '09:37:53', 150, 1),
(67, 62, 1, '2019-09-12', '09:38:07', 150, 1),
(68, 63, 1, '2019-09-12', '09:38:17', 150, 1),
(69, 64, 1, '2019-09-12', '09:38:34', 150, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `docente`
--

DROP TABLE IF EXISTS `docente`;
CREATE TABLE IF NOT EXISTS `docente` (
`idDocente` int(11) NOT NULL,
  `dni` varchar(8) NOT NULL,
  `nomb` varchar(45) NOT NULL,
  `apepa` varchar(45) NOT NULL,
  `apema` varchar(45) NOT NULL,
  `fnac` date NOT NULL,
  `telf` varchar(12) NOT NULL,
  `dir` varchar(150) NOT NULL,
  `pass` varchar(45) NOT NULL,
  `ext` varchar(5) DEFAULT '0',
  `idsex` int(11) NOT NULL,
  `targeta` varchar(50) DEFAULT NULL,
  `est` int(11) NOT NULL,
  `saldo` double DEFAULT '0',
  `idtipo` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `docente`
--

INSERT INTO `docente` (`idDocente`, `dni`, `nomb`, `apepa`, `apema`, `fnac`, `telf`, `dir`, `pass`, `ext`, `idsex`, `targeta`, `est`, `saldo`, `idtipo`) VALUES
(1, '71043266', 'DANNY MANUEL', 'CHAVEZ', 'HERRERA', '1996-06-13', '991268866', 'jr.alfonzo ugarte mz:N lt:3 ', '1234', '0', 1, NULL, 1, 0, 1),
(2, '00123573', 'DANIA MARITA', 'HERRERA', 'ESCOBAR', '1977-05-31', '061596675', 'jr.PomaRosa mz:F lt:3     ', '1234', 'jpg', 2, NULL, 1, 0, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estados`
--

DROP TABLE IF EXISTS `estados`;
CREATE TABLE IF NOT EXISTS `estados` (
`idestados` int(11) NOT NULL,
  `descr` varchar(45) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `estados`
--

INSERT INTO `estados` (`idestados`, `descr`) VALUES
(1, 'ACTIVO'),
(2, 'INACTIVO'),
(3, 'RETIRADO');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `grado`
--

DROP TABLE IF EXISTS `grado`;
CREATE TABLE IF NOT EXISTS `grado` (
`idGrado` int(11) NOT NULL,
  `descr` varchar(45) NOT NULL,
  `idTipo` int(11) NOT NULL,
  `est` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `grado`
--

INSERT INTO `grado` (`idGrado`, `descr`, `idTipo`, `est`) VALUES
(1, '1ro', 1, 1),
(2, '2do', 1, 1),
(3, '3ro', 1, 1),
(4, '4to', 1, 1),
(5, '5to', 1, 1),
(6, '6to', 1, 1),
(7, '1ro', 2, 1),
(8, '2do', 2, 1),
(9, '3ro', 2, 1),
(10, '4to', 2, 1),
(11, '5to', 2, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `gradoseccion`
--

DROP TABLE IF EXISTS `gradoseccion`;
CREATE TABLE IF NOT EXISTS `gradoseccion` (
  `idGrado` int(11) NOT NULL,
  `idSeccion` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `historial`
--

DROP TABLE IF EXISTS `historial`;
CREATE TABLE IF NOT EXISTS `historial` (
`idhistorial` int(11) NOT NULL,
  `idUsuario` int(11) NOT NULL,
  `tabla` varchar(45) NOT NULL,
  `id` int(11) NOT NULL,
  `descr` varchar(100) NOT NULL,
  `fecha` date NOT NULL,
  `hora` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `insidencias`
--

DROP TABLE IF EXISTS `insidencias`;
CREATE TABLE IF NOT EXISTS `insidencias` (
`idinsidencias` int(11) NOT NULL,
  `IdMat` int(11) NOT NULL,
  `idtipoIns` int(11) NOT NULL,
  `descr` varchar(250) NOT NULL,
  `tabla` varchar(45) NOT NULL,
  `id` varchar(45) NOT NULL,
  `fecha` date NOT NULL,
  `est` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `matricula`
--

DROP TABLE IF EXISTS `matricula`;
CREATE TABLE IF NOT EXISTS `matricula` (
`idMatricula` int(11) NOT NULL,
  `dnialu` varchar(8) NOT NULL,
  `idGrado` int(11) NOT NULL,
  `idSeccion` int(11) NOT NULL,
  `idAnioEscolar` int(11) NOT NULL,
  `idUsuario` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `hora` time NOT NULL,
  `est` int(11) NOT NULL DEFAULT '1',
  `idtipomat` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=65 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `matricula`
--

INSERT INTO `matricula` (`idMatricula`, `dnialu`, `idGrado`, `idSeccion`, `idAnioEscolar`, `idUsuario`, `fecha`, `hora`, `est`, `idtipomat`) VALUES
(1, '71980781', 9, 1, 4, 1, '2019-09-04', '10:46:50', 1, 4),
(2, '60755761', 7, 1, 4, 1, '2019-09-04', '20:57:58', 1, 1),
(3, '61379596', 7, 1, 4, 1, '2019-09-04', '20:58:16', 1, 1),
(4, '60885570', 7, 1, 4, 1, '2019-09-04', '20:58:37', 1, 1),
(5, '61122235', 7, 1, 4, 1, '2019-09-04', '20:59:09', 1, 1),
(6, '60885470', 7, 1, 4, 1, '2019-09-04', '20:59:28', 1, 1),
(7, '60956890', 7, 1, 4, 1, '2019-09-04', '20:59:50', 1, 1),
(8, '60956538', 7, 1, 4, 1, '2019-09-04', '21:00:08', 1, 1),
(9, '60832217', 7, 1, 4, 1, '2019-09-04', '21:00:27', 1, 1),
(10, '61730326', 7, 1, 4, 1, '2019-09-04', '21:00:45', 1, 1),
(11, '62926820', 7, 1, 4, 1, '2019-09-04', '21:01:07', 1, 1),
(12, '61040218', 7, 1, 4, 1, '2019-09-04', '21:01:33', 1, 1),
(13, '60956569', 7, 1, 4, 1, '2019-09-04', '21:02:12', 1, 1),
(14, '61345891', 7, 1, 4, 1, '2019-09-04', '21:02:34', 1, 1),
(15, '61487832', 7, 1, 4, 1, '2019-09-04', '21:02:56', 1, 1),
(16, '60737416', 7, 1, 4, 1, '2019-09-04', '21:03:13', 1, 1),
(17, '60996935', 7, 1, 4, 1, '2019-09-04', '21:03:48', 1, 1),
(18, '74748496', 8, 1, 4, 1, '2019-09-12', '01:55:01', 1, 1),
(19, '75960471', 8, 1, 4, 1, '2019-09-12', '01:55:37', 1, 1),
(20, '74723915', 8, 1, 4, 1, '2019-09-12', '01:55:54', 1, 1),
(21, '76050122', 8, 1, 4, 1, '2019-09-12', '01:57:47', 1, 1),
(22, '76255774', 8, 1, 4, 1, '2019-09-12', '01:58:15', 1, 1),
(23, '71055609', 8, 1, 4, 1, '2019-09-12', '01:58:41', 1, 1),
(24, '72370805', 8, 1, 4, 1, '2019-09-12', '01:59:07', 1, 1),
(25, '74724876', 8, 1, 4, 1, '2019-09-12', '01:59:31', 1, 1),
(26, '74048011', 8, 1, 4, 1, '2019-09-12', '01:59:49', 1, 1),
(27, '63256332', 8, 1, 4, 1, '2019-09-12', '02:00:14', 1, 1),
(28, '75812287', 8, 1, 4, 1, '2019-09-12', '02:00:36', 1, 1),
(29, '62969537', 8, 1, 4, 1, '2019-09-12', '02:08:04', 1, 1),
(30, '74366144', 8, 1, 4, 1, '2019-09-12', '02:08:27', 1, 1),
(31, '60737947', 8, 1, 4, 1, '2019-09-12', '02:08:52', 1, 1),
(32, '60738084', 8, 1, 4, 1, '2019-09-12', '02:09:35', 1, 1),
(33, '60756281', 8, 1, 4, 1, '2019-09-12', '02:09:55', 1, 1),
(34, '63692306', 8, 1, 4, 1, '2019-09-12', '02:10:19', 1, 1),
(35, '139', 8, 1, 4, 1, '2019-09-12', '02:11:40', 1, 1),
(36, '72616511', 8, 1, 4, 1, '2019-09-12', '02:12:06', 1, 1),
(37, '73228103', 8, 1, 4, 1, '2019-09-12', '02:12:27', 1, 1),
(38, '142', 8, 1, 4, 1, '2019-09-12', '02:13:06', 1, 1),
(39, '60755764', 8, 1, 4, 1, '2019-09-12', '02:13:27', 1, 1),
(40, '60737907', 8, 1, 4, 1, '2019-09-12', '02:13:44', 1, 1),
(41, '145', 8, 1, 4, 1, '2019-09-12', '02:15:15', 1, 1),
(42, '60756252', 8, 1, 4, 1, '2019-09-12', '02:15:40', 1, 1),
(43, '70782753', 8, 1, 4, 1, '2019-09-12', '02:16:21', 1, 1),
(44, '60831660', 8, 1, 4, 1, '2019-09-12', '02:16:38', 1, 1),
(45, '77935796', 1, 1, 4, 1, '2019-09-12', '09:32:56', 1, 1),
(46, '77865906', 1, 1, 4, 1, '2019-09-12', '09:33:12', 1, 1),
(47, '63693168', 1, 1, 4, 1, '2019-09-12', '09:33:33', 1, 1),
(48, '63188596', 1, 1, 4, 1, '2019-09-12', '09:33:47', 1, 1),
(49, '63441955', 1, 1, 4, 1, '2019-09-12', '09:33:58', 1, 1),
(50, '81137474', 1, 1, 4, 1, '2019-09-12', '09:34:13', 1, 1),
(51, '81056216', 1, 1, 4, 1, '2019-09-12', '09:34:35', 1, 1),
(52, '63802336', 1, 1, 4, 1, '2019-09-12', '09:35:02', 1, 1),
(53, '77840120', 1, 1, 4, 1, '2019-09-12', '09:35:15', 1, 1),
(54, '81075624', 1, 1, 4, 1, '2019-09-12', '09:35:41', 1, 1),
(55, '63693200', 1, 1, 4, 1, '2019-09-12', '09:36:09', 1, 1),
(56, '77729457', 1, 1, 4, 1, '2019-09-12', '09:36:30', 1, 1),
(57, '81137498', 1, 1, 4, 1, '2019-09-12', '09:36:47', 1, 1),
(58, '77631575', 1, 1, 4, 1, '2019-09-12', '09:37:09', 1, 1),
(59, '81137712', 1, 1, 4, 1, '2019-09-12', '09:37:22', 1, 1),
(60, '63530752', 1, 1, 4, 1, '2019-09-12', '09:37:38', 1, 1),
(61, '81102417', 1, 1, 4, 1, '2019-09-12', '09:37:53', 1, 1),
(62, '77648457', 1, 1, 4, 1, '2019-09-12', '09:38:07', 1, 1),
(63, '80961445', 1, 1, 4, 1, '2019-09-12', '09:38:17', 1, 1),
(64, '63793112', 1, 1, 4, 1, '2019-09-12', '09:38:34', 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `notasalumno`
--

DROP TABLE IF EXISTS `notasalumno`;
CREATE TABLE IF NOT EXISTS `notasalumno` (
  `idMatricula` int(11) NOT NULL,
  `idComp` int(11) NOT NULL,
  `nota1` int(11) DEFAULT '-1',
  `nota2` int(11) DEFAULT '-1',
  `nota3` int(11) DEFAULT '-1',
  `nota4` int(11) DEFAULT '-1',
  `recu` int(11) DEFAULT '-1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `notasalumno`
--

INSERT INTO `notasalumno` (`idMatricula`, `idComp`, `nota1`, `nota2`, `nota3`, `nota4`, `recu`) VALUES
(1, 1, -1, -1, -1, -1, -1),
(1, 2, -1, -1, -1, -1, -1),
(1, 3, -1, -1, -1, -1, -1),
(1, 4, -1, -1, -1, -1, -1),
(1, 5, -1, -1, -1, -1, -1),
(1, 6, -1, -1, -1, -1, -1),
(1, 7, -1, -1, -1, -1, -1),
(1, 8, -1, -1, -1, -1, -1),
(1, 9, -1, -1, -1, -1, -1),
(1, 10, -1, -1, -1, -1, -1),
(1, 11, -1, -1, -1, -1, -1),
(1, 12, -1, -1, -1, -1, -1),
(1, 13, -1, -1, -1, -1, -1),
(1, 14, -1, -1, -1, -1, -1),
(1, 15, -1, -1, -1, -1, -1),
(1, 16, -1, -1, -1, -1, -1),
(1, 17, -1, -1, -1, -1, -1),
(1, 18, -1, -1, -1, -1, -1),
(1, 19, -1, -1, -1, -1, -1),
(1, 20, -1, -1, -1, -1, -1),
(1, 21, -1, -1, -1, -1, -1),
(1, 22, -1, -1, -1, -1, -1),
(1, 23, -1, -1, -1, -1, -1),
(1, 24, -1, -1, -1, -1, -1),
(1, 25, -1, -1, -1, -1, -1),
(1, 26, -1, -1, -1, -1, -1),
(2, 1, -1, -1, -1, -1, -1),
(2, 2, -1, -1, -1, -1, -1),
(2, 3, -1, -1, -1, -1, -1),
(2, 4, -1, -1, -1, -1, -1),
(2, 5, -1, -1, -1, -1, -1),
(2, 6, -1, -1, -1, -1, -1),
(2, 7, -1, -1, -1, -1, -1),
(2, 8, -1, -1, -1, -1, -1),
(2, 9, -1, -1, -1, -1, -1),
(2, 10, -1, -1, -1, -1, -1),
(2, 11, -1, -1, -1, -1, -1),
(2, 12, -1, -1, -1, -1, -1),
(2, 13, -1, -1, -1, -1, -1),
(2, 14, -1, -1, -1, -1, -1),
(2, 15, -1, -1, -1, -1, -1),
(2, 16, -1, -1, -1, -1, -1),
(2, 17, -1, -1, -1, -1, -1),
(2, 18, -1, -1, -1, -1, -1),
(2, 19, -1, -1, -1, -1, -1),
(2, 20, -1, -1, -1, -1, -1),
(2, 21, -1, -1, -1, -1, -1),
(2, 22, -1, -1, -1, -1, -1),
(2, 23, -1, -1, -1, -1, -1),
(2, 24, -1, -1, -1, -1, -1),
(2, 25, -1, -1, -1, -1, -1),
(2, 26, -1, -1, -1, -1, -1),
(3, 1, -1, -1, -1, -1, -1),
(3, 2, -1, -1, -1, -1, -1),
(3, 3, -1, -1, -1, -1, -1),
(3, 4, -1, -1, -1, -1, -1),
(3, 5, -1, -1, -1, -1, -1),
(3, 6, -1, -1, -1, -1, -1),
(3, 7, -1, -1, -1, -1, -1),
(3, 8, -1, -1, -1, -1, -1),
(3, 9, -1, -1, -1, -1, -1),
(3, 10, -1, -1, -1, -1, -1),
(3, 11, -1, -1, -1, -1, -1),
(3, 12, -1, -1, -1, -1, -1),
(3, 13, -1, -1, -1, -1, -1),
(3, 14, -1, -1, -1, -1, -1),
(3, 15, -1, -1, -1, -1, -1),
(3, 16, -1, -1, -1, -1, -1),
(3, 17, -1, -1, -1, -1, -1),
(3, 18, -1, -1, -1, -1, -1),
(3, 19, -1, -1, -1, -1, -1),
(3, 20, -1, -1, -1, -1, -1),
(3, 21, -1, -1, -1, -1, -1),
(3, 22, -1, -1, -1, -1, -1),
(3, 23, -1, -1, -1, -1, -1),
(3, 24, -1, -1, -1, -1, -1),
(3, 25, -1, -1, -1, -1, -1),
(3, 26, -1, -1, -1, -1, -1),
(4, 1, -1, -1, -1, -1, -1),
(4, 2, -1, -1, -1, -1, -1),
(4, 3, -1, -1, -1, -1, -1),
(4, 4, -1, -1, -1, -1, -1),
(4, 5, -1, -1, -1, -1, -1),
(4, 6, -1, -1, -1, -1, -1),
(4, 7, -1, -1, -1, -1, -1),
(4, 8, -1, -1, -1, -1, -1),
(4, 9, -1, -1, -1, -1, -1),
(4, 10, -1, -1, -1, -1, -1),
(4, 11, -1, -1, -1, -1, -1),
(4, 12, -1, -1, -1, -1, -1),
(4, 13, -1, -1, -1, -1, -1),
(4, 14, -1, -1, -1, -1, -1),
(4, 15, -1, -1, -1, -1, -1),
(4, 16, -1, -1, -1, -1, -1),
(4, 17, -1, -1, -1, -1, -1),
(4, 18, -1, -1, -1, -1, -1),
(4, 19, -1, -1, -1, -1, -1),
(4, 20, -1, -1, -1, -1, -1),
(4, 21, -1, -1, -1, -1, -1),
(4, 22, -1, -1, -1, -1, -1),
(4, 23, -1, -1, -1, -1, -1),
(4, 24, -1, -1, -1, -1, -1),
(4, 25, -1, -1, -1, -1, -1),
(4, 26, -1, -1, -1, -1, -1),
(5, 1, -1, -1, -1, -1, -1),
(5, 2, -1, -1, -1, -1, -1),
(5, 3, -1, -1, -1, -1, -1),
(5, 4, -1, -1, -1, -1, -1),
(5, 5, -1, -1, -1, -1, -1),
(5, 6, -1, -1, -1, -1, -1),
(5, 7, -1, -1, -1, -1, -1),
(5, 8, -1, -1, -1, -1, -1),
(5, 9, -1, -1, -1, -1, -1),
(5, 10, -1, -1, -1, -1, -1),
(5, 11, -1, -1, -1, -1, -1),
(5, 12, -1, -1, -1, -1, -1),
(5, 13, -1, -1, -1, -1, -1),
(5, 14, -1, -1, -1, -1, -1),
(5, 15, -1, -1, -1, -1, -1),
(5, 16, -1, -1, -1, -1, -1),
(5, 17, -1, -1, -1, -1, -1),
(5, 18, -1, -1, -1, -1, -1),
(5, 19, -1, -1, -1, -1, -1),
(5, 20, -1, -1, -1, -1, -1),
(5, 21, -1, -1, -1, -1, -1),
(5, 22, -1, -1, -1, -1, -1),
(5, 23, -1, -1, -1, -1, -1),
(5, 24, -1, -1, -1, -1, -1),
(5, 25, -1, -1, -1, -1, -1),
(5, 26, -1, -1, -1, -1, -1),
(6, 1, -1, -1, -1, -1, -1),
(6, 2, -1, -1, -1, -1, -1),
(6, 3, -1, -1, -1, -1, -1),
(6, 4, -1, -1, -1, -1, -1),
(6, 5, -1, -1, -1, -1, -1),
(6, 6, -1, -1, -1, -1, -1),
(6, 7, -1, -1, -1, -1, -1),
(6, 8, -1, -1, -1, -1, -1),
(6, 9, -1, -1, -1, -1, -1),
(6, 10, -1, -1, -1, -1, -1),
(6, 11, -1, -1, -1, -1, -1),
(6, 12, -1, -1, -1, -1, -1),
(6, 13, -1, -1, -1, -1, -1),
(6, 14, -1, -1, -1, -1, -1),
(6, 15, -1, -1, -1, -1, -1),
(6, 16, -1, -1, -1, -1, -1),
(6, 17, -1, -1, -1, -1, -1),
(6, 18, -1, -1, -1, -1, -1),
(6, 19, -1, -1, -1, -1, -1),
(6, 20, -1, -1, -1, -1, -1),
(6, 21, -1, -1, -1, -1, -1),
(6, 22, -1, -1, -1, -1, -1),
(6, 23, -1, -1, -1, -1, -1),
(6, 24, -1, -1, -1, -1, -1),
(6, 25, -1, -1, -1, -1, -1),
(6, 26, -1, -1, -1, -1, -1),
(7, 1, -1, -1, -1, -1, -1),
(7, 2, -1, -1, -1, -1, -1),
(7, 3, -1, -1, -1, -1, -1),
(7, 4, -1, -1, -1, -1, -1),
(7, 5, -1, -1, -1, -1, -1),
(7, 6, -1, -1, -1, -1, -1),
(7, 7, -1, -1, -1, -1, -1),
(7, 8, -1, -1, -1, -1, -1),
(7, 9, -1, -1, -1, -1, -1),
(7, 10, -1, -1, -1, -1, -1),
(7, 11, -1, -1, -1, -1, -1),
(7, 12, -1, -1, -1, -1, -1),
(7, 13, -1, -1, -1, -1, -1),
(7, 14, -1, -1, -1, -1, -1),
(7, 15, -1, -1, -1, -1, -1),
(7, 16, -1, -1, -1, -1, -1),
(7, 17, -1, -1, -1, -1, -1),
(7, 18, -1, -1, -1, -1, -1),
(7, 19, -1, -1, -1, -1, -1),
(7, 20, -1, -1, -1, -1, -1),
(7, 21, -1, -1, -1, -1, -1),
(7, 22, -1, -1, -1, -1, -1),
(7, 23, -1, -1, -1, -1, -1),
(7, 24, -1, -1, -1, -1, -1),
(7, 25, -1, -1, -1, -1, -1),
(7, 26, -1, -1, -1, -1, -1),
(8, 1, -1, -1, -1, -1, -1),
(8, 2, -1, -1, -1, -1, -1),
(8, 3, -1, -1, -1, -1, -1),
(8, 4, -1, -1, -1, -1, -1),
(8, 5, -1, -1, -1, -1, -1),
(8, 6, -1, -1, -1, -1, -1),
(8, 7, -1, -1, -1, -1, -1),
(8, 8, -1, -1, -1, -1, -1),
(8, 9, -1, -1, -1, -1, -1),
(8, 10, -1, -1, -1, -1, -1),
(8, 11, -1, -1, -1, -1, -1),
(8, 12, -1, -1, -1, -1, -1),
(8, 13, -1, -1, -1, -1, -1),
(8, 14, -1, -1, -1, -1, -1),
(8, 15, -1, -1, -1, -1, -1),
(8, 16, -1, -1, -1, -1, -1),
(8, 17, -1, -1, -1, -1, -1),
(8, 18, -1, -1, -1, -1, -1),
(8, 19, -1, -1, -1, -1, -1),
(8, 20, -1, -1, -1, -1, -1),
(8, 21, -1, -1, -1, -1, -1),
(8, 22, -1, -1, -1, -1, -1),
(8, 23, -1, -1, -1, -1, -1),
(8, 24, -1, -1, -1, -1, -1),
(8, 25, -1, -1, -1, -1, -1),
(8, 26, -1, -1, -1, -1, -1),
(9, 1, -1, -1, -1, -1, -1),
(9, 2, -1, -1, -1, -1, -1),
(9, 3, -1, -1, -1, -1, -1),
(9, 4, -1, -1, -1, -1, -1),
(9, 5, -1, -1, -1, -1, -1),
(9, 6, -1, -1, -1, -1, -1),
(9, 7, -1, -1, -1, -1, -1),
(9, 8, -1, -1, -1, -1, -1),
(9, 9, -1, -1, -1, -1, -1),
(9, 10, -1, -1, -1, -1, -1),
(9, 11, -1, -1, -1, -1, -1),
(9, 12, -1, -1, -1, -1, -1),
(9, 13, -1, -1, -1, -1, -1),
(9, 14, -1, -1, -1, -1, -1),
(9, 15, -1, -1, -1, -1, -1),
(9, 16, -1, -1, -1, -1, -1),
(9, 17, -1, -1, -1, -1, -1),
(9, 18, -1, -1, -1, -1, -1),
(9, 19, -1, -1, -1, -1, -1),
(9, 20, -1, -1, -1, -1, -1),
(9, 21, -1, -1, -1, -1, -1),
(9, 22, -1, -1, -1, -1, -1),
(9, 23, -1, -1, -1, -1, -1),
(9, 24, -1, -1, -1, -1, -1),
(9, 25, -1, -1, -1, -1, -1),
(9, 26, -1, -1, -1, -1, -1),
(10, 1, -1, -1, -1, -1, -1),
(10, 2, -1, -1, -1, -1, -1),
(10, 3, -1, -1, -1, -1, -1),
(10, 4, -1, -1, -1, -1, -1),
(10, 5, -1, -1, -1, -1, -1),
(10, 6, -1, -1, -1, -1, -1),
(10, 7, -1, -1, -1, -1, -1),
(10, 8, -1, -1, -1, -1, -1),
(10, 9, -1, -1, -1, -1, -1),
(10, 10, -1, -1, -1, -1, -1),
(10, 11, -1, -1, -1, -1, -1),
(10, 12, -1, -1, -1, -1, -1),
(10, 13, -1, -1, -1, -1, -1),
(10, 14, -1, -1, -1, -1, -1),
(10, 15, -1, -1, -1, -1, -1),
(10, 16, -1, -1, -1, -1, -1),
(10, 17, -1, -1, -1, -1, -1),
(10, 18, -1, -1, -1, -1, -1),
(10, 19, -1, -1, -1, -1, -1),
(10, 20, -1, -1, -1, -1, -1),
(10, 21, -1, -1, -1, -1, -1),
(10, 22, -1, -1, -1, -1, -1),
(10, 23, -1, -1, -1, -1, -1),
(10, 24, -1, -1, -1, -1, -1),
(10, 25, -1, -1, -1, -1, -1),
(10, 26, -1, -1, -1, -1, -1),
(11, 1, -1, -1, -1, -1, -1),
(11, 2, -1, -1, -1, -1, -1),
(11, 3, -1, -1, -1, -1, -1),
(11, 4, -1, -1, -1, -1, -1),
(11, 5, -1, -1, -1, -1, -1),
(11, 6, -1, -1, -1, -1, -1),
(11, 7, -1, -1, -1, -1, -1),
(11, 8, -1, -1, -1, -1, -1),
(11, 9, -1, -1, -1, -1, -1),
(11, 10, -1, -1, -1, -1, -1),
(11, 11, -1, -1, -1, -1, -1),
(11, 12, -1, -1, -1, -1, -1),
(11, 13, -1, -1, -1, -1, -1),
(11, 14, -1, -1, -1, -1, -1),
(11, 15, -1, -1, -1, -1, -1),
(11, 16, -1, -1, -1, -1, -1),
(11, 17, -1, -1, -1, -1, -1),
(11, 18, -1, -1, -1, -1, -1),
(11, 19, -1, -1, -1, -1, -1),
(11, 20, -1, -1, -1, -1, -1),
(11, 21, -1, -1, -1, -1, -1),
(11, 22, -1, -1, -1, -1, -1),
(11, 23, -1, -1, -1, -1, -1),
(11, 24, -1, -1, -1, -1, -1),
(11, 25, -1, -1, -1, -1, -1),
(11, 26, -1, -1, -1, -1, -1),
(12, 1, -1, -1, -1, -1, -1),
(12, 2, -1, -1, -1, -1, -1),
(12, 3, -1, -1, -1, -1, -1),
(12, 4, -1, -1, -1, -1, -1),
(12, 5, -1, -1, -1, -1, -1),
(12, 6, -1, -1, -1, -1, -1),
(12, 7, -1, -1, -1, -1, -1),
(12, 8, -1, -1, -1, -1, -1),
(12, 9, -1, -1, -1, -1, -1),
(12, 10, -1, -1, -1, -1, -1),
(12, 11, -1, -1, -1, -1, -1),
(12, 12, -1, -1, -1, -1, -1),
(12, 13, -1, -1, -1, -1, -1),
(12, 14, -1, -1, -1, -1, -1),
(12, 15, -1, -1, -1, -1, -1),
(12, 16, -1, -1, -1, -1, -1),
(12, 17, -1, -1, -1, -1, -1),
(12, 18, -1, -1, -1, -1, -1),
(12, 19, -1, -1, -1, -1, -1),
(12, 20, -1, -1, -1, -1, -1),
(12, 21, -1, -1, -1, -1, -1),
(12, 22, -1, -1, -1, -1, -1),
(12, 23, -1, -1, -1, -1, -1),
(12, 24, -1, -1, -1, -1, -1),
(12, 25, -1, -1, -1, -1, -1),
(12, 26, -1, -1, -1, -1, -1),
(13, 1, -1, -1, -1, -1, -1),
(13, 2, -1, -1, -1, -1, -1),
(13, 3, -1, -1, -1, -1, -1),
(13, 4, -1, -1, -1, -1, -1),
(13, 5, -1, -1, -1, -1, -1),
(13, 6, -1, -1, -1, -1, -1),
(13, 7, -1, -1, -1, -1, -1),
(13, 8, -1, -1, -1, -1, -1),
(13, 9, -1, -1, -1, -1, -1),
(13, 10, -1, -1, -1, -1, -1),
(13, 11, -1, -1, -1, -1, -1),
(13, 12, -1, -1, -1, -1, -1),
(13, 13, -1, -1, -1, -1, -1),
(13, 14, -1, -1, -1, -1, -1),
(13, 15, -1, -1, -1, -1, -1),
(13, 16, -1, -1, -1, -1, -1),
(13, 17, -1, -1, -1, -1, -1),
(13, 18, -1, -1, -1, -1, -1),
(13, 19, -1, -1, -1, -1, -1),
(13, 20, -1, -1, -1, -1, -1),
(13, 21, -1, -1, -1, -1, -1),
(13, 22, -1, -1, -1, -1, -1),
(13, 23, -1, -1, -1, -1, -1),
(13, 24, -1, -1, -1, -1, -1),
(13, 25, -1, -1, -1, -1, -1),
(13, 26, -1, -1, -1, -1, -1),
(14, 1, -1, -1, -1, -1, -1),
(14, 2, -1, -1, -1, -1, -1),
(14, 3, -1, -1, -1, -1, -1),
(14, 4, -1, -1, -1, -1, -1),
(14, 5, -1, -1, -1, -1, -1),
(14, 6, -1, -1, -1, -1, -1),
(14, 7, -1, -1, -1, -1, -1),
(14, 8, -1, -1, -1, -1, -1),
(14, 9, -1, -1, -1, -1, -1),
(14, 10, -1, -1, -1, -1, -1),
(14, 11, -1, -1, -1, -1, -1),
(14, 12, -1, -1, -1, -1, -1),
(14, 13, -1, -1, -1, -1, -1),
(14, 14, -1, -1, -1, -1, -1),
(14, 15, -1, -1, -1, -1, -1),
(14, 16, -1, -1, -1, -1, -1),
(14, 17, -1, -1, -1, -1, -1),
(14, 18, -1, -1, -1, -1, -1),
(14, 19, -1, -1, -1, -1, -1),
(14, 20, -1, -1, -1, -1, -1),
(14, 21, -1, -1, -1, -1, -1),
(14, 22, -1, -1, -1, -1, -1),
(14, 23, -1, -1, -1, -1, -1),
(14, 24, -1, -1, -1, -1, -1),
(14, 25, -1, -1, -1, -1, -1),
(14, 26, -1, -1, -1, -1, -1),
(15, 1, -1, -1, -1, -1, -1),
(15, 2, -1, -1, -1, -1, -1),
(15, 3, -1, -1, -1, -1, -1),
(15, 4, -1, -1, -1, -1, -1),
(15, 5, -1, -1, -1, -1, -1),
(15, 6, -1, -1, -1, -1, -1),
(15, 7, -1, -1, -1, -1, -1),
(15, 8, -1, -1, -1, -1, -1),
(15, 9, -1, -1, -1, -1, -1),
(15, 10, -1, -1, -1, -1, -1),
(15, 11, -1, -1, -1, -1, -1),
(15, 12, -1, -1, -1, -1, -1),
(15, 13, -1, -1, -1, -1, -1),
(15, 14, -1, -1, -1, -1, -1),
(15, 15, -1, -1, -1, -1, -1),
(15, 16, -1, -1, -1, -1, -1),
(15, 17, -1, -1, -1, -1, -1),
(15, 18, -1, -1, -1, -1, -1),
(15, 19, -1, -1, -1, -1, -1),
(15, 20, -1, -1, -1, -1, -1),
(15, 21, -1, -1, -1, -1, -1),
(15, 22, -1, -1, -1, -1, -1),
(15, 23, -1, -1, -1, -1, -1),
(15, 24, -1, -1, -1, -1, -1),
(15, 25, -1, -1, -1, -1, -1),
(15, 26, -1, -1, -1, -1, -1),
(16, 1, -1, -1, -1, -1, -1),
(16, 2, -1, -1, -1, -1, -1),
(16, 3, -1, -1, -1, -1, -1),
(16, 4, -1, -1, -1, -1, -1),
(16, 5, -1, -1, -1, -1, -1),
(16, 6, -1, -1, -1, -1, -1),
(16, 7, -1, -1, -1, -1, -1),
(16, 8, -1, -1, -1, -1, -1),
(16, 9, -1, -1, -1, -1, -1),
(16, 10, -1, -1, -1, -1, -1),
(16, 11, -1, -1, -1, -1, -1),
(16, 12, -1, -1, -1, -1, -1),
(16, 13, -1, -1, -1, -1, -1),
(16, 14, -1, -1, -1, -1, -1),
(16, 15, -1, -1, -1, -1, -1),
(16, 16, -1, -1, -1, -1, -1),
(16, 17, -1, -1, -1, -1, -1),
(16, 18, -1, -1, -1, -1, -1),
(16, 19, -1, -1, -1, -1, -1),
(16, 20, -1, -1, -1, -1, -1),
(16, 21, -1, -1, -1, -1, -1),
(16, 22, -1, -1, -1, -1, -1),
(16, 23, -1, -1, -1, -1, -1),
(16, 24, -1, -1, -1, -1, -1),
(16, 25, -1, -1, -1, -1, -1),
(16, 26, -1, -1, -1, -1, -1),
(17, 1, -1, -1, -1, -1, -1),
(17, 2, -1, -1, -1, -1, -1),
(17, 3, -1, -1, -1, -1, -1),
(17, 4, -1, -1, -1, -1, -1),
(17, 5, -1, -1, -1, -1, -1),
(17, 6, -1, -1, -1, -1, -1),
(17, 7, -1, -1, -1, -1, -1),
(17, 8, -1, -1, -1, -1, -1),
(17, 9, -1, -1, -1, -1, -1),
(17, 10, -1, -1, -1, -1, -1),
(17, 11, -1, -1, -1, -1, -1),
(17, 12, -1, -1, -1, -1, -1),
(17, 13, -1, -1, -1, -1, -1),
(17, 14, -1, -1, -1, -1, -1),
(17, 15, -1, -1, -1, -1, -1),
(17, 16, -1, -1, -1, -1, -1),
(17, 17, -1, -1, -1, -1, -1),
(17, 18, -1, -1, -1, -1, -1),
(17, 19, -1, -1, -1, -1, -1),
(17, 20, -1, -1, -1, -1, -1),
(17, 21, -1, -1, -1, -1, -1),
(17, 22, -1, -1, -1, -1, -1),
(17, 23, -1, -1, -1, -1, -1),
(17, 24, -1, -1, -1, -1, -1),
(17, 25, -1, -1, -1, -1, -1),
(17, 26, -1, -1, -1, -1, -1),
(18, 1, 16, -1, -1, -1, -1),
(18, 2, 15, -1, -1, -1, -1),
(18, 3, 15, -1, -1, -1, -1),
(18, 4, 15, -1, -1, -1, -1),
(18, 5, -1, -1, -1, -1, -1),
(18, 6, -1, -1, -1, -1, -1),
(18, 7, -1, -1, -1, -1, -1),
(18, 8, -1, -1, -1, -1, -1),
(18, 9, -1, -1, -1, -1, -1),
(18, 10, -1, -1, -1, -1, -1),
(18, 11, -1, -1, -1, -1, -1),
(18, 12, -1, -1, -1, -1, -1),
(18, 13, -1, -1, -1, -1, -1),
(18, 14, -1, -1, -1, -1, -1),
(18, 15, -1, -1, -1, -1, -1),
(18, 16, -1, -1, -1, -1, -1),
(18, 17, -1, -1, -1, -1, -1),
(18, 18, -1, -1, -1, -1, -1),
(18, 19, -1, -1, -1, -1, -1),
(18, 20, -1, -1, -1, -1, -1),
(18, 21, -1, -1, -1, -1, -1),
(18, 22, -1, -1, -1, -1, -1),
(18, 23, -1, -1, -1, -1, -1),
(18, 24, -1, -1, -1, -1, -1),
(18, 25, -1, -1, -1, -1, -1),
(18, 26, -1, -1, -1, -1, -1),
(19, 1, 10, -1, -1, -1, -1),
(19, 2, 9, -1, -1, -1, -1),
(19, 3, 10, -1, -1, -1, -1),
(19, 4, 10, -1, -1, -1, -1),
(19, 5, -1, -1, -1, -1, -1),
(19, 6, -1, -1, -1, -1, -1),
(19, 7, -1, -1, -1, -1, -1),
(19, 8, -1, -1, -1, -1, -1),
(19, 9, -1, -1, -1, -1, -1),
(19, 10, -1, -1, -1, -1, -1),
(19, 11, -1, -1, -1, -1, -1),
(19, 12, -1, -1, -1, -1, -1),
(19, 13, -1, -1, -1, -1, -1),
(19, 14, -1, -1, -1, -1, -1),
(19, 15, -1, -1, -1, -1, -1),
(19, 16, -1, -1, -1, -1, -1),
(19, 17, -1, -1, -1, -1, -1),
(19, 18, -1, -1, -1, -1, -1),
(19, 19, -1, -1, -1, -1, -1),
(19, 20, -1, -1, -1, -1, -1),
(19, 21, -1, -1, -1, -1, -1),
(19, 22, -1, -1, -1, -1, -1),
(19, 23, -1, -1, -1, -1, -1),
(19, 24, -1, -1, -1, -1, -1),
(19, 25, -1, -1, -1, -1, -1),
(19, 26, -1, -1, -1, -1, -1),
(20, 1, 14, -1, -1, -1, -1),
(20, 2, 12, -1, -1, -1, -1),
(20, 3, 12, -1, -1, -1, -1),
(20, 4, 8, -1, -1, -1, -1),
(20, 5, -1, -1, -1, -1, -1),
(20, 6, -1, -1, -1, -1, -1),
(20, 7, -1, -1, -1, -1, -1),
(20, 8, -1, -1, -1, -1, -1),
(20, 9, -1, -1, -1, -1, -1),
(20, 10, -1, -1, -1, -1, -1),
(20, 11, -1, -1, -1, -1, -1),
(20, 12, -1, -1, -1, -1, -1),
(20, 13, -1, -1, -1, -1, -1),
(20, 14, -1, -1, -1, -1, -1),
(20, 15, -1, -1, -1, -1, -1),
(20, 16, -1, -1, -1, -1, -1),
(20, 17, -1, -1, -1, -1, -1),
(20, 18, -1, -1, -1, -1, -1),
(20, 19, -1, -1, -1, -1, -1),
(20, 20, -1, -1, -1, -1, -1),
(20, 21, -1, -1, -1, -1, -1),
(20, 22, -1, -1, -1, -1, -1),
(20, 23, -1, -1, -1, -1, -1),
(20, 24, -1, -1, -1, -1, -1),
(20, 25, -1, -1, -1, -1, -1),
(20, 26, -1, -1, -1, -1, -1),
(21, 1, 9, -1, -1, -1, -1),
(21, 2, 9, -1, -1, -1, -1),
(21, 3, 9, -1, -1, -1, -1),
(21, 4, 9, -1, -1, -1, -1),
(21, 5, -1, -1, -1, -1, -1),
(21, 6, -1, -1, -1, -1, -1),
(21, 7, -1, -1, -1, -1, -1),
(21, 8, -1, -1, -1, -1, -1),
(21, 9, -1, -1, -1, -1, -1),
(21, 10, -1, -1, -1, -1, -1),
(21, 11, -1, -1, -1, -1, -1),
(21, 12, -1, -1, -1, -1, -1),
(21, 13, -1, -1, -1, -1, -1),
(21, 14, -1, -1, -1, -1, -1),
(21, 15, -1, -1, -1, -1, -1),
(21, 16, -1, -1, -1, -1, -1),
(21, 17, -1, -1, -1, -1, -1),
(21, 18, -1, -1, -1, -1, -1),
(21, 19, -1, -1, -1, -1, -1),
(21, 20, -1, -1, -1, -1, -1),
(21, 21, -1, -1, -1, -1, -1),
(21, 22, -1, -1, -1, -1, -1),
(21, 23, -1, -1, -1, -1, -1),
(21, 24, -1, -1, -1, -1, -1),
(21, 25, -1, -1, -1, -1, -1),
(21, 26, -1, -1, -1, -1, -1),
(22, 1, -1, -1, -1, -1, -1),
(22, 2, -1, -1, -1, -1, -1),
(22, 3, -1, -1, -1, -1, -1),
(22, 4, -1, -1, -1, -1, -1),
(22, 5, -1, -1, -1, -1, -1),
(22, 6, -1, -1, -1, -1, -1),
(22, 7, -1, -1, -1, -1, -1),
(22, 8, -1, -1, -1, -1, -1),
(22, 9, -1, -1, -1, -1, -1),
(22, 10, -1, -1, -1, -1, -1),
(22, 11, -1, -1, -1, -1, -1),
(22, 12, -1, -1, -1, -1, -1),
(22, 13, -1, -1, -1, -1, -1),
(22, 14, -1, -1, -1, -1, -1),
(22, 15, -1, -1, -1, -1, -1),
(22, 16, -1, -1, -1, -1, -1),
(22, 17, -1, -1, -1, -1, -1),
(22, 18, -1, -1, -1, -1, -1),
(22, 19, -1, -1, -1, -1, -1),
(22, 20, -1, -1, -1, -1, -1),
(22, 21, -1, -1, -1, -1, -1),
(22, 22, -1, -1, -1, -1, -1),
(22, 23, -1, -1, -1, -1, -1),
(22, 24, -1, -1, -1, -1, -1),
(22, 25, -1, -1, -1, -1, -1),
(22, 26, -1, -1, -1, -1, -1),
(23, 1, 19, -1, -1, -1, -1),
(23, 2, 18, -1, -1, -1, -1),
(23, 3, 19, -1, -1, -1, -1),
(23, 4, 19, -1, -1, -1, -1),
(23, 5, -1, -1, -1, -1, -1),
(23, 6, -1, -1, -1, -1, -1),
(23, 7, -1, -1, -1, -1, -1),
(23, 8, -1, -1, -1, -1, -1),
(23, 9, -1, -1, -1, -1, -1),
(23, 10, -1, -1, -1, -1, -1),
(23, 11, -1, -1, -1, -1, -1),
(23, 12, -1, -1, -1, -1, -1),
(23, 13, -1, -1, -1, -1, -1),
(23, 14, -1, -1, -1, -1, -1),
(23, 15, -1, -1, -1, -1, -1),
(23, 16, -1, -1, -1, -1, -1),
(23, 17, -1, -1, -1, -1, -1),
(23, 18, -1, -1, -1, -1, -1),
(23, 19, -1, -1, -1, -1, -1),
(23, 20, -1, -1, -1, -1, -1),
(23, 21, -1, -1, -1, -1, -1),
(23, 22, -1, -1, -1, -1, -1),
(23, 23, -1, -1, -1, -1, -1),
(23, 24, -1, -1, -1, -1, -1),
(23, 25, -1, -1, -1, -1, -1),
(23, 26, -1, -1, -1, -1, -1),
(24, 1, -1, -1, -1, -1, -1),
(24, 2, -1, -1, -1, -1, -1),
(24, 3, -1, -1, -1, -1, -1),
(24, 4, -1, -1, -1, -1, -1),
(24, 5, -1, -1, -1, -1, -1),
(24, 6, -1, -1, -1, -1, -1),
(24, 7, -1, -1, -1, -1, -1),
(24, 8, -1, -1, -1, -1, -1),
(24, 9, -1, -1, -1, -1, -1),
(24, 10, -1, -1, -1, -1, -1),
(24, 11, -1, -1, -1, -1, -1),
(24, 12, -1, -1, -1, -1, -1),
(24, 13, -1, -1, -1, -1, -1),
(24, 14, -1, -1, -1, -1, -1),
(24, 15, -1, -1, -1, -1, -1),
(24, 16, -1, -1, -1, -1, -1),
(24, 17, -1, -1, -1, -1, -1),
(24, 18, -1, -1, -1, -1, -1),
(24, 19, -1, -1, -1, -1, -1),
(24, 20, -1, -1, -1, -1, -1),
(24, 21, -1, -1, -1, -1, -1),
(24, 22, -1, -1, -1, -1, -1),
(24, 23, -1, -1, -1, -1, -1),
(24, 24, -1, -1, -1, -1, -1),
(24, 25, -1, -1, -1, -1, -1),
(24, 26, -1, -1, -1, -1, -1),
(25, 1, -1, -1, -1, -1, -1),
(25, 2, -1, -1, -1, -1, -1),
(25, 3, -1, -1, -1, -1, -1),
(25, 4, -1, -1, -1, -1, -1),
(25, 5, -1, -1, -1, -1, -1),
(25, 6, -1, -1, -1, -1, -1),
(25, 7, -1, -1, -1, -1, -1),
(25, 8, -1, -1, -1, -1, -1),
(25, 9, -1, -1, -1, -1, -1),
(25, 10, -1, -1, -1, -1, -1),
(25, 11, -1, -1, -1, -1, -1),
(25, 12, -1, -1, -1, -1, -1),
(25, 13, -1, -1, -1, -1, -1),
(25, 14, -1, -1, -1, -1, -1),
(25, 15, -1, -1, -1, -1, -1),
(25, 16, -1, -1, -1, -1, -1),
(25, 17, -1, -1, -1, -1, -1),
(25, 18, -1, -1, -1, -1, -1),
(25, 19, -1, -1, -1, -1, -1),
(25, 20, -1, -1, -1, -1, -1),
(25, 21, -1, -1, -1, -1, -1),
(25, 22, -1, -1, -1, -1, -1),
(25, 23, -1, -1, -1, -1, -1),
(25, 24, -1, -1, -1, -1, -1),
(25, 25, -1, -1, -1, -1, -1),
(25, 26, -1, -1, -1, -1, -1),
(26, 1, -1, -1, -1, -1, -1),
(26, 2, -1, -1, -1, -1, -1),
(26, 3, -1, -1, -1, -1, -1),
(26, 4, -1, -1, -1, -1, -1),
(26, 5, -1, -1, -1, -1, -1),
(26, 6, -1, -1, -1, -1, -1),
(26, 7, -1, -1, -1, -1, -1),
(26, 8, -1, -1, -1, -1, -1),
(26, 9, -1, -1, -1, -1, -1),
(26, 10, -1, -1, -1, -1, -1),
(26, 11, -1, -1, -1, -1, -1),
(26, 12, -1, -1, -1, -1, -1),
(26, 13, -1, -1, -1, -1, -1),
(26, 14, -1, -1, -1, -1, -1),
(26, 15, -1, -1, -1, -1, -1),
(26, 16, -1, -1, -1, -1, -1),
(26, 17, -1, -1, -1, -1, -1),
(26, 18, -1, -1, -1, -1, -1),
(26, 19, -1, -1, -1, -1, -1),
(26, 20, -1, -1, -1, -1, -1),
(26, 21, -1, -1, -1, -1, -1),
(26, 22, -1, -1, -1, -1, -1),
(26, 23, -1, -1, -1, -1, -1),
(26, 24, -1, -1, -1, -1, -1),
(26, 25, -1, -1, -1, -1, -1),
(26, 26, -1, -1, -1, -1, -1),
(27, 1, -1, -1, -1, -1, -1),
(27, 2, -1, -1, -1, -1, -1),
(27, 3, -1, -1, -1, -1, -1),
(27, 4, -1, -1, -1, -1, -1),
(27, 5, -1, -1, -1, -1, -1),
(27, 6, -1, -1, -1, -1, -1),
(27, 7, -1, -1, -1, -1, -1),
(27, 8, -1, -1, -1, -1, -1),
(27, 9, -1, -1, -1, -1, -1),
(27, 10, -1, -1, -1, -1, -1),
(27, 11, -1, -1, -1, -1, -1),
(27, 12, -1, -1, -1, -1, -1),
(27, 13, -1, -1, -1, -1, -1),
(27, 14, -1, -1, -1, -1, -1),
(27, 15, -1, -1, -1, -1, -1),
(27, 16, -1, -1, -1, -1, -1),
(27, 17, -1, -1, -1, -1, -1),
(27, 18, -1, -1, -1, -1, -1),
(27, 19, -1, -1, -1, -1, -1),
(27, 20, -1, -1, -1, -1, -1),
(27, 21, -1, -1, -1, -1, -1),
(27, 22, -1, -1, -1, -1, -1),
(27, 23, -1, -1, -1, -1, -1),
(27, 24, -1, -1, -1, -1, -1),
(27, 25, -1, -1, -1, -1, -1),
(27, 26, -1, -1, -1, -1, -1),
(28, 1, -1, -1, -1, -1, -1),
(28, 2, -1, -1, -1, -1, -1),
(28, 3, -1, -1, -1, -1, -1),
(28, 4, -1, -1, -1, -1, -1),
(28, 5, -1, -1, -1, -1, -1),
(28, 6, -1, -1, -1, -1, -1),
(28, 7, -1, -1, -1, -1, -1),
(28, 8, -1, -1, -1, -1, -1),
(28, 9, -1, -1, -1, -1, -1),
(28, 10, -1, -1, -1, -1, -1),
(28, 11, -1, -1, -1, -1, -1),
(28, 12, -1, -1, -1, -1, -1),
(28, 13, -1, -1, -1, -1, -1),
(28, 14, -1, -1, -1, -1, -1),
(28, 15, -1, -1, -1, -1, -1),
(28, 16, -1, -1, -1, -1, -1),
(28, 17, -1, -1, -1, -1, -1),
(28, 18, -1, -1, -1, -1, -1),
(28, 19, -1, -1, -1, -1, -1),
(28, 20, -1, -1, -1, -1, -1),
(28, 21, -1, -1, -1, -1, -1),
(28, 22, -1, -1, -1, -1, -1),
(28, 23, -1, -1, -1, -1, -1),
(28, 24, -1, -1, -1, -1, -1),
(28, 25, -1, -1, -1, -1, -1),
(28, 26, -1, -1, -1, -1, -1),
(29, 1, -1, -1, -1, -1, -1),
(29, 2, -1, -1, -1, -1, -1),
(29, 3, -1, -1, -1, -1, -1),
(29, 4, -1, -1, -1, -1, -1),
(29, 5, -1, -1, -1, -1, -1),
(29, 6, -1, -1, -1, -1, -1),
(29, 7, -1, -1, -1, -1, -1),
(29, 8, -1, -1, -1, -1, -1),
(29, 9, -1, -1, -1, -1, -1),
(29, 10, -1, -1, -1, -1, -1),
(29, 11, -1, -1, -1, -1, -1),
(29, 12, -1, -1, -1, -1, -1),
(29, 13, -1, -1, -1, -1, -1),
(29, 14, -1, -1, -1, -1, -1),
(29, 15, -1, -1, -1, -1, -1),
(29, 16, -1, -1, -1, -1, -1),
(29, 17, -1, -1, -1, -1, -1),
(29, 18, -1, -1, -1, -1, -1),
(29, 19, -1, -1, -1, -1, -1),
(29, 20, -1, -1, -1, -1, -1),
(29, 21, -1, -1, -1, -1, -1),
(29, 22, -1, -1, -1, -1, -1),
(29, 23, -1, -1, -1, -1, -1),
(29, 24, -1, -1, -1, -1, -1),
(29, 25, -1, -1, -1, -1, -1),
(29, 26, -1, -1, -1, -1, -1),
(30, 1, -1, -1, -1, -1, -1),
(30, 2, -1, -1, -1, -1, -1),
(30, 3, -1, -1, -1, -1, -1),
(30, 4, -1, -1, -1, -1, -1),
(30, 5, -1, -1, -1, -1, -1),
(30, 6, -1, -1, -1, -1, -1),
(30, 7, -1, -1, -1, -1, -1),
(30, 8, -1, -1, -1, -1, -1),
(30, 9, -1, -1, -1, -1, -1),
(30, 10, -1, -1, -1, -1, -1),
(30, 11, -1, -1, -1, -1, -1),
(30, 12, -1, -1, -1, -1, -1),
(30, 13, -1, -1, -1, -1, -1),
(30, 14, -1, -1, -1, -1, -1),
(30, 15, -1, -1, -1, -1, -1),
(30, 16, -1, -1, -1, -1, -1),
(30, 17, -1, -1, -1, -1, -1),
(30, 18, -1, -1, -1, -1, -1),
(30, 19, -1, -1, -1, -1, -1),
(30, 20, -1, -1, -1, -1, -1),
(30, 21, -1, -1, -1, -1, -1),
(30, 22, -1, -1, -1, -1, -1),
(30, 23, -1, -1, -1, -1, -1),
(30, 24, -1, -1, -1, -1, -1),
(30, 25, -1, -1, -1, -1, -1),
(30, 26, -1, -1, -1, -1, -1),
(31, 1, -1, -1, -1, -1, -1),
(31, 2, -1, -1, -1, -1, -1),
(31, 3, -1, -1, -1, -1, -1),
(31, 4, -1, -1, -1, -1, -1),
(31, 5, -1, -1, -1, -1, -1),
(31, 6, -1, -1, -1, -1, -1),
(31, 7, -1, -1, -1, -1, -1),
(31, 8, -1, -1, -1, -1, -1),
(31, 9, -1, -1, -1, -1, -1),
(31, 10, -1, -1, -1, -1, -1),
(31, 11, -1, -1, -1, -1, -1),
(31, 12, -1, -1, -1, -1, -1),
(31, 13, -1, -1, -1, -1, -1),
(31, 14, -1, -1, -1, -1, -1),
(31, 15, -1, -1, -1, -1, -1),
(31, 16, -1, -1, -1, -1, -1),
(31, 17, -1, -1, -1, -1, -1),
(31, 18, -1, -1, -1, -1, -1),
(31, 19, -1, -1, -1, -1, -1),
(31, 20, -1, -1, -1, -1, -1),
(31, 21, -1, -1, -1, -1, -1),
(31, 22, -1, -1, -1, -1, -1),
(31, 23, -1, -1, -1, -1, -1),
(31, 24, -1, -1, -1, -1, -1),
(31, 25, -1, -1, -1, -1, -1),
(31, 26, -1, -1, -1, -1, -1),
(32, 1, -1, -1, -1, -1, -1),
(32, 2, -1, -1, -1, -1, -1),
(32, 3, -1, -1, -1, -1, -1),
(32, 4, -1, -1, -1, -1, -1),
(32, 5, -1, -1, -1, -1, -1),
(32, 6, -1, -1, -1, -1, -1),
(32, 7, -1, -1, -1, -1, -1),
(32, 8, -1, -1, -1, -1, -1),
(32, 9, -1, -1, -1, -1, -1),
(32, 10, -1, -1, -1, -1, -1),
(32, 11, -1, -1, -1, -1, -1),
(32, 12, -1, -1, -1, -1, -1),
(32, 13, -1, -1, -1, -1, -1),
(32, 14, -1, -1, -1, -1, -1),
(32, 15, -1, -1, -1, -1, -1),
(32, 16, -1, -1, -1, -1, -1),
(32, 17, -1, -1, -1, -1, -1),
(32, 18, -1, -1, -1, -1, -1),
(32, 19, -1, -1, -1, -1, -1),
(32, 20, -1, -1, -1, -1, -1),
(32, 21, -1, -1, -1, -1, -1),
(32, 22, -1, -1, -1, -1, -1),
(32, 23, -1, -1, -1, -1, -1),
(32, 24, -1, -1, -1, -1, -1),
(32, 25, -1, -1, -1, -1, -1),
(32, 26, -1, -1, -1, -1, -1),
(33, 1, -1, -1, -1, -1, -1),
(33, 2, -1, -1, -1, -1, -1),
(33, 3, -1, -1, -1, -1, -1),
(33, 4, -1, -1, -1, -1, -1),
(33, 5, -1, -1, -1, -1, -1),
(33, 6, -1, -1, -1, -1, -1),
(33, 7, -1, -1, -1, -1, -1),
(33, 8, -1, -1, -1, -1, -1),
(33, 9, -1, -1, -1, -1, -1),
(33, 10, -1, -1, -1, -1, -1),
(33, 11, -1, -1, -1, -1, -1),
(33, 12, -1, -1, -1, -1, -1),
(33, 13, -1, -1, -1, -1, -1),
(33, 14, -1, -1, -1, -1, -1),
(33, 15, -1, -1, -1, -1, -1),
(33, 16, -1, -1, -1, -1, -1),
(33, 17, -1, -1, -1, -1, -1),
(33, 18, -1, -1, -1, -1, -1),
(33, 19, -1, -1, -1, -1, -1),
(33, 20, -1, -1, -1, -1, -1),
(33, 21, -1, -1, -1, -1, -1),
(33, 22, -1, -1, -1, -1, -1),
(33, 23, -1, -1, -1, -1, -1),
(33, 24, -1, -1, -1, -1, -1),
(33, 25, -1, -1, -1, -1, -1),
(33, 26, -1, -1, -1, -1, -1),
(34, 1, -1, -1, -1, -1, -1),
(34, 2, -1, -1, -1, -1, -1),
(34, 3, -1, -1, -1, -1, -1),
(34, 4, -1, -1, -1, -1, -1),
(34, 5, -1, -1, -1, -1, -1),
(34, 6, -1, -1, -1, -1, -1),
(34, 7, -1, -1, -1, -1, -1),
(34, 8, -1, -1, -1, -1, -1),
(34, 9, -1, -1, -1, -1, -1),
(34, 10, -1, -1, -1, -1, -1),
(34, 11, -1, -1, -1, -1, -1),
(34, 12, -1, -1, -1, -1, -1),
(34, 13, -1, -1, -1, -1, -1),
(34, 14, -1, -1, -1, -1, -1),
(34, 15, -1, -1, -1, -1, -1),
(34, 16, -1, -1, -1, -1, -1),
(34, 17, -1, -1, -1, -1, -1),
(34, 18, -1, -1, -1, -1, -1),
(34, 19, -1, -1, -1, -1, -1),
(34, 20, -1, -1, -1, -1, -1),
(34, 21, -1, -1, -1, -1, -1),
(34, 22, -1, -1, -1, -1, -1),
(34, 23, -1, -1, -1, -1, -1),
(34, 24, -1, -1, -1, -1, -1),
(34, 25, -1, -1, -1, -1, -1),
(34, 26, -1, -1, -1, -1, -1),
(35, 1, -1, -1, -1, -1, -1),
(35, 2, -1, -1, -1, -1, -1),
(35, 3, -1, -1, -1, -1, -1),
(35, 4, -1, -1, -1, -1, -1),
(35, 5, -1, -1, -1, -1, -1),
(35, 6, -1, -1, -1, -1, -1),
(35, 7, -1, -1, -1, -1, -1),
(35, 8, -1, -1, -1, -1, -1),
(35, 9, -1, -1, -1, -1, -1),
(35, 10, -1, -1, -1, -1, -1),
(35, 11, -1, -1, -1, -1, -1),
(35, 12, -1, -1, -1, -1, -1),
(35, 13, -1, -1, -1, -1, -1),
(35, 14, -1, -1, -1, -1, -1),
(35, 15, -1, -1, -1, -1, -1),
(35, 16, -1, -1, -1, -1, -1),
(35, 17, -1, -1, -1, -1, -1),
(35, 18, -1, -1, -1, -1, -1),
(35, 19, -1, -1, -1, -1, -1),
(35, 20, -1, -1, -1, -1, -1),
(35, 21, -1, -1, -1, -1, -1),
(35, 22, -1, -1, -1, -1, -1),
(35, 23, -1, -1, -1, -1, -1),
(35, 24, -1, -1, -1, -1, -1),
(35, 25, -1, -1, -1, -1, -1),
(35, 26, -1, -1, -1, -1, -1),
(36, 1, -1, -1, -1, -1, -1),
(36, 2, -1, -1, -1, -1, -1),
(36, 3, -1, -1, -1, -1, -1),
(36, 4, -1, -1, -1, -1, -1),
(36, 5, -1, -1, -1, -1, -1),
(36, 6, -1, -1, -1, -1, -1),
(36, 7, -1, -1, -1, -1, -1),
(36, 8, -1, -1, -1, -1, -1),
(36, 9, -1, -1, -1, -1, -1),
(36, 10, -1, -1, -1, -1, -1),
(36, 11, -1, -1, -1, -1, -1),
(36, 12, -1, -1, -1, -1, -1),
(36, 13, -1, -1, -1, -1, -1),
(36, 14, -1, -1, -1, -1, -1),
(36, 15, -1, -1, -1, -1, -1),
(36, 16, -1, -1, -1, -1, -1),
(36, 17, -1, -1, -1, -1, -1),
(36, 18, -1, -1, -1, -1, -1),
(36, 19, -1, -1, -1, -1, -1),
(36, 20, -1, -1, -1, -1, -1),
(36, 21, -1, -1, -1, -1, -1),
(36, 22, -1, -1, -1, -1, -1),
(36, 23, -1, -1, -1, -1, -1),
(36, 24, -1, -1, -1, -1, -1),
(36, 25, -1, -1, -1, -1, -1),
(36, 26, -1, -1, -1, -1, -1),
(37, 1, -1, -1, -1, -1, -1),
(37, 2, -1, -1, -1, -1, -1),
(37, 3, -1, -1, -1, -1, -1),
(37, 4, -1, -1, -1, -1, -1),
(37, 5, -1, -1, -1, -1, -1),
(37, 6, -1, -1, -1, -1, -1),
(37, 7, -1, -1, -1, -1, -1),
(37, 8, -1, -1, -1, -1, -1),
(37, 9, -1, -1, -1, -1, -1),
(37, 10, -1, -1, -1, -1, -1),
(37, 11, -1, -1, -1, -1, -1),
(37, 12, -1, -1, -1, -1, -1),
(37, 13, -1, -1, -1, -1, -1),
(37, 14, -1, -1, -1, -1, -1),
(37, 15, -1, -1, -1, -1, -1),
(37, 16, -1, -1, -1, -1, -1),
(37, 17, -1, -1, -1, -1, -1),
(37, 18, -1, -1, -1, -1, -1),
(37, 19, -1, -1, -1, -1, -1),
(37, 20, -1, -1, -1, -1, -1),
(37, 21, -1, -1, -1, -1, -1),
(37, 22, -1, -1, -1, -1, -1),
(37, 23, -1, -1, -1, -1, -1),
(37, 24, -1, -1, -1, -1, -1),
(37, 25, -1, -1, -1, -1, -1),
(37, 26, -1, -1, -1, -1, -1),
(38, 1, -1, -1, -1, -1, -1),
(38, 2, -1, -1, -1, -1, -1),
(38, 3, -1, -1, -1, -1, -1),
(38, 4, -1, -1, -1, -1, -1),
(38, 5, -1, -1, -1, -1, -1),
(38, 6, -1, -1, -1, -1, -1),
(38, 7, -1, -1, -1, -1, -1),
(38, 8, -1, -1, -1, -1, -1),
(38, 9, -1, -1, -1, -1, -1),
(38, 10, -1, -1, -1, -1, -1),
(38, 11, -1, -1, -1, -1, -1),
(38, 12, -1, -1, -1, -1, -1),
(38, 13, -1, -1, -1, -1, -1),
(38, 14, -1, -1, -1, -1, -1),
(38, 15, -1, -1, -1, -1, -1),
(38, 16, -1, -1, -1, -1, -1),
(38, 17, -1, -1, -1, -1, -1),
(38, 18, -1, -1, -1, -1, -1),
(38, 19, -1, -1, -1, -1, -1),
(38, 20, -1, -1, -1, -1, -1),
(38, 21, -1, -1, -1, -1, -1),
(38, 22, -1, -1, -1, -1, -1),
(38, 23, -1, -1, -1, -1, -1),
(38, 24, -1, -1, -1, -1, -1),
(38, 25, -1, -1, -1, -1, -1),
(38, 26, -1, -1, -1, -1, -1),
(39, 1, -1, -1, -1, -1, -1),
(39, 2, -1, -1, -1, -1, -1),
(39, 3, -1, -1, -1, -1, -1),
(39, 4, -1, -1, -1, -1, -1),
(39, 5, -1, -1, -1, -1, -1),
(39, 6, -1, -1, -1, -1, -1),
(39, 7, -1, -1, -1, -1, -1),
(39, 8, -1, -1, -1, -1, -1),
(39, 9, -1, -1, -1, -1, -1),
(39, 10, -1, -1, -1, -1, -1),
(39, 11, -1, -1, -1, -1, -1),
(39, 12, -1, -1, -1, -1, -1),
(39, 13, -1, -1, -1, -1, -1),
(39, 14, -1, -1, -1, -1, -1),
(39, 15, -1, -1, -1, -1, -1),
(39, 16, -1, -1, -1, -1, -1),
(39, 17, -1, -1, -1, -1, -1),
(39, 18, -1, -1, -1, -1, -1),
(39, 19, -1, -1, -1, -1, -1),
(39, 20, -1, -1, -1, -1, -1),
(39, 21, -1, -1, -1, -1, -1),
(39, 22, -1, -1, -1, -1, -1),
(39, 23, -1, -1, -1, -1, -1),
(39, 24, -1, -1, -1, -1, -1),
(39, 25, -1, -1, -1, -1, -1),
(39, 26, -1, -1, -1, -1, -1),
(40, 1, -1, -1, -1, -1, -1),
(40, 2, -1, -1, -1, -1, -1),
(40, 3, -1, -1, -1, -1, -1),
(40, 4, -1, -1, -1, -1, -1),
(40, 5, -1, -1, -1, -1, -1),
(40, 6, -1, -1, -1, -1, -1),
(40, 7, -1, -1, -1, -1, -1),
(40, 8, -1, -1, -1, -1, -1),
(40, 9, -1, -1, -1, -1, -1),
(40, 10, -1, -1, -1, -1, -1),
(40, 11, -1, -1, -1, -1, -1),
(40, 12, -1, -1, -1, -1, -1),
(40, 13, -1, -1, -1, -1, -1),
(40, 14, -1, -1, -1, -1, -1),
(40, 15, -1, -1, -1, -1, -1),
(40, 16, -1, -1, -1, -1, -1),
(40, 17, -1, -1, -1, -1, -1),
(40, 18, -1, -1, -1, -1, -1),
(40, 19, -1, -1, -1, -1, -1),
(40, 20, -1, -1, -1, -1, -1),
(40, 21, -1, -1, -1, -1, -1),
(40, 22, -1, -1, -1, -1, -1),
(40, 23, -1, -1, -1, -1, -1),
(40, 24, -1, -1, -1, -1, -1),
(40, 25, -1, -1, -1, -1, -1),
(40, 26, -1, -1, -1, -1, -1),
(41, 1, -1, -1, -1, -1, -1),
(41, 2, -1, -1, -1, -1, -1),
(41, 3, -1, -1, -1, -1, -1),
(41, 4, -1, -1, -1, -1, -1),
(41, 5, -1, -1, -1, -1, -1),
(41, 6, -1, -1, -1, -1, -1),
(41, 7, -1, -1, -1, -1, -1),
(41, 8, -1, -1, -1, -1, -1),
(41, 9, -1, -1, -1, -1, -1),
(41, 10, -1, -1, -1, -1, -1),
(41, 11, -1, -1, -1, -1, -1),
(41, 12, -1, -1, -1, -1, -1),
(41, 13, -1, -1, -1, -1, -1),
(41, 14, -1, -1, -1, -1, -1),
(41, 15, -1, -1, -1, -1, -1),
(41, 16, -1, -1, -1, -1, -1),
(41, 17, -1, -1, -1, -1, -1),
(41, 18, -1, -1, -1, -1, -1),
(41, 19, -1, -1, -1, -1, -1),
(41, 20, -1, -1, -1, -1, -1),
(41, 21, -1, -1, -1, -1, -1),
(41, 22, -1, -1, -1, -1, -1),
(41, 23, -1, -1, -1, -1, -1),
(41, 24, -1, -1, -1, -1, -1),
(41, 25, -1, -1, -1, -1, -1),
(41, 26, -1, -1, -1, -1, -1),
(42, 1, -1, -1, -1, -1, -1),
(42, 2, -1, -1, -1, -1, -1),
(42, 3, -1, -1, -1, -1, -1),
(42, 4, -1, -1, -1, -1, -1),
(42, 5, -1, -1, -1, -1, -1),
(42, 6, -1, -1, -1, -1, -1),
(42, 7, -1, -1, -1, -1, -1),
(42, 8, -1, -1, -1, -1, -1),
(42, 9, -1, -1, -1, -1, -1),
(42, 10, -1, -1, -1, -1, -1),
(42, 11, -1, -1, -1, -1, -1),
(42, 12, -1, -1, -1, -1, -1),
(42, 13, -1, -1, -1, -1, -1),
(42, 14, -1, -1, -1, -1, -1),
(42, 15, -1, -1, -1, -1, -1),
(42, 16, -1, -1, -1, -1, -1),
(42, 17, -1, -1, -1, -1, -1),
(42, 18, -1, -1, -1, -1, -1),
(42, 19, -1, -1, -1, -1, -1),
(42, 20, -1, -1, -1, -1, -1),
(42, 21, -1, -1, -1, -1, -1),
(42, 22, -1, -1, -1, -1, -1),
(42, 23, -1, -1, -1, -1, -1),
(42, 24, -1, -1, -1, -1, -1),
(42, 25, -1, -1, -1, -1, -1),
(42, 26, -1, -1, -1, -1, -1),
(43, 1, -1, -1, -1, -1, -1),
(43, 2, -1, -1, -1, -1, -1),
(43, 3, -1, -1, -1, -1, -1),
(43, 4, -1, -1, -1, -1, -1),
(43, 5, -1, -1, -1, -1, -1),
(43, 6, -1, -1, -1, -1, -1),
(43, 7, -1, -1, -1, -1, -1),
(43, 8, -1, -1, -1, -1, -1),
(43, 9, -1, -1, -1, -1, -1),
(43, 10, -1, -1, -1, -1, -1),
(43, 11, -1, -1, -1, -1, -1),
(43, 12, -1, -1, -1, -1, -1),
(43, 13, -1, -1, -1, -1, -1),
(43, 14, -1, -1, -1, -1, -1),
(43, 15, -1, -1, -1, -1, -1),
(43, 16, -1, -1, -1, -1, -1),
(43, 17, -1, -1, -1, -1, -1),
(43, 18, -1, -1, -1, -1, -1),
(43, 19, -1, -1, -1, -1, -1),
(43, 20, -1, -1, -1, -1, -1),
(43, 21, -1, -1, -1, -1, -1),
(43, 22, -1, -1, -1, -1, -1),
(43, 23, -1, -1, -1, -1, -1),
(43, 24, -1, -1, -1, -1, -1),
(43, 25, -1, -1, -1, -1, -1),
(43, 26, -1, -1, -1, -1, -1),
(44, 1, -1, -1, -1, -1, -1),
(44, 2, -1, -1, -1, -1, -1),
(44, 3, -1, -1, -1, -1, -1),
(44, 4, -1, -1, -1, -1, -1),
(44, 5, -1, -1, -1, -1, -1),
(44, 6, -1, -1, -1, -1, -1),
(44, 7, -1, -1, -1, -1, -1),
(44, 8, -1, -1, -1, -1, -1),
(44, 9, -1, -1, -1, -1, -1),
(44, 10, -1, -1, -1, -1, -1),
(44, 11, -1, -1, -1, -1, -1),
(44, 12, -1, -1, -1, -1, -1),
(44, 13, -1, -1, -1, -1, -1),
(44, 14, -1, -1, -1, -1, -1),
(44, 15, -1, -1, -1, -1, -1),
(44, 16, -1, -1, -1, -1, -1),
(44, 17, -1, -1, -1, -1, -1),
(44, 18, -1, -1, -1, -1, -1),
(44, 19, -1, -1, -1, -1, -1),
(44, 20, -1, -1, -1, -1, -1),
(44, 21, -1, -1, -1, -1, -1),
(44, 22, -1, -1, -1, -1, -1),
(44, 23, -1, -1, -1, -1, -1),
(44, 24, -1, -1, -1, -1, -1),
(44, 25, -1, -1, -1, -1, -1),
(44, 26, -1, -1, -1, -1, -1),
(45, 27, -1, -1, -1, -1, -1),
(45, 28, -1, -1, -1, -1, -1),
(45, 29, -1, -1, -1, -1, -1),
(45, 30, 1, -1, -1, -1, -1),
(45, 31, 2, -1, -1, -1, -1),
(45, 32, 1, -1, -1, -1, -1),
(45, 33, -1, -1, -1, -1, -1),
(45, 34, -1, -1, -1, -1, -1),
(45, 35, 2, -1, -1, -1, -1),
(45, 36, 2, -1, -1, -1, -1),
(45, 37, -1, -1, -1, -1, -1),
(45, 38, -1, -1, -1, -1, -1),
(45, 39, -1, -1, -1, -1, -1),
(45, 40, -1, -1, -1, -1, -1),
(45, 41, -1, -1, -1, -1, -1),
(45, 42, -1, -1, -1, -1, -1),
(45, 43, -1, -1, -1, -1, -1),
(45, 44, -1, -1, -1, -1, -1),
(45, 45, -1, -1, -1, -1, -1),
(45, 46, -1, -1, -1, -1, -1),
(45, 47, -1, -1, -1, -1, -1),
(45, 48, -1, -1, -1, -1, -1),
(45, 49, -1, -1, -1, -1, -1),
(45, 50, -1, -1, -1, -1, -1),
(45, 51, -1, -1, -1, -1, -1),
(45, 52, -1, -1, -1, -1, -1),
(45, 53, -1, -1, -1, -1, -1),
(45, 54, -1, -1, -1, -1, -1),
(45, 55, -1, -1, -1, -1, -1),
(45, 56, -1, -1, -1, -1, -1),
(45, 57, -1, -1, -1, -1, -1),
(45, 58, -1, -1, -1, -1, -1),
(45, 59, -1, -1, -1, -1, -1),
(46, 27, -1, -1, -1, -1, -1),
(46, 28, -1, -1, -1, -1, -1),
(46, 29, -1, -1, -1, -1, -1),
(46, 30, 1, -1, -1, -1, -1),
(46, 31, 2, -1, -1, -1, -1),
(46, 32, 1, -1, -1, -1, -1),
(46, 33, -1, -1, -1, -1, -1),
(46, 34, -1, -1, -1, -1, -1),
(46, 35, 1, -1, -1, -1, -1),
(46, 36, 3, -1, -1, -1, -1),
(46, 37, -1, -1, -1, -1, -1),
(46, 38, -1, -1, -1, -1, -1),
(46, 39, -1, -1, -1, -1, -1),
(46, 40, -1, -1, -1, -1, -1),
(46, 41, -1, -1, -1, -1, -1),
(46, 42, -1, -1, -1, -1, -1),
(46, 43, -1, -1, -1, -1, -1),
(46, 44, -1, -1, -1, -1, -1),
(46, 45, -1, -1, -1, -1, -1),
(46, 46, -1, -1, -1, -1, -1),
(46, 47, -1, -1, -1, -1, -1),
(46, 48, -1, -1, -1, -1, -1),
(46, 49, -1, -1, -1, -1, -1),
(46, 50, -1, -1, -1, -1, -1),
(46, 51, -1, -1, -1, -1, -1),
(46, 52, -1, -1, -1, -1, -1),
(46, 53, -1, -1, -1, -1, -1),
(46, 54, -1, -1, -1, -1, -1),
(46, 55, -1, -1, -1, -1, -1),
(46, 56, -1, -1, -1, -1, -1),
(46, 57, -1, -1, -1, -1, -1),
(46, 58, -1, -1, -1, -1, -1),
(46, 59, -1, -1, -1, -1, -1),
(47, 27, -1, -1, -1, -1, -1),
(47, 28, -1, -1, -1, -1, -1),
(47, 29, -1, -1, -1, -1, -1),
(47, 30, -1, -1, -1, -1, -1),
(47, 31, -1, -1, -1, -1, -1),
(47, 32, -1, -1, -1, -1, -1),
(47, 33, -1, -1, -1, -1, -1),
(47, 34, -1, -1, -1, -1, -1),
(47, 35, -1, -1, -1, -1, -1),
(47, 36, -1, -1, -1, -1, -1),
(47, 37, -1, -1, -1, -1, -1),
(47, 38, -1, -1, -1, -1, -1),
(47, 39, -1, -1, -1, -1, -1),
(47, 40, -1, -1, -1, -1, -1),
(47, 41, -1, -1, -1, -1, -1),
(47, 42, -1, -1, -1, -1, -1),
(47, 43, -1, -1, -1, -1, -1),
(47, 44, -1, -1, -1, -1, -1),
(47, 45, -1, -1, -1, -1, -1),
(47, 46, -1, -1, -1, -1, -1),
(47, 47, -1, -1, -1, -1, -1),
(47, 48, -1, -1, -1, -1, -1),
(47, 49, -1, -1, -1, -1, -1),
(47, 50, -1, -1, -1, -1, -1),
(47, 51, -1, -1, -1, -1, -1),
(47, 52, -1, -1, -1, -1, -1),
(47, 53, -1, -1, -1, -1, -1),
(47, 54, -1, -1, -1, -1, -1),
(47, 55, -1, -1, -1, -1, -1),
(47, 56, -1, -1, -1, -1, -1),
(47, 57, -1, -1, -1, -1, -1),
(47, 58, -1, -1, -1, -1, -1),
(47, 59, -1, -1, -1, -1, -1),
(48, 27, -1, -1, -1, -1, -1),
(48, 28, -1, -1, -1, -1, -1),
(48, 29, -1, -1, -1, -1, -1),
(48, 30, -1, -1, -1, -1, -1),
(48, 31, -1, -1, -1, -1, -1),
(48, 32, -1, -1, -1, -1, -1),
(48, 33, -1, -1, -1, -1, -1),
(48, 34, -1, -1, -1, -1, -1),
(48, 35, -1, -1, -1, -1, -1),
(48, 36, -1, -1, -1, -1, -1),
(48, 37, -1, -1, -1, -1, -1),
(48, 38, -1, -1, -1, -1, -1),
(48, 39, -1, -1, -1, -1, -1),
(48, 40, -1, -1, -1, -1, -1),
(48, 41, -1, -1, -1, -1, -1),
(48, 42, -1, -1, -1, -1, -1),
(48, 43, -1, -1, -1, -1, -1),
(48, 44, -1, -1, -1, -1, -1),
(48, 45, -1, -1, -1, -1, -1),
(48, 46, -1, -1, -1, -1, -1),
(48, 47, -1, -1, -1, -1, -1),
(48, 48, -1, -1, -1, -1, -1),
(48, 49, -1, -1, -1, -1, -1),
(48, 50, -1, -1, -1, -1, -1),
(48, 51, -1, -1, -1, -1, -1),
(48, 52, -1, -1, -1, -1, -1),
(48, 53, -1, -1, -1, -1, -1),
(48, 54, -1, -1, -1, -1, -1),
(48, 55, -1, -1, -1, -1, -1),
(48, 56, -1, -1, -1, -1, -1),
(48, 57, -1, -1, -1, -1, -1),
(48, 58, -1, -1, -1, -1, -1),
(48, 59, -1, -1, -1, -1, -1),
(49, 27, -1, -1, -1, -1, -1),
(49, 28, -1, -1, -1, -1, -1),
(49, 29, -1, -1, -1, -1, -1),
(49, 30, -1, -1, -1, -1, -1),
(49, 31, -1, -1, -1, -1, -1),
(49, 32, -1, -1, -1, -1, -1),
(49, 33, -1, -1, -1, -1, -1),
(49, 34, -1, -1, -1, -1, -1),
(49, 35, -1, -1, -1, -1, -1),
(49, 36, -1, -1, -1, -1, -1),
(49, 37, -1, -1, -1, -1, -1),
(49, 38, -1, -1, -1, -1, -1),
(49, 39, -1, -1, -1, -1, -1),
(49, 40, -1, -1, -1, -1, -1),
(49, 41, -1, -1, -1, -1, -1),
(49, 42, -1, -1, -1, -1, -1),
(49, 43, -1, -1, -1, -1, -1),
(49, 44, -1, -1, -1, -1, -1),
(49, 45, -1, -1, -1, -1, -1),
(49, 46, -1, -1, -1, -1, -1),
(49, 47, -1, -1, -1, -1, -1),
(49, 48, -1, -1, -1, -1, -1),
(49, 49, -1, -1, -1, -1, -1),
(49, 50, -1, -1, -1, -1, -1),
(49, 51, -1, -1, -1, -1, -1),
(49, 52, -1, -1, -1, -1, -1),
(49, 53, -1, -1, -1, -1, -1),
(49, 54, -1, -1, -1, -1, -1),
(49, 55, -1, -1, -1, -1, -1),
(49, 56, -1, -1, -1, -1, -1),
(49, 57, -1, -1, -1, -1, -1),
(49, 58, -1, -1, -1, -1, -1),
(49, 59, -1, -1, -1, -1, -1),
(50, 27, -1, -1, -1, -1, -1),
(50, 28, -1, -1, -1, -1, -1),
(50, 29, -1, -1, -1, -1, -1),
(50, 30, -1, -1, -1, -1, -1),
(50, 31, -1, -1, -1, -1, -1),
(50, 32, -1, -1, -1, -1, -1),
(50, 33, -1, -1, -1, -1, -1),
(50, 34, -1, -1, -1, -1, -1),
(50, 35, -1, -1, -1, -1, -1),
(50, 36, -1, -1, -1, -1, -1),
(50, 37, -1, -1, -1, -1, -1),
(50, 38, -1, -1, -1, -1, -1),
(50, 39, -1, -1, -1, -1, -1),
(50, 40, -1, -1, -1, -1, -1),
(50, 41, -1, -1, -1, -1, -1),
(50, 42, -1, -1, -1, -1, -1),
(50, 43, -1, -1, -1, -1, -1),
(50, 44, -1, -1, -1, -1, -1),
(50, 45, -1, -1, -1, -1, -1),
(50, 46, -1, -1, -1, -1, -1),
(50, 47, -1, -1, -1, -1, -1),
(50, 48, -1, -1, -1, -1, -1),
(50, 49, -1, -1, -1, -1, -1),
(50, 50, -1, -1, -1, -1, -1),
(50, 51, -1, -1, -1, -1, -1),
(50, 52, -1, -1, -1, -1, -1),
(50, 53, -1, -1, -1, -1, -1),
(50, 54, -1, -1, -1, -1, -1),
(50, 55, -1, -1, -1, -1, -1),
(50, 56, -1, -1, -1, -1, -1),
(50, 57, -1, -1, -1, -1, -1),
(50, 58, -1, -1, -1, -1, -1),
(50, 59, -1, -1, -1, -1, -1),
(51, 27, -1, -1, -1, -1, -1),
(51, 28, -1, -1, -1, -1, -1),
(51, 29, -1, -1, -1, -1, -1),
(51, 30, -1, -1, -1, -1, -1),
(51, 31, -1, -1, -1, -1, -1),
(51, 32, -1, -1, -1, -1, -1),
(51, 33, -1, -1, -1, -1, -1),
(51, 34, -1, -1, -1, -1, -1),
(51, 35, -1, -1, -1, -1, -1),
(51, 36, -1, -1, -1, -1, -1),
(51, 37, -1, -1, -1, -1, -1),
(51, 38, -1, -1, -1, -1, -1),
(51, 39, -1, -1, -1, -1, -1),
(51, 40, -1, -1, -1, -1, -1),
(51, 41, -1, -1, -1, -1, -1),
(51, 42, -1, -1, -1, -1, -1),
(51, 43, -1, -1, -1, -1, -1),
(51, 44, -1, -1, -1, -1, -1),
(51, 45, -1, -1, -1, -1, -1),
(51, 46, -1, -1, -1, -1, -1),
(51, 47, -1, -1, -1, -1, -1),
(51, 48, -1, -1, -1, -1, -1),
(51, 49, -1, -1, -1, -1, -1),
(51, 50, -1, -1, -1, -1, -1),
(51, 51, -1, -1, -1, -1, -1),
(51, 52, -1, -1, -1, -1, -1),
(51, 53, -1, -1, -1, -1, -1),
(51, 54, -1, -1, -1, -1, -1),
(51, 55, -1, -1, -1, -1, -1),
(51, 56, -1, -1, -1, -1, -1),
(51, 57, -1, -1, -1, -1, -1),
(51, 58, -1, -1, -1, -1, -1),
(51, 59, -1, -1, -1, -1, -1),
(52, 27, -1, -1, -1, -1, -1),
(52, 28, -1, -1, -1, -1, -1),
(52, 29, -1, -1, -1, -1, -1),
(52, 30, -1, -1, -1, -1, -1),
(52, 31, -1, -1, -1, -1, -1),
(52, 32, -1, -1, -1, -1, -1),
(52, 33, -1, -1, -1, -1, -1),
(52, 34, -1, -1, -1, -1, -1),
(52, 35, -1, -1, -1, -1, -1),
(52, 36, -1, -1, -1, -1, -1),
(52, 37, -1, -1, -1, -1, -1),
(52, 38, -1, -1, -1, -1, -1),
(52, 39, -1, -1, -1, -1, -1),
(52, 40, -1, -1, -1, -1, -1),
(52, 41, -1, -1, -1, -1, -1),
(52, 42, -1, -1, -1, -1, -1),
(52, 43, -1, -1, -1, -1, -1),
(52, 44, -1, -1, -1, -1, -1),
(52, 45, -1, -1, -1, -1, -1),
(52, 46, -1, -1, -1, -1, -1),
(52, 47, -1, -1, -1, -1, -1),
(52, 48, -1, -1, -1, -1, -1),
(52, 49, -1, -1, -1, -1, -1),
(52, 50, -1, -1, -1, -1, -1),
(52, 51, -1, -1, -1, -1, -1),
(52, 52, -1, -1, -1, -1, -1),
(52, 53, -1, -1, -1, -1, -1),
(52, 54, -1, -1, -1, -1, -1),
(52, 55, -1, -1, -1, -1, -1),
(52, 56, -1, -1, -1, -1, -1),
(52, 57, -1, -1, -1, -1, -1),
(52, 58, -1, -1, -1, -1, -1),
(52, 59, -1, -1, -1, -1, -1),
(53, 27, -1, -1, -1, -1, -1),
(53, 28, -1, -1, -1, -1, -1),
(53, 29, -1, -1, -1, -1, -1),
(53, 30, -1, -1, -1, -1, -1),
(53, 31, -1, -1, -1, -1, -1),
(53, 32, -1, -1, -1, -1, -1),
(53, 33, -1, -1, -1, -1, -1),
(53, 34, -1, -1, -1, -1, -1),
(53, 35, -1, -1, -1, -1, -1),
(53, 36, -1, -1, -1, -1, -1),
(53, 37, -1, -1, -1, -1, -1),
(53, 38, -1, -1, -1, -1, -1),
(53, 39, -1, -1, -1, -1, -1),
(53, 40, -1, -1, -1, -1, -1),
(53, 41, -1, -1, -1, -1, -1),
(53, 42, -1, -1, -1, -1, -1),
(53, 43, -1, -1, -1, -1, -1),
(53, 44, -1, -1, -1, -1, -1),
(53, 45, -1, -1, -1, -1, -1),
(53, 46, -1, -1, -1, -1, -1),
(53, 47, -1, -1, -1, -1, -1),
(53, 48, -1, -1, -1, -1, -1),
(53, 49, -1, -1, -1, -1, -1),
(53, 50, -1, -1, -1, -1, -1),
(53, 51, -1, -1, -1, -1, -1),
(53, 52, -1, -1, -1, -1, -1),
(53, 53, -1, -1, -1, -1, -1),
(53, 54, -1, -1, -1, -1, -1),
(53, 55, -1, -1, -1, -1, -1),
(53, 56, -1, -1, -1, -1, -1),
(53, 57, -1, -1, -1, -1, -1),
(53, 58, -1, -1, -1, -1, -1),
(53, 59, -1, -1, -1, -1, -1),
(54, 27, -1, -1, -1, -1, -1),
(54, 28, -1, -1, -1, -1, -1),
(54, 29, -1, -1, -1, -1, -1),
(54, 30, -1, -1, -1, -1, -1),
(54, 31, -1, -1, -1, -1, -1),
(54, 32, -1, -1, -1, -1, -1),
(54, 33, -1, -1, -1, -1, -1),
(54, 34, -1, -1, -1, -1, -1),
(54, 35, -1, -1, -1, -1, -1),
(54, 36, -1, -1, -1, -1, -1),
(54, 37, -1, -1, -1, -1, -1),
(54, 38, -1, -1, -1, -1, -1),
(54, 39, -1, -1, -1, -1, -1),
(54, 40, -1, -1, -1, -1, -1),
(54, 41, -1, -1, -1, -1, -1),
(54, 42, -1, -1, -1, -1, -1),
(54, 43, -1, -1, -1, -1, -1),
(54, 44, -1, -1, -1, -1, -1),
(54, 45, -1, -1, -1, -1, -1),
(54, 46, -1, -1, -1, -1, -1),
(54, 47, -1, -1, -1, -1, -1),
(54, 48, -1, -1, -1, -1, -1),
(54, 49, -1, -1, -1, -1, -1),
(54, 50, -1, -1, -1, -1, -1),
(54, 51, -1, -1, -1, -1, -1),
(54, 52, -1, -1, -1, -1, -1),
(54, 53, -1, -1, -1, -1, -1),
(54, 54, -1, -1, -1, -1, -1),
(54, 55, -1, -1, -1, -1, -1),
(54, 56, -1, -1, -1, -1, -1),
(54, 57, -1, -1, -1, -1, -1),
(54, 58, -1, -1, -1, -1, -1),
(54, 59, -1, -1, -1, -1, -1),
(55, 27, -1, -1, -1, -1, -1),
(55, 28, -1, -1, -1, -1, -1),
(55, 29, -1, -1, -1, -1, -1),
(55, 30, -1, -1, -1, -1, -1),
(55, 31, -1, -1, -1, -1, -1),
(55, 32, -1, -1, -1, -1, -1),
(55, 33, -1, -1, -1, -1, -1),
(55, 34, -1, -1, -1, -1, -1),
(55, 35, -1, -1, -1, -1, -1),
(55, 36, -1, -1, -1, -1, -1),
(55, 37, -1, -1, -1, -1, -1),
(55, 38, -1, -1, -1, -1, -1),
(55, 39, -1, -1, -1, -1, -1),
(55, 40, -1, -1, -1, -1, -1),
(55, 41, -1, -1, -1, -1, -1),
(55, 42, -1, -1, -1, -1, -1),
(55, 43, -1, -1, -1, -1, -1),
(55, 44, -1, -1, -1, -1, -1),
(55, 45, -1, -1, -1, -1, -1),
(55, 46, -1, -1, -1, -1, -1),
(55, 47, -1, -1, -1, -1, -1),
(55, 48, -1, -1, -1, -1, -1),
(55, 49, -1, -1, -1, -1, -1),
(55, 50, -1, -1, -1, -1, -1),
(55, 51, -1, -1, -1, -1, -1),
(55, 52, -1, -1, -1, -1, -1),
(55, 53, -1, -1, -1, -1, -1),
(55, 54, -1, -1, -1, -1, -1),
(55, 55, -1, -1, -1, -1, -1),
(55, 56, -1, -1, -1, -1, -1),
(55, 57, -1, -1, -1, -1, -1),
(55, 58, -1, -1, -1, -1, -1),
(55, 59, -1, -1, -1, -1, -1),
(56, 27, -1, -1, -1, -1, -1),
(56, 28, -1, -1, -1, -1, -1),
(56, 29, -1, -1, -1, -1, -1),
(56, 30, -1, -1, -1, -1, -1),
(56, 31, -1, -1, -1, -1, -1),
(56, 32, -1, -1, -1, -1, -1),
(56, 33, -1, -1, -1, -1, -1),
(56, 34, -1, -1, -1, -1, -1),
(56, 35, -1, -1, -1, -1, -1),
(56, 36, -1, -1, -1, -1, -1),
(56, 37, -1, -1, -1, -1, -1),
(56, 38, -1, -1, -1, -1, -1),
(56, 39, -1, -1, -1, -1, -1),
(56, 40, -1, -1, -1, -1, -1),
(56, 41, -1, -1, -1, -1, -1),
(56, 42, -1, -1, -1, -1, -1),
(56, 43, -1, -1, -1, -1, -1),
(56, 44, -1, -1, -1, -1, -1),
(56, 45, -1, -1, -1, -1, -1),
(56, 46, -1, -1, -1, -1, -1),
(56, 47, -1, -1, -1, -1, -1),
(56, 48, -1, -1, -1, -1, -1),
(56, 49, -1, -1, -1, -1, -1),
(56, 50, -1, -1, -1, -1, -1),
(56, 51, -1, -1, -1, -1, -1),
(56, 52, -1, -1, -1, -1, -1),
(56, 53, -1, -1, -1, -1, -1),
(56, 54, -1, -1, -1, -1, -1),
(56, 55, -1, -1, -1, -1, -1),
(56, 56, -1, -1, -1, -1, -1),
(56, 57, -1, -1, -1, -1, -1),
(56, 58, -1, -1, -1, -1, -1),
(56, 59, -1, -1, -1, -1, -1),
(57, 27, -1, -1, -1, -1, -1),
(57, 28, -1, -1, -1, -1, -1),
(57, 29, -1, -1, -1, -1, -1),
(57, 30, -1, -1, -1, -1, -1),
(57, 31, -1, -1, -1, -1, -1),
(57, 32, -1, -1, -1, -1, -1),
(57, 33, -1, -1, -1, -1, -1),
(57, 34, -1, -1, -1, -1, -1),
(57, 35, -1, -1, -1, -1, -1),
(57, 36, -1, -1, -1, -1, -1),
(57, 37, -1, -1, -1, -1, -1),
(57, 38, -1, -1, -1, -1, -1),
(57, 39, -1, -1, -1, -1, -1),
(57, 40, -1, -1, -1, -1, -1),
(57, 41, -1, -1, -1, -1, -1),
(57, 42, -1, -1, -1, -1, -1),
(57, 43, -1, -1, -1, -1, -1),
(57, 44, -1, -1, -1, -1, -1),
(57, 45, -1, -1, -1, -1, -1),
(57, 46, -1, -1, -1, -1, -1),
(57, 47, -1, -1, -1, -1, -1),
(57, 48, -1, -1, -1, -1, -1),
(57, 49, -1, -1, -1, -1, -1),
(57, 50, -1, -1, -1, -1, -1),
(57, 51, -1, -1, -1, -1, -1),
(57, 52, -1, -1, -1, -1, -1),
(57, 53, -1, -1, -1, -1, -1),
(57, 54, -1, -1, -1, -1, -1),
(57, 55, -1, -1, -1, -1, -1),
(57, 56, -1, -1, -1, -1, -1),
(57, 57, -1, -1, -1, -1, -1),
(57, 58, -1, -1, -1, -1, -1),
(57, 59, -1, -1, -1, -1, -1),
(58, 27, -1, -1, -1, -1, -1),
(58, 28, -1, -1, -1, -1, -1),
(58, 29, -1, -1, -1, -1, -1),
(58, 30, -1, -1, -1, -1, -1),
(58, 31, -1, -1, -1, -1, -1),
(58, 32, -1, -1, -1, -1, -1),
(58, 33, -1, -1, -1, -1, -1),
(58, 34, -1, -1, -1, -1, -1),
(58, 35, -1, -1, -1, -1, -1),
(58, 36, -1, -1, -1, -1, -1),
(58, 37, -1, -1, -1, -1, -1),
(58, 38, -1, -1, -1, -1, -1),
(58, 39, -1, -1, -1, -1, -1),
(58, 40, -1, -1, -1, -1, -1),
(58, 41, -1, -1, -1, -1, -1),
(58, 42, -1, -1, -1, -1, -1),
(58, 43, -1, -1, -1, -1, -1),
(58, 44, -1, -1, -1, -1, -1),
(58, 45, -1, -1, -1, -1, -1),
(58, 46, -1, -1, -1, -1, -1),
(58, 47, -1, -1, -1, -1, -1),
(58, 48, -1, -1, -1, -1, -1),
(58, 49, -1, -1, -1, -1, -1),
(58, 50, -1, -1, -1, -1, -1),
(58, 51, -1, -1, -1, -1, -1),
(58, 52, -1, -1, -1, -1, -1),
(58, 53, -1, -1, -1, -1, -1),
(58, 54, -1, -1, -1, -1, -1),
(58, 55, -1, -1, -1, -1, -1),
(58, 56, -1, -1, -1, -1, -1),
(58, 57, -1, -1, -1, -1, -1),
(58, 58, -1, -1, -1, -1, -1),
(58, 59, -1, -1, -1, -1, -1),
(59, 27, -1, -1, -1, -1, -1),
(59, 28, -1, -1, -1, -1, -1),
(59, 29, -1, -1, -1, -1, -1),
(59, 30, -1, -1, -1, -1, -1),
(59, 31, -1, -1, -1, -1, -1),
(59, 32, -1, -1, -1, -1, -1),
(59, 33, -1, -1, -1, -1, -1),
(59, 34, -1, -1, -1, -1, -1),
(59, 35, -1, -1, -1, -1, -1),
(59, 36, -1, -1, -1, -1, -1),
(59, 37, -1, -1, -1, -1, -1),
(59, 38, -1, -1, -1, -1, -1),
(59, 39, -1, -1, -1, -1, -1),
(59, 40, -1, -1, -1, -1, -1),
(59, 41, -1, -1, -1, -1, -1),
(59, 42, -1, -1, -1, -1, -1),
(59, 43, -1, -1, -1, -1, -1),
(59, 44, -1, -1, -1, -1, -1),
(59, 45, -1, -1, -1, -1, -1),
(59, 46, -1, -1, -1, -1, -1),
(59, 47, -1, -1, -1, -1, -1),
(59, 48, -1, -1, -1, -1, -1),
(59, 49, -1, -1, -1, -1, -1),
(59, 50, -1, -1, -1, -1, -1),
(59, 51, -1, -1, -1, -1, -1),
(59, 52, -1, -1, -1, -1, -1),
(59, 53, -1, -1, -1, -1, -1),
(59, 54, -1, -1, -1, -1, -1),
(59, 55, -1, -1, -1, -1, -1),
(59, 56, -1, -1, -1, -1, -1),
(59, 57, -1, -1, -1, -1, -1),
(59, 58, -1, -1, -1, -1, -1),
(59, 59, -1, -1, -1, -1, -1),
(60, 27, -1, -1, -1, -1, -1),
(60, 28, -1, -1, -1, -1, -1),
(60, 29, -1, -1, -1, -1, -1),
(60, 30, -1, -1, -1, -1, -1),
(60, 31, -1, -1, -1, -1, -1),
(60, 32, -1, -1, -1, -1, -1),
(60, 33, -1, -1, -1, -1, -1),
(60, 34, -1, -1, -1, -1, -1),
(60, 35, -1, -1, -1, -1, -1),
(60, 36, -1, -1, -1, -1, -1),
(60, 37, -1, -1, -1, -1, -1),
(60, 38, -1, -1, -1, -1, -1),
(60, 39, -1, -1, -1, -1, -1),
(60, 40, -1, -1, -1, -1, -1),
(60, 41, -1, -1, -1, -1, -1),
(60, 42, -1, -1, -1, -1, -1),
(60, 43, -1, -1, -1, -1, -1),
(60, 44, -1, -1, -1, -1, -1),
(60, 45, -1, -1, -1, -1, -1),
(60, 46, -1, -1, -1, -1, -1),
(60, 47, -1, -1, -1, -1, -1),
(60, 48, -1, -1, -1, -1, -1),
(60, 49, -1, -1, -1, -1, -1),
(60, 50, -1, -1, -1, -1, -1),
(60, 51, -1, -1, -1, -1, -1),
(60, 52, -1, -1, -1, -1, -1),
(60, 53, -1, -1, -1, -1, -1),
(60, 54, -1, -1, -1, -1, -1),
(60, 55, -1, -1, -1, -1, -1),
(60, 56, -1, -1, -1, -1, -1),
(60, 57, -1, -1, -1, -1, -1),
(60, 58, -1, -1, -1, -1, -1),
(60, 59, -1, -1, -1, -1, -1),
(61, 27, -1, -1, -1, -1, -1),
(61, 28, -1, -1, -1, -1, -1),
(61, 29, -1, -1, -1, -1, -1),
(61, 30, -1, -1, -1, -1, -1),
(61, 31, -1, -1, -1, -1, -1),
(61, 32, -1, -1, -1, -1, -1),
(61, 33, -1, -1, -1, -1, -1),
(61, 34, -1, -1, -1, -1, -1),
(61, 35, -1, -1, -1, -1, -1),
(61, 36, -1, -1, -1, -1, -1),
(61, 37, -1, -1, -1, -1, -1),
(61, 38, -1, -1, -1, -1, -1),
(61, 39, -1, -1, -1, -1, -1),
(61, 40, -1, -1, -1, -1, -1),
(61, 41, -1, -1, -1, -1, -1),
(61, 42, -1, -1, -1, -1, -1),
(61, 43, -1, -1, -1, -1, -1),
(61, 44, -1, -1, -1, -1, -1),
(61, 45, -1, -1, -1, -1, -1),
(61, 46, -1, -1, -1, -1, -1),
(61, 47, -1, -1, -1, -1, -1),
(61, 48, -1, -1, -1, -1, -1),
(61, 49, -1, -1, -1, -1, -1),
(61, 50, -1, -1, -1, -1, -1),
(61, 51, -1, -1, -1, -1, -1),
(61, 52, -1, -1, -1, -1, -1),
(61, 53, -1, -1, -1, -1, -1),
(61, 54, -1, -1, -1, -1, -1),
(61, 55, -1, -1, -1, -1, -1),
(61, 56, -1, -1, -1, -1, -1),
(61, 57, -1, -1, -1, -1, -1),
(61, 58, -1, -1, -1, -1, -1),
(61, 59, -1, -1, -1, -1, -1),
(62, 27, -1, -1, -1, -1, -1),
(62, 28, -1, -1, -1, -1, -1),
(62, 29, -1, -1, -1, -1, -1),
(62, 30, -1, -1, -1, -1, -1),
(62, 31, -1, -1, -1, -1, -1),
(62, 32, -1, -1, -1, -1, -1),
(62, 33, -1, -1, -1, -1, -1),
(62, 34, -1, -1, -1, -1, -1),
(62, 35, -1, -1, -1, -1, -1),
(62, 36, -1, -1, -1, -1, -1),
(62, 37, -1, -1, -1, -1, -1),
(62, 38, -1, -1, -1, -1, -1),
(62, 39, -1, -1, -1, -1, -1),
(62, 40, -1, -1, -1, -1, -1),
(62, 41, -1, -1, -1, -1, -1),
(62, 42, -1, -1, -1, -1, -1),
(62, 43, -1, -1, -1, -1, -1),
(62, 44, -1, -1, -1, -1, -1),
(62, 45, -1, -1, -1, -1, -1),
(62, 46, -1, -1, -1, -1, -1),
(62, 47, -1, -1, -1, -1, -1),
(62, 48, -1, -1, -1, -1, -1),
(62, 49, -1, -1, -1, -1, -1),
(62, 50, -1, -1, -1, -1, -1),
(62, 51, -1, -1, -1, -1, -1),
(62, 52, -1, -1, -1, -1, -1),
(62, 53, -1, -1, -1, -1, -1),
(62, 54, -1, -1, -1, -1, -1),
(62, 55, -1, -1, -1, -1, -1),
(62, 56, -1, -1, -1, -1, -1),
(62, 57, -1, -1, -1, -1, -1),
(62, 58, -1, -1, -1, -1, -1),
(62, 59, -1, -1, -1, -1, -1),
(63, 27, -1, -1, -1, -1, -1),
(63, 28, -1, -1, -1, -1, -1),
(63, 29, -1, -1, -1, -1, -1),
(63, 30, -1, -1, -1, -1, -1),
(63, 31, -1, -1, -1, -1, -1),
(63, 32, -1, -1, -1, -1, -1),
(63, 33, -1, -1, -1, -1, -1),
(63, 34, -1, -1, -1, -1, -1),
(63, 35, -1, -1, -1, -1, -1),
(63, 36, -1, -1, -1, -1, -1),
(63, 37, -1, -1, -1, -1, -1),
(63, 38, -1, -1, -1, -1, -1),
(63, 39, -1, -1, -1, -1, -1),
(63, 40, -1, -1, -1, -1, -1),
(63, 41, -1, -1, -1, -1, -1),
(63, 42, -1, -1, -1, -1, -1),
(63, 43, -1, -1, -1, -1, -1),
(63, 44, -1, -1, -1, -1, -1),
(63, 45, -1, -1, -1, -1, -1),
(63, 46, -1, -1, -1, -1, -1),
(63, 47, -1, -1, -1, -1, -1),
(63, 48, -1, -1, -1, -1, -1),
(63, 49, -1, -1, -1, -1, -1),
(63, 50, -1, -1, -1, -1, -1),
(63, 51, -1, -1, -1, -1, -1),
(63, 52, -1, -1, -1, -1, -1),
(63, 53, -1, -1, -1, -1, -1),
(63, 54, -1, -1, -1, -1, -1),
(63, 55, -1, -1, -1, -1, -1),
(63, 56, -1, -1, -1, -1, -1),
(63, 57, -1, -1, -1, -1, -1),
(63, 58, -1, -1, -1, -1, -1),
(63, 59, -1, -1, -1, -1, -1),
(64, 27, -1, -1, -1, -1, -1),
(64, 28, -1, -1, -1, -1, -1),
(64, 29, -1, -1, -1, -1, -1),
(64, 30, -1, -1, -1, -1, -1),
(64, 31, -1, -1, -1, -1, -1),
(64, 32, -1, -1, -1, -1, -1),
(64, 33, -1, -1, -1, -1, -1),
(64, 34, -1, -1, -1, -1, -1),
(64, 35, -1, -1, -1, -1, -1),
(64, 36, -1, -1, -1, -1, -1),
(64, 37, -1, -1, -1, -1, -1),
(64, 38, -1, -1, -1, -1, -1),
(64, 39, -1, -1, -1, -1, -1),
(64, 40, -1, -1, -1, -1, -1),
(64, 41, -1, -1, -1, -1, -1),
(64, 42, -1, -1, -1, -1, -1),
(64, 43, -1, -1, -1, -1, -1),
(64, 44, -1, -1, -1, -1, -1),
(64, 45, -1, -1, -1, -1, -1),
(64, 46, -1, -1, -1, -1, -1),
(64, 47, -1, -1, -1, -1, -1),
(64, 48, -1, -1, -1, -1, -1),
(64, 49, -1, -1, -1, -1, -1),
(64, 50, -1, -1, -1, -1, -1),
(64, 51, -1, -1, -1, -1, -1),
(64, 52, -1, -1, -1, -1, -1),
(64, 53, -1, -1, -1, -1, -1),
(64, 54, -1, -1, -1, -1, -1),
(64, 55, -1, -1, -1, -1, -1),
(64, 56, -1, -1, -1, -1, -1),
(64, 57, -1, -1, -1, -1, -1),
(64, 58, -1, -1, -1, -1, -1),
(64, 59, -1, -1, -1, -1, -1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pago`
--

DROP TABLE IF EXISTS `pago`;
CREATE TABLE IF NOT EXISTS `pago` (
`idpago` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `hora` time NOT NULL,
  `idDeuda` int(11) NOT NULL,
  `idUsuario` int(11) NOT NULL,
  `recibido` double(11,2) NOT NULL,
  `vuelto` double(11,2) NOT NULL,
  `est` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `periodos`
--

DROP TABLE IF EXISTS `periodos`;
CREATE TABLE IF NOT EXISTS `periodos` (
`idPeriodos` int(11) NOT NULL,
  `descr` varchar(45) NOT NULL,
  `est` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `periodos`
--

INSERT INTO `periodos` (`idPeriodos`, `descr`, `est`) VALUES
(1, 'BIMESTRE I', 1),
(2, 'BIMESTRE II', 1),
(3, 'BIMESTRE III', 2),
(4, 'BIMESTRE IV', 2),
(5, 'RECUPERACION', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `recarga`
--

DROP TABLE IF EXISTS `recarga`;
CREATE TABLE IF NOT EXISTS `recarga` (
`idrecarga` int(11) NOT NULL,
  `idUsuario` int(11) NOT NULL,
  `idMatricula` int(11) NOT NULL,
  `monto` double(11,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `seccion`
--

DROP TABLE IF EXISTS `seccion`;
CREATE TABLE IF NOT EXISTS `seccion` (
`idSeccion` int(11) NOT NULL,
  `descr` varchar(45) NOT NULL,
  `est` int(11) DEFAULT '1'
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `seccion`
--

INSERT INTO `seccion` (`idSeccion`, `descr`, `est`) VALUES
(1, 'A', 1),
(2, 'B', 2),
(3, 'C', 2),
(4, 'D', 2),
(5, 'E', 2),
(7, 'F', 2),
(8, 'G', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sexo`
--

DROP TABLE IF EXISTS `sexo`;
CREATE TABLE IF NOT EXISTS `sexo` (
`idsexo` int(11) NOT NULL,
  `descr` varchar(45) NOT NULL,
  `est` int(11) DEFAULT '1'
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `sexo`
--

INSERT INTO `sexo` (`idsexo`, `descr`, `est`) VALUES
(1, 'MASCULINO', 1),
(2, 'FEMENINO', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `temp`
--

DROP TABLE IF EXISTS `temp`;
CREATE TABLE IF NOT EXISTS `temp` (
  `idtemp` int(11) NOT NULL,
  `codigo` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `temp`
--

INSERT INTO `temp` (`idtemp`, `codigo`) VALUES
(1, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipoapoderado`
--

DROP TABLE IF EXISTS `tipoapoderado`;
CREATE TABLE IF NOT EXISTS `tipoapoderado` (
`idtipoApoderado` int(11) NOT NULL,
  `descr` varchar(45) NOT NULL,
  `est` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `tipoapoderado`
--

INSERT INTO `tipoapoderado` (`idtipoApoderado`, `descr`, `est`) VALUES
(1, 'PADRE', 1),
(2, 'MADRE', 1),
(3, 'ABUELO(A)', 1),
(4, 'TIO(A)', 1),
(5, 'PRIMO(A)', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipodeuda`
--

DROP TABLE IF EXISTS `tipodeuda`;
CREATE TABLE IF NOT EXISTS `tipodeuda` (
`idTipoDeuda` int(11) NOT NULL,
  `TipoDeudacol` varchar(45) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `tipodeuda`
--

INSERT INTO `tipodeuda` (`idTipoDeuda`, `TipoDeudacol`) VALUES
(1, 'MATRICULA'),
(2, 'VACANTE '),
(3, 'PENCION');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipogrado`
--

DROP TABLE IF EXISTS `tipogrado`;
CREATE TABLE IF NOT EXISTS `tipogrado` (
`idTipo` int(11) NOT NULL,
  `descr` varchar(45) NOT NULL,
  `est` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `tipogrado`
--

INSERT INTO `tipogrado` (`idTipo`, `descr`, `est`) VALUES
(1, 'PRIMARIA', 1),
(2, 'SECUNDARIA', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipoinsidencia`
--

DROP TABLE IF EXISTS `tipoinsidencia`;
CREATE TABLE IF NOT EXISTS `tipoinsidencia` (
`idtipoInsidencia` int(11) NOT NULL,
  `descr` varchar(45) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tipoinsidencia`
--

INSERT INTO `tipoinsidencia` (`idtipoInsidencia`, `descr`) VALUES
(1, 'POSITIVA'),
(2, 'NEGATIVA');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipomatricula`
--

DROP TABLE IF EXISTS `tipomatricula`;
CREATE TABLE IF NOT EXISTS `tipomatricula` (
`idtipomatricula` int(11) NOT NULL,
  `descr` varchar(45) NOT NULL,
  `pencion` double NOT NULL,
  `pago` double NOT NULL,
  `est` int(11) DEFAULT '1'
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `tipomatricula`
--

INSERT INTO `tipomatricula` (`idtipomatricula`, `descr`, `pencion`, `pago`, `est`) VALUES
(1, 'MATRICULA NORMAL', 280, 150, 1),
(2, 'MATRICULA 2DO HIJO', 250, 150, 1),
(3, 'MATRICULA 3ER HIJO', 230, 150, 1),
(4, 'MATRICULA HIJO TRABAJADOR', 140, 150, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipousuario`
--

DROP TABLE IF EXISTS `tipousuario`;
CREATE TABLE IF NOT EXISTS `tipousuario` (
`idTipoUsuario` int(11) NOT NULL,
  `descr` varchar(45) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `tipousuario`
--

INSERT INTO `tipousuario` (`idTipoUsuario`, `descr`) VALUES
(1, 'DIRECTOR'),
(2, 'CAFETIN'),
(3, 'CAJA'),
(4, 'DOCENTE'),
(5, 'FAMILIAR');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

DROP TABLE IF EXISTS `usuario`;
CREATE TABLE IF NOT EXISTS `usuario` (
`idUsuario` int(11) NOT NULL,
  `dni` varchar(8) NOT NULL,
  `nomb` varchar(45) NOT NULL,
  `apepa` varchar(45) NOT NULL,
  `apema` varchar(45) NOT NULL,
  `fnac` date NOT NULL,
  `telf` varchar(12) NOT NULL,
  `dir` varchar(150) NOT NULL,
  `idTipoUsuario` int(11) NOT NULL,
  `pass` varchar(45) NOT NULL,
  `ext` varchar(5) DEFAULT '0',
  `idsex` int(11) NOT NULL,
  `est` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`idUsuario`, `dni`, `nomb`, `apepa`, `apema`, `fnac`, `telf`, `dir`, `idTipoUsuario`, `pass`, `ext`, `idsex`, `est`) VALUES
(1, '00086749', 'JOSE ELMO', 'VIA', 'MALPARTIDA', '0000-00-00', '948046469', 'JR. IQUITOS #481 ', 1, '1234', 'jpg', 1, 1),
(2, '71043266', 'DANNY MANUEL', 'CHAVEZ', 'HERRERA', '1996-06-13', '596675', 'jr.PomaRosa mz:F lt:3   ', 3, '123456', 'jpg', 1, 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `alumnos`
--
ALTER TABLE `alumnos`
 ADD PRIMARY KEY (`idAlumnos`), ADD UNIQUE KEY `dni_UNIQUE` (`dni`);

--
-- Indices de la tabla `anioescolar`
--
ALTER TABLE `anioescolar`
 ADD PRIMARY KEY (`idAnioEscolar`);

--
-- Indices de la tabla `apoderado`
--
ALTER TABLE `apoderado`
 ADD PRIMARY KEY (`idApoderado`), ADD UNIQUE KEY `dni_UNIQUE` (`dni`), ADD KEY `fk_Apoderado_tipoApoderado1_idx` (`idtipoApoderado`);

--
-- Indices de la tabla `asigdocente`
--
ALTER TABLE `asigdocente`
 ADD PRIMARY KEY (`idDocente`,`idCursos`,`idGrado`,`idSeccion`,`idAnioEscolar`), ADD KEY `fk_CursosGrado_Cursos1_idx` (`idCursos`), ADD KEY `fk_CursosGrado_Grado1_idx` (`idGrado`), ADD KEY `fk_CursosGrado_Docente1_idx` (`idDocente`), ADD KEY `fk_CursosGrado_AnioEscolar1_idx` (`idAnioEscolar`);

--
-- Indices de la tabla `asistencia`
--
ALTER TABLE `asistencia`
 ADD PRIMARY KEY (`idasistencia`), ADD KEY `fk_asistencia_Matricula1_idx` (`idMatricula`);

--
-- Indices de la tabla `competencias`
--
ALTER TABLE `competencias`
 ADD PRIMARY KEY (`idComp`);

--
-- Indices de la tabla `cursos`
--
ALTER TABLE `cursos`
 ADD PRIMARY KEY (`idCursos`);

--
-- Indices de la tabla `deuda`
--
ALTER TABLE `deuda`
 ADD PRIMARY KEY (`idDeuda`), ADD KEY `fk_Deudas_Matricula1_idx` (`idMatricula`), ADD KEY `fk_Deudas_TipoDeuda1_idx` (`idTipoDeuda`);

--
-- Indices de la tabla `docente`
--
ALTER TABLE `docente`
 ADD PRIMARY KEY (`idDocente`), ADD UNIQUE KEY `dni_UNIQUE` (`dni`);

--
-- Indices de la tabla `estados`
--
ALTER TABLE `estados`
 ADD PRIMARY KEY (`idestados`);

--
-- Indices de la tabla `grado`
--
ALTER TABLE `grado`
 ADD PRIMARY KEY (`idGrado`), ADD KEY `fk_Grado_Tipo1_idx` (`idTipo`);

--
-- Indices de la tabla `gradoseccion`
--
ALTER TABLE `gradoseccion`
 ADD PRIMARY KEY (`idGrado`,`idSeccion`), ADD KEY `fk_GradoSeccion_Grado1_idx` (`idGrado`), ADD KEY `fk_GradoSeccion_Seccion1_idx` (`idSeccion`);

--
-- Indices de la tabla `historial`
--
ALTER TABLE `historial`
 ADD PRIMARY KEY (`idhistorial`), ADD KEY `fk_historial_Usuario1_idx` (`idUsuario`);

--
-- Indices de la tabla `insidencias`
--
ALTER TABLE `insidencias`
 ADD PRIMARY KEY (`idinsidencias`);

--
-- Indices de la tabla `matricula`
--
ALTER TABLE `matricula`
 ADD PRIMARY KEY (`idMatricula`), ADD KEY `fk_Matricula_AnioEscolar1_idx` (`idAnioEscolar`), ADD KEY `fk_Matricula_Usuario1_idx` (`idUsuario`);

--
-- Indices de la tabla `notasalumno`
--
ALTER TABLE `notasalumno`
 ADD PRIMARY KEY (`idMatricula`,`idComp`), ADD KEY `fk_Matricula_has_Notas_Matricula1_idx` (`idMatricula`), ADD KEY `fk_NotasAlumno_CursosGrado_has_Notas1_idx` (`idComp`);

--
-- Indices de la tabla `pago`
--
ALTER TABLE `pago`
 ADD PRIMARY KEY (`idpago`), ADD KEY `fk_pago_Usuario1_idx` (`idUsuario`), ADD KEY `fk_pago_Deuda1_idx` (`idDeuda`);

--
-- Indices de la tabla `periodos`
--
ALTER TABLE `periodos`
 ADD PRIMARY KEY (`idPeriodos`);

--
-- Indices de la tabla `recarga`
--
ALTER TABLE `recarga`
 ADD PRIMARY KEY (`idrecarga`), ADD KEY `fk_recarga_Usuario1_idx` (`idUsuario`), ADD KEY `fk_recarga_Matricula1_idx` (`idMatricula`);

--
-- Indices de la tabla `seccion`
--
ALTER TABLE `seccion`
 ADD PRIMARY KEY (`idSeccion`);

--
-- Indices de la tabla `sexo`
--
ALTER TABLE `sexo`
 ADD PRIMARY KEY (`idsexo`);

--
-- Indices de la tabla `temp`
--
ALTER TABLE `temp`
 ADD PRIMARY KEY (`idtemp`);

--
-- Indices de la tabla `tipoapoderado`
--
ALTER TABLE `tipoapoderado`
 ADD PRIMARY KEY (`idtipoApoderado`);

--
-- Indices de la tabla `tipodeuda`
--
ALTER TABLE `tipodeuda`
 ADD PRIMARY KEY (`idTipoDeuda`);

--
-- Indices de la tabla `tipogrado`
--
ALTER TABLE `tipogrado`
 ADD PRIMARY KEY (`idTipo`);

--
-- Indices de la tabla `tipoinsidencia`
--
ALTER TABLE `tipoinsidencia`
 ADD PRIMARY KEY (`idtipoInsidencia`);

--
-- Indices de la tabla `tipomatricula`
--
ALTER TABLE `tipomatricula`
 ADD PRIMARY KEY (`idtipomatricula`);

--
-- Indices de la tabla `tipousuario`
--
ALTER TABLE `tipousuario`
 ADD PRIMARY KEY (`idTipoUsuario`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
 ADD PRIMARY KEY (`idUsuario`), ADD KEY `fk_Usuario_TipoUsuario1_idx` (`idTipoUsuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `alumnos`
--
ALTER TABLE `alumnos`
MODIFY `idAlumnos` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=200;
--
-- AUTO_INCREMENT de la tabla `anioescolar`
--
ALTER TABLE `anioescolar`
MODIFY `idAnioEscolar` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT de la tabla `apoderado`
--
ALTER TABLE `apoderado`
MODIFY `idApoderado` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT de la tabla `asistencia`
--
ALTER TABLE `asistencia`
MODIFY `idasistencia` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `competencias`
--
ALTER TABLE `competencias`
MODIFY `idComp` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=61;
--
-- AUTO_INCREMENT de la tabla `cursos`
--
ALTER TABLE `cursos`
MODIFY `idCursos` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=20;
--
-- AUTO_INCREMENT de la tabla `deuda`
--
ALTER TABLE `deuda`
MODIFY `idDeuda` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=70;
--
-- AUTO_INCREMENT de la tabla `docente`
--
ALTER TABLE `docente`
MODIFY `idDocente` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `estados`
--
ALTER TABLE `estados`
MODIFY `idestados` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `grado`
--
ALTER TABLE `grado`
MODIFY `idGrado` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT de la tabla `historial`
--
ALTER TABLE `historial`
MODIFY `idhistorial` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `insidencias`
--
ALTER TABLE `insidencias`
MODIFY `idinsidencias` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `matricula`
--
ALTER TABLE `matricula`
MODIFY `idMatricula` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=65;
--
-- AUTO_INCREMENT de la tabla `pago`
--
ALTER TABLE `pago`
MODIFY `idpago` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `periodos`
--
ALTER TABLE `periodos`
MODIFY `idPeriodos` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT de la tabla `recarga`
--
ALTER TABLE `recarga`
MODIFY `idrecarga` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `seccion`
--
ALTER TABLE `seccion`
MODIFY `idSeccion` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT de la tabla `sexo`
--
ALTER TABLE `sexo`
MODIFY `idsexo` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `tipoapoderado`
--
ALTER TABLE `tipoapoderado`
MODIFY `idtipoApoderado` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT de la tabla `tipodeuda`
--
ALTER TABLE `tipodeuda`
MODIFY `idTipoDeuda` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `tipogrado`
--
ALTER TABLE `tipogrado`
MODIFY `idTipo` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `tipoinsidencia`
--
ALTER TABLE `tipoinsidencia`
MODIFY `idtipoInsidencia` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `tipomatricula`
--
ALTER TABLE `tipomatricula`
MODIFY `idtipomatricula` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT de la tabla `tipousuario`
--
ALTER TABLE `tipousuario`
MODIFY `idTipoUsuario` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
MODIFY `idUsuario` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `apoderado`
--
ALTER TABLE `apoderado`
ADD CONSTRAINT `fk_Apoderado_tipoApoderado1` FOREIGN KEY (`idtipoApoderado`) REFERENCES `tipoapoderado` (`idtipoApoderado`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `asigdocente`
--
ALTER TABLE `asigdocente`
ADD CONSTRAINT `fk_CursosGrado_AnioEscolar1` FOREIGN KEY (`idAnioEscolar`) REFERENCES `anioescolar` (`idAnioEscolar`) ON DELETE NO ACTION ON UPDATE NO ACTION,
ADD CONSTRAINT `fk_CursosGrado_Cursos1` FOREIGN KEY (`idCursos`) REFERENCES `cursos` (`idCursos`) ON DELETE NO ACTION ON UPDATE NO ACTION,
ADD CONSTRAINT `fk_CursosGrado_Docente1` FOREIGN KEY (`idDocente`) REFERENCES `docente` (`idDocente`) ON DELETE NO ACTION ON UPDATE NO ACTION,
ADD CONSTRAINT `fk_CursosGrado_Grado1` FOREIGN KEY (`idGrado`) REFERENCES `grado` (`idGrado`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `asistencia`
--
ALTER TABLE `asistencia`
ADD CONSTRAINT `fk_asistencia_Matricula1` FOREIGN KEY (`idMatricula`) REFERENCES `matricula` (`idMatricula`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `deuda`
--
ALTER TABLE `deuda`
ADD CONSTRAINT `fk_Deudas_Matricula1` FOREIGN KEY (`idMatricula`) REFERENCES `matricula` (`idMatricula`) ON DELETE NO ACTION ON UPDATE NO ACTION,
ADD CONSTRAINT `fk_Deudas_TipoDeuda1` FOREIGN KEY (`idTipoDeuda`) REFERENCES `tipodeuda` (`idTipoDeuda`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `grado`
--
ALTER TABLE `grado`
ADD CONSTRAINT `fk_Grado_Tipo1` FOREIGN KEY (`idTipo`) REFERENCES `tipogrado` (`idTipo`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `gradoseccion`
--
ALTER TABLE `gradoseccion`
ADD CONSTRAINT `fk_GradoSeccion_Grado1` FOREIGN KEY (`idGrado`) REFERENCES `grado` (`idGrado`) ON DELETE NO ACTION ON UPDATE NO ACTION,
ADD CONSTRAINT `fk_GradoSeccion_Seccion1` FOREIGN KEY (`idSeccion`) REFERENCES `seccion` (`idSeccion`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `historial`
--
ALTER TABLE `historial`
ADD CONSTRAINT `fk_historial_Usuario1` FOREIGN KEY (`idUsuario`) REFERENCES `usuario` (`idUsuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `matricula`
--
ALTER TABLE `matricula`
ADD CONSTRAINT `fk_Matricula_AnioEscolar1` FOREIGN KEY (`idAnioEscolar`) REFERENCES `anioescolar` (`idAnioEscolar`) ON DELETE NO ACTION ON UPDATE NO ACTION,
ADD CONSTRAINT `fk_Matricula_Usuario1` FOREIGN KEY (`idUsuario`) REFERENCES `usuario` (`idUsuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `notasalumno`
--
ALTER TABLE `notasalumno`
ADD CONSTRAINT `fkmatricula` FOREIGN KEY (`idMatricula`) REFERENCES `matricula` (`idMatricula`),
ADD CONSTRAINT `fk_NotasAlumno_Competencia` FOREIGN KEY (`idComp`) REFERENCES `competencias` (`idComp`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `pago`
--
ALTER TABLE `pago`
ADD CONSTRAINT `fk_pago_Deuda1` FOREIGN KEY (`idDeuda`) REFERENCES `deuda` (`idDeuda`) ON DELETE NO ACTION ON UPDATE NO ACTION,
ADD CONSTRAINT `fk_pago_Usuario1` FOREIGN KEY (`idUsuario`) REFERENCES `usuario` (`idUsuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `recarga`
--
ALTER TABLE `recarga`
ADD CONSTRAINT `fk_recarga_Matricula1` FOREIGN KEY (`idMatricula`) REFERENCES `matricula` (`idMatricula`) ON DELETE NO ACTION ON UPDATE NO ACTION,
ADD CONSTRAINT `fk_recarga_Usuario1` FOREIGN KEY (`idUsuario`) REFERENCES `usuario` (`idUsuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `usuario`
--
ALTER TABLE `usuario`
ADD CONSTRAINT `fk_Usuario_TipoUsuario1` FOREIGN KEY (`idTipoUsuario`) REFERENCES `tipousuario` (`idTipoUsuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
