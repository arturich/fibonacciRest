<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
require_once('includes/db/DB_mysql.inc.php');
require_once('includes/info/Eventot.inc.php');
/**
 * Description of DB_Eventot
 *
 * @author Arturo
 */
class DB_Eventot {
    //put your code here



  /* Revisa si el objeto existe en la base de datos */
    function containsId($id_eventot)
    {
        if (!is_null($this->find($id_eventot)))
        return true;
        else
        return false;

    }

  /* Revisa si el objeto existe en la base de datos */
    function contains($eventot)

    {
        return contains($eventot->getId_eventot());

    }

  /* Actualiza el objeto en la base de datos */
    function merge($eventot)
    {

        if ($eventot->getId_eventot() != "")

        {

            $this->remove($eventot);
            $this->persist($eventot);



        }

        return true;
    }

  /* Elimina el objeto de la base de datos */
    function remove($eventot)
    {
        $db = new DB_mysql;

        $db->openConnection();
        $db->setAutocommit(false);

        if ($eventot->getId_eventot() != "")

        {
            //Eliminamos el objeto eventot
            // $db->executeUpdate("delete from programacion where id=".$eventot->getId_eventot().";");

        }

        $db->commit();
        $db->closeConnection();

        return true;




    }

  /* Hace persistente el objeto en la base de datos */
    function persist($eventot)

    {

        $db = new DB_mysql;

        $db->openConnection();

        $db->setAutocommit(false);


        if ($eventot->id_eventot != "")

        {
            //Si tenemos el id_eventot entonces insertamos todos los atributos

            $query_string = $eventot->id_eventot;

            $query_string = $query_string.",'".$eventot->nombre."'";

            $query_string = $query_string.",'".$eventot->apellidopat."'";

            $query_string = $query_string.",'".$eventot->apellidomat."'";

            $query_string = $query_string.",'".$eventot->correo."'";

            $query_string = $query_string.",'".$eventot->identificador."'";

            $query_string = $query_string.",'".$eventot->semestre."'";

            $query_string = $query_string.",'".$eventot->departamento."'";

            $query_string = $query_string.",'".$eventot->valencia."'";

            $query_string = $query_string.",'".$eventot->nombre_materia."'";

            $query_string = $query_string.",'".$eventot->no_grupo."'";

            $query_string = $query_string.",'".$eventot->crn."'";

            $query_string = $query_string.",'".$eventot->eventots_bb."'";

            $query_string = $query_string.",'".$eventot->tecdidacta."'";

            $query_string = $query_string.",'".$eventot->hora."'";

            $query_string = $query_string.",'".$eventot->duracion."'";

            $query_string = $query_string.",'".$eventot->dias."'";

            $query_string = $query_string.",'".$eventot->nomina."'";

            $query_string = $query_string.",'".$eventot->salon."'";

            //      $query_string = $query_string.",'".$eventot->cargo."'";
            //
            //      $query_string = $query_string.",'".$eventot->visitas."'";
            //
            //      $query_string = $query_string.",'".$eventot->fechainiciov."'";
            //
            //      $query_string = $query_string.",'".$eventot->fechafinv."'";
            //
            //      $query_string = $query_string.",'".$eventot->pass."'";
            //
            //	  $query_string = $query_string.",'".$eventot->usupla."'";




            $db->executeUpdate("insert into programacion values (".$query_string.");");


        }

        else

        {

            // Si no nos dan el id_eventot, entonces la bd usara el auto_increment para generar uno nuevo

            $query_string = "'".$eventot->nombre."'";

            $query_string = $query_string.",'".$eventot->apellidopat."'";

            $query_string = $query_string.",'".$eventot->apellidomat."'";

            $query_string = $query_string.",'".$eventot->correo."'";

            $query_string = $query_string.",'".$eventot->semestre."'";

            $query_string = $query_string.",'".$eventot->departamento."'";

            $query_string = $query_string.",'".$eventot->identificador."'";

            $query_string = $query_string.",'".$eventot->valencia."'";

            $query_string = $query_string.",'".$eventot->nombre_materia."'";

            $query_string = $query_string.",'".$eventot->no_grupo."'";

            $query_string = $query_string.",'".$eventot->crn."'";

            $query_string = $query_string.",'".$eventot->eventots_bb."'";

            $query_string = $query_string.",'".$eventot->tecdidacta."'";

            $query_string = $query_string.",'".$eventot->hora."'";

            $query_string = $query_string.",'".$eventot->duracion."'";

            $query_string = $query_string.",'".$eventot->dias."'";

            $query_string = $query_string.",'".$eventot->nomina."'";

            $query_string = $query_string.",'".$eventot->salon."'";

            //      $query_string = $query_string.",'".$eventot->cargo."'";
            //
            //      $query_string = $query_string.",'".$eventot->visitas."'";
            //
            //      $query_string = $query_string.",'".$eventot->fechainiciov."'";
            //
            //      $query_string = $query_string.",'".$eventot->fechafinv."'";
            //
            //      $query_string = $query_string.",'".$eventot->pass."'";
            //
            //	  $query_string = $query_string.",'".$eventot->usupla."'";




        $generatedkey = $db->executeUpdate("insert into programacion (nombre,apellidop,apellidom,email,semestre,departamento,identificador,valencia,nombre_materia,no_grupo, crn, eventots_bb, tecdidacta,hora,duracion,dias, nomina,salon) values (".$query_string.");");
            //obtenemos el id generado y lo asignamos al atributo del objeto
            if ($generatedkey > 0)
            $eventot->setId_eventot($generatedkey);

        }

        $db->commit();

        $db->closeConnection();

        return true;

    }


  /* Recupera un objeto de la base de datos */
    function find($eventot_id)

    {

        $db = new DB_mysql;

        $db->openConnection();

        $db->executeQuery("select * from programacion where id_eventot=".$eventot_id.";");

        $rs = $db->getResultSet();



        $eventot = new Eventot;

        $eventot->setId_eventot($rs[0][0]);

        $eventot->setDepartamento($rs[0][1]);

        $eventot->setIdentificador($rs[0][2]);

        $eventot->setSemestre($rs[0][3]);

        $eventot->setValencia($rs[0][4]);

        $eventot->setNombre_materia($rs[0][5]);

        $eventot->setNo_grupo($rs[0][6]);

        $eventot->setCrn($rs[0][7]);

        $eventot->setEventots_bb($rs[0][8]);

        $eventot->setTecdidacta($rs[0][9]);

        $eventot->setHora($rs[0][10]);

        $eventot->setDuracion($rs[0][11]);

        $eventot->setDias($rs[0][12]);

        $eventot->setNomina($rs[0][13]);

        $eventot->setApellidopat($rs[0][14]);

        $eventot->setApellidomat($rs[0][15]);

        $eventot->setNombre($rs[0][16]);

        $eventot->setCorreo($rs[0][17]);

        $eventot->setSalon($rs[0][18]);


        //    $eventot->setCargo($rs[0][19]);
        //
        //    $eventot->setVisitas($rs[0][20]);
        //
        //    $eventot->setFechainiciov($rs[0][21]);
        //
        //    $eventot->setFechafinv($rs[0][22]);
        //
        //    $eventot->setPass($rs[0][23]);
        //
        //    $eventot->setUsupla($rs[0][24]);




        $db->closeConnection();
        return $eventot;





    }

  /* Recupera todos los objetos de la base de datos */

    function findAll()

    {

        $db = new DB_mysql;

        $db->openConnection();

        $db->executeQuery("SELECT id_eventot, hora, dias, salon, duracion, semestre, apellidop, nombre_materia  FROM programacion;");

        $rs = $db->getResultSet();

        if(count($rs) == 0) {
            $db->closeConnection();
            return 0;
        }else{

            for ($counter = 0; $counter < count($rs); $counter++)
            {

                $eventot = new Eventot;

                $eventot->setId_eventot($rs[$counter][0]);

                $eventot->setHora($rs[$counter][1]);

                $eventot->setDias($rs[$counter][2]);

                $eventot->setSalon($rs[$counter][3]);

                $eventot->setDuracion($rs[$counter][4]);

                $eventot->setSemestre($rs[$counter][5]);

                $eventot->setApellidopat($rs[$counter][6]);

                $eventot->setNombre_materia($rs[$counter][7]);



                $eventotes[$counter] = $eventot;

            }

            $db->closeConnection();
            return $eventotes;

        }

    }


/* Recupera todos los objetos de la base de datos que sean de una X materia*/

    function findByX($revisa,$materia)

    {

        $db = new DB_mysql;

        $db->openConnection();

        $db->executeQuery("select* from programacion where $revisa ='$materia';");

        $rs = $db->getResultSet();


        for ($counter = 0; $counter < count($rs); $counter++)
        {

            $eventot = new Eventot;

            $eventot->setId_eventot($rs[0][0]);

            $eventot->setDepartamento($rs[0][1]);

            $eventot->setIdentificador($rs[0][2]);

            $eventot->setSemestre($rs[0][3]);

            $eventot->setValencia($rs[0][4]);

            $eventot->setNombre_materia($rs[0][5]);

            $eventot->setNo_grupo($rs[0][6]);

            $eventot->setCrn($rs[0][7]);

            $eventot->setEventots_bb($rs[0][8]);

            $eventot->setTecdidacta($rs[0][9]);

            $eventot->setHora($rs[0][10]);

            $eventot->setDuracion($rs[0][11]);

            $eventot->setDias($rs[0][12]);

            $eventot->setNomina($rs[0][13]);

            $eventot->setApellidopat($rs[0][14]);

            $eventot->setApellidomat($rs[0][15]);

            $eventot->setNombre($rs[0][16]);

            $eventot->setCorreo($rs[0][17]);

            $eventot->setSalon($rs[0][18]);


            $eventots[$counter] = $eventot;
        }

        $db->closeConnection();
        return $eventots;

    }

  /* Recupera algunos objetos de la base de datos
  se da un offset o desplazamiento y un numero de items
  de manera que si estamos paginando de 10 en 10 y queremos
  la 4a pagina, tendriamos que decir 31,10
   */
    function findSome($offset, $items)

    {

        $db = new DB_mysql;

        $db->openConnection();

        $db->executeQuery("select id_eventot,nombre from programacion limit ".$offset.",".$items.";");

        $rs = $db->getResultSet();

        for ($counter = 0; $counter < count($rs); $counter++)
        {

            $eventot = new Eventot;

            $eventot->setId_eventot($rs[$counter][0]);

            $eventot->setNombre($rs[$counter][1]);

            $eventots[$counter] = $eventot;

        }

        $db->closeConnection();

        return $eventots;





    }


    function findAcumMat($materia, $nombre)

    {

        $db = new DB_mysql;

        $db->openConnection();

        $db->executeQuery("SELECT COUNT(*) FROM programacion WHERE $materia = '$nombre' ;");

        $rs = $db->getResultSet();


        $db->closeConnection();
        return $rs[0][0];

    }


    function findTuroresByPref($materia, $nombre)

    {

        $db = new DB_mysql;

        $tutures = NULL;

        $db->openConnection();

        $db->executeQuery("SELECT identificador, nombre, apellidopat, apellidomat, departamento, semestre, email, id  FROM eventotes WHERE $materia = '$nombre' ;");

        $rs = $db->getResultSet();

        if(count($rs) == 0) {
            $db->closeConnection();
            return 0;
        }else{

            for ($counter = 0; $counter < count($rs); $counter++)
            {

                $eventot = new Eventot;

                $eventot->setIdentificador($rs[$counter][0]);

                $eventot->setNombre($rs[$counter][1]);

                $eventot->setApellidopat($rs[$counter][2]);

                $eventot->setApellidomat($rs[$counter][3]);

                $eventot->setDepartamento($rs[$counter][4]);

                $eventot->setSemestre($rs[$counter][5]);

                $eventot->setCorreo($rs[$counter][6]);

                $eventot->setId_eventot($rs[$counter][7]);



                $eventotes[$counter] = $eventot;

            }

            $db->closeConnection();
            return $eventotes;

        }

    }


    function findTuroresByWHAT($materia, $nombre)

    {

        $db = new DB_mysql;

        $tutures = NULL;

        $db->openConnection();

        $db->executeQuery("SELECT identificador, nombre, apellidopat, apellidomat, departamento, semestre, emailop FROM eventotes WHERE $materia = '$nombre' ;");

        $rs = $db->getResultSet();


        for ($counter = 0; $counter < count($rs); $counter++)
        {

            $eventot = new Eventot;

            $eventot->setId_eventot($rs[0][0]);

            $eventot->setNombre($rs[0][1]);

            $eventot->setApellidopat($rs[0][2]);

            $eventot->setApellidomat($rs[0][3]);

            $eventot->setSemestre($rs[0][4]);

            $eventot->setDepartamento($rs[0][5]);

            $eventot->setIdentificador($rs[0][6]);

            $eventot->setValencia($rs[0][7]);

            $eventot->setCorreo($rs[0][8]);

            $eventot->setNombre_materia($rs[0][9]);

            $eventot->setNo_grupo($rs[0][10]);

            $eventot->setCrn($rs[0][11]);

            $eventot->setEventots_bb($rs[0][12]);

            $eventot->setTecdidacta($rs[0][13]);

            $eventot->setHora($rs[0][14]);

            $eventot->setDuracion($rs[0][15]);

            $eventot->setDias($rs[0][16]);

            $eventot->setNomina($rs[0][17]);

            $eventot->setSalon($rs[0][18]);

            $eventot->setCargo($rs[0][19]);

            $eventot->setVisitas($rs[0][20]);

            $eventot->setFechainiciov($rs[0][21]);

            $eventot->setFechafinv($rs[0][22]);

            $eventot->setPass($rs[0][23]);

            $eventot->setUsupla($rs[0][24]);

            $eventotes[$counter] = $eventot;

        }

        $db->closeConnection();
        return $eventotes;



    }

    function actualiza($eventot)

    {

        $db = new DB_mysql;

        $db->openConnection();


        //  $db->executeQuery("UPDATE programacion SET nombre = '$eventot->nombre',apellidop = '$eventot->apellidopat',apellidom= '$eventot->apellidomat',email='$eventot->correo',semestre='$eventot->semestre',departamento='$eventot->departamento',identificador='$eventot->identificador',valencia='$eventot->valencia',nombre_materia='$eventot->nombre_materia',no_grupo='$eventot->no_grupo', crn='$eventot->crn', eventots_bb='$eventot->eventots_bb', tecdidacta='$eventot->tecdidacta',hora='$eventot->hora',duracion='$eventot->duracion',dias='$eventot->dias', salon='$eventot->salon',cargo='$eventot->cargo',visitas='$eventot->visitas'  WHERE id_eventot = $eventot->id_eventot ;");

        $db->closeConnection();

        return true;

    }



    function derriba()

    {

        $db = new DB_mysql;

        $db->openConnection();

        $db->setAutocommit(false);

        //$db->executeQuery("TRUNCATE TABLE programacion;");

        $db->commit();

        $db->closeConnection();
        return true;

    }
    

  /* Para reservar primero guardamos el motivo, de ahi es referenciado */
  //Lo utilizo en reserva.php
    function persist_motivo($justificacion,$nomatri, $f_solicitud,$h_ini,$h_fin,$bq)
    {

        $db = new DB_mysql;

        $db->openConnection();

        $db->setAutocommit(false);
        
        $generatedkey = $db->executeUpdate("INSERT INTO motivo (justificacion, id_nom_mat, fecha_solicitud,hora_inicio,hora_fin,bloques) values ('$justificacion','$nomatri','$f_solicitud','$h_ini','$h_fin',$bq);");


        $db->commit();

        $db->closeConnection();

            if ($generatedkey > 0)
				return $generatedkey;
			else
				return	false;

    }
    

  /* Para reservar primero guardamos el motivo, de ahi es referenciado */
    function persist_reserva($space,$halfa,$day,$date,$mot,$estatus)
    {

        $db = new DB_mysql;

        $db->openConnection();

        $db->setAutocommit(false);
        
        $generatedkey = $db->executeUpdate("INSERT INTO eventot (idespacio, mediahora, dia, fechaevento, idmotivo, status) values ('$space','$halfa','$day','$date',$mot,$estatus);");

        $db->commit();

        $db->closeConnection();

            if ($generatedkey > 0)
				return $generatedkey;
			else
				return	false;

    }
    
   //Guarda en la base de datos la informacion de la entrega oportuna
    function persist_agenda($idmotivo, $responsable, $correo, $extension, $departamento, $descripcion, $audiencia, $nombre, $pantallas){
        
        $db = new DB_mysql;

        $db->openConnection();

        $db->setAutocommit(false);

        $generatedkey = $db->executeUpdate("INSERT INTO agenda (idmotivo, responsable, correo, extension, departamento, descripcion, audiencia, nombre, pantallas) values ('$idmotivo','$responsable','$correo', '$extension', '$departamento','$descripcion','$audiencia','$nombre','$pantallas');");

        $db->commit();

        $db->closeConnection();

            if ($generatedkey > 0)
				return $generatedkey;
			else
				return	false;

   }
   
//Método que nos entrega las autorizaciones para un determinado edificio, esto es todas aquellas con status 1.
//edificio debe tener cualquier ade los siguientes valores: 1 ,2 ó 3
    function autorizaciones($edificio)

    {

        $db = new DB_mysql;

        $tutures = NULL;

        $db->openConnection();

        $db->executeQuery('SELECT DISTINCT(e.idmotivo), fechaevento, dia, idespacio,fecha_solicitud,id_nom_mat,hora_inicio,hora_fin,justificacion FROM eventot e, motivo m WHERE (status = 1) AND (idespacio LIKE "%PUE-A'.$edificio.'%") AND (m.idmotivo = e.idmotivo) ORDER BY fecha_solicitud ASC');

        $rs = $db->getResultSet();


        for ($counter = 0; $counter < count($rs); $counter++)
        {

            $eventot = new Eventot;

            $eventot->setIdEventot($rs[$counter][0]);

            $eventot->setFechaEvento($rs[$counter][1]);

            $eventot->setDia($rs[$counter][2]);

            $eventot->setIdEspacio($rs[$counter][3]);

            $eventot->setFechaSolicitud($rs[$counter][4]);

            $eventot->setIdSolicitante($rs[$counter][5]);

            $eventot->setH_ini($rs[$counter][6]);

            $eventot->setH_fin($rs[$counter][7]);

            $eventot->setMotivosEvento($rs[$counter][8]);

            $eventotes[$counter] = $eventot;

        }

        $db->closeConnection();
        return $eventotes;



    }
    

 function autorizaciones_limites($edificio,$inicio,$items)

    {

        $db = new DB_mysql;

        $tutures = NULL;

        $db->openConnection();

        $db->executeQuery('SELECT DISTINCT(e.idmotivo), fechaevento, dia, idespacio,fecha_solicitud,id_nom_mat,hora_inicio,hora_fin,justificacion FROM eventot e, motivo m WHERE (status = 1) AND (idespacio LIKE "%PUE-A'.$edificio.'%") AND (m.idmotivo = e.idmotivo) ORDER BY fecha_solicitud DESC LIMIT '.$inicio.','.$items);

        $rs = $db->getResultSet();
        
        
        if(count($rs) == 0) {
					$db->closeConnection();
					return 0;
	}else{


        for ($counter = 0; $counter < count($rs); $counter++)
        {

            $eventot = new Eventot;

            $eventot->setIdEventot($rs[$counter][0]);

            $eventot->setFechaEvento($rs[$counter][1]);

            $eventot->setDia($rs[$counter][2]);

            $eventot->setIdEspacio($rs[$counter][3]);

            $eventot->setFechaSolicitud($rs[$counter][4]);

            $eventot->setIdSolicitante($rs[$counter][5]);

            $eventot->setH_ini($rs[$counter][6]);

            $eventot->setH_fin($rs[$counter][7]);

            $eventot->setMotivosEvento($rs[$counter][8]);

            $eventotes[$counter] = $eventot;

        }
	 }
        $db->closeConnection();
        return $eventotes;



    }

/** Método en el cual muestros las autorizaciones que on sean en edificios, que sean en cualquier otra cosa **/
    function autorizaciones_dif()
    {

        $db = new DB_mysql;

        $tutures = NULL;

        $db->openConnection();

        $db->executeQuery('SELECT DISTINCT(e.idmotivo), fechaevento, dia, idespacio,fecha_solicitud,id_nom_mat,hora_inicio,hora_fin,justificacion FROM eventot e, motivo m WHERE (status = 1) AND (idespacio NOT IN ( SELECT DISTINCT  idespacio 
FROM eventot e 
WHERE (status = 1) AND ( (idespacio LIKE "%PUE-A1%") OR (idespacio LIKE "%PUE-A2%") OR (idespacio LIKE "%PUE-A3%") ) ) ) AND (m.idmotivo = e.idmotivo) ORDER BY fecha_solicitud ASC');

        $rs = $db->getResultSet();


        for ($counter = 0; $counter < count($rs); $counter++)
        {

            $eventot = new Eventot;

            $eventot->setIdEventot($rs[$counter][0]);

            $eventot->setFechaEvento($rs[$counter][1]);

            $eventot->setDia($rs[$counter][2]);

            $eventot->setIdEspacio($rs[$counter][3]);

            $eventot->setFechaSolicitud($rs[$counter][4]);

            $eventot->setIdSolicitante($rs[$counter][5]);

            $eventot->setH_ini($rs[$counter][6]);

            $eventot->setH_fin($rs[$counter][7]);

            $eventot->setMotivosEvento($rs[$counter][8]);

            $eventotes[$counter] = $eventot;

        }

        $db->closeConnection();
        return $eventotes;



    }
    

 function autorizaciones_dif_limites($inicio,$items)

    {

        $db = new DB_mysql;

        $tutures = NULL;

        $db->openConnection();

        $db->executeQuery('SELECT DISTINCT(e.idmotivo), fechaevento, dia, idespacio,fecha_solicitud,id_nom_mat,hora_inicio,hora_fin,justificacion FROM eventot e, motivo m WHERE (status = 1) AND (idespacio NOT IN ( SELECT DISTINCT  idespacio 
FROM eventot e 
WHERE (status = 1) AND ( (idespacio LIKE "%PUE-A1%") OR (idespacio LIKE "%PUE-A2%") OR (idespacio LIKE "%PUE-A3%") ) ) ) AND (m.idmotivo = e.idmotivo) ORDER BY fecha_solicitud DESC LIMIT '.$inicio.','.$items);

        $rs = $db->getResultSet();
        
        
        if(count($rs) == 0) {
					$db->closeConnection();
					return 0;
	}else{


        for ($counter = 0; $counter < count($rs); $counter++)
        {

            $eventot = new Eventot;

            $eventot->setIdEventot($rs[$counter][0]);

            $eventot->setFechaEvento($rs[$counter][1]);

            $eventot->setDia($rs[$counter][2]);

            $eventot->setIdEspacio($rs[$counter][3]);

            $eventot->setFechaSolicitud($rs[$counter][4]);

            $eventot->setIdSolicitante($rs[$counter][5]);

            $eventot->setH_ini($rs[$counter][6]);

            $eventot->setH_fin($rs[$counter][7]);

            $eventot->setMotivosEvento($rs[$counter][8]);

            $eventotes[$counter] = $eventot;

        }
	 }
        $db->closeConnection();
        return $eventotes;



    }
    

//Función que utilizo en el ax_autorize para cambiar el tipo de autorización.
    function cambia_autorizacion($idmoty,$stat)

    {
    	$vl = 0;

        $db = new DB_mysql;

        $db->openConnection();
							//id_nom_mat se refiere a la Nómina o bien a la Matricula.
        $vl = $db->executeQuery("UPDATE eventot SET status = '$stat' WHERE idmotivo = '$idmoty' ;");


        $db->closeConnection();
        
        return $vl;

    }

//Función que utilizo en el ax_autorize para cambiar el tipo de autorización.
    function agrega_justificacion($idmoty,$justi)

    {
    	$vl = 0;

        $db = new DB_mysql;

        $db->openConnection();
							//id_nom_mat se refiere a la Nómina o bien a la Matricula.
        $vl = $db->executeQuery("UPDATE motivo SET comentario = '$justi' WHERE idmotivo = '$idmoty' ;");


        $db->closeConnection();
        
        return $vl;

    }
    

/*
*	Este método lo utilizo en mireservacion.php para consultar el total de pendientes
*	que se registran, de manera
*
*	@Author 
*
*
**/
    function pendientes($userid)

    {

        $db = new DB_mysql;

        $tutures = NULL;

        $db->openConnection();

        $db->executeQuery('SELECT DISTINCT(e.idmotivo), fechaevento, dia, idespacio,fecha_solicitud,id_nom_mat,hora_inicio,hora_fin,justificacion FROM eventot e, motivo m WHERE (status = 1) AND (id_nom_mat LIKE "'.$userid.'") AND (m.idmotivo = e.idmotivo) ORDER BY fecha_solicitud ASC');

        $rs = $db->getResultSet();


        for ($counter = 0; $counter < count($rs); $counter++)
        {

            $eventot = new Eventot;

            $eventot->setIdEventot($rs[$counter][0]);

            $eventot->setFechaEvento($rs[$counter][1]);

            $eventot->setDia($rs[$counter][2]);

            $eventot->setIdEspacio($rs[$counter][3]);

            $eventot->setFechaSolicitud($rs[$counter][4]);

            $eventot->setIdSolicitante($rs[$counter][5]);

            $eventot->setH_ini($rs[$counter][6]);

            $eventot->setH_fin($rs[$counter][7]);

            $eventot->setMotivosEvento($rs[$counter][8]);

            $eventotes[$counter] = $eventot;

        }

        $db->closeConnection();
        return $eventotes;



    }
    

    
 function pendientes_limites($userid,$inicio,$items)

    {

        $db = new DB_mysql;

        $tutures = NULL;

        $db->openConnection();

        $db->executeQuery('SELECT DISTINCT(e.idmotivo), fechaevento, dia, idespacio,fecha_solicitud,id_nom_mat,hora_inicio,hora_fin,justificacion FROM eventot e, motivo m WHERE (status = 1) AND (id_nom_mat LIKE "'.$userid.'") AND (m.idmotivo = e.idmotivo) ORDER BY fecha_solicitud ASC LIMIT '.$inicio.','.$items);

        $rs = $db->getResultSet();
        
        
        if(count($rs) == 0) {
					$db->closeConnection();
					return 0;
	}else{


        for ($counter = 0; $counter < count($rs); $counter++)
        {

            $eventot = new Eventot;

            $eventot->setIdEventot($rs[$counter][0]);

            $eventot->setFechaEvento($rs[$counter][1]);

            $eventot->setDia($rs[$counter][2]);

            $eventot->setIdEspacio($rs[$counter][3]);

            $eventot->setFechaSolicitud($rs[$counter][4]);

            $eventot->setIdSolicitante($rs[$counter][5]);

            $eventot->setH_ini($rs[$counter][6]);

            $eventot->setH_fin($rs[$counter][7]);

            $eventot->setMotivosEvento($rs[$counter][8]);

            $eventotes[$counter] = $eventot;

        }
	 }
        $db->closeConnection();
        return $eventotes;



    }

/*
*	Este método lo utilizo en mireservacion.php para consultar el total de pendientes
*	que se registran, de manera
*
*	@Author 
*
*
**/
    function pasados($userid)

    {

        $db = new DB_mysql;

        $tutures = NULL;

        $db->openConnection();

        $db->executeQuery('SELECT DISTINCT(e.idmotivo), fechaevento, dia, idespacio,fecha_solicitud,id_nom_mat,hora_inicio,hora_fin,justificacion,status FROM eventot e, motivo m WHERE (status <> 1) AND (id_nom_mat LIKE "'.$userid.'") AND (m.idmotivo = e.idmotivo) AND (str_to_date( fechaevento, "%m/%d/%Y" ) < str_to_date( "'.date("m/d/y").'", "%m/%d/%Y" )) 
 UNION
    SELECT DISTINCT(e.idmotivo), fechaevento, dia, idespacio,fecha_solicitud,id_nom_mat,hora_inicio,hora_fin,justificacion,status FROM eventot e, motivo m WHERE (status > 2) AND (id_nom_mat LIKE "'.$userid.'") AND (m.idmotivo = e.idmotivo) AND (str_to_date( fechaevento, "%m/%d/%Y" ) >= str_to_date( "'.date("m/d/y").'", "%m/%d/%Y" ))');

        $rs = $db->getResultSet();


        for ($counter = 0; $counter < count($rs); $counter++)
        {

            $eventot = new Eventot;

            $eventot->setIdEventot($rs[$counter][0]);

            $eventot->setFechaEvento($rs[$counter][1]);

            $eventot->setDia($rs[$counter][2]);

            $eventot->setIdEspacio($rs[$counter][3]);

            $eventot->setFechaSolicitud($rs[$counter][4]);

            $eventot->setIdSolicitante($rs[$counter][5]);

            $eventot->setH_ini($rs[$counter][6]);

            $eventot->setH_fin($rs[$counter][7]);

            $eventot->setMotivosEvento($rs[$counter][8]);
            
            $eventot->setStatus($rs[$counter][9]);

            $eventotes[$counter] = $eventot;

        }

        $db->closeConnection();
        return $eventotes;



    }
    
 function pasados_limites($userid,$inicio,$items)

    {

        $db = new DB_mysql;

        $tutures = NULL;

        $db->openConnection();

        $db->executeQuery('SELECT DISTINCT(e.idmotivo), fechaevento, dia, idespacio,fecha_solicitud,id_nom_mat,hora_inicio,hora_fin,justificacion,status FROM eventot e, motivo m WHERE (status <> 1) AND (id_nom_mat LIKE "'.$userid.'") AND (m.idmotivo = e.idmotivo) AND (str_to_date( fechaevento, "%m/%d/%Y" ) < str_to_date( "'.date("m/d/y").'", "%m/%d/%Y" )) 
        UNION
    SELECT DISTINCT(e.idmotivo), fechaevento, dia, idespacio,fecha_solicitud,id_nom_mat,hora_inicio,hora_fin,justificacion,status FROM eventot e, motivo m WHERE (status > 2) AND (id_nom_mat LIKE "'.$userid.'") AND (m.idmotivo = e.idmotivo) AND (str_to_date( fechaevento, "%m/%d/%Y" ) >= str_to_date( "'.date("m/d/y").'", "%m/%d/%Y" )) 	ORDER BY fecha_solicitud ASC LIMIT '.$inicio.','.$items);

        $rs = $db->getResultSet();
        
        
        if(count($rs) == 0) {
					$db->closeConnection();
					return 0;
	}else{


        for ($counter = 0; $counter < count($rs); $counter++)
        {

            $eventot = new Eventot;

            $eventot->setIdEventot($rs[$counter][0]);

            $eventot->setFechaEvento($rs[$counter][1]);

            $eventot->setDia($rs[$counter][2]);

            $eventot->setIdEspacio($rs[$counter][3]);

            $eventot->setFechaSolicitud($rs[$counter][4]);

            $eventot->setIdSolicitante($rs[$counter][5]);

            $eventot->setH_ini($rs[$counter][6]);

            $eventot->setH_fin($rs[$counter][7]);

            $eventot->setMotivosEvento($rs[$counter][8]);
            
            $eventot->setStatus($rs[$counter][9]);

            $eventotes[$counter] = $eventot;

        }
	 }
        $db->closeConnection();
        return $eventotes;



    }
    

/**
 *	Este método lo utilizo en mireservacion.php para consultar el total de reservaciones pendientes pero que 
 *	ya fueron autorizadas, estas reservaciones tambien las podria cancelar, porque no han pasado
 *	
 *
 *	@Author arturich
 *
 *
 **/
    function acept_pend($userid)

    {

        $db = new DB_mysql;

        $tutures = NULL;

        $db->openConnection();

        $db->executeQuery('SELECT DISTINCT(e.idmotivo), fechaevento, dia, idespacio,fecha_solicitud,id_nom_mat,hora_inicio,hora_fin,justificacion FROM eventot e, motivo m WHERE (status = 2) AND (id_nom_mat LIKE "'.$userid.'") AND (m.idmotivo = e.idmotivo) AND (str_to_date( fechaevento, "%m/%d/%Y" ) >= str_to_date( "'.date("m/d/y").'", "%m/%d/%Y" ))ORDER BY fecha_solicitud ASC ');

        $rs = $db->getResultSet();


        for ($counter = 0; $counter < count($rs); $counter++)
        {

            $eventot = new Eventot;

            $eventot->setIdEventot($rs[$counter][0]);

            $eventot->setFechaEvento($rs[$counter][1]);

            $eventot->setDia($rs[$counter][2]);

            $eventot->setIdEspacio($rs[$counter][3]);

            $eventot->setFechaSolicitud($rs[$counter][4]);

            $eventot->setIdSolicitante($rs[$counter][5]);

            $eventot->setH_ini($rs[$counter][6]);

            $eventot->setH_fin($rs[$counter][7]);

            $eventot->setMotivosEvento($rs[$counter][8]);

            $eventotes[$counter] = $eventot;

        }

        $db->closeConnection();
        return $eventotes;



    }

    function acept_pend_limites($userid,$inicio,$items)

    {

        $db = new DB_mysql;

        $tutures = NULL;

        $db->openConnection();

        $db->executeQuery('SELECT DISTINCT(e.idmotivo), fechaevento, dia, idespacio,fecha_solicitud,id_nom_mat,hora_inicio,hora_fin,justificacion FROM eventot e, motivo m WHERE (status = 2) AND (id_nom_mat LIKE "'.$userid.'") AND (m.idmotivo = e.idmotivo) AND (str_to_date( fechaevento, "%m/%d/%Y" ) >= str_to_date( "'.date("m/d/y").'", "%m/%d/%Y" )) ORDER BY str_to_date( fechaevento, "%m/%d/%Y" ) ASC LIMIT '.$inicio.','.$items);

        $rs = $db->getResultSet();


        for ($counter = 0; $counter < count($rs); $counter++)
        {

            $eventot = new Eventot;

            $eventot->setIdEventot($rs[$counter][0]);

            $eventot->setFechaEvento($rs[$counter][1]);

            $eventot->setDia($rs[$counter][2]);

            $eventot->setIdEspacio($rs[$counter][3]);

            $eventot->setFechaSolicitud($rs[$counter][4]);

            $eventot->setIdSolicitante($rs[$counter][5]);

            $eventot->setH_ini($rs[$counter][6]);

            $eventot->setH_fin($rs[$counter][7]);

            $eventot->setMotivosEvento($rs[$counter][8]);

            $eventotes[$counter] = $eventot;

        }

        $db->closeConnection();
        return $eventotes;



    }
    

/*
*	Este método lo utilizo en ax_autorice.php, cuando es necesario enviarle al fulano que reservo la confirmación de que 
*	ya puede utilizar el salon. con los datos de la misma en el correo
*	@Author 
*
*
**/
    function obten_datareser($idmota)

    {

        $db = new DB_mysql;

        $db->openConnection();

        $db->executeQuery('SELECT e.idmotivo, fechaevento, dia, idespacio,fecha_solicitud,id_nom_mat,hora_inicio,hora_fin,justificacion,bloques FROM eventot e, motivo m WHERE (e.idmotivo = '.$idmota.') AND (m.idmotivo = e.idmotivo) LIMIT 0,1;');

        $rs = $db->getResultSet();


            $eventoty = new Eventot;

            $eventoty->setIdEventot($rs[0][0]);

            $eventoty->setFechaEvento($rs[0][1]);

            $eventoty->setDia($rs[0][2]);

            $eventoty->setIdEspacio($rs[0][3]);

            $eventoty->setFechaSolicitud($rs[0][4]);

            $eventoty->setIdSolicitante($rs[0][5]);

            $eventoty->setH_ini($rs[0][6]);

            $eventoty->setH_fin($rs[0][7]);

            $eventoty->setMotivosEvento($rs[0][8]);
            
            $eventoty->setMediaHora($rs[0][9]);



        $db->closeConnection();
        return $eventoty;



    }
    
    function obten_correo ($idmoto){
		

        $db = new DB_mysql;

        $db->openConnection();

        $db->executeQuery('SELECT correo FROM `motivo` m, correo c WHERE (m.`id_nom_mat` = c.`id_nom_mat`) AND (`idmotivo`='.$idmoto.') LIMIT 0,1;');

        $rs = $db->getResultSet();
        
        if( count($rs) == 0 )
        	$correo = "";
        else
			$correo = ($rs[0][0]);

        $db->closeConnection();
        return $correo;

		
	}

//Éste metodo se centra en buscar los eventos y espacios se llevaran acabo en un determinado edificio y en una determinada
//fecha, vale la pena mencionar que son eventos que han sido autorizados previamente unicamente los que se despliegan 
    function agenda($edificio,$fecha)

    {

        $db = new DB_mysql;

        $tutures = NULL;

        $db->openConnection();

        $db->executeQuery('SELECT DISTINCT(e.idmotivo), fechaevento, dia, idespacio,fecha_solicitud,id_nom_mat,hora_inicio,hora_fin,justificacion FROM eventot e, motivo m WHERE (status = 2) AND (idespacio LIKE "%PUE-A'.$edificio.'%") AND (m.idmotivo = e.idmotivo) AND (str_to_date( fechaevento, "%m/%d/%Y" )  = str_to_date( "'.$fecha.'", "%m/%d/%Y" )) ORDER BY hora_inicio ASC');

        $rs = $db->getResultSet();


        for ($counter = 0; $counter < count($rs); $counter++)
        {

            $eventot = new Eventot;

            $eventot->setIdEventot($rs[$counter][0]);

            $eventot->setFechaEvento($rs[$counter][1]);

            $eventot->setDia($rs[$counter][2]);

            $eventot->setIdEspacio($rs[$counter][3]);

            $eventot->setFechaSolicitud($rs[$counter][4]);

            $eventot->setIdSolicitante($rs[$counter][5]);

            $eventot->setH_ini($rs[$counter][6]);

            $eventot->setH_fin($rs[$counter][7]);

            $eventot->setMotivosEvento($rs[$counter][8]);

            $eventotes[$counter] = $eventot;

        }

        $db->closeConnection();
        return $eventotes;



    }
    

function agenda_dif($fecha)

    {

        $db = new DB_mysql;

        $tutures = NULL;

        $db->openConnection();

        $db->executeQuery('SELECT DISTINCT(e.idmotivo), fechaevento, dia, idespacio,fecha_solicitud,id_nom_mat,hora_inicio,hora_fin,justificacion FROM eventot e, motivo m WHERE (status = 2) AND (idespacio NOT IN ( SELECT DISTINCT  idespacio 
FROM eventot e 
WHERE (status = 2) AND ( (idespacio LIKE "%PUE-A1%") OR (idespacio LIKE "%PUE-A2%") OR (idespacio LIKE "%PUE-A4%") OR (idespacio LIKE "%MUSEO%") OR (idespacio LIKE "%CANCHA%") OR (idespacio LIKE "%PASILLO%") OR (idespacio LIKE "%PUE-A3%") ) )) AND (m.idmotivo = e.idmotivo) AND (fechaevento = "'.$fecha.'") ORDER BY hora_inicio ASC');

        $rs = $db->getResultSet();


        for ($counter = 0; $counter < count($rs); $counter++)
        {

            $eventot = new Eventot;

            $eventot->setIdEventot($rs[$counter][0]);

            $eventot->setFechaEvento($rs[$counter][1]);

            $eventot->setDia($rs[$counter][2]);

            $eventot->setIdEspacio($rs[$counter][3]);

            $eventot->setFechaSolicitud($rs[$counter][4]);

            $eventot->setIdSolicitante($rs[$counter][5]);

            $eventot->setH_ini($rs[$counter][6]);

            $eventot->setH_fin($rs[$counter][7]);

            $eventot->setMotivosEvento($rs[$counter][8]);

            $eventotes[$counter] = $eventot;

        }

        $db->closeConnection();
        return $eventotes;



    }

    function agenda_especific($identificador,$fecha)

    {

        $db = new DB_mysql;

        $tutures = NULL;

        $db->openConnection();

        $db->executeQuery('SELECT DISTINCT(e.idmotivo), fechaevento, dia, idespacio,fecha_solicitud,id_nom_mat,hora_inicio,hora_fin,justificacion FROM eventot e, motivo m WHERE (status = 2) AND (idespacio LIKE "%'.$identificador.'%") AND (m.idmotivo = e.idmotivo) AND (str_to_date( fechaevento, "%m/%d/%Y" )  = str_to_date( "'.$fecha.'", "%m/%d/%Y" )) ORDER BY hora_inicio ASC');

        $rs = $db->getResultSet();


        for ($counter = 0; $counter < count($rs); $counter++)
        {

            $eventot = new Eventot;

            $eventot->setIdEventot($rs[$counter][0]);

            $eventot->setFechaEvento($rs[$counter][1]);

            $eventot->setDia($rs[$counter][2]);

            $eventot->setIdEspacio($rs[$counter][3]);

            $eventot->setFechaSolicitud($rs[$counter][4]);

            $eventot->setIdSolicitante($rs[$counter][5]);

            $eventot->setH_ini($rs[$counter][6]);

            $eventot->setH_fin($rs[$counter][7]);

            $eventot->setMotivosEvento($rs[$counter][8]);

            $eventotes[$counter] = $eventot;

        }

        $db->closeConnection();
        return $eventotes;



    }

function agenda_dif_eve($fecha)

    {

        $db = new DB_mysql;

        $db->openConnection();

        $db->executeQuery('SELECT DISTINCT(e.idmotivo), fechaevento, dia, idespacio,fecha_solicitud,id_nom_mat,hora_inicio,hora_fin,justificacion,  a.responsable, a.correo, a.descripcion, a.audiencia, a.nombre, a.extension, a.departamento, 	a.pantallas FROM eventot e, motivo m, agenda a WHERE (status = 2) AND (idespacio NOT IN ( SELECT DISTINCT  idespacio 
FROM eventot e 
WHERE (status = 2) AND ( (idespacio LIKE "%PUE-A1%") OR (idespacio LIKE "%PUE-A2%") OR (idespacio LIKE "%PUE-A3%") ) )) AND (m.idmotivo = a.idmotivo) AND (m.idmotivo = e.idmotivo) AND (fechaevento = "'.$fecha.'") ORDER BY hora_inicio ASC');

        $rs = $db->getResultSet();


        for ($counter = 0; $counter < count($rs); $counter++)
        {

             $eventot = new Eventot;

            $eventot->setIdEventot($rs[$counter][0]);

            $eventot->setFechaEvento($rs[$counter][1]);

            $eventot->setDia($rs[$counter][2]);

            $eventot->setIdEspacio($rs[$counter][3]);

            $eventot->setFechaSolicitud($rs[$counter][4]);

            $eventot->setIdSolicitante($rs[$counter][5]);

            $eventot->setH_ini($rs[$counter][6]);

            $eventot->setH_fin($rs[$counter][7]);

            $eventot->setMotivosEvento($rs[$counter][8]);

            $eventot->setResponsable($rs[$counter][9]);

            $eventot->setCorreo($rs[$counter][10]);

            $eventot->setDescripcion($rs[$counter][11]);

            $eventot->setAudiencia($rs[$counter][12]);

            $eventot->setNombre($rs[$counter][13]);

            $eventot->setExtension($rs[$counter][14]);

            $eventot->setDepartamento($rs[$counter][15]);

            $eventot->setPantallas($rs[$counter][16]);


            $eventotes[$counter] = $eventot;

        }

        $db->closeConnection();
        return $eventotes;



    }

//Éste metodo se centra en buscar los eventos y espacios se llevaran acabo en un determinado edificio y en una determinada
//fecha, vale la pena mencionar que son eventos que han sido autorizados previamente unicamente los que se despliegan 
    function agenda_limites($edificio,$fecha,$inicio,$items)

    {

        $db = new DB_mysql;

        $tutures = NULL;

        $db->openConnection();

        $db->executeQuery('SELECT DISTINCT(e.idmotivo), fechaevento, dia, idespacio,fecha_solicitud,id_nom_mat,hora_inicio,hora_fin,justificacion FROM eventot e, motivo m WHERE (status = 2) AND (idespacio LIKE "%PUE-A'.$edificio.'%") AND (m.idmotivo = e.idmotivo) AND (fechaevento = "'.$fecha.'") ORDER BY hora_inicio ASC LIMIT '.$inicio.','.$items);

        $rs = $db->getResultSet();


        for ($counter = 0; $counter < count($rs); $counter++)
        {

            $eventot = new Eventot;

            $eventot->setIdEventot($rs[$counter][0]);

            $eventot->setFechaEvento($rs[$counter][1]);

            $eventot->setDia($rs[$counter][2]);

            $eventot->setIdEspacio($rs[$counter][3]);

            $eventot->setFechaSolicitud($rs[$counter][4]);

            $eventot->setIdSolicitante($rs[$counter][5]);

            $eventot->setH_ini($rs[$counter][6]);

            $eventot->setH_fin($rs[$counter][7]);

            $eventot->setMotivosEvento($rs[$counter][8]);

            $eventotes[$counter] = $eventot;

        }

        $db->closeConnection();
        return $eventotes;



    }

function agenda_dif_limites($fecha,$inicio,$items)

    {

        $db = new DB_mysql;

        $tutures = NULL;

        $db->openConnection();

        $db->executeQuery('SELECT DISTINCT(e.idmotivo), fechaevento, dia, idespacio,fecha_solicitud,id_nom_mat,hora_inicio,hora_fin,justificacion FROM eventot e, motivo m WHERE (status = 2) AND (idespacio NOT IN ( SELECT DISTINCT  idespacio 
FROM eventot e 
WHERE (status = 2) AND ( (idespacio LIKE "%PUE-A1%") OR (idespacio LIKE "%PUE-A2%") OR (idespacio LIKE "%PUE-A3%") ) )) AND (m.idmotivo = e.idmotivo) AND (fechaevento = "'.$fecha.'") ORDER BY hora_inicio ASC LIMIT '.$inicio.','.$items);

        $rs = $db->getResultSet();


        for ($counter = 0; $counter < count($rs); $counter++)
        {

            $eventot = new Eventot;

            $eventot->setIdEventot($rs[$counter][0]);

            $eventot->setFechaEvento($rs[$counter][1]);

            $eventot->setDia($rs[$counter][2]);

            $eventot->setIdEspacio($rs[$counter][3]);

            $eventot->setFechaSolicitud($rs[$counter][4]);

            $eventot->setIdSolicitante($rs[$counter][5]);

            $eventot->setH_ini($rs[$counter][6]);

            $eventot->setH_fin($rs[$counter][7]);

            $eventot->setMotivosEvento($rs[$counter][8]);

            $eventotes[$counter] = $eventot;

        }

        $db->closeConnection();
        return $eventotes;



    }
    

//Éste metodo se centra en buscar los eventos y espacios se llevaran acabo en un determinado edificio y en una determinada
//fecha, vale la pena mencionar que son eventos que han sido autorizados previamente unicamente los que se despliegan 
    function cheker($spaso, $mediahora, $fecha)

    {

        $db = new DB_mysql;

        $tutures = NULL;

        $db->openConnection();

        $db->executeQuery('SELECT DISTINCT(e.idmotivo), fechaevento, dia, idespacio,fecha_solicitud,id_nom_mat,hora_inicio,hora_fin,justificacion FROM eventot e, motivo m WHERE (status < 3) AND (idespacio LIKE "'.$spaso.'") AND (fechaevento = "'.$fecha.'") AND (mediahora LIKE "'.$mediahora.'" ) ORDER BY hora_inicio ASC LIMIT 0,1');

        $rs = $db->getResultSet();

	if(count($rs) > 0)
        {

            $eventot = new Eventot;

            $eventot->setIdEventot($rs[0][0]);

            $eventot->setFechaEvento($rs[0][1]);

            $eventot->setDia($rs[0][2]);

            $eventot->setIdEspacio($rs[0][3]);

            $eventot->setFechaSolicitud($rs[0][4]);

            $eventot->setIdSolicitante($rs[0][5]);

            $eventot->setH_ini($rs[0][6]);

            $eventot->setH_fin($rs[0][7]);

            $eventot->setMotivosEvento($rs[0][8]);

        }
    else
    	$eventot = 0;

        $db->closeConnection();
        return $eventot;



    }

 function cheker_optimus($spaso, $mediahora, $fecha)
    {

        $db = new DB_mysql;

        $tutures = NULL;

        $db->openConnection();

        $db->executeQuery('SELECT DISTINCT idmotivo FROM eventot WHERE (status < 3) AND (idespacio LIKE "'.$spaso.'") AND (fechaevento = "'.$fecha.'") AND (mediahora LIKE "'.$mediahora.'" )  LIMIT 0,1');

        $rs = $db->getResultSet();

	if(count($rs) > 0)
        {
        	
            $eventot = ($rs[0][0]);

        }
    else
    	$eventot = null;

        $db->closeConnection();
        return $eventot;

    }

//Éste metodo se centra en buscar los eventos y espacios se llevaran acabo en un determinado edificio y en una determinada
//fecha, vale la pena mencionar que son eventos que han sido autorizados previamente unicamente los que se despliegan 
    function info_tempox($idt)

    {

        $db = new DB_mysql;

        $tutures = NULL;

        $db->openConnection();

        $db->executeQuery(' SELECT DISTINCT fecha_solicitud, id_nom_mat, hora_inicio, hora_fin, justificacion
							FROM motivo
							WHERE (
							idmotivo = '.$idt.'
							)
							LIMIT 0 , 1 ');

        $rs = $db->getResultSet();

	if(count($rs) > 0)
        {

            $eventot = new Eventot;

            $eventot->setIdEventot($idt);

            $eventot->setFechaSolicitud($rs[0][0]);

            $eventot->setIdSolicitante($rs[0][1]);

            $eventot->setH_ini($rs[0][2]);

            $eventot->setH_fin($rs[0][3]);

            $eventot->setMotivosEvento($rs[0][4]);

        }
    else
    	$eventot = 0;

        $db->closeConnection();
        return $eventot;



    }

    function info_eve($idt)

    {

        $db = new DB_mysql;

        $tutures = NULL;

        $db->openConnection();

        $db->executeQuery(' SELECT DISTINCT departamento, audiencia, pantallas, descripcion
							FROM agenda
							WHERE (
							idmotivo = '.$idt.'
							)
							LIMIT 0 , 1 ');

        $rs = $db->getResultSet();

	if(count($rs) > 0)
        {
            $eventot = new Eventot;
            
            $eventot->setIdEventot($idt);

            $eventot->setDepartamento($rs[0][0]);

            $eventot->setAudiencia($rs[0][1]);

            $eventot->setPantallas($rs[0][2]);

            $eventot->setDescripcion($rs[0][3]);

        }
    else
    	$eventot = 0;

        $db->closeConnection();
        return $eventot;



    }
    
//Para mostrar los siguientes 10 eventos 

    function acept_pend_siguientes($inicio,$items)

    {

        $db = new DB_mysql;

        $tutures = NULL;

        $db->openConnection();

        $db->executeQuery('SELECT DISTINCT(e.idmotivo), fechaevento, dia, idespacio,fecha_solicitud,id_nom_mat,hora_inicio,hora_fin,justificacion FROM eventot e, motivo m WHERE (status = 2) AND (m.idmotivo = e.idmotivo) AND (str_to_date( fechaevento, "%m/%d/%Y" ) >= str_to_date("'.date("m/d/y").'", "%m/%d/%Y" )) ORDER BY fechaevento ASC LIMIT '.$inicio.','.$items);

        $rs = $db->getResultSet();


        for ($counter = 0; $counter < count($rs); $counter++)
        {

            $eventot = new Eventot;

            $eventot->setIdEventot($rs[$counter][0]);

            $eventot->setFechaEvento($rs[$counter][1]);

            $eventot->setDia($rs[$counter][2]);

            $eventot->setIdEspacio($rs[$counter][3]);

            $eventot->setFechaSolicitud($rs[$counter][4]);

            $eventot->setIdSolicitante($rs[$counter][5]);

            $eventot->setH_ini($rs[$counter][6]);

            $eventot->setH_fin($rs[$counter][7]);

            $eventot->setMotivosEvento($rs[$counter][8]);

            $eventotes[$counter] = $eventot;

        }

        $db->closeConnection();
        return $eventotes;



    }

//Función que NO deberia estar aqui, puesto que es para obtener el correo de un usuario dependiendo de su matricula
//Pero dado que la utilizo muy a la par de eventot ;) 
//Se usa en correo para obtener el correo de la persona y enviarle un recordatorio. 
    function obtenCorreo($matricula)

    {

        $db = new DB_mysql;

        $tutures = NULL;

        $db->openConnection();
							//id_nom_mat se refiere a la Nómina o bien a la Matricula.
        $db->executeQuery("SELECT correo  FROM correo WHERE id_nom_mat = '$matricula' ;");

        $rs = $db->getResultSet();

        if(count($rs) == 0) {
            $db->closeConnection();
            return 0;
        }else{
		 //Sólo envío el correo electrónico.
            $db->closeConnection();
            return $rs[0][0];

        }

    }
    

//Éste metodo se centra en buscar los eventos y espacios se llevaran acabo en un determinado edificio y en una determinada
//fecha, vale la pena mencionar que son eventos que han sido autorizados previamente unicamente los que se despliegan 
    function reminder($fecha)

    {

        $db = new DB_mysql;

        $tutures = NULL;

        $db->openConnection();

        $db->executeQuery('SELECT DISTINCT(e.idmotivo) FROM eventot e WHERE (status = 2) AND (fechaevento = "'.$fecha.'")');

        $rs = $db->getResultSet();


        for ($counter = 0; $counter < count($rs); $counter++)
        {

            $eventot = new Eventot;

            $eventot->setIdEventot($rs[$counter][0]);

            $eventotes[$counter] = $eventot;

        }

        $db->closeConnection();
        return $eventotes;



    }

/**
	Método que se utiliza para cambiar el estado de los eventos temporales cuyo espacio físico fué clausuriado o era		inexistente en un momento dado, ello para evitar inconsistencias.  
**/
    function cambia_cesp($ides)

    {
    	$vl = 0;

        $db = new DB_mysql;

        $db->openConnection();
							//id_nom_mat se refiere a la Nómina o bien a la Matricula.
        $vl = $db->executeQuery("UPDATE eventot SET status = 4 WHERE (idespacio = '$ides') AND (str_to_date( fechaevento, '%m/%d/%Y' ) >= str_to_date( '".date("m/d/y")."', '%m/%d/%Y' )) AND (status != 3) ;");


        $db->closeConnection();
        
        return $vl;

    }
    

/** Método que utilizo para obtener el estdo actual de un evento**/
    function obtenStatus($idmotivo)

    {

        $db = new DB_mysql;

        $tutures = NULL;

        $db->openConnection();
							//id_nom_mat se refiere a la Nómina o bien a la Matricula.
        $db->executeQuery("SELECT status  FROM eventot WHERE idmotivo = $idmotivo LIMIT 0,1;");

        $rs = $db->getResultSet();

        if(count($rs) == 0) {
            $db->closeConnection();
            return 0;
        }else{
		 //Sólo envío el correo electrónico.
            $db->closeConnection();
            return $rs[0][0];

        }

    }

//Este método me servirá para la agenda del campus, es decir los eventos que tienen que realizarce en un determinado momento.
    function agenda_eve($edificio,$fecha)

    {

        $db = new DB_mysql;

        $db->openConnection();

        $db->executeQuery('SELECT DISTINCT(e.idmotivo), fechaevento, dia, idespacio,fecha_solicitud,id_nom_mat,hora_inicio,hora_fin,justificacion, a.responsable, a.correo, a.descripcion, a.audiencia, a.nombre, a.extension, a.departamento, 	a.pantallas  FROM eventot e, motivo m, agenda a WHERE (status = 2) AND (idespacio LIKE "%PUE-A'.$edificio.'%") AND (m.idmotivo = a.idmotivo) AND (m.idmotivo = e.idmotivo) AND (str_to_date( fechaevento, "%m/%d/%Y" )  = str_to_date( "'.$fecha.'", "%m/%d/%Y" )) ORDER BY hora_inicio ASC');

        $rs = $db->getResultSet();


        for ($counter = 0; $counter < count($rs); $counter++)
        {

            $eventot = new Eventot;

            $eventot->setIdEventot($rs[$counter][0]);

            $eventot->setFechaEvento($rs[$counter][1]);

            $eventot->setDia($rs[$counter][2]);

            $eventot->setIdEspacio($rs[$counter][3]);

            $eventot->setFechaSolicitud($rs[$counter][4]);

            $eventot->setIdSolicitante($rs[$counter][5]);

            $eventot->setH_ini($rs[$counter][6]);

            $eventot->setH_fin($rs[$counter][7]);

            $eventot->setMotivosEvento($rs[$counter][8]);

            $eventot->setResponsable($rs[$counter][9]);

            $eventot->setCorreo($rs[$counter][10]);

            $eventot->setDescripcion($rs[$counter][11]);

            $eventot->setAudiencia($rs[$counter][12]);

            $eventot->setNombre($rs[$counter][13]);

            $eventot->setExtension($rs[$counter][14]);

            $eventot->setDepartamento($rs[$counter][15]);

            $eventot->setPantallas($rs[$counter][16]);


            $eventotes[$counter] = $eventot;

        }

        $db->closeConnection();
        return $eventotes;



    }
    
    function agenda_vip($edificio,$fecha)

    {

        $db = new DB_mysql;

        $tutures = NULL;

        $db->openConnection();

        $db->executeQuery('SELECT DISTINCT(e.idmotivo), fechaevento, dia, idespacio,fecha_solicitud,id_nom_mat,hora_inicio,hora_fin,justificacion FROM eventot e, motivo m WHERE (m.agenda = 1) AND (status = 2) AND (idespacio LIKE "%PUE-A'.$edificio.'%") AND (m.idmotivo = e.idmotivo) AND (str_to_date( fechaevento, "%m/%d/%Y" )  = str_to_date( "'.$fecha.'", "%m/%d/%Y" )) ORDER BY hora_inicio ASC');

        $rs = $db->getResultSet();


        for ($counter = 0; $counter < count($rs); $counter++)
        {

            $eventot = new Eventot;

            $eventot->setIdEventot($rs[$counter][0]);

            $eventot->setFechaEvento($rs[$counter][1]);

            $eventot->setDia($rs[$counter][2]);

            $eventot->setIdEspacio($rs[$counter][3]);

            $eventot->setFechaSolicitud($rs[$counter][4]);

            $eventot->setIdSolicitante($rs[$counter][5]);

            $eventot->setH_ini($rs[$counter][6]);

            $eventot->setH_fin($rs[$counter][7]);

            $eventot->setMotivosEvento($rs[$counter][8]);

            $eventotes[$counter] = $eventot;

        }

        $db->closeConnection();
        return $eventotes;



    }
function agenda_dif_vip($fecha)

    {

        $db = new DB_mysql;

        $tutures = NULL;

        $db->openConnection();

        $db->executeQuery('SELECT DISTINCT(e.idmotivo), fechaevento, dia, idespacio,fecha_solicitud,id_nom_mat,hora_inicio,hora_fin,justificacion FROM eventot e, motivo m WHERE (agenda = 1) AND (status = 2) AND (idespacio NOT IN ( SELECT DISTINCT  idespacio 
FROM eventot e 
WHERE (agenda = 1) AND (status = 2) AND ( (idespacio LIKE "%PUE-A1%") OR (idespacio LIKE "%PUE-A2%") OR (idespacio LIKE "%PUE-A3%") ) )) AND (m.idmotivo = e.idmotivo) AND (fechaevento = "'.$fecha.'") ORDER BY hora_inicio ASC');

        $rs = $db->getResultSet();


        for ($counter = 0; $counter < count($rs); $counter++)
        {

            $eventot = new Eventot;

            $eventot->setIdEventot($rs[$counter][0]);

            $eventot->setFechaEvento($rs[$counter][1]);

            $eventot->setDia($rs[$counter][2]);

            $eventot->setIdEspacio($rs[$counter][3]);

            $eventot->setFechaSolicitud($rs[$counter][4]);

            $eventot->setIdSolicitante($rs[$counter][5]);

            $eventot->setH_ini($rs[$counter][6]);

            $eventot->setH_fin($rs[$counter][7]);

            $eventot->setMotivosEvento($rs[$counter][8]);

            $eventotes[$counter] = $eventot;

        }

        $db->closeConnection();
        return $eventotes;



    }
   


}//Fin de CLASE
?>
