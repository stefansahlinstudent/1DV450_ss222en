<?php
require_once("./View/createuserview.php");
require_once("./Model/memberhandler.php");
require_once("./Validation4.php");
class createUserController{
	
	
	public function cucControll(DBConfig $db, $status){
		
		$output= "";
			
		$cuw = new createUserView();
		$user = $cuw->Username;
		$firstPassword = $cuw->Password1;
		$secondPassword = $cuw->Password2;
		
		$FirstName = $cuw->FirstName;
		$LastName = $cuw->LastName;
		$RealName = $cuw->RealName;
			
		//Sidan hämtas men inte från formuläret	
		if ($_SERVER['REQUEST_METHOD'] == 'GET'){ 
			
			$output.= $cuw->NewMemberBox($status);
		 }
		
		//Användaren har försökt bli medlem. 
		 else {
		 	if($cuw->IsSubmit()){
		 	
				$RealName = $cuw->GetRealname();
				
				$user = $cuw->GetNewUsername();
				$fPassword = $cuw->GetFirstPassword();
				$sPassword = $cuw->GetSecondPassword();
				
				$mh = new MemberHandler($db);				
				$validator = new Validation();
				
				//Valideringsfunktioner för skapa-användare-formuläret
				if(!$validator->CheckUsername($RealName)){
					$output .= $cuw::wrongName;
					$output .= $cuw->NewMemberBox($status);
					return $output;
				}
					
				if(!$validator->CheckUsername($user)){
					$output .=$cuw->NewMemberBox($status).$cuw::usernameErrorMessage;
				}
				elseif(!$validator->CheckPassword($fPassword, $sPassword)){
					$output .=$cuw->NewMemberBox($status).$cuw::passwordErrorMessage;
				}
				elseif($mh->existingUsernameCheck($user)){
					$output .=$cuw->NewMemberBox($status).$cuw::alreadyExistingUser;
				}
				else{
					if($mh->NewInsert($user, $fPassword, $RealName)){
						$output .= $cuw->successfulRegistration();
					}
					else{
						$output .= $cuw->NewMemberBox($status).$cuw::errorMessage;
					}					
				}
			}
			else{
				$output.= $cuw->NewMemberBox($status);
			}
 		}
	return $output;
	}
}	

