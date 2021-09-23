
<?php

$servername = "190.92.148.156";
$username = "mykmpart_quote";
$password ="S;H2l5w8I,@+";
$db = "mykmpart_quote";


$conn = mysqli_connect($servername,$username,$password,$db);

if(!$conn)
{
	die("connection Failed".mysqli_connect_error());
}
//echo "conected";

?>
