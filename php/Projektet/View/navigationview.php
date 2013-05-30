<?php
require_once("action.php");
class NavigationView {
	const action = "action";
	
	public function getAction(){
		if (isset($_GET[NavigationView::action])){
			return $_GET[NavigationView::action];
		}
		else {
			return action:: GetAvSidan;
		}
	}   
	
	//Länkmenyn i högerkolumnen
	public function createMenu(){
		return
		'
			<li><a href="index.php?'.NavigationView::action.'='.action::CREATE_MESSAGE.'">Läs och skapa meddelanden</a></li>
			<li><a href="index.php?'.NavigationView::action.'='.action::SEARCH.'">Sök meddelanden</a></li>
			<li><a href="index.php?'.NavigationView::action.'='.action::CHANGE_AUTHORITY.'">Blockera meddelanden</a></li></ul>
		';			
	}   
}