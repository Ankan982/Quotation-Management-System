
<?php

$servername = "190.92.148.156";
$username = "mykmpart_quote";
$password ="S;H2l5w8I,@+";
$db = "mykmpart_quote";

//ip : 162.222.225.87
//db_name: luxurvaf_addver
//user_name: luxurvaf_addver
//pass: J4z!3a5y

//login: admin
//pss: Abhishek@2021

$conn = mysqli_connect($servername,$username,$password,$db);

if(!$conn)
{
	die("connection Failed".mysqli_connect_error());
}
//echo "conected";

?>