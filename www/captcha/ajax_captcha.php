<?php
    if ($_POST['captcha'] == 1) {
        // if the form has been submitted

        $captcha = @$_POST['ct_captcha']; // the user's entry for the captcha code
        $errors = array();  // initialize empty error array

        // Only try to validate the captcha if the form has no errors
        // This is especially important for ajax calls
        if (sizeof($errors) == 0) {
            require_once dirname(__FILE__) . '/securimage.php';
            $securimage = new Securimage();
            if ($securimage->check($captcha) == false) 
			{
                $errors['captcha_error'] = 'Please enter the security code';
            }
        }

        if (sizeof($errors) == 0) 
		{
           echo "1|||ok";
        } else {
            $errmsg = '';
            foreach($errors as $key => $error) {
                // set up error messages to display with each field
                $errmsg .= "{$error}\n";
            }
           echo "0|||";
		   echo $errmsg;
        }
    } // POST

?>