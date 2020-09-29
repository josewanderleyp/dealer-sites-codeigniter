<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {
	function __construct(){  
		parent::__construct();  
		$this->load->helper('url');
		$this->load->model('LoginModel');
	}  

	public function index()
	{
		$title = nomeSistema." | Login";
		$data['title'] = $title;

		$this->load->view('login/header', $data);
		$this->load->view('login/index');
		$this->load->view('login/footer', $data);
	}

	public function CheckLogin(){
		$post = $this -> input -> post();

		$dados = json_decode(file_get_contents("php://input"),true);       

		if( !empty($dados) ){
			$_POST = json_decode(file_get_contents("php://input"),true);
		}

		if( isset($post) ){
			if( isset($_POST['email']) && isset($_POST['senha']) ){
				$email = antiInjection($_POST['email']);
				$senha = antiInjection(md5($_POST['senha']));

				$return = $this -> LoginModel -> getLogin($email, $senha);

				if( sizeof( $return ) > 0 ){
					$numero_logins = $return[0] -> numero_logins + 1;
					
					$tokenLogado = tokenLogado($return[0]);

					$array = array('tokenLogado' => $tokenLogado, 'numero_logins' => $numero_logins);
					
					$updateToken = $this -> LoginModel -> updateToken($array, $return[0] -> id);

					$this -> session -> set_userdata('id', $return[0] -> id);
					$this -> session -> set_userdata('name', $return[0] -> name);
					$this -> session -> set_userdata('email', $return[0] -> email);
					$this -> session -> set_userdata('tokenUser', $tokenLogado);

					date_default_timezone_set('America/Sao_Paulo');
					$insertLogin = array('user_id' => $return[0] -> id, 'last_login' => date("Y-m-d H:i:s"));
					$this -> LoginModel -> insertLogin($insertLogin);

					echo json_encode(array("stats" => true, "msg" => "Logado com sucesso!", "user" => $return, 'tokenLogado' => $tokenLogado));
				}else{
					echo json_encode(array("stats" => false, "msg" => "Desculpe, não econtramos nenhum usuário com essas informações!"));
				}
			}else{
				echo json_encode(array("stats" => false, "msg" => "Nenhuma informação encontrada!"));
			}
		}
	}

	public function logout($token = ''){
		$dados = json_decode(file_get_contents("php://input"),true);       
		$web = false;

		if( sizeof($dados) > 0 ){
			$post = json_decode(file_get_contents("php://input"),true);
		}else{
			$post = $this -> input -> get();
			$post = antiInjectionArray($post);
			$token = decodeTokenJWT($post['token']);
			$web = true;
		}

		$returnToken = verificaTokenJWT($token);

		if( isset($returnToken -> idUser) ){
			$array = array('tokenLogado' => '');
					
			$updateToken = $this -> LoginModel -> updateToken($array, $returnToken -> idUser);

			if( $updateToken ){
				if( $web ){
					redirect(base_url());
				}else{
					echo json_encode(array("stats" => true, "msg" => "Usuário deslogado com sucesso!"));
				}
			}else{
				echo json_encode(array("stats" => false, "msg" => "Erro por favor tente mais tarde!"));
			}
		}else{
			echo json_encode(array("stats" => false, "msg" => "ID do usuário não encontrado!"));
		}
	}
}
