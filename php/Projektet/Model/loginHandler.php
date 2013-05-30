<?php 
class LoginHandler{
	public $userId = "userId";
	private $username = "Username";
	private $password = "password";
	private $sessionLoggedIn = "loggedIn";
	private $sessionUsername = "anvNamn";
	private $members = "members";
		
	public function __construct(DBConfig $config) { 
		      $this->m_mysqli = new mysqli($config->m_host, $config->m_user, $config->m_pass, $config->m_db); 
		      $this->m_mysqli->set_charset("utf8");
	}
	public function GetUserSession(){
		return (isset($_SESSION[$this->username])) ?  $_SESSION[$this->username] : null;
	}
	public function GetpwSession(){
		return (isset($_SESSION[$this->password])) ?  $_SESSION[$this->password] : null;
	}	
	public function RemoveUserSession(){
		session_unset();
	}
	
	//Tar här bort användarens id och även spåren från användaren i accesstabellen och meddelandetabellen. 
 	public function Remove($userId) {		
        $stmt = $this->m_mysqli->prepare("DELETE FROM `mymembers` WHERE UserId = ?"); 
		$stmt->bind_param("i", $userId);
        
        if (!$stmt->execute()) {
                    $stmt->close();
                    return false;
        }
        		
		$stmt2 = $this->m_mysqli->prepare("DELETE FROM `messages` WHERE UserId OR ReceiverId = ?"); 
		$stmt2->bind_param("i", $userId);
        
        if (!$stmt2->execute()) {
                    $stmt2->close();
                    return false;
        }
		
		$stmt3 = $this->m_mysqli->prepare("DELETE FROM `access` WHERE UserId OR BlockedId = ?"); 
		$stmt3->bind_param("i", $userId);
        
        if (!$stmt3->execute()) {
                    $stmt3->close();
                    return false;
         }
        return true;
     }  	
	
	public function DoLogin($username, $password){
		if($this->IsLoggedIn($username, $password)){
			$_SESSION[$this->username] = $username; 
			$_SESSION[$this->password] = $password; 
			return true;
		}
		return false;
	}
	
	public function IsLoggedIn($username, $password)
	{
		$stmt = $this->m_mysqli->prepare("SELECT * FROM `mymembers` WHERE `Username` = ? AND `Password` = ?");
		$stmt->bind_param("ss", $username, $password); 
		$stmt->execute();
		$stmt->store_result();
		if($stmt->num_rows > 0){		
		 	return  true;
		 }
		else {
			return false;
		}					
	}
	
	public function GetId($username)
	{
		 $query = $this->m_mysqli->prepare("SELECT `UserId` FROM `mymembers` WHERE `Username` = ?");
		 $query->bind_param("s", $username);  
		 $query->bind_result($userId);
		 $query->execute();
		 if($query->fetch()){		  
			 return $userId;	  
		 }	
		 return null;
	
	}
	
	//Genererar en randomsträng som används i samband med att användaren loggar in via cookie. 
	public function GenerateCookiePassword($username){
		
		$length = 8;
		$str = (string)NULL;
		$charset = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
     	$count = strlen($charset);
     	
     	while ($length--) {
         	$str .= $charset[mt_rand(0, $count-1)];
     	}
		
		$stmt = $this->m_mysqli->prepare("UPDATE mymembers SET tempPassword = ? WHERE Username = ?");
		$stmt->bind_param("ss", $str, $username);
		$stmt->execute();
		$stmt->close();
  		
	   return $str;

	}
	
	//Funktion som går om användaren väljer att logga in via cookie. 
	public function DoCookieLogin($username, $password){		
		
	  	$sql = "SELECT * FROM `mymembers` WHERE `Username` = ? AND `tempPassword` = ?"; 
	    $stmt = $this->m_mysqli->prepare($sql);
		$stmt->bind_param("ss", $username, $password);
		$stmt->execute();
		$stmt->store_result();
			
		if($stmt->num_rows > 0){			
			$newCookie = $this->GenerateCookiePassword($username);
			return $newCookie;			
		}
		
		$stmt->close();
		
		return null;	
	}	
	
	
}

