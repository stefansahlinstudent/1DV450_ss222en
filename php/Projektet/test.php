<?php
require_once('Model/memberhandler.php');
require_once('DBconfig.php');
require_once('Model/loginHandler.php');
require_once('Model/writeMessageHandler.php');
require_once('Model/searchModel.php');


$db = new DBConfig();

$mh = new MemberHandler($db);
$lh = new LoginHandler($db);
$wmh = new WriteMessageHandler($db);
$sh = new SearchModel($db);

echo "<h1>Member handler test<h1>";
$uname = "randomName";
$upass = "randomPass";
$realName = "Dude Dudeson";

echo "<h2>Testing insert</h2>";
if ($mh->NewInsert($uname, $upass, $realName) == false) {
	echo "Test failed";
} else {
	echo "Test Succeded";
}


echo "<h2>Testing existing membername </h2>";
if ($mh->existingUsernameCheck($uname) == false) {
	echo "No such user";
} else {
	echo "User Exists";
}


echo "<h1>Loginhandler test<h1>";
$uname = "randomName";
$upass = "randomPass";

echo "<h2>Testing remove member </h2>";
if ($lh->Remove(24) == false) {
	echo "Test failed";
} else {
	echo "Test succeded";
}

echo "<h2>Testing login</h2>";
if ($lh->DoLogin($uname, $upass) == true) {
	echo "Test failed";
} else {
	echo "Test succeded";
}

echo "<h2>Testing Get Id</h2>";
echo $lh->GetID($uname);

echo "<h2>Testing IsLoggedIn</h2>";
if ($lh->IsLoggedIn($uname, $upass) == true) {
	echo "Logged in";
} else {
	echo "Logged out";
}

echo "<h2>Testing DoCookieLogin</h2>";
if ($lh->DoCookieLogin($uname, $upass) == true) {
	echo "Logged in by cookie";
} else {
	echo "Not logged in by cookie";
}

echo "<h1>WriteMessageHandler Test<h1>";
$members = $wmh->GetAllMembers();

/*
foreach($members as $member){
	  			echo "<p>member: </p> ";
	  			echo $member["Username"];			
}

 */

echo "<h2>Enemy Test<h2>";
$enemies = $wmh->BlockedEnemies(1);
$nrEnemies =  count($enemies);
if ($nrEnemies == 0) {
     echo "<p>No enemies</p>";
} 
else{
	foreach($enemies as $enemy){
	  			echo "<p>enemy: </p> ";
	  			echo $enemy["Username"];			
	}
}

echo "<h2>Testing Save Message</h2>";
if ($wmh->SaveWrittenMessage(3, 2, "A message") == true) {
	echo "Test failed";
} else {
	echo "Test Succeded";
}

echo "<h2>Testing Remove Message</h2>";
if ($wmh->RemoveMessage(1) == true) {
	echo "Test failed";
} else {
	echo "Test Succeded";
}


echo "<h2>Testing GetMessages</h2>";

$messages = $wmh->GetMessages(2);

foreach($messages as $message){
	  			echo "<p>message: </p> ";
	  			echo $message["Content"];			
}

echo "<h1>SearchHandler Test<h1>";
$searchMessages = $sh->GetAllMessages("hello", 1);

$nrOfSearchMessages = count($searchMessages);
echo "<h2>Number of SearchMessages<h2>";
echo $nrOfSearchMessages;
 
?>       