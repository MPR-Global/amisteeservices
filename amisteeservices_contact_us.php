<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['recaptcha_response']) && isset($_POST['Email']) ) {

    // Build POST request:
    $recaptcha_url = 'https://www.google.com/recaptcha/api/siteverify';
    $recaptcha_secret = '6LdBIK0UAAAAANVJwcm6dYGg0H5gmFomN7O3DV0W';
    $recaptcha_response = $_POST['recaptcha_response'];

    // Make and decode POST request:
    $recaptcha = file_get_contents($recaptcha_url . '?secret=' . $recaptcha_secret . '&response=' . $recaptcha_response);
    $recaptcha = json_decode($recaptcha);

    // Take action based on the score returned:
    if ($recaptcha->score >= 0.5) {
        // Verified - send email
		
									$today = date("F j, Y");
									//$email_to = "steve@amistee.com,mike@amistee.com,kevin@amistee.com,donna@amistee.com,jamie@amistee.com,shaileshk@mprglobalsolutions.com,deepikab@mprglobalsolutions.com,jeff@amistee.com,rohitl@mprglobalsolutions.com,rohitl@amistee.com "; // your email address
									$email_to = "deepikab@mprglobalsolutions.com,rohitl@mprglobalsolutions.com "; // your email address
									$email_subject = $today . " :Its time to offer great service to a amisteeservices customer"; // email subject line
									$thankyou = "form_response_2019.html"; // thank you page
									
									function testinput($data) {
											   $data = trim($data);
											   $data = stripslashes($data);
											   $data = htmlspecialchars($data);
											   return $data;
											}
											
												$full_name = testinput($_POST['Name']); // required
												$address = testinput($_POST['Address']); 
												$city = testinput($_POST['City']); 
												$state = testinput($_POST['State']); 
												$zip = testinput($_POST['Zip']); 
												$email_from = testinput($_POST['Email']); // required
												$telephone = testinput($_POST['Phone']); // not required
												$estimatetype = testinput($_POST['Type_of_Estimate']); // not required
												$hear = testinput($_POST['Hear']); // not required
												$type = testinput($_POST['Type']); // not required
												$size = testinput($_POST['Size']); // not required
												$furnaces = testinput($_POST['Furnances']); // not required
												$comments = testinput($_POST['Comments']); // required
												$antispam = testinput($_POST['Captcha']); // required
												$today= date("m/d/Y");	
												$error_message = "";
												
												$email_exp = '/^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/';
											  if(preg_match($email_exp,$email_from)==0) {
												$error_message .= 'The Email Address you entered does not appear to be valid.<br />';
											  }
											  if(strlen($full_name) < 2) {
												$error_message .= 'Your Name does not appear to be valid.<br />';
											  }
											  if($antispam != ""){
											  if($antispam <> $antispam_answer) {
												$error_message .= 'The Anti-Spam answer you entered is not correct.<br />';
											  }
											  }
											  if(strlen($error_message) > 0) {
												died($error_message);
											  }
												$email_message = "Form details below.\r\n";
												
												function clean_string($string) {
												  $bad = array("content-type","bcc:","to:","cc:");
												  return str_replace($bad,"",$string);
												}
												
												

											// first send message 	
												
												$email_message .= "Full Name: ".clean_string($full_name)."\r\n";
												$email_message .= "Address: ".clean_string($address)."\r\n";
												$email_message .= "City: ".clean_string($city)."\r\n";
												$email_message .= "State: ".clean_string($state)."\r\n";
												$email_message .= "Zip: ".clean_string($zip)."\r\n";
												$email_message .= "Email: ".clean_string($email_from)."\r\n";
												$email_message .= "Telephone: ".clean_string($telephone)."\r\n";
												$email_message .= "Type_Of_Estimate: ".clean_string($estimatetype)."\r\n";
												$email_message .= "Hear: ".clean_string($hear)."\r\n";
												$email_message .= "Type: ".clean_string($type)."\r\n";
												$email_message .= "Size: ".clean_string($size)."\r\n";
												$email_message .= "Furnaces: ".clean_string($furnaces)."\r\n";
												$email_message .= "Message: ".clean_string($comments)."\r\n";
												$email_message .= "Date: ".$today."\r\n";
												
											/* $headers = 'From: '.$email_from."\r\n".   */
											$headers = 'From: amisteeservices@server.amisteeservices.com '."\r\n".  
											'Reply-To: '.$email_from."\r\n" .
											'X-Mailer: PHP/' . phpversion();
											@mail($email_to, $email_subject, $email_message, $headers);
										//	@mail("shaileshk@mprglobalsolutions.com", $email_subject, $email_message, $headers);
											header("Location: $thankyou");



    } else {
        // Not verified - show form error
		echo "<script >alert('It Seems Robotic Action.');</script>";
		}

		
	}

 

?>