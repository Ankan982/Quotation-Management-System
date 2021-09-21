<?php

echo "Hwllo";


require_once("database.php");

$query = "SET @sl:=0;";
$query.= "SELECT @sl:=@sl+1 AS 'Qnum';";

if (mysqli_multi_query($conn, $query)) {
    do {
        /* store first result set */
        if ($result = mysqli_store_result($conn)) {
            while ($row = mysqli_fetch_array($result)) 
    
    /* print your results */    
    {
    echo $row['Qnum'];

    }
    mysqli_free_result($result);
    }   
    } while (mysqli_next_result($conn));
    }




?>