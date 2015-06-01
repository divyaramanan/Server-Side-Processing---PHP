
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


if(strlen($user)==0)
{
echo "*User Name is Required";
exit;
}
if(strlen($pass)==0)
{
echo "*Password is Required";
exit;
}


$raw_str = file_get_contents('pass.dat');
$data = explode("\n",$raw_str);
foreach($data as $item) {
	$pair = explode('=',$item);
	if($user === $pair[0] && crypt($pass,$pair[1]) === $pair[1])
		$valid = true;
	}
if($valid)
	{
	if(!($rep=="rep1"||$rep=="rep2"))
    {
     echo "*Choose any one Report";
     exit;
    }
	if($rep == "rep1")
	{
	echo '<script> $("#loginbody").load("report1.php");
	</script>';
	exit;
	}
	if($rep == "rep2")
	{
	echo '<script> $("#loginbody").load("report2.php");
	</script>';
	exit;
	}
	}
else
	echo "Incorrect User name or password";
?>

