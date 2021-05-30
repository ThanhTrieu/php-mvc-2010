<?php
namespace app\model;

use app\config\Database;
use \PDO; // su dung thu vien PDO

class BrandModel extends Database
{
	public function __construct()
	{
		parent::__construct();
	}

	public function getAllBrand()
	{
		$allBrand = [];
		$sql = "SELECT * FROM `brand` ";
		$stmt = $this->conDb->prepare($sql);

		if($stmt){
			// vi cau lenh sql ko co tham so truyen vao nen ko can kiem tra
			// thuc thi cau lenh
			if($stmt->execute()){
				// kiem tra co data tra ve ko
				if($stmt->rowCount() > 0){
					$allBrand = $stmt->fetchAll(PDO::FETCH_ASSOC);
					// fetchAll : lay multil row
				}
				// closeCursor
				$stmt->closeCursor();
			}
		}
		return $allBrand;
	}

	public function insertBrand(
		$name,
		$add,
		$desc,
		$logo
	) {
		$flag = false;
		$status = 1;
		$creteTime = date('Y-m-d H:i:s');
		$update = null;

		$sql = "INSERT INTO `brand`(`name`, `address`, `description`, `logo`, `status`, `created_time`, `updated_time`) VALUES (:name, :address, :description, :logo, :status, :created_time, :updated_time) ";
		$stmt = $this->conDb->prepare($sql);

		if($stmt){
			// kiem tra tham so
			$stmt->bindParam(':name', $name, PDO::PARAM_STR);
			$stmt->bindParam(':address', $add, PDO::PARAM_STR);
			$stmt->bindParam(':description', $desc, PDO::PARAM_STR);
			$stmt->bindParam(':logo', $logo, PDO::PARAM_STR);
			$stmt->bindParam(':status', $status, PDO::PARAM_INT);
			$stmt->bindParam(':created_time', $creteTime, PDO::PARAM_STR);
			$stmt->bindParam(':updated_time', $update, PDO::PARAM_STR);
			// thuc thi 
			if($stmt->execute()){
				$flag = true;
				$stmt->closeCursor();
			}
		}
		return $flag;
	}

	public function checkExistsNameBrand($nameBrand)
	{
		$flag = false;
		$sql = "SELECT `name` FROM `brand` WHERE `name` = :name";
		$stmt = $this->conDb->prepare($sql);
		if($stmt){
			// kiem tra tham so
			$stmt->bindParam(':name', $nameBrand, PDO::PARAM_STR);
			if($stmt->execute()){
				if($stmt->rowCount() > 0){
					$flag = true;
				}
				$stmt->closeCursor();
			}
		}
		return $flag;
	}
}


