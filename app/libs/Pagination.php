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

	// viet ham phan trang
	public function createPaginate($link, $totalRecord, $limit, $page = 1) 
	{
		// $link : tao ra tu ham createLink
		// $totalRecord: tong so du lieu (tinh toan tong so trang)
		// $page: trang truyen vao
		// $limit: gioi han co bao nhieu item(san pham) tren 1 trang
		$limit = $limit == null ? self::LIMIT_ITEMS : $limit;
		
		// di tinh tong so trang
		$totalPage = ceil($totalRecord/$limit);

		// tinh toan lai $page
		// $page >= 1 && $page <= $totalPage
		if($page < 1){
			$page = 1;
		} elseif($page > $totalPage) {
			$page = $totalPage;
		}

		// page luonluon bat dau tu 1 ==> lay tren param url trinh duyet
		// mysql: limit s,t : s == 0
		// tinh toan start
		$start = ($page - 1)*$limit;

		//tao template(giao dien) phan trang bang bootstrap 
		$htmlPage = '';
		$htmlPage .= '<nav>';
		$htmlPage .= '<ul class="pagination">';
		// xu ly previous (back page)
		if($page > 1 && $page <= $totalPage) {
			$htmlPage .= '<li class="page-item">';
			$htmlPage .= '<a class="page-link" href="'.str_replace('{page}', ($page-1), $link).'">Previous</a>';
			$htmlPage .= '</li>';
		}
		//xu ly nhung trang o giua
		for($i = 1; $i <= $totalPage; $i++) {
			if($page == $i){
				// dang o trang active - hien tai
				$htmlPage .= '<li class="page-item active" aria-current="page">';
				$htmlPage .= '<a class="page-link">'.$page.'</a>';
				$htmlPage .= '</li>';
			} else {
				$htmlPage .= '<li class="page-item"><a class="page-link" href="'.str_replace('{page}', $i, $link).'">'.$i.'</a></li>';
			}
		}
		// xu ly next page
		if($page < $totalPage && $page >= 1){
			$htmlPage .= '<li class="page-item">';
			$htmlPage .= '<a class="page-link" href="'.str_replace('{page}', ($page+1), $link).'">Next</a>';
			$htmlPage .= '</li>';
		}
		$htmlPage .= '</ul>';
		$htmlPage .= '</nav>';


		return [
			'start' => $start,
			'total_page' => $totalPage,
			'html_page' => $htmlPage
		];
	}

}
