<?php
class WriteMessageView{
	private $Content= "Content";
	private $SendButton= "SendButton";
	private $Receiver= "Receiver";
	private $UserListButton = "UserListButton";
	private $removeMessage = 'removeMessage';
	private $UserId = "UserId";
	private $username = "Username";
	private $sender = "Sender";
	private $MessagesId = 'MessagesId';
	private $realname = "realName";
	
	const intro = "<h2>Skriv meddelanden</h2>";
	
	const Explanation = "<p>Skriv ett meddelande. Du kan även skicka till dig själv. Mottagarens <i>användarnamn</i> måste finnas i databasen.  Klicka på Alla användare för att få fram användarnamn. 
	Om meddelandefältet eller mottagarfältet lämnas tomt eller mottagarfältet är felaktigt, skickas inget meddelande. Ett meddelande får ha max 255 tecken.</p>"; 
	const NoContent = "Inget meddelande fanns";
	const NoMembers = "Inga medlemmar hittades";
	const NoMessages = "Inga meddelanden hittades";
	const SentMessage = "Meddelandet har skickats";
	const BadString = "<p class='red'>Skriv i uppgifterna rätt</p>";
	

	//Uppdaterad meddelandeformulär. Nu med javascriptfunktion som försvårar användaren från att göra fel. 
	public function WriteMessageForm(){
		
		return '<form class="messageForm"  onsubmit ="validateForm()" action="index.php?'.NavigationView::action.'='.action::CREATE_MESSAGE.'" method="post">
		Receiver <input type="text" id="receiverBox" onchange="enableField()"  onkeyup="enableField()" name="'.$this->Receiver.'" value="'.$this->GetReceiver().'" />
		Content <input type="text" id="contentBox"  name="'.$this->Content.'" maxlength="255" />
		
	    <input type="submit" value="Skicka meddelande" name="'.$this->SendButton.'" />
	    </form><script type="text/javascript">enableField()</script>';
	    
	}
	
	
	public function HasSentMessage(){
	  	if (isset($_POST[$this->Content])) {   
	      return true;
	    }
		return false;
	}
	
	//Tar emot innehåll
	public function GetContent(){
		if (isset( $_POST[$this->Content])){
			utf8_encode($_POST[$this->Content]);
			return $_POST[$this->Content];
		}
		return null;
	}
	
	//Tar emot mottagare
	public function GetReceiver(){
		if (isset( $_POST[$this->Receiver])){
			return $_POST[$this->Receiver];
		}
		return null;
	}
	
	//Användarna visas upp
	 public function GetAllMembers($members, $enemies){
	  	
	  	if(is_Array($members)){
	  		$html = '';
	  		foreach($members as $member){
	  			if(in_array($member[$this->UserId], $enemies)){
					$html .= $this->MemberShow($member, false);
				}
				else{
					$html.=$this->MemberShow($member);
				}			
	  		}
			return $html;
	  	}
		return self::NoMembers;
	 }
	 
	 //Visuell presentation av varje användare. Kopplad till javascriptfunktion som förenklar processen vid meddelarformuläret
	public function MemberShow($member, $isFriend = true){
	  	return"<div class='Member'>  	
	  		<p class='MessagengerName'>".$member[$this->realname]."</p><a href='#' onclick='setReceiver(\"" . $member[$this->username] . "\")'>välj</a>	  		
	  		</div>";
	}  
	  
	//Användaren har valt att ta fram lista över övriga användare
	public function WantsUserList(){
		if (isset( $_POST[$this->UserListButton])){
			return true;
		}
		return false;
	}
	 
	 
	 public function UserListButton(){
		return '<form action="index.php?'.NavigationView::action.'='.action::CREATE_MESSAGE.'" method="post">
	    <input type="submit" onsubmit ="return validateForm()"  name='.$this->UserListButton.' value="Alla användare" />
	    </form>';
	 }
	 
	 //Tar med bild som visar om användaren är vän eller fiende
	 public function FriendPicture($isFriend){
	  	if($isFriend){
	  		return"./img/greenCheck.png";
	  	}
	  	return"./img/redX.png";
	  } 
	 
	 //Presenterar arrayen med meddelanden
	 public function GetMessages($messages){
	  	
	  	if(is_Array($messages)){
	  		$html = '';
	  		foreach($messages as $message){
	  			$html.=$this->StandardMessage($message);			
	  		}
			return $html;
	  	}
		return self::NoMessages;
	 }
	  
	  //Mallen för hur ett meddelande ska se ut
	  public function StandardMessage($message){
	  	return
	  	"<div class='Message'>	  		
	  		<p class='MessagengerName'>".$message[$this->sender]." -> ".$message[$this->Receiver] ."</p><p> ". $message[$this->Content] ."</p>
	  		".$this->RemoveMessageLink($message[$this->MessagesId])."
	  	</div>
	  	"; 
	  }  
	  
	  //Funktion som används vid borttagande av meddelande. 
	  public function GetMessageId(){
	  	if(isset($_GET[$this->removeMessage])){
	  		return $_GET[$this->removeMessage];
	  	}
		 return null;
	  }
	  
	  //Länk till att ta bort meddelande
	 public function RemoveMessageLink($messageId){
	 	return "<a class='right' href='?".NavigationView::action."=".action::REMOVE_MESSAGE."&removeMessage=$messageId'>Ta bort meddelande</a>";
	 }
}
