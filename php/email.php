<?php

$to_email = 'vacation.portal.email@gmail.com';
$subject = 'Simple Email Test via PHP';
$body = "Hi,nn This is test email send by PHP Script";
$headers = "From: vacation.portal.email@gmail.com";
// mail($to_email, $subject, $body, $headers);
$email_sent =mail($to_email, $subject, $body, $headers);
if ($email_sent == true) {
    echo "Email successfully sent to $to_email...";
} else {
    echo "Email sending failed...";
}

background: #4A00E0;  /* fallback for old browsers */
background: -webkit-linear-gradient(to right, #4A00E0, #8E2DE2);  /* Chrome 10-25, Safari 5.1-6 */
background: linear-gradient(to right, #4A00E0, #8E2DE2); /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */

background: #5C258D;  /* fallback for old browsers */
    background: -webkit-linear-gradient(to right, #4389A2, #5C258D);  /* Chrome 10-25, Safari 5.1-6 */
    background: linear-gradient(to right, #4389A2, #5C258D); /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */