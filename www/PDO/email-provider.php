<?php
// for registration-mails from the system as well as for email-sending-functionalities (wbs-related CFLX-mails)
// you need an account of an E-Mail-Provider/ E-Mail_service-Provider / smtp service
// For the C-BOARD you usually can benefit from free offers, like:
// smtp2go - 1000emails per month for free. Should be enough for a small team if you use the C-BOARD for communication and not the C-MAIL part of the application... 
// Sendgrid offer for free is limited to only 30days now! 
// _> 09.june 2019: https://sendgrid.com/docs/API_Reference/SMTP_API/integrating_with_the_smtp_api.html 
/*
 To integrate with SendGrids SMTP API:

    Create an API Key with at least “Mail” permissions. (https://app.sendgrid.com/settings/api_keys -< [Create API Key]btn)
    Set the server host in your email client or application to smtp.sendgrid.net.
        This setting is sometimes referred to as the external SMTP server or the SMTP relay. here: $mailersHost
    Set your username to "apikey".
    Set your password to the API key generated in step 1.
    Set the port to 587.

*/ 



	$mailersName = "apikey"; // the user-name bei sendgrid = apikey
	$mailersPass =  "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"; // the password used for your email-service-provider
// mit der API hat sich die addressse wohl geändert: https://api.sendgrid.com/
$mailersHost = 'smtp.sendgrid.net';
//	$mailersHost =  'smtp.sendgrid.net'; // the (smtp) host of your email-service-provider(e.g.: mail.smtp2go.com or smtp.sendgrid.net)
	$mailersEncryptionType = 'ssl';
	$mailersPort = 465; // the port of your email-service-provider
  
