<?php
require_once("./View/searchView.php");
require_once("./Model/searchModel.php");

class SearchController{
 	
	 	public function DoControll(DBConfig $db, Validation $validator, $userId){			 		
	 		$body = "";
			$sm = new SearchModel($db);
	 		$sw = new SearchView();	
			$body .= $sw::Rubrik;
			$body .= $sw::Explanation;	
			$body .= $sw->SearchForm();	
			
			if ($sw->HasMadeSearch()){
				$searchPhrase = $validator->FormatTextString($sw->GetSearchPhrase());
				
				$messages = $sm->GetAllMessages($searchPhrase, $userId);
				if(!$messages){
					$body .= $sw::NoMessages;
				}
				$body .= $sw->ShowMessages($messages);
							
				return $body;
			}	
								
			return $body;		
	}
}

