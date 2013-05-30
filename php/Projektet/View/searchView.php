<?php

class SearchView{
		
	const NoMessages = "Inga meddelanden hittades";
	const Rubrik = "<h2>Sök meddelande</h2>";	
	const Explanation = "Skriv ett meddelande. Du kan söka på allt innehåll som har skrivits och allt från hela meningar och delar av ord. Söktjänsten hämtar även blockerade meddelanden.";
	private $searchInput = "searchInput";
	private $searchButton = "searchButton";
	
	public function SearchForm(){
		return '
		<form action="" method="post">
		<input type="text" name="'.$this->searchInput.'" maxlength="255" />
		 <input type="submit" name="'.$this->searchButton.'" value="Sök" />
	    </form>';
	}
	
	
	
	
	
	public function HasMadeSearch(){
		if (isset( $_POST[$this->searchButton])) {	      
	      return true;
	    }
		return false;
	}
	
	public function GetSearchPhrase(){
		if(isset($_POST[$this->searchInput])){
			return $_POST[$this->searchInput];
		}
		return null;
	}
	
	public function ShowMessages($messages){  	
	 	if(is_Array($messages)){
	  		$html = '';
	  		foreach($messages as $message){
	  			$html.=$this->StandardMessage($message);			
	  		}
			return $html;
	  	}
		$body = self::NoMessages;
		return $body;
	 }
	  
	  
	  public function StandardMessage($message){
	  	return
	  	"<div class='Message'>
	  		<p class='MessagengerName'>".$message['Sender']." -> ".$message['Receiver'] ." </p><p> ".$message['Content']."</p>
	  	</div>
	  	"; 
	  } 	
	  	
}