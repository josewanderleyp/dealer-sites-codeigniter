<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends CI_Controller {
	function __construct(){  
		parent::__construct();  
		$this->load->helper('url');
		$this->load->model('VerifySession');
		$this->load->model('Admin/UsersModel');
	}  

	public function index(){
		if( !empty( $this -> session -> userdata['id'] ) && isset($this -> session -> userdata['id']) ){
			$this -> VerifySession -> verifySession($this -> session -> userdata['id']);
		}else{
			redirect(base_url());
		}

		$title = nomeSistema." | Usuários";
		$data['title'] = $title;

		$this->load->view('admin/includes/header', $data);
		$this->load->view('admin/users');
		$this->load->view('admin/includes/footer', $data);
	}

	public function getUsers(){
		if( !empty( $this -> session -> userdata['id'] ) && isset($this -> session -> userdata['id']) ){
			$this -> VerifySession -> verifySession($this -> session -> userdata['id']);
		}else{
			redirect(base_url());
		}

		$array = array();

		$users = $this -> UsersModel -> getUsers();

		if( sizeof( $users ) > 0 ){
			$x = 0;

			foreach ($users as $key => $value) {
				$getLastLogin = $this -> UsersModel -> getLastLogin($value -> id);

				if( sizeof($getLastLogin) > 0 ){
					$lastLogin = $getLastLogin[0] -> last_login;
				}else{
					$lastLogin = '';
				}

				$array["data"][$x]["ID"] = "<td>".$value -> id."</td>";
				$array["data"][$x]["name"] = "<td>".$value -> name."</td>";
				$array["data"][$x]["email"] = "<td>".$value -> email."</td>";
				$array["data"][$x]["active"] = "<td>".$value -> active."</td>";
				$array["data"][$x]["numberLogin"] = "<td>".$value -> numero_logins."</td>";
				$array["data"][$x]["last_login"] = "<td>".$lastLogin."</td>";
				$x++;
			}
		}


		echo json_encode($array);
	}
}
