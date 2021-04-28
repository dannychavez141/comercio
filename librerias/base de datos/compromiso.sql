select * from compromisos c 
left join detallecomp dc on c.idcompromisos=dc.idcompromisos 
left join alumnos a on c.idAlumno=a.idAlumnos
left join apoderado ap on c.idApoderado= ap.idApoderado
where c.idcompromisos=''  