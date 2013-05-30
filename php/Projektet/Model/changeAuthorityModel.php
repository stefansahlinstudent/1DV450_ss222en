<?php 
class ChangeAuthorityModel{
	private $m_mysqli;
	private $username = 'username';
	private $userId;
	private $BlockedId = 'BlockedId';

	public function __construct(DBConfig $db, $userId) {
		$this->userId = $userId;
        $this->m_mysqli = new mysqli($db->m_host, $db->m_user, $db->m_pass, $db->m_db);
		$this->m_mysqli->set_charset("utf8");
    }
	
	//Nu Korrigerad så jag inte kan blocka mina egna meddelanden. 	
	public function GetAllMembers($userId){
		$username =  $this->username;
		$membersArray = Array();			
		$stmt = $this->m_mysqli->prepare("SELECT realName, Username, UserId FROM mymembers WHERE `UserId` <> ?");	
		$stmt->bind_param("i", $userId);
		$stmt->execute();
		$result = $stmt->get_result();
		while ($row = $result->fetch_array()){
			$membersArray[] = $row;
		} 
		return $membersArray;
	}
	
	//Returnerar lista på de användare vars id finns med i accesslistan över blockerade användare. 
	public function BlockedEnemies($userId){
		$enemies =  Array();
		$stmt = $this->m_mysqli->prepare("SELECT `BlockedId` FROM access WHERE `UserId` = ?");	
		$stmt->bind_param("i", $userId);
		$stmt->execute();
		$result = $stmt->get_result();
		while ($row = $result->fetch_array()){
			$enemies[] = $row[$this->BlockedId]; 
		}	
		return $enemies;
	}
	
	//Blockfunktionen lägger till berörd användares id i accesstabellen om denne inte är blockerad och tar bort samme användares id om den är blockerad. 
	public function Block($receiverId){
		$enemies = $this->BlockedEnemies($this->userId);
		if (!in_array($receiverId, $enemies)){
			$stmt = $this->m_mysqli->prepare("INSERT INTO `access`(UserId, BlockedId) VALUES(?, ?)");
			$stmt->bind_param("ii", $this->userId, $receiverId);
			$stmt->execute();
			$stmt->close();
		}	
		else{
			$stmt = $this->m_mysqli->prepare("DELETE FROM `access`WHERE UserId=? AND BlockedId = ?");			
			$stmt->bind_param("ii", $this->userId, $receiverId);
			$stmt->execute();
			$stmt->close();
		}
	}	
}
