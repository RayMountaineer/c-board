<?php
session_start();
?><!DOCTYPE html>
<head>
	<meta charset="UTF-8" /> 
	<link rel="stylesheet" href="loginCSS.css" type="text/css" media="screen" />
</head>

<body>

<form action="InsTokenSendEmail.php" method="post" id="login">
	<fieldset>
		<legend>YOUR USER-NAME OR EMAIL IS REQUIRED</legend>
		
		
		 <table border="0" cellpadding="0" cellspacing="4">
    <tr>
      <td align="right"></td>
      <td>After verification you will receive an email with further instructions immediately</td>
    </tr>
	
    <tr>
      <td align="right"></td>
      <td><input id="usernameemail" name="usernameemail" type="text" placeholder="Enter your username or email-address here" required value="" size="30" maxlength="50" /></td>
     		
    </tr>
  </table>
		
	</fieldset>
	
	<fieldset>
		<button type="submit" value="Register">Send me the further instructions</button>
		<br>
		
	</fieldset>
</form>


</body>
</html>


