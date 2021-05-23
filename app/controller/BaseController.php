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

	protected function loadSideBar($data = [])
	{
		$this->loadView('partials/sidebar_view', $data);
	}

	protected function loadNavBar($data = [])
	{
		$this->loadView('partials/navbar_view', $data);
	}

	protected function loadFooter($data = []) 
	{
		$this->loadView('partials/footer_view', $data);
	}

	protected function getIdSessions()
	{
		$id = $_SESSION['id_user'] ?? 0;
		return $id;
	}

	protected function getUserSession()
	{
		$user = $_SESSION['user'] ?? '';
		return $user;
	}

	protected function checkAdminLogin()
	{
		$idAdmin = $this->getIdSessions();
		$idAdmin = is_numeric($idAdmin) && $idAdmin > 0 ? $idAdmin : 0;

		$userAdmin = $this->getUserSession();
		$userAdmin = !empty($userAdmin) && $userAdmin !== null ? $userAdmin : '';

		if($idAdmin === 0 || $userAdmin === ''){
			// chua login
			return false;
		}
		return true;
	}

	public function __call($method, $args)
	{
		echo $method . ' khong ton tai';
	}
}



