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