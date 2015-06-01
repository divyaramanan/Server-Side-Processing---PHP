<?php


$salt = '$1$div@@90uq'; #12 characters starting with $1$

$users = array('cs545','divya','student','tester');
$pass = array('fall2014','divya','project','sdsu');

for($i=0; $i<count($users); $i++) 
	if(CRYPT_MD5)
		echo $users[$i].'='.crypt($pass[$i],$salt)."\n";
?>