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

	public function updateBrand($nameBrand, $addBrand, $description, $logoBrand, $id)
	{
		$flag = false;
		$updatedTime = date('Y-m-d H:i:s');
		$sql  = "UPDATE `brand` SET `name` = :name, `address` = :address, `description` = :description, `logo` = :logo, `updated_time` = :updated_time WHERE `id` = :id ";
		$stmt = $this->conDb->prepare($sql);

		if($stmt){
			$stmt->bindParam(':name',$nameBrand,PDO::PARAM_STR);
			$stmt->bindParam(':address',$addBrand,PDO::PARAM_STR);
			$stmt->bindParam(':description',$description,PDO::PARAM_STR);
			$stmt->bindParam(':logo',$logoBrand,PDO::PARAM_STR);
			$stmt->bindParam(':updated_time',$updatedTime,PDO::PARAM_STR);
			$stmt->bindParam(':id',$id,PDO::PARAM_INT);

			if($stmt->execute()) {
				$flag = true;
				$stmt->closeCursor();
			}
		}
		// true: update thanh cong
		return $flag;;
	}

	public function checkUpdateNameBrand($name, $id = 0)
	{
		$flag = true;
		$sql = "SELECT `name` FROM `brand` WHERE `name` = :name AND `id` <> :id ";
		$stmt = $this->conDb->prepare($sql);
		if($stmt){
			$stmt->bindParam(':name',$name,PDO::PARAM_STR);
			$stmt->bindParam(':id',$id,PDO::PARAM_INT);
			if($stmt->execute()){
				if($stmt->rowCount() > 0) {
					// loai chinh ten thuong hieu cua id do - neu ton tai thi la sai
					// nhung thang khac co ten thuong hieu do roi
					$flag = false;
				}
				$stmt->closeCursor();
			}
		}
		// true :cho update
		return $flag;
	}

	public function getDataBrandByPage($start, $limited, $keyword = '')
	{
		$listBrands = [];
		$key = "%".$keyword."%";

		if(empty($keyword)){
			// phan trang khong kem theo tim kiem
			$sql = "SELECT * FROM `brand` WHERE `status` = 1 LIMIT :start, :limited";
		} else {
			// phan trang co kem theo tim kiem
			$sql = "SELECT * FROM `brand` WHERE `name` LIKE :k1 OR `address` LIKE :k2 AND `status` = 1 LIMIT :start, :limited";
		}
		// :k1 - :k2 chinh la $key
		$stmt = $this->conDb->prepare($sql);
		if($stmt){
			if(!empty($keyword)){
				// co tim kiem voi phan trang
				$stmt->bindParam(':k1', $key, PDO::PARAM_STR);
				$stmt->bindParam(':k2', $key, PDO::PARAM_STR);
			}
			$stmt->bindParam(':start', $start, PDO::PARAM_INT);
			$stmt->bindParam(':limited', $limited, PDO::PARAM_INT);

			if($stmt->execute()){
				if($stmt->rowCount() > 0){
					$listBrands = $stmt->fetchAll(PDO::FETCH_ASSOC);
				}
				$stmt->closeCursor();
			}
		}
		return $listBrands;
	}

	public function getAllBrand($keyword = '')
	{
		$allBrand = [];
		$key = "%".$keyword."%";

		// chi lay ra thuong hieu dang duoc dung
		if(empty($keyword)) {
			$sql = "SELECT * FROM `brand` WHERE `status` = 1 ";
		} else {
			$sql = "SELECT * FROM `brand` WHERE `name` LIKE :key1 OR `address` LIKE :key2 AND `status` = 1";
		}
		
		$stmt = $this->conDb->prepare($sql);

		if($stmt) {

			if(!empty($keyword)) {
				$stmt->bindParam(':key1', $key, PDO::PARAM_STR);
				$stmt->bindParam(':key2', $key, PDO::PARAM_STR);
			}
			
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

	public function deleteBrandById($id = 0) 
	{
		$flag = false;
		$sql = "UPDATE `brand` SET `status` = 0 WHERE `id` = :id ";
		$stmt = $this->conDb->prepare($sql);
		if($stmt){
			$stmt->bindParam(':id',$id,PDO::PARAM_INT);
			if($stmt->execute()){
				$flag = true;
				$stmt->closeCursor();
			}
		}
		return $flag;
	}

	public function getInfoBrandById($id) 
	{
		$data = [];
		$sql = "SELECT * FROM `brand` WHERE `id` = :id ";
		$stmt = $this->conDb->prepare($sql);
		if($stmt){
			$stmt->bindParam(':id',$id,PDO::PARAM_INT);
			if($stmt->execute()){
				if($stmt->rowCount() > 0){
					$data = $stmt->fetch(PDO::FETCH_ASSOC);
				}
				$stmt->closeCursor();
			}
		}
		return $data;
	}
}


