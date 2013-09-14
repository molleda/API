<?php

class config
{
	public $config = array();

	function __construct()
	{
		$this->config = parse_ini_file("config.ini");
	}
}