<?php

session_start();
require_once("Controller/changeAuthorityController.php");
require_once("Controller/createusercontroller.php");
require_once("Controller/loginController.php");
require_once("DBconfig.php");
require_once("action.php");
require_once("View/navigationview.php");
require_once("Validation4.php");
require_once("masterpage.php");
require_once("Controller/writeMessageController.php");
require_once("Controller/searchController.php");
require_once("indexmessages.php");


class MasterController {

	public static function doControll() {
	$xhtml="";
	$cuc = new createUserController(); 
	$lc = new LoginController();
	$db = new DBConfig();
	$nw = new NavigationView(); 
	$wmc = new WriteMessageController();
	$cac = new ChangeAuthorityController();
	$sfc = new SearchController();
	$im = new indexMessages();
		
	$validator = new Validation();
	$mp = new MasterPage();	

	$links = $lc->DoControll($db, $validator);
	
		//Sidan laddas. Switchsaterna bestämmer vilken action användaren har valt. 
		switch ($nw->getAction())
		{
			case action::REMOVE_MESSAGE:
				$title = $im::remove;
				if($lc->GetLoginStatus()){
					$xhtml.= $wmc->WriteMessageControll($db, $validator, $lc->GetUserId());
				}					
		  	break;
				
			case action::CREATE_NEW_USER:
				$status = $lc->GetLoginStatus();
				$title = $im::create;
				$xhtml= $cuc->cucControll($db, $status);
			break;
			
		  	case action::CREATE_MESSAGE: 
				$title = $im::write;
				if($lc->GetLoginStatus()){
					$xhtml.= $wmc->WriteMessageControll($db, $validator, $lc->GetUserId());
				}
				else{
					$xhtml.=  $im::notlogdin;
				}
			break;
			
		  	case action::CHANGE_AUTHORITY: 
				$title = $im::change;
				if($lc->GetLoginStatus()){
					$xhtml.= $cac->ChangeAuthorityControll($db, $validator, $lc->GetUserId());
				}
				else{
					$xhtml.=  $im::notlogdin;
				}
			break;
			
			case action::SEARCH:
				$title = $im::search;
				if($lc->GetLoginStatus()){
					$xhtml.= $sfc->DoControll($db, $validator, $lc->GetUserId());
				}else{
					$xhtml.=  $im::notlogdin;
				}	
			break;
			
			default: 	  	
				$title = $im::MainView;			
		  	break;	
	    }	
		return $mp->GetVestaliaPage($title, $xhtml, $links. $nw->createMenu());	
	}
}

echo MasterController::doControll();
?>

