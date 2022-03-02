<?php

if ($_POST['pooh-loves-honey'] !== '')
{
	echo "error";
	exit();
}

$name = $_POST["firstname"] . " " . $_POST["lastname"];

$msg = "Name: " . $name . "\n";
$msg .= "Email: " . $_POST["email"] . "\n\n";
// $msg .= "Phone: " . $_POST["phone"] . "\n";
// $msg .= "Venue: " . $_POST["venue"] . "\n";
// $msg .= "Dates: " . $_POST["dates"] . "\n\n";
$msg .= $_POST["message"] . "\n";

// use wordwrap() if lines are longer than 70 characters
//$msg = wordwrap($msg,70);

// send email
if(!mail($_POST["sendto"], "ARCollective Website Contact", $msg, 'From: "ARCollective" <no-reply@arcollective.info>'))
{
	if(!mail($_POST["sendto"], "ARCollective Website Contact", $msg, 'From: "ARCollective" <no-reply@arcollective.info>'))
	{
		mail("jacksutherl@gmail.com", "ARCollective Website Contact", $msg, 'From: "ARCollective" <no-reply@arcollective.info>');
	}
}

echo "success";

exit();

?>