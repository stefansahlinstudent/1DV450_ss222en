<?php
class ChangeAuthorityView{
	const intro = "Välj vems meddelanden som du inte vill se. Rödkryssade användares meddelanden kan du inte se. För att ändra synlighet, klicka på bocken/krysset";
	const rubrik = "<h1>Blockera meddelanden</h1>";
	private $switchButton = "SwitchButton";
	private $username = "Username";
	private $UserId = 'UserId';
	private $membernumber = "membernumber";
	private $realname = "realName";
	
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
		$html = "Inga medlemmar hittades";
		return $html;
	 }
	 
	  public function MemberShow($member, $isFriend = true){
		if($isFriend == true){
			return"<div class='Member'>  	
	  		<p>".$member[$this->realname]."<a href='?".NavigationView::action."=".action::CHANGE_AUTHORITY  ."&membernumber=".$member[$this->UserId]."'><img class='redImage' src=".$this->FriendPicture($isFriend).">Dölj</a></p>	  		
	  		</div>
	  	";	
		}
		return "<div class='Member'>  	
	  		<p>Användaren ".$member[$this->username]."<a href='?".NavigationView::action."=".action::CHANGE_AUTHORITY  ."&membernumber=".$member[$this->UserId]."'><img class='redImage' src=".$this->FriendPicture($isFriend).">Läs</a></p>	  		
	  		</div>
	  	";	
	  }  
	  		  
	  public function FriendPicture($isFriend){
	  	if($isFriend){
	  		return "./img/greenCheck.png";
	  	}
	  	return "./img/redX.png";
	  } 
	  
	  public function WantToBlock(){
			if (isset($_GET[$this->membernumber])){
	 			return true;
	 		}
			return false;
	  }
	  
	  //Tar emot id från den användare som vår användare har klickat på för att blocka
	  public function BlockingId(){
		return $_GET[$this->membernumber];
	  }
}