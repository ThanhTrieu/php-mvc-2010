<?php
namespace app\controller;

use app\controller\BaseController as Controller;
use app\model\BrandModel;

class BrandController extends Controller
{
	private $brandModel;

	public function __construct()
	{
		if(!$this->checkAdminLogin()){
			header('Location:index.php?login');
			exit();
		}

		// khoi tao doi tuong truy cap vao model
		$this->brandModel = new BrandModel();
	}

	public function index()
	{
		$data = [];
		// xu ly logic o day
		$brands = $this->brandModel->getAllBrand();
		$data['brands'] = $brands;
		$data['title'] = 'Quan ly thuong hieu';

		// load giao dien
		$this->loadSideBar();
		$this->loadNavBar();
		// hien thi giao dien va do du lieu ra ngoai giao dien view
		// cai key cua mang $data(minh dat ten) se la 1 bien ben ngoai view
		$this->loadView('brand/index_view', $data);
		$this->loadFooter();
	}
}



