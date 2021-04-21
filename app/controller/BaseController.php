<?php
namespace app\controller;

class BaseController
{
	protected $pathView = 'app/view/';

	protected function loadView($file, $data = [])
	{
		// $file: ten file view can load
		// data : du lieu ma mh can truyen ra ngoai view
		extract($data);
		// chuyen key cua mang thanh 1 bien de su dung ngoai view
		require $this->pathView.$file.'.php';
	}

	public function __call($method, $args)
	{
		echo $method . ' khong ton tai';
	}
}



