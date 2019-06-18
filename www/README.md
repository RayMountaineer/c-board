***************************** THE READ ME :: Open C-BOARD *************************************************************
Part of the Open C-BOARD - a CYBR CSCW-SUITE spin-off, (c) 2019 | Florian Strahberger | SUPPORT, CONSULTING & WORKSHOPS 
-----------------------------------------------------------------------------------------------------------------------

You can start with working in your locally distributed project-team & set-up the Forum following your WBS within a few minutes.

----------------------------------------------
This is the docker-version of the c-board, 
so the requirements are, of course:

+ a running docker
## our 
docker --version

Docker version 18.09.6, build 481bc77
=====================================

+ an email-service-provider

## we suggest you to simplify the email-capabilities out of tho docker-container by using sindgrid.
## via sendgrid: a free account isw good for 400 emails per day, create a bearer token and copypaste this token
into the PDO/email-provider.php file
-------- for sendgrid as follows (you REALLY only need to exchange the token): -------------------

    $mailersName = "apikey"; // the user-name with sendgrid = apikey. do not change!

    $mailersPass =  "SG.123123123-abcdabcdabcd-123123123-456456456_123"; // THIS IS ALL YOU NEED TO MODIFY. EXCHANGE IT WITH YOURS
    
    $mailersHost = 'smtp.sendgrid.net';
    $mailersEncryptionType = 'ssl';
    $mailersPort = 465; 
--------- that's all with the email. the other connection-string is that of your database (sqame folder, ./connex.php)  
===========================================


+ an account at a hosting-provider which offers dockerized applications (if you own/ have a server, you can can use this, of course.)


3) save the modified files

4) upload the OpenC-BOARD folder to your webspace

5) navigate with your browser to the webspace into the http://www.YOUR-WEBSPACE.COM/OpenC-BOARD/auto/maketables.php
-> will result in creating the needed database-tables

6) navigate with your browser to the webspace into the http://www.YOUR-WEBSPACE.COM/OpenC-BOARD/login/register.php

**********THIS IS IMPORTANT: the 1st "user" who registers in a newly set-up C-BOARD has the super-user permissions, so: 
-> register your administration-account at first.

7) login via the form at the welcome-page or
in general via navigation with your browser to the webspace into the http://www.YOUR-WEBSPACE.COM/OpenC-BOARD/login/login.php

==============================================================================
EMAIL SERVICE PROVIDER SETUP  (9th June 2017)
_____________________________

A short setup-how2 for using smtp2go.com for the C-BOARD's email-sending capabilities
---------------------------------------------------------------------------------------

For both transactional & team-collaboration-emails: 
- the transactional emails are automated outgoing from the system, like new user registration info-emails or for the workflow to get a new password.
- the team-collaboration-emails are individual, from the C-MAIL part of the application sent emails (CFLX enhanced & WBS-assigned emails, stored in the system's database for reusability & as a recorded protocol)


step-by-step:

A) at https://www.smtp2go.com/ : create a (FREE) account
----------------------------------------------
1) click the SMTP2GO free button at https://www.smtp2go.com/ and follow the registration steps
2) if you click the verification-link in your registration-email, you will be redirected directly to the page with the needed connection-strings (the app.smtp2go.com/welcome/ page)
3) copy and paste these two strings (your registration email-address and the password created by the system) into the OpenC-BOARD/PDO/email-provider.php
4) !Important: you need to click the [FINISH] button at the app.smtp2go.com/welcome/ page to accept these values!

B) Example how to modify the email-provider.php file for smtp2go.com:
----------------------------------------------
5) Open the file from the package, you will find it at: OpenC-BOARD/PDO/email-provider.php
6) enter values:
	$mailersName = "EmailServiceProviderUsername"; // the user-name used for your email-service-provider - for smtp2go this is your registration email-address
	$mailersPass =  "EmailServiceProviderPassword"; // the password used for your email-service-provider - !!! do not forget to click the [finish]button !!!
	$mailersHost =  'mail.smtp2go.com'; // the (smtp) host of your email-service-provider(e.g.: mail.smtp2go.com or smtp.sendgrid.net)
	$mailersEncryptionType = 'ssl';
	$mailersPort = 465; // the port of your email-service-provider

If you use another email-service provider with tls -eg sendgrid- your connection-strings would look like this: 
	$mailersName = "apikey"; // the value of Username
	$mailersPass =  "SG.0naXV42oyCyMJgEaM9zP529DCI6mvz2_7T5q2aQ.gDYQMUh5BRB1QVRoWVKjse5OI0"; // the value of Password (YOUR API KEY)
	$mailersHost =  'smtp.sendgrid.net'; 
	$mailersEncryptionType = 'tls';
	$mailersPort = 587;
7) save & upload the file to the server where the app is installed (e.g. via ftp to your free-hoster) 



... the procedure changes from time to time - this step-by-step-guide was up-to-date on 9th June 2017.

This C-BOARD application for your digital project workingplace relies on the PHPmailer.
It does not depend on using sendgrid or smtp2go as an email service provider,
but it requires the capability to change the "From address" on-the-fly by simply inserting the user's registration-email-address which is stored in the database.
Most other email service providers do have restrictions which do not allow us to do this.

If you did find another solution: do not hesitate and tell us about it!



 		
==============================================================================
==============================================================================

YOUR FIRST LOGIN:

a) login always redirects you to the overview page, showing you the forums.
b) there are no forums yet - you need to create them via the green button [wbs admin.]
c) Select the blue WBS-Level1 -> create new Project
d) add the project-id(e.g. "1" for your first project); a project-name; a project-description
e) If you already have created a work-breakdown-structure of your project, you can map that structure 1:1 via the [wbs admin.]
or f) If you wish or need to create the WBS in a collaborative process (gaining advantage of the knowledge of the experts in your team, building up comittment from the very beginning): use the first, just automated discussion-thread in the C-BOARD. Click the blue [WBS/ overview] button.

g) If you are playing an active role in the project being an active member and C-BOARD-user, we strongly reccomend you to create an account for this role and do not use the administrator account for the daily usage. 
h) if you/other users create their user-account, the administrator has to change the permission of each user for granting access to the C-BOARD. 


====================================================================
====================================================================
 ADDITIONAL INFORMATION

I) You can TEST your EMAIL / MAILER FUNCTIONALITIES
a) go to your c-board-domain/login/MailerTest.php
b) enter your admin-name or admin-email
c) click the button and check info/ email sent.
d) If email is not functioning properly, please check your Email-Service-Provider's credentials:

 "Enter these connexion-strings into the PDO/email-provider.php file"
==> check, make corrections, and upload only this modified email-provider.php file into its PDO/ folder at your webspace.

---------------------

II) You can MANUALLY SET YOUR ADMIN-PERMISSION of the "user-number-one"
a) Problem: if you did not set your email-provider properly, the registration-process might stop before have gained the admin-permissions for your "user-number-one".
b) Solution: go to your c-board-domain/login/AdminSet.php
c) follow the instructions.





****************** if you need a more professional business-solution,
check out the CYBR CSCW-SUITE which is now available for free: https://sourceforge.net/projects/c-c-s/ *******************



have a look at the CYBER-SCRUM BLOG for more information as well: https://cyberscrumblog.wordpress.com/ 
or at our google+ page for more information: https://plus.google.com/115605238971051238829 
 *********************************************************************************************************
