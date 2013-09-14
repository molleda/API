<?php

class connect_api
{
	private $url = "";
	// 0 no conectado
	// 1 conectado
	private $status = 0;

	private $curlobject = NULL;


	function __construct($url)
	{
		$this->url = $url;
		return True;
	}

	function __destruct()
	{
		if ($this->get_status()!=0)
		{
			$this->close();
		}
		return True;
	}

	function connect()
	{
		try{
			$this->curlobject = curl_init($this->get_url());
			curl_setopt($this->curlobject, CURLOPT_RETURNTRANSFER, 1); //do not output directly, use variable
			$this->set_status(1);
		}
		catch (Exception $e)  
		{
			throw new Exception( 'Error in method connect', 0, $e);  
		}
		return True;

	}

	function close()
	{
		try{
			curl_close($this->curlobject);
			$this->set_status(0);	
		}
		catch (Exception $e)  
		{
			throw new Exception( 'Error in method close', 0, $e);  
		}
		return True;
	}

	function execute()
	{
		try{
			$output = curl_exec($this->curlobject);
		}
		catch (Exception $e)  
		{
			throw new Exception( 'Error in method execute', 0, $e);  
		}
		return $output;
	}

	function execute_json()
	{
		$data = json_decode($this->execute());
		//var_dump($data);
		return $data;
	}

	function set_url($newurl)
	{
		$this->url=$newurl;
		return true;
	}

	function get_url()
	{
		return $this->url;
	}

	function set_status($newstatus)
	{
		$this->status=$newstatus;
		return true;
	}

	function get_status()
	{
		return $this->status;
	}

	function debug()
	{
		echo "------------------------------------\n";
		var_dump(curl_getinfo($this->curlobject));
		echo "------------------------------------\n";
		return true;
	}

}