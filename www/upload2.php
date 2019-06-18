<?php // Part of the Open C-BOARD - a CYBR CSCW-SUITE spin-off, (c) 2019 | Florian Strahberger | SUPPORT, CONSULTING & WORKSHOPS | fs@c-cybernetics.com
if (session_status() == PHP_SESSION_NONE) {session_start();}
	$usrArray = $_SESSION['user'];

	if ($usrArray == '') // if empty
	{ 
     	header("Location: ./login/login.php");
   	exit;
	}
 
ob_start();
 include_once('./PDO/connex.php');
$_SESSION['url'] = $_SERVER['REQUEST_URI']; 
 

?><!DOCTYPE html>
<head>
<meta charset="UTF-8" /> 
	<title>C-BOARD: Image-upload -> share your interests</title>
   


		<link rel="stylesheet" href="CSS/standard.css" type="text/css" />
		<link rel="stylesheet" href="CSS/wbslayout.css" type="text/css" />
	   <link rel="stylesheet" href="CSS/styles.css">
		
	<link rel="stylesheet" href="./CSS/dropdownstylesWBSlevels.css" type="text/css" />
	<link rel="stylesheet" href="./CSS/newWBSform.css" type="text/css" />
	<link rel="stylesheet" href="./CSS/button.css" type="text/css" />
	<!--  <link rel="stylesheet" href="CSS/styles.css">-->
   
      

		<!--CFLX-part start-->	
		<link rel="stylesheet" href="CSS/html.css"> 	 
  <link rel="stylesheet" href="CSS/cssboardhead-Neo.css"> 	
		
</head>
<body bgcolor="grey">


<?php
	echo '<p style="float: right;"><a href="overview.php" class="myButtonBlu" title="the wbs-structured board-sight">WBS/ overview</a></p>'; // Thema erstellen-Link

	echo '<h2 style="font-size: 1.6em; font-weight: 400; text-align: left; ">C-BOARD :: Y O U R - I N T E R E S T S</h2><hr />';
	//	echo '<p style="display: inline;"><a href="overview.php" class="myButtonBlu" title="back to the wbs-structured board-sight">WBS/ overview</a> &laquo; </p>'; // <a class="WBS2link" href="threadview.php?ID='.$strg_id.'">'.$pers_row['topic'].'</a> </p>'; 

echo '<table border=2 bordercolor="green" width="100%" class="cssov">'; // start Ansatz div classes in den tablen html-table und unterschiedlichen tablen mit gesetzter td breite classes  
echo'<tr style="line-height: 0.7em;"><td><h3 style="font-size: 1.3em; text-align:center; padding: 0.5em;">u p l o a d   _  I M A G E  _  d i s t i n g u i s h i n g </3></td></tr></table><br>';
// admin-user-header-table end
?>
 <form enctype="multipart/form-data" action="<?php echo htmlentities($_SERVER['PHP_SELF']);?>" method="post" id="nwbs">	

	<fieldset>
		<legend>SELECT & UPLOAD YOUR IMAGE</legend>
		
		
		 <table border="0" cellpadding="0" cellspacing="4">
    <tr>
      <td align="right"></td>
      <td>  <input type="hidden" name="MAX_FILE_SIZE" value="99999999" /></td>
    </tr>
     <tr>
     
      <td><input name="userfile" type="file" /></td>
    </tr>
	<tr>
 			<td><input type="submit" value="Submit" /></td>
 	</tr>
  </table>
		
	</fieldset>
	
</form>

</body>
</html>

<?php
$usrn = $_SESSION['user']['username'];
/*** check if a file was submitted ***/
if(!isset($_FILES['userfile']))
    {
    echo '<p>Please browse, select your image-file and click the submit-button</p>';
    }
else
    {
    try    {
        upload();
        /*** give praise and thanks to the php gods ***/
        echo '<p>Thank you for submitting</p>';
        }
    catch(Exception $e)
        {
       echo '<h4> upload failure ...</h4>';
        }
    }
?>


 <?php
/**
 *
 * the upload function
 * 
 * @access public
 *
 * @return void
 *
 */
function upload(){
/*** check if a file was uploaded ***/
if(is_uploaded_file($_FILES['userfile']['tmp_name']) && getimagesize($_FILES['userfile']['tmp_name']) != false)
    {
    /***  get the image info. ***/
    $size = getimagesize($_FILES['userfile']['tmp_name']);
    /*** assign our variables ***/
    $type = $size['mime'];
    $imgfp = fopen($_FILES['userfile']['tmp_name'], 'rb');
    $size = $size[3];
    $avatar = $_FILES['userfile']['name'];
    $maxsize = 99999999;


    /***  check the file is less than the maximum file size ***/
    if($_FILES['userfile']['size'] < $maxsize ){
// neo2 start

//PDO-login und querry:
if(!@file_exists('./PDO/connex.php') ) {
    echo 'can not include database-connex-files!';
} else {
   include('./PDO/connex.php');
 //
 
$usrnaam = $_SESSION['user']['username'];
//
$stmt = $pdo->prepare("UPDATE usrsprofiles SET  image2=?, image_size2=?, image_type2=?, avatar2=? WHERE username=?");
$stmt->bindParam(1,$imgfp, PDO::PARAM_LOB); 
$stmt->bindParam(2,$size);
$stmt->bindParam(3,$type);
$stmt->bindParam(4,$avatar);


$stmt->bindParam(5,$usrnaam);

$stmt->execute();

 header("Location: persProfile.php#misc");

 exit();
 
 }

        }
    else
        {
        /*** throw an exception is image is not of type ***/
        throw new Exception("File Size Error");
        }
    }
else
    {
    // if the file is not less than the maximum allowed, print an error
    throw new Exception("Unsupported Image Format!");
    }
}
echo '<p style="display: inline;"><a href="persProfile.php" class="myButtonBlu" title="back to your profile administration">back to pers. profile admin</a></p>'; // <a class="WBS2link" href="threadview.php?ID='.$strg_id.'">'.$pers_row['topic'].'</a> </p>'; 

?>