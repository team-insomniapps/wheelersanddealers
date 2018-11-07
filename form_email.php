<?php

	// grab information from form
  $name = $_POST['name'];
  $visitor_email = $_POST['email'];
  $message = $_POST['message'];
  
  // set variables of the sites information
  $email_from = "www.wheelersanddealers.net";
  $email_address = $visitor_email;
  $email_subject = "Feedback or Issue";
  $email_body = "You have received a new message from the user $name.\n".
                            "Here is the message:\n $message";
	
 
 // send message information
  $to = "jasonaelane@gmail.com";
  $headers = "From: $email_from \r\n";
  $headers .= "Reply-To: $visitor_email \r\n";
  mail($to,$email_subject,$email_body,$headers);

  
 
  // change back to contact user page
  

  header('Location: success.php');
  echo "Thank you for your submission')";
 
  
  
?>
