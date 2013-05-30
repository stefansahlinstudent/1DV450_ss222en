<?php
require_once("./Model/writeMessageHandler.php");
require_once("./View/writeMessageView.php");

class WriteMessageController{
	
	private $userId = "userId";
	private $username = "username";
	
	public function WriteMessageControll(DBConfig $db, Validation $validator, $userId){

	 		$body = "";			
			$wmw = new WriteMessageView();
			$wmh = new WriteMessageHandler($db);
			
			$userId = $userId; 
			$body.= $wmw::intro;
			
			$body .= $wmw::Explanation;
			$body .= $wmw->WriteMessageForm();	
			
			

			//Användaren har skickat ett meddelande.
			if($wmw->HasSentMessage()){
				$content = $validator->FormatTextString($wmw->GetContent());
				$receiver = $validator->FormatTextString($wmw->GetReceiver());
				if(!empty($content) && (($receiverId = $wmh->GetID($receiver)) != null))
				{				
					$wmh->SaveWrittenMessage($userId, $receiverId, $content);
				}
				
				else{
					$body.= $wmw::BadString;
				}
			}	
			 
			//Användaren vill ta bort ett meddelande.  
			if(($messageId = $wmw->GetMessageId())!= null){
				$wmh->RemoveMessage($wmw->GetMessageId());
			}	
						
			$userMessages = $wmh->GetMessages($userId, $wmh->BlockedEnemies($userId));					
			
			$body .= $wmw->UserListButton();
			//Om användaren har bett om att få se alla medlemmar. 
			if ($wmw->WantsUserList()){
				$members = $wmh->GetAllMembers();	
				
				$enemies = 	$wmh->BlockedEnemies($userId);	
				$body .= $wmw->GetAllMembers($members, $enemies); 
				return $body;
			}					
			
			$body .= $wmw->GetMessages($userMessages); 	
			
			return $body;
				
	}
}