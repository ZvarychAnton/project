<?php

	session_start();
	if (md5($_POST['norobot']) == $_SESSION['randomnr2'])	{ 
		// here you  place code to be executed if the captcha test passes
			echo "norobot";
	}	else {  
		// here you  place code to be executed if the captcha test fails
			echo "robot";
			
	}
		
		
?>