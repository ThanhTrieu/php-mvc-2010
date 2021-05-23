<?php
namespace app\config;
use \PDO; // su dung thu vien pdo php connect database

class Database
{
	protected $conDb;

	public function __construct()
	{
		$this->conDb = $this->connectDatabase();
	}

	// ket noi database 
	private function connectDatabase()
	{
		try {
			$dbh = new PDO('mysql:host=localhost;dbname=shopping;charset=utf8', 'root', '');
			// hien thi loi cu phap PDO php
			$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    	$dbh->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

			return $dbh;
		} catch (PDOException $e) {
			print "Error!: " . $e->getMessage() . "<br/>";
    	die();
		}
	}

	// huy ket noi database
	private function disconnectDatabase()
	{
		$this->conDb = null;
	}

	public function __destruct()
	{
		$this->disconnectDatabase();
	}
}


