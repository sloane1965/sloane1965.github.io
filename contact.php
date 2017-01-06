 <?php
 
if(isset($_POST['email'])) {
 
     

 
    $to = "oldmansloane@gmail.com";
 
    $subject = "Work Submission";
 
 
    function died($error) {
 
        // your error code can go here
 
        echo "We are very sorry, but there were error(s) found with the form you submitted. ";
 
        echo "These errors appear below.<br /><br />";
 
        echo $error."<br /><br />";
 
        echo "Please go back and fix these errors.<br /><br />";
 
        die();
 
    }
  
 
 
    if(!isset($_POST['contact-name']) ||
  
        !isset($_POST['contact-email']) ||
 
        !isset($_POST['contact-phone']) ||
 
        !isset($_POST['child_info'])) {
 
        died('We are sorry, but there appears to be a problem with the form you submitted.');       
 
    }
 
     


        $contactname = $_POST["contact-name"]; //required

        $contactemail = $_POST["contact-email"]; //required

        $contactphone = $_POST["contact-phone"]; //required

        $child_info = $_POST["child_info"]; //required

 
     
 
    $error_message = "";
 
    $email_exp = '/^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/';
 
  if(!preg_match($email_exp,$contactemail)) {
 
    $error_message .= 'The Email Address you entered does not appear to be valid.<br />';
 
  }
 
    $string_exp = "/^[A-Za-z .'-]+$/";
    $numb_exp = '/^[0-9.-]';
 
  if(!preg_match($string_exp,$contactname)) {
 
    $error_message .= 'The First Name you entered does not appear to be valid.<br />';
 
  }
 
  if(!preg_match($numb_exp,$contactphone)) {
 
    $error_message .= 'The Phone Number you entered does not appear to be valid.<br />';
 
  }
 
  if(strlen(child_info) < 2) {
 
    $error_message .= 'The Comments you entered do not appear to be valid.<br />';
 
  }
 
  if(strlen($error_message) > 0) {
 
    died($error_message);
 
  }
 
    $email_message = "Form details below.\n\n";
 
     
 
    function clean_string($string) {
 
      $bad = array("content-type","bcc:","to:","cc:","href");
 
      return str_replace($bad,"",$string);
 
    }
 
     
 
    $email_message .= "First Name: ".clean_string($contactname)."\n";
  
    $email_message .= "Email: ".clean_string($contactemail)."\n";
 
    $email_message .= "Telephone: ".clean_string($contactphone)."\n";
 
    $email_message .= "Child Information: ".clean_string($child_info)."\n";
 
     
 
     
 
// create email headers
 
$headers = 'From: '.$contactemail."\r\n".
 
'Reply-To: '.$contactemail."\r\n" .
 
'X-Mailer: PHP/' . phpversion();
 
@mail($email_to, $email_subject, $email_message, $headers);  
 
?>
 


 
Thank you for contacting us. We will be in touch with you very soon.
 
 
 
<?php
 
}
