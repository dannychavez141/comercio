SELECT fc.idfichacontrol,fc.nsesion,fc.nsemana,concat(d.nomb,' ',d.apepa,' ',d.apema) as ndocente, 
g.descr,s.descr,c.descr
FROM fichacontrol fc
left join docente d on fc.iddocente=d.idDocente
left join grado g on fc.idgrado=g.idGrado
left join seccion s on fc.idseccion=s.idSeccion
left join cursos c on fc.idCurso=c.idCursos
left join anioescolar a on fc.idanio=a.idAnioEscolar;
SELECT f.idficha,c.descr FROM fichacompetencia f
left join competencias c on f.idcompetencia=c.idComp;
SELECT f.idficha,f.idmatricula,concat(a.nomb,' ',a.apepa,' ',a.apema) as nalumno,f.participacion FROM fichamatriculados f
left join matricula m on f.idmatricula=m.idmatricula
left join alumnos a on m.dnialu=a.dni;
CREATE TABLE `evalpadre` (
  `idevalPadre` int(11) NOT NULL AUTO_INCREMENT,
  `decrEval` varchar(200) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `est` int(11) NOT NULL,
  PRIMARY KEY (`idevalPadre`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

INSERT INTO `evalpadre` (`decrEval`,`est`) VALUES ('El alumno asiste todos los dias a las clases.','1');
INSERT INTO `evalpadre` (`decrEval`,`est`) VALUES ('El alumno asiste puntualmente a las clases.','1');
INSERT INTO `evalpadre` (`decrEval`,`est`) VALUES ('El alumno participa en todos los dias en las clases con el uniforme escolar.','1');
INSERT INTO `evalpadre` (`decrEval`,`est`) VALUES ('El alumno participa en las clases correctamente aseado y peinado.','1');
INSERT INTO `evalpadre` (`decrEval`,`est`) VALUES ('El padre esta pendiente de que el alumno cumpla con todas sus tareas.','1');
INSERT INTO `evalpadre` (`decrEval`,`est`) VALUES ('El padre esta pendiente de que el alumno tenga todos sus materiales para trabajar.','1');
INSERT INTO `evalpadre` (`decrEval`,`est`) VALUES ('El padre esta pendiente de que el alumno tenga todos sus materiales en buen estado.','1');
INSERT INTO `evalpadre` (`decrEval`,`est`) VALUES ('El padre se encarga el alumno ingiera alimentos nutritivos antes de participar en las clases.','1');
INSERT INTO `evalpadre` (`decrEval`,`est`) VALUES ('El padre esta pendiende del desempeño escolar y consuslta  regularmente r a los docentes sobre la conducta del alumno.','1');
INSERT INTO `evalpadre` (`decrEval`,`est`) VALUES ('Participa en las reuuniones de padres de familia.','1');
INSERT INTO `evalpadre` (`decrEval`,`est`) VALUES ('Atiende las indicaciones y sugerencias del maestro.','1');
INSERT INTO `evalpadre` (`decrEval`,`est`) VALUES ('Asiste a los llamados cuando se requiere su presencia en la escuela.','1');