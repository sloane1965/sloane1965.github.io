<?php
if ($_POST){
if (!filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL)){
$message="Please provide a correct email address";} else {
  $name = strip_tags($_POST['name']);
  $company_name = strip_tags($_POST['company_name']);
  $telephone = strip_tags($_POST['telephone']);
  $email = $_POST['email'];
  $comments = strip_tags($_POST['comments']);
  $to = 'oldmansloane@gmail.com';
  $subject = 'Contact form submitted.';
  $body = $name. "\n" .$comments;
  $headers = 'From: ' .$email;
  if (mail($to, $subject, $body, $headers)) {
  echo 'Thanks for contacting us. We\'ll be in touch soon!';
  } else {
  $message = 'Sorry an error occurred. Please try again later.';
  }
  }}
?>
