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

	public function add()
	{
		$data = [];
		$data['title'] = 'Add brand';
		
		$data['error'] = null;
		if(isset($_GET['state']) && $_GET['state'] === 'err'){
			$data['error'] = $_SESSION['errBrand'];
		}

		$data['exist_name'] = null;
		if(isset($_GET['state']) && $_GET['state'] === 'exist_name'){
			$data['exist_name'] = 'Ten thuong hieu da ton tai, vui long chon ten khac';
		}


		// load giao dien
		$this->loadSideBar();
		$this->loadNavBar();
		// hien thi giao dien va do du lieu ra ngoai giao dien view
		// cai key cua mang $data(minh dat ten) se la 1 bien ben ngoai view
		$this->loadView('brand/add_view', $data);
		$this->loadFooter();
	}

	public function handle()
	{
		if(isset($_POST['btnAddBrand'])){
			$nameBrand = $_POST['nameBrand'] ?? '';
			$addBrand = $_POST['addBrand'] ?? '';
			$description = $_POST['descriptionBrand'] ?? '';

			// xu ly upload logo
			$nameLogo = false;
			if(isset($_FILES['logoBrand'])){
				$nameLogo = uploadFileImage($_FILES['logoBrand']);
			}
			// validate thong tin de truoc khi add vao database
			$flagErr = true;
			$arrError = $this->validateDataBrand($nameBrand, $addBrand, $description, $nameLogo);
			// kiem tra xem co loi hay ko?
			foreach ($arrError as $val) {
				if(!empty($val)) {
					$flagErr = false;
					break;
				}
			}

			if($flagErr){
				// ko he co loi
				// xoa bo session loi da tung co
				if(isset($_SESSION['errBrand'])){
					unset($_SESSION['errBrand']);
				}
				// kiem tra trung ten thuong hieu ko ?
				// khong thi moi add
				// trung ko cho add
				
				if(!$this->brandModel->checkExistsNameBrand($nameBrand)){
					// luu vao database
					$insert = $this->brandModel->insertBrand($nameBrand, $addBrand, $description, $nameLogo);
					// quay ve trang list brand
					header('Location:?c=brand');
				} else {
					// quay ve form giao dien add brand
					header('Location:?c=brand&m=add&state=exist_name');
				}
			} else {
				// co loi
				// xoa bo anh vua upload
				if(file_exists(PATH_UPLOAD_FILE.$nameLogo)){
					unlink(PATH_UPLOAD_FILE.$nameLogo);
				}
				// luu thong tin loi de hien thi cho nguoi dung biet
				// luu vao session
				$_SESSION['errBrand'] = $arrError;
				// quay ve form giao dien add brand
				header('Location:?c=brand&m=add&state=err');
			}
		}
	}

	private function validateDataBrand(
		$nameBrand,
		$addBrand,
		$description,
		$logoBrand
	) {
		$error = [];
		$error['name_brand'] = empty($nameBrand) ? 'vui long nhap ten thuong hieu' : '';
		$error['add_brand'] = empty($addBrand) ? 'vui long nhap dia chi thuong hieu' : '';
		$error['description'] = empty($description) ? 'vui long mieu ta ve thuong hieu' : '';
		$error['logo_brand'] = !$logoBrand ? 'Vui long kiem tra lai dinh dang anh logo hay kich thuoc anh logo' : '';

		return $error;
	}
}



