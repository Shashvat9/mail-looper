<?php
    include("./DBmethod.php");

	// $api=new APIkeyOperaations();
	// // $user=new GetUserInfoData();
	// // $email=$user->getEmailfromId($_COOKIE[$__SESSIONID]);
	// // echo $email;
	// $ar=$api->displayAllkey($_COOKIE[$__SESSIONID]);
	// print_r($ar);

	// echo base64_decode($_COOKIE[$__SESSIONID]);
	function emailExists($email) {
		// Check if the email is valid
		if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
			// Split the email into a user and domain part
			list($user, $domain) = explode('@', $email);
	
			// Check if the domain has a MX record
			if (checkdnsrr($domain, 'MX')) {
				return true;
			}
		}
	
		return false;
	}
	