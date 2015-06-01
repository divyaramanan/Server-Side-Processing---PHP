<?php
if($_GET) exit;
if($_POST) exit;

$salt = '$1$hy23@@u7Q'; #12 characters starting with $1$

$users = array('cs545','ariggins','jsmith','tester');
$pass = array('fall2014','123abc','abc123','sdsu');

for($i=0; $i<count($users); $i++) 
	if(CRYPT_MD5)
		echo $users[$i].'='.crypt($pass[$i],$salt)."\n";
?>
