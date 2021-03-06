<?php
require(dirname(__FILE__) . '/../MadMimi.class.php');

// There are a total of four arguments that can be used on the next line. The first two are shown here, the second two
// are optional. The first of them is a debugger, which defaults to false, and the second, allows you to print
// the transaction ID when sending a message. It also defaults to false.
$mailer = new MadMimi('nicholas@madmimi.com', 'f745b56de62ab9b46f613173a10806fb'); 

if ($mailer->Authenticate()) {
	// Get all lists for this account..
	$lists = $mailer->Lists();
	$lists = new SimpleXMLElement($lists);
	// ...and loop through them.
	foreach ($lists as $list) {
		echo $list['name'] . "<br />";
	}

	// Now, let's check a user's membership status...
	$memberships = $mailer->Memberships('noreply@example.com');
	$memberships = new SimpleXMLElement($memberships);
	foreach ($memberships as $list) {
		echo $list['name'] . "<br />";
	}

	// Maybe we just want to send a message?
	$options = array('recipients' => 'Nicholas Young <nicholas@madmimi.com>', 
					 'promotion_name' => 'Untitled Promotion', 'subject' => 'You Gotta Read This', 
					 'from' => 'Mad Mailer <noreply@example.com>');
	$body = array('greeting' => 'Hello', 'name' => 'Nicholas');
	$mailer->SendMessage($options, $body);
} else {
	echo 'Wrong username or api key'.'<br />'.PHP_EOL;
}
?>

