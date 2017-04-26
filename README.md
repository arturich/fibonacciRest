# fibonacciRest
Fibonacci serie

This project has the purpose to expose a Restful server with Fibonacci series functionality.
In order to get this project running in your computer, you will need:
•	PHP 5.4 or greater
•	MySQL 5.6.32 (Optional, you can modify it to use variables).
•	Jacwright RESTServer v1.0.1  https://github.com/jacwright/RestServer (included).

The main functionality is in FibonacciController.php:
Has three principal methods:
<?php

use \RestServer\RestException;
require_once('../model/DB_Fibonacci.inc.php');

class FibonacciController
{
    /**
     * Returns the welcome to the fibonacci restfull api
     *
     * @url GET /
     */
    public function test()
    {
        return "Welcome to the Fibonacci Series Restul Api";
    }

	
	public function authorize() 
	{
		return true;
	}

    /**
     * Gets the serie of a specific number
     *
     * @url GET /fserie/$nm
     */
    public function getSerie($nm = null)
    {
        // if ($id) {
        //     $user = User::load($id); // possible user loading method
        // } else {
        //     $user = $_SESSION['user'];
        // }
		if($nm < 0 || $nm > 100)
		{
			//throw new RestException(406, "Invalid number");
			$response = array("code" => "Error", "result" => "Invalid number");
		}
		else
		{
			$serie = DB_Fibonacci::findSerie($nm);
			if(is_null($serie) || trim($serie) == "")
				$response = array("code" => "Error", "result" => "No serie yet");
			else
				$response = array("code" => "OK", "result" => $serie);			
		}
		return $response; 
    }

    /**
     * Saves a valid number from 0 to 100 series to the database
     *
     * @url POST /number/
     * @url PUT /number/$nm
     */
    public function saveSerie($nm = null, $data)
    {	
		 $nm =  $_POST['nm'];

		if($nm < 0 || $nm > 100)
		{
			//throw new RestException(406, "Invalid number");
			$response = array("code" => "Error", "result" => "Invalid number");
		}
		else
		{
			$serie =  $this->doFibonacci($nm);
			DB_Fibonacci::saveSerie($nm,$serie);
			$response = array("code" => "OK", "result" => $serie);
		}	
         
        return $response; // returning the updated or newly created user object
    }



	
	/**
     * Deletes a number
     * 
     * @url DELETE /delete/$nm
     */
    public function deleteSerie($nm) {
			
		if($nm < 0 || $nm > 100)
		{
			//throw new RestException(406, "Invalid number");
			$response = array("code" => "Error", "result" => "Invalid number");
		}
		else
		{			
			$result = DB_Fibonacci::deleteSerie($nm);
			if(is_null($result))
				$response = array("code" => "Error", "result" => "No serie exist");
			else
				$response = array("code" => "OK", "result" => $result);
		}	
         
        return $response; 

    }
	
	function doFibonacci($n)
	{	 
	  $serie = "";	
	  $first = 0;
	  $second = 1;
	  $serie  = $first.' '.$second.' ';
	  	 
	  for($i = 2; $i < $n; $i++){
	 
		$third = $first + $second;
	 
		$serie  .= $third.' ';
	 
		$first = $second;
		$second = $third;
	 
		}
		return $serie;
	}
}

saveSerie(). This method will receive a number via POST, to your site, for instance www.yoursite.com/number and pass the parameter as nm and it will store the number and the series, and return the series with a status of Ok, a valid number will be in the range o 0 to 100.
getSerie(). This method will query the number that you pass in a GET method, and if the series for that number is already store in the database will retrieve the information for you, if it doesn’t exist, will throw an error. The way you will consult it is for instance www.yoursite.com/fserie/5 
deleteSerie(). This method will act with DELETE, and will receive a number and delete the number and the serie from the database, if the number doesn’t exist will show you an error. You can delete a serie by using for instance www.yoursite.com/delete/5
If you want to use the database functionality, you will need to create a database and a table:

CREATE TABLE IF NOT EXISTS `fibonacci_t` (
  `number` int(11) NOT NULL,
  `serie` text NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`number`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;


Now in the model folder change DB_mysql.inc.php in the constructor set the $bd variable with the name or your database, set you $user and $password.

An example that is currently running is in http://citalin.com/acce/test/fserie/20
Enjoy.
