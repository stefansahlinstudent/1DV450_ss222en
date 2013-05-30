<?php

class createUserView{
	const errorMessage = "Det blev fel på registreringen"; 
	const usernameErrorMessage = "Användarnamnet måste vara mellan 6 och 20 tecken och inga taggar får användas";
	const passwordErrorMessage = "Lösenordet måste vara mellan 6 och 20 tecken och de måste matcha";
	const alreadyExistingUser = "Användaren finns redan";
	const nowRegistered = "Användaren är nu registrerad, du kan nu logga in.";
	const indexLink = "<a href='index.php'>Tillbaka till index</a> ";
	const firstEvilScript = "Du skickade in en otillåten sträng i användar";
	const secondEvilScript = "Du skickade in en otillåten sträng i första passwordformuläret";
	const thirdEvilScript = "Du skickade in en otillåten sträng i andra passwordformuläret";
	const brk = "<br />";
	const wrongName = "Skriv ut ditt riktiga namn!";
	
	public $BecomeMember= "BecomeMember";
	public  $CreateMember= "CreateMember";
	public  $Username= "createUsername";
	public  $Password1= "createPassword1";
	public  $Password2= "createPassword2";
	public  $FirstName= "FirstName";
	public  $LastName= "LastName";
	public  $RealName= "RealName";
	
	public function successfulRegistration(){
		return self::nowRegistered . self::brk;
	}
	
	
	public function NewMemberBox($status) {
		if ($status == true){
			return '<p>Welcome to Vestalia</p>';
		}
		
		$Username="";		
	  	return '<form action="index.php?'.NavigationView::action.'='.action::CREATE_NEW_USER.'" method="post">
	    <fieldset>
	    <input type="text" name="'.$this->RealName.'" maxlength="100"  value="" /> Ditt riktiga namn (min 6) <br />
	    <input type="text" name="'.$this->Username.'" maxlength="60"  value="'.$this->GetNewUsername().'" /> Username (min 6) <br />
		<input type="password" name="'.$this->Password1.'" maxlength="255"  value="" /> Password (min 6) <br />
		<input type="password" name="'.$this->Password2.'" maxlength="255"  value="" /> Repeat Password <br />
		
	   	<input type="submit" name="'.$this->CreateMember.'" value="Skapa medlem" />
	   	</fieldset>
	   	</form>';
  	}
	
	public function CreateNewMember(){
	  	if (isset( $_POST[$this->CreateMember])) {    
	      return true;
		}
		else {
			return false;
		}
  	}
	
	public function GetRealname(){
	  	if (isset( $_POST[$this->RealName])) {	      
	      return $_POST[$this->RealName];
	    }
		else {
			return null;
		}
	}
  	
	public function GetFirstname(){
	  	if (isset( $_POST[$this->FirstName])) {	      
	      return $_POST[$this->FirstName];
	    }
		else {
			return null;
		}
	}
	
	public function GetLastname(){
	  	if (isset( $_POST[$this->LastName])) {	      
	      return $_POST[$this->LastName];
	    }
		else {
			return null;
		}
	}
	
	
	public function GetNewUsername(){
	  	if (isset( $_POST[$this->Username])) {	      
	      return $_POST[$this->Username];
	    }
		else {
			return null;
		}
	}
	
	public function IsSubmit(){
		return (isset($_POST[$this->CreateMember])) ? true : false;
	}
	
	public function GetFirstPassword(){
	  	if (isset($_POST[$this->Password1])) {
	      
	      return $_POST[$this->Password1];
	    }
		else {
			return null;
		}
  	}
	
	public function GetSecondPassword(){
	  	if (isset( $_POST[$this->Password2])) {
	      
	      return $_POST[$this->Password2];
	    }
		else {
			return null;
		}
	 }	
}


