<?php 
include("db.php");

switch($_POST['action']) {
	case "addtobeta":
		$dbconnect = mysql_connect($host, $dbuser, $dbpass) or die("could not connect to database<br>".mysql_error());

		addtobeta($_POST['mail'], $dbconnect);
		break;
	case "checkcode":
		if($_POST['code'] == $invitecode) {
			header("Location: ./?/code/$invitecode");

		} else {
			header("Location: ./?/code/error");

		}
}
function addtobeta($mail, $dbconnect) {


	if(!$mail) {
			header("Location: ./?/invites/error/1");
	} else {
		mysql_select_db("invites", $dbconnect) or die("could not select database<br>".mysql_error());

		$result = mysql_query("SELECT * FROM invites", $dbconnect) or die(mysql_error());
		while($r[]=mysql_fetch_row($result));
		
		if(findIndexByName($r, $mail, 0) != -1) {
			header("Location: ./?/invites/error/3");

		} else if(filter_var($mail, FILTER_VALIDATE_EMAIL)) {

			mysql_select_db("invites", $dbconnect) or die("could not select database<br>".mysql_error());

			$result = mysql_query("INSERT INTO invites (mail) VALUES('$mail');", $dbconnect) or die(mysql_error());
			
			header("Location: ./?/invites/done");
		} else {
			header("Location: ./?/invites/error/2");
		}

	}
}

function findIndexByName ($array, $name, $indexname) {
	foreach ($array as $index => $entry)
		if ($entry[$indexname] === $name) return $index;
		return -1; // or "false", or "-1", or whatever
}

?>