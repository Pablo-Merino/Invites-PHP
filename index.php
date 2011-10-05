<?php
include('db.php');
if($_SERVER['QUERY_STRING'] == "" || $_SERVER['QUERY_STRING'] == "/") {
header('Location:?/home');
}

$location = explode('/',$_SERVER['QUERY_STRING']);

if($location[1] == "home") {
?>
<h1>Welcome to -sitename-</h1>

<form action="./functions.php" method="post">
	<input name="mail" size="30" type="text" placeholder="Enter your mail here!"> 
	<input type="hidden" name="action" value="addtobeta"> <input type="submit">
</form><?php
} else if($location[1] == "invites") {
	if($location[2] == "done") {
		?>
		<h1>Added to the invite list</h1>
		<p>You should hear from us in a few</p>
		<?php
	} else if ($location[2] == "error") {
	?><h1>Error</h1><?php
		switch($location[3]) {
			case 1:
				?>
				<p>You need to write a mail address!</p>
				<?php
				break;
			case 2:
				?>
				<p>The mail address you inputed is not valid</p>
				<?php
				break;
			case 3:
				?>
				<p>You're already on the list!</p>
				<?php
				break;
			default:
				?>
				<p>Unknown error :(</p>
				<?php
		
		}
	}
	
} else if($location[1] == "code") {
	if(!$location[2]) {
		?>
			<h1>Welcome to -sitename-</h1>

			<form action="./functions.php" method="post">
				<input name="code" size="30" type="text" placeholder="Enter your invite code!"> 
				<input type="hidden" name="action" value="checkcode"> <input type="submit">
			</form><?php

	} else if($location[2] == $invitecode) {
			?>
			<h1>Access granted :D</h1>

			<?php
	} else if($location[2] != $invitecode || $location[2] == "error"){
			?>
			<h1>Code error :(</h1>

			<?php
	}
} else {
?>
<h1>404 Not Found</h1>
<?php
}
?>

