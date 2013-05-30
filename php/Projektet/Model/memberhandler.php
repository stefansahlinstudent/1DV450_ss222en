<?php
//Modellklassen som motsvarar createUser. 
class MemberHandler{
	private $m_mysqli;
	private $members = "members";
	private $newmembers = "newmembers";
	private $mymembers = "mymembers";
	
     public function __construct(DBConfig $db) { 
	 	$this->m_mysqli = new mysqli($db->m_host, $db->m_user, $db->m_pass, $db->m_db); 	 
	 	$this->m_mysqli->set_charset("utf8");      	        
     }
	 
	 //Lägger in användare i databasen. 
	 public function NewInsert($name, $password, $realName) {	
		$mymembers = $this->mymembers;
        $sql = "INSERT INTO " . $mymembers . "(Username, Password, tempPassword, realName) VALUES(?, ?, 0, ?)";
        $stmt = $this->m_mysqli->prepare($sql);
        
        if ($stmt === FALSE) {
                return false;
        }
        
      
		if ($stmt->bind_param("sss", $name, $password, $realName) === FALSE) {
                $stmt->close();
                return false;
        }
        
        if ($stmt->execute()) {
        } 
        else {
                $stmt->close();
                return false;
        }
            
        $stmt->close();
        return true;
	}
	
	//Kontrollfunktioner i samband med inloggningsformuläret.   		
	public function existingUsernameCheck($username){			
        $sql = "SELECT * FROM `mymembers` WHERE Username = ?";            
        $stmt = $this->m_mysqli->prepare($sql); 
		$stmt->bind_param("s", $username);
		$stmt->execute();
		$stmt->store_result();
		if($stmt->num_rows > 0){
			return true;
		}
		return false;
	}
	
	public function countRows(){
		$stmt = $this->m_mysqli->prepare("SELECT * FROM mymembers");
		$stmt->execute();
		$stmt->store_result();
		$result = $stmt->num_rows;
		
		return $result;
	}
	   
}
