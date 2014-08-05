<?php
    // header("content-type: text/xml");
    echo "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n";

    /* Load the quotes JSON file */
    $file = "sms.json";
    $string = file_get_contents($file);
    $json = json_decode($string, true);

    /* Select a quote at random */
    $num_quotes = count($json["quotes"]) - 1;
    $random_number = rand(0, $num_quotes);
    $quote = $json["quotes"][$random_number]["text"];
    $author = $json["quotes"][$random_number]["author"];

/**
	 * To reply to a text message.
	 *
	 */

	// Step 1: Check for new messages
	include ( "../lib/src/NexmoMessage.php" );
	
    
	// // Step 2: Use reply method to send a message. 
	
	$message = $quote;
	$nexmo_sms = new NexmoMessage('88ead324', 'c4a0a0dd');
	$nexmo_sms->inboundText ( $data=null );
	$info = $nexmo_sms->reply($message);

	// // Step 3: Display an overview of the message
	echo $nexmo_sms->displayOverview($info);

	// Done!
?>

