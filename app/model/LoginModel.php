<?php
namespace app\model;

use app\config\Database;
use \PDO;

class LoginModel extends Database
{
	public function __construct()
	{
		parent::__construct();
	}

	public function checkLoginUser($user, $pass)
	{
		$infoUser = [];
		if($this->conDb){
			if($user === 'admin' && $pass === '123'){
				$infoUser = [
					'id' => 1,
					'username' => 'admin',
					'email' => 'admin@example.com'
				];
				return $infoUser;
			}
		}
		return $infoUser;
	}
}


