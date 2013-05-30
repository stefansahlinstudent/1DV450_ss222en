<?php
require_once("./View/changeAuthorityView.php");
require_once("./Model/changeAuthorityModel.php");
class ChangeAuthorityController{
	//Klass vars funktion är att välja bort meddelanden från valda användare
	
	private $userId = "userId";
	private $membernumber = "membernumber";
	
	public function ChangeAuthorityControll(DBConfig $db, Validation $validator, $userId){	 		
	 		$body = "";
			$cam = new ChangeAuthorityModel($db, $userId);
	 		$caw = new ChangeAuthorityView();	
			$body .= $caw::rubrik;	
			$body .= $caw::intro;					
			
			if ($caw->WantToBlock() == true){			
				$blockingId = $caw->BlockingId();
				$cam->Block($blockingId);
			}
			
			$enemies = 	$cam->BlockedEnemies($userId);			
			$members = $cam->GetAllMembers($userId);	
			$body .= $caw->GetAllMembers($members, $enemies); 			
			
			return $body;
	}
}