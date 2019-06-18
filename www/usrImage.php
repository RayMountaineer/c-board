<?php // Part of the Open C-BOARD - a CYBR CSCW-SUITE spin-off, (c) 2019 | Florian Strahberger | SUPPORT, CONSULTING & WORKSHOPS | fs@c-cybernetics.com
require_once("./PDO/connex.php");



//

if(filter_has_var(INPUT_GET, "ID") !== false && filter_input(INPUT_GET, 'ID', FILTER_VALIDATE_INT) !== false)
    {
 
    $image_id = filter_input(INPUT_GET, "ID", FILTER_SANITIZE_NUMBER_INT);
    try     {
    
        $pdocx->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
 
 $sql = "SELECT image, image_type FROM usrsprofiles WHERE id=0";
 
        $stmt = $pdo->prepare($sql);
 
        $stmt->execute(); 
 
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
 
        $array = $stmt->fetch();
 
        if(sizeof($array) == 2)
            { 
            header("Content-type: ".$array['image_type']);
 
            echo $array['image'];
            }
        else
            {
            throw new Exception("Out of bounds Error");
            }
        }
    
        }
  else
        {
        echo 'Please, only use your own id number! (this incident has to be reported...)';
        }
?>