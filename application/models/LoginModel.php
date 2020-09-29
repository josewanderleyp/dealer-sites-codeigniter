<?php  
class LoginModel extends CI_Model {  
	function __construct()  
	{  
		parent::__construct();  
		$this->load->database();  
	}  

	private $tableUsers = 'users';
	private $tableUsersAccess = 'user_access';
	
	public function getLogin($email = '', $senha = ''){
		$this->db->select('*');
		$this->db->from($this -> tableUsers);
		$this->db->where('email', $email); 
		$this->db->where('password', $senha); 
		$this->db->where('active', 1); 
		$query = $this->db->get();
		$login = $query->result();
		return $login;
	}

	public function getEmail($email = ''){
		$this->db->select('id, nome, email');
		$this->db->from($this -> tableUsers);
		$this->db->where('email', $email); 
		$query = $this->db->get();
		$login = $query->result();
		return $login;
	}

	public function updateToken($arrDados, $idUser = ''){
		$this->db->where('id', $idUser);
		$update = $this->db->update($this -> tableUsers, $arrDados);
		
		return $update;
	}

	public function insertLogin($post){
		$this->db->insert($this -> tableUsersAccess, $post);
		return $this->db->insert_id();
	}
	
}
