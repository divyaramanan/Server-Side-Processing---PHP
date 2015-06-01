<?php

$values = array();
foreach($_POST as $item) {
    $item = trim($item);  
    $values [] = $item;
    }
	
$user = $values[0];
$pass = $values[1];
$rep = $values[2];

$valid = false;
$raw_str = file_get_contents('pass.dat');
$data = explode("\n",$raw_str);
foreach($data as $item) {
	$pair = explode('=',$item);
	if($user === $pair[0] && crypt($pass,$pair[1]) === $pair[1])
		$valid = true;
	}
if($valid)
	{
	if($rep == "report1")
	include 'report1.php';
	else
	include 'repor2.php';
	}
else
	echo "Incorrect User name or password";
?>