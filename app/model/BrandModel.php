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
}


