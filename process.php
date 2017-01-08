<?php
require_once "recaptchalib.php";

// your secret key
$secret = "6LfhQxAUAAAAAHwrgdZIR8Xbs8My-RmApEOEJ2-O";
 
// empty response
$response = null;
 
// check secret key
$reCaptcha = new ReCaptcha($secret);

// if submitted check response
if ($_POST["g-recaptcha-response"]) {
    $response = $reCaptcha->verifyResponse(
        $_SERVER["REMOTE_ADDR"],
        $_POST["g-recaptcha-response"]
    );
}
else 
{
echo "FAILURE on RECAPTCHA";
}

if ($response != null && $response->success)
{
   $to = 'contact@centrallocus.com' ;    
    //email address on which you want to receive the information

   $ipaddress = $_SERVER['REMOTE_ADDR']; 
   $datetime = date('d/m/Y H:i:s');
   
   $subject = 'Enquiry From Contact Form';   //set the subject of email.
   $headers .= "MIME-Version: 1.0\r\n";
   $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
   $headers .= "From: $email" . PHP_EOL . "Reply-To: $email";  
   $message = "Name: ".$_POST['name']."\r\nEmail: "
   .$_POST['email']."\r\nContact #: "
   .$_POST['telephone']."\r\n"
			   
   //Send mail using PHP			   
   mail($to, $subject, $message, $headers);
   //Redirect
   header('Location: thank-you.html');
   }
   else
   {
    echo "FAILURE ON FORM SEND";
   }
?>