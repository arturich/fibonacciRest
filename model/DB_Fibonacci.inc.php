<?php

require_once('DB_mysql.inc.php');

/**
 * Description of DB_Fibonacci
 *
 * @author Arturo
 */
class DB_Fibonacci {
	
	
	/*
	*	Save the serie to the DB_Fibonacci
	*/
	
	function saveSerie($number,$serie)

    {

		$db = new DB_mysql;
		$db->openConnection();
		$db->setAutocommit(false);
		$generatedkey = $db->executeUpdate("INSERT INTO fibonacci_t (number,serie) VALUES ($number,'$serie');");
		$db->commit();
		$db->closeConnection();

		return true;

    }
	
	
	
	
	function findSerie($number)

    {
		//$number = mysql_real_escape_string($number);
        $db = new DB_mysql;

        $db->openConnection();

        $db->executeQuery("SELECT serie
						   FROM `fibonacci_t`
						   WHERE `number` = $number;");

        $rs = $db->getResultSet();


        $db->closeConnection();
        return $rs[0][0];

    }
	
	/* Delete the serie from DB */
    function deleteSerie($number)
    {
		$serie = self::findSerie($number);
		
		if(is_null($serie) || trim($serie) == "")
			return null;
		else
		{	
			$db = new DB_mysql;
			$db->openConnection();
			$db->setAutocommit(false);        
			$result = $db->executeUpdate("DELETE FROM `fibonacci_t` WHERE number =$number ;");
			$db->commit();
			$db->closeConnection();
		}

        return $serie;
    }

    
}//fin de la clase
?>
