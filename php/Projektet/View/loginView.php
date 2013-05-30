<?php
class LoginView {
	
	private $Username= "Username";
	private $Password= "Password";
	private $LoginButton= "LoginButton";
	private $LogoutButton= "LogoutButton";
	private $Remember= "Remember";
	private $RemoveButton = "RemoveButton";
	
	const Brk = "<br/>";
	const Loggedout = "Du har just loggat ut";
	const Utloggad = "Du är utloggad";
	const Inloggad = "Du är inloggad";
	const FailedLogin= "Du misslyckades med inloggningen";
	const Rubrik = "<p>Logga in</p> ";
	const firstEvilScript = "Du skickade in en otillåten sträng i användar";
	const secondEvilScript = "Du skickade in en otillåten sträng i första passwordformuläret";
	const removeUserMessage = "Användaren är nu borttagen";
	
	  public function RemoveUser(){
	  	if (isset( $_POST[$this->RemoveButton])) {
	      return $_POST[$this->RemoveButton];
	    }
		return null;
	  }
	  
	  public function GetUserName(){
	  	if (isset( $_POST[$this->Username])) {
	      return $_POST[$this->Username];
	    }
		return null;
	  }
	  public function GetPassword(){
	  	if (isset( $_POST[$this->Password])) {
	      return $_POST[$this->Password];
	 	}
		return null;
	  }
	  
	  public function TriedToLogIn(){
	  	if (isset( $_POST[$this->LoginButton]) ) {
	      return true;
		}
		return false;
	  }
	  
	  public function TriedToLogOut(){
	  	if (isset( $_POST[$this->LogoutButton])) { 
	      return true;
		}
		return false;
	  }	
	  
	public function userLoggedOut(){
		$html = $this->DoLoginBox();
		$html.= self::Brk;
		return $html;
	}
	
	public function userLoggedIn(){
		$html = $this->DoLogoutBox();
		$html.= self::Brk;
		$html.= $this->RemoveButton();
		return $html;
	}
	
	public function removeCookie(){
		setcookie($this->Username, "", time()-3600);
		setcookie($this->Password, "", time()-3600);
	}
	
	public function createCookie($Username, $Password){
		setcookie($this->Username, $Username, time()+3600);
		setcookie($this->Password, $Password, time()+3600);
	}
	
	public function getUserCookie(){
		if (isset($_COOKIE[$this->Username]))
		{
			return $_COOKIE[$this->Username];
		}
		return null;			
	}
	
	public function getPwCookie(){
		if (isset($_COOKIE[$this->Password]))
		{
			return $_COOKIE[$this->Password];
		}
		return null;			
	}
	
	//Motsvarar rutan användaren har kryssat i för att bli ihågkommen.	
	public function rememberMe(){
		if (isset( $_POST[$this->Remember])) {
			  
		      return $_POST[$this->Remember];
		    }
		else {
			return null;
		}				
	}
			
	public function DoLoginBox() {	
	    return 
	    ''.self::Rubrik.'
	    <div class="formArea">
		    <form method="post">
			    <fieldset>
				    User name: <input type="text" name="'.$this->Username.'" maxlength="60"  value="'.$this->GetUserName().'" /><br />
					Password: <input type="password" name="'.$this->Password.'" maxlength="255"  value="" /><br />
					
				   <input type="checkbox" name="Remember" value="Remember" /> Remember me
				   <input type="submit" name="LoginButton" value="Log in" />
			   </fieldset>
		   </form>
		   <a href="?action=1">Bli medlem?</a>
	   </div>';
  	}
  
	 public function DoLogoutBox() {
	   return '
		   <div class="formArea">
		   <form name="input"  method="post">
		   <input type="submit" name="LogoutButton" value="Logga ut" />
		   </form>
	   </div> ';
	 }
  
	  public function RemoveButton() {
	    return '<form name="input"  method="post">
	    <input type="submit" name="RemoveButton" value="Ta bort mig!" />
	    </form>';
	  }
}
  