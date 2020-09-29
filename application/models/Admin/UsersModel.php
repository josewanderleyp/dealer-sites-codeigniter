<?php  
class UsersModel extends CI_Model {  
	function __construct()  
	{  
		parent::__construct();  
		$this->load->database();  
	}  
	
	private $tabelaUsers = "users";
	private $tabelaAcess = "user_access";

	
	public function getUsers(){
		$this->db->select('*');
		$this->db->from($this -> tabelaUsers);
		$this->db->where('active', 1);
		$query = $this->db->get();
		$login = $query->result();
		return $login;
	}

	
	public function getLastLogin($idUser = ''){
		$this->db->select('DATE_FORMAT(last_login, "%d/%m/%Y %H:%i%:%s") as last_login');
		$this->db->from($this -> tabelaAcess);
		$this->db->where('user_id', $idUser);
		$this->db->order_by('id', 'DESC');
		$query = $this->db->get();
		$login = $query->result();
		return $login;
	}

	public function ToObject($Array) { 
		// Create new stdClass object 
		$object = new stdClass(); 
		
		// Use loop to convert array into 
		// stdClass object 
		foreach ($Array as $key => $value) { 
			if (is_array($value)) { 
				$value = $this -> ToObject($value); 
			} 
			$object->$key = $value; 
		} 
		return $object;
	}

	// Puxar campos da tabela
	public function selectCampos($tbl){
		$sql = 'SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_SCHEMA = "'.$this->db->database.'" AND TABLE_NAME = "'. $tbl.'"';
		$query = $this->db->query($sql);
		$rows = $query->result_array();

		$array = array();

		if( sizeof( $rows ) > 0 ){
			$x = 0;

			foreach ($rows as $key => $value) {
				$name = $value['COLUMN_NAME'];
				$array[$name] = "";
				// $x++;
			}
		}

		$array[0] = $array;

		return $array;
	}
}	
 