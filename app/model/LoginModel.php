<?php
namespace app\model;

use app\config\Database;
use \PDO; // su dung thu vien PDO

class LoginModel extends Database
{
	public function __construct()
	{
		parent::__construct();
	}

	public function checkLoginUser($user, $pass)
	{
		$infoUser = [];
		// thuc hanh truy van du lieu mysql
		// su dung thu vien pdo php
		
		// SELECT * FROM `admin` WHERE `username` = 'admin' AND `password` = '123456789' AND `status` = 1
		
		$sql = " SELECT * FROM `admin` WHERE `username` = :user AND `password` = :pass AND `status` = 1 ";
		// :user va :pass : chinh la tham so truyen vao cau lenh sql
		
		// di kiem tra xem cau lenh sql da dung chua
		$stmt = $this->conDb->prepare($sql);
		// prepare : cua pdo php
		
		if($stmt){
			// kiem tra tham so truyen vao cau lenh sql neu co
			$stmt->bindParam(':user', $user, PDO::PARAM_STR);
			// bindParam : cua PDO php
			$stmt->bindParam(':pass', $pass, PDO::PARAM_STR);

			// thuc thi cau lenh sql
			if($stmt->execute()){
				// kiem tra xem co dong du lieu nao tra ve ko ?
				if($stmt->rowCount() > 0) {

					$infoUser = $stmt->fetch(PDO::FETCH_ASSOC);
					// fetch : tra ve 1 row data
					// PDO::FETCH_ASSOC : tra ve mang khong tuan voi key cua mang chinh la ten cac cot (truong) trong database
				}
				// dung ket qua cua viec truy van SQL ben tren
				$stmt->closeCursor();
				// chung ta xu ly cac lenh sql tiep neu can !
			}
		}
		return $infoUser;
	}
}


