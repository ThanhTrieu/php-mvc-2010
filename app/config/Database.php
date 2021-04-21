<?php
namespace app\config;

class Database
{
	protected $conDb;

	public function __construct()
	{
		$this->conDb = true;
	}

	public function __destruct()
	{
		$this->conDb = false;
	}
}