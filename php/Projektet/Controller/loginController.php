<?php
require_once("./View/loginView.php");
require_once("./Model/loginHandler.php");

class LoginController{
	private $userId = null;
	private $loginStatus = false;
		
	
	//Huvudkontrollern som körs varje gång i samband med in- och utloggning. 
	public function DoControll(DBConfig $db, Validation $validator){
		$lh = new LoginHandler($db);
		$lw = new LoginView();
		$xhtml = "";
		
		$loginValidator = new Validation(); 
		
		//Användaren vill logga ut
		if ($lw->TriedToLogout()){								
			$lh->RemoveUserSession();
			$lw->removeCookie();
			$xhtml .= $lw->userLoggedOut();  					
			return $xhtml;				
		}
		
		//Användaren vill logga in med cookie. 
		if(($username = $lw->getUserCookie()) != null && ($password = $lw->getPwCookie()) != null){
			if(($newCookie = $lh->DoCookieLogin($username, $password)) != null){
				//Användaren vill ta bort sig själv ur databasen. 
				if ($lw->RemoveUser()){
					$lh->Remove($lh->GetUserSession()); 
					$lw->removeCookie();
					$xhtml .= $lw->userLoggedOut();  					
					return $xhtml;		
				}
				$this->userId = $lh->GetId($username);
				$lw->removeCookie();
				$lw->createCookie($username, $newCookie);
				$this->loginStatus = true;
				$xhtml.= $lw->userLoggedIn();
				return $xhtml;
			}
		}
			
		//Inloggad-tillstånd
		if($lh->IsLoggedIn($lh->GetUserSession(), $lh->GetPwSession())){
			//Ta bort sig själv som användare. 
			if ($lw->RemoveUser()){
				$lh->Remove($lh->GetID($lh->GetUserSession()));
				$lw->removeCookie(); 
				$xhtml .= $lw->userLoggedOut();  					
				return $xhtml;		
			}
			
			$this->userId = $lh->GetId($lh->GetUserSession());
			$this->loginStatus = true;
			$xhtml.= $lw->userLoggedIn();
			return $xhtml;
		}
		
		//Försöker logga in. 
		if($lw->TriedToLogIn()){
			if($lh->DoLogin($lw->GetUserName(), $lw->GetPassword())){
				if($lw->rememberMe()){						
					$lw->createCookie($lw->GetUserName(), $lh->GenerateCookiePassword($lw->GetUserName())); 
				}
				$this->userId = $lh->GetId($lw->GetUserName());
				$this->loginStatus = true;
				$xhtml.= $lw->userLoggedIn();
				return $xhtml;			
			}
		}
		
		$xhtml .= $lw->userLoggedOut();  					
		return $xhtml;			
	}
	public function GetLoginStatus(){
		return $this->loginStatus;
	}
	
	public function GetUserId(){
		return $this->userId;
	}
}
