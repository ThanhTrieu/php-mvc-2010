<?php
// viet cac ham xu ly tien ich o day

function uploadFileImage($file)
{
	$size = checkSizeFile($file['size']);
	$type = checkTypeFile($file['type']);
	if($size && $type){
		// tien hanh upload
		$nameFile = $file['name'];
		$arrFile 	= pathinfo($nameFile);

		// add time timestamp vao ten file
		// tao su khac biet
		$date = date('Y-m-d H:i:s');
		$time = strtotime($date);
		$nameFile = $arrFile['filename'].'-'.$time.'.'.$arrFile['extension'];
		// test-01212.png;
		// test-12123.png;

		$tmpFile = $file['tmp_name'];
		if(!empty($tmpFile)){
			
			
			$upload = move_uploaded_file($tmpFile, PATH_UPLOAD_FILE . $nameFile);
			if($upload){
				return $nameFile;
			}
			return false;
		}
		return false;
	}
	return false;
}

function checkSizeFile($size)
{
	// $size : la don vi byte
	// muon anh ko lon hon 5Mb
	$allowSize = 5*1024*1024; 
	if($size <= $allowSize){
		return true;
	}
	return false;
}

function checkTypeFile($type)
{
	// check dinh dang file dc upload
	$arrFile = ['image/png','image/jpg', 'image/jpeg'];
	return in_array($type, $arrFile);
}




