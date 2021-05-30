<?php
namespace app\controller;

use app\controller\BaseController as Controller;

class DashboardController extends Controller
{
	public function __construct()
	{
		if(!$this->checkAdminLogin()){
			header('Location:index.php?login');
			exit();
		}
	}

	public function index()
	{
		// xu ly logic o day

		// load giao dien
		$this->loadSideBar();
		$this->loadNavBar();
		$this->loadView('dashboard/index_view');
		$this->loadFooter();
	}
}