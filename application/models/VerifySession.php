<?php  
class VerifySession extends CI_Model {  
	function __construct()  
	{  
		parent::__construct();  
		$this->load->database();  
	}  
	
	private $tabelaPerfil = "users";

	public function verifySession($idUser = ''){
		if( !empty($idUser) ){
			$return = $this -> getTokenUser($idUser);
			
			if( sizeof($return) > 0 ){
				if( !$return[0] -> tokenLogado && empty($return[0] -> tokenLogado) ){
					redirect(base_url());
				}
			}
		}

		$array = array('Alunos', 'Grupos', 'Livros');

		$url = base_url(uri_string());
		$url = explode("/", $url);
		
		$result = array_intersect($array, $url);
		if( sizeof($result) > 0 && $this -> session -> userdata['tipoUser'] == 2 ){
			redirect(base_url()."Admin/Dashboard");
		}
	}

	public function getTokenUser($idUser = ''){
		$this->db->select('tokenLogado');
		$this->db->from($this -> tabelaPerfil);
		$this->db->where('id', $idUser);
		$query=$this->db->get();
		$rows = $query->result();

		return $rows;
	}
}
 