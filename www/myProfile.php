<?php
if(!@file_exists('./PDO/connex.php') ) {
    echo 'could not include the needed database-connection-file!';
} else {
   include('./PDO/connex.php');
}

/*** some basic sanity checks ***/
if(filter_has_var(INPUT_GET, "ID") !== false && filter_input(INPUT_GET, 'ID', FILTER_VALIDATE_INT) !== false)
    {
    /*** assign the image id ***/
    $image_id = filter_input(INPUT_GET, "ID", FILTER_SANITIZE_NUMBER_INT);
    try     {

        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "SELECT * FROM usrsprofiles WHERE id=$image_id";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(); 
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $array = $stmt->fetch();
        if(sizeof($array) == 15)
            {
            header("Content-type: ".$array['image_type']);
            echo $array['image'];

            }
        else
            {
            throw new Exception("Out of bounds Error");
            }
       
       
        }
    catch(PDOException $e)
        {
        echo $e->getMessage();
        }
    catch(Exception $e)
        {
        echo $e->getMessage();
        }
        }
  else
        {
        echo 'Please, only use your own id number! (this incident has to be reported...)';
        }
// query for text-data
$sqltxt = $pdo->query("SELECT id,username FROM usrsprofiles WHERE id='$image_id'");
$arraytxt= $sqltxt->fetchAll(PDO::FETCH_ASSOC); 

  echo 'users username = <b>'. $arraytxt['username']. '</b><br>';
  echo '<br>';
  echo 'users id = '. $arraytxt['id']. '<br>';
  
  echo 'users avatar (uploaded pic name) = '. $arraytxt['avatar']. '<br>';
          

?>
</head>
<body>

</body>
</html>