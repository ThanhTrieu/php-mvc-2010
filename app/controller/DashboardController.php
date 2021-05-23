<?php
namespace app\controller;

use app\controller\BaseController as Controller;

class DashboardController extends Controller
{

	public function index()
	{
		$this->loadView('dashboard/index_view');
	}
}