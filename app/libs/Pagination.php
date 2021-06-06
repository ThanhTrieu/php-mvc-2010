<?php

namespace app\libs;

class Pagination
{
	const LIMIT_ITEMS = 4; // bao nhieu data tren 1 trang
	const ROOT_PAGE = 'index.php';

	// viet ham bo tro tao duong link phan trang
	public function createLink($dataLinks = [])
	{
		// index.php?c=brand&m=index&page=1&s=
		/* 
			$dataLinks = [
				'c' => 'brand',
				'm' => 'index',
				'page' => {page},
				's' => ''
			]
		*/
		$link = '';
		foreach ($dataLinks as $key => $item) {
			$link .= empty($link) 
				? self::ROOT_PAGE."?{$key}={$item}" 
				: "&{$key}={$item}";
		}
		return $link;
	}
}
