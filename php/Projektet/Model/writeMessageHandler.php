<?php

class WriteMessageHandler{
	private $m_mysqli;
	private $messages = "messages";
	private $username = "username";
	private $userId = "userId";
	private $blockedId = "BlockedId";
	
	public function __construct(DBConfig $config) { 
	      $this->m_mysqli = new mysqli($config->m_host, $config->m_user, $config->m_pass, $config->m_db); 
	      $this->m_mysqli->set_charset("utf8");
	}
	
	//används för att man ska kunna se de övriga användarnas användarnamn när man ska skicka meddelanden
	public function GetAllMembers(){
		$username = $this->username;
		$membersArray = Array();			
			
		$query = "SELECT realName, Username, UserId FROM mymembers";	
		$result = $this->m_mysqli->query($query);
		while ($row = $result->fetch_array()){
			$membersArray[] = $row;
		} 
		return $membersArray;
	}

	//funktion för att hämta id att arbeta med i projektet
	public function GetID($receiver)
	{
		
		 $query = $this->m_mysqli->prepare("SELECT `UserId` FROM mymembers WHERE `Username` = ?");
		 $query->bind_param("s", $receiver);  
		 $query->bind_result($userId);
		 $query->execute();
		 $query->store_result();

		 if($query->fetch()){
			  return $userId;	
		 }		 		 
		 return null;	
	}
	
	
	public function SaveWrittenMessage($sender, $receiver, $content){
		$messages = $this->messages;
        $sql = "INSERT INTO " . $messages . "(UserId, ReceiverId, Content) VALUES(?, ?, ?)"; 
        $stmt = $this->m_mysqli->prepare($sql);  
        $stmt->bind_param("iis", $sender, $receiver, $content);
        
        $stmt->execute();
        $stmt->close();				
	}
	//Hämtar de användare vars meddelanden man inte vill se
	public function BlockedEnemies($userId){
		$enemies =  Array();
		$stmt = $this->m_mysqli->prepare("SELECT `BlockedId` FROM access WHERE `UserId` = ?");		
		$stmt->bind_param("i", $userId);
		$stmt->execute();
		$result = $stmt->get_result();
		while ($row = $result->fetch_array()){
			$enemies[] = $row[$this->blockedId]; 
		}	
		return $enemies;
	}
	
	public function RemoveMessage($messageId){

		$stmt = $this->m_mysqli->prepare("DELETE FROM messages WHERE MessagesId = ?");
		$stmt->bind_param("i", $messageId);
		$stmt->execute();
		$stmt->close();
	}
	
	
	//Här ska man se till så att den inte hämtar ens egna meddelanden. 
	public function GetMessages($userId, $blockedArray = array()){
		$messagesArray = Array();			
		
		$stmt = $this->m_mysqli->prepare("SELECT `MessagesId`, `UserId`,`Content`, (SELECT realName FROM mymembers WHERE mymembers.UserId=messages.UserId) AS Sender, (SELECT realName FROM mymembers WHERE mymembers.UserId=messages.ReceiverId) AS Receiver FROM `messages` WHERE `UserId` = ? OR `receiverId` = ?");	
		$stmt->bind_param("ii", $userId, $userId);   
		$stmt->execute();
		$result = $stmt->get_result();
		//Placerar in alla meddelanden som inte har sin userId placerad i blockedArray
		while($row = $result->fetch_array()){
			if(!in_array($row['UserId'], $blockedArray)){
				$messagesArray[] = $row;	
			}
		}
		
	    $stmt->close();
		return $messagesArray;
	}
	
}