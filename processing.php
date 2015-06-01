<?php
require 'dbhelpers.php';





$values = array();
foreach($_POST as $item) {
    $item = trim($item);  
    $values [] = $item;
    }
	
	
	//Function to Check for special characters
	function checkspecial($val,$ans)
	{
	if (preg_match('/[\'^£$%&*()}{@#~?><>|=_+¬-]/', $val))
	{
	echo "NV".$ans;
    exit;	
	}
	}
	
	//Function to check if field is not empty
	function reqd($val,$ans)
	{
	if(strlen($val) == 0)
	{
	echo "NV".$ans;
    exit;	
	}
	}
	
	//Function to validate area code and prefix code
	function phone3dig($val,$ans)
	{
	reqd($val,$ans);
	if((strlen($val) != 3)||(!is_numeric($val)))
	{
	echo "NV".$ans;
    exit;	
	}
	}
	
	//Function to validate suffix code
	function phone4dig($val,$ans)
	{
	reqd($val,$ans);
	if((strlen($val) != 4)||(!is_numeric($val)))
	{
	echo "NV".$ans;
    exit;	
	}
	}
	
	

	//Parent First Name Validations 
	reqd($values[1],"Parent's First Name Required");
	checkspecial($values[1],"Special Characters like *,#,$ found in Parent's First Name");
	
	
	//Program Selection Check
	if($_POST['psel']=="Select One")
	{
	$ans="Select a Program";
	echo "NV".$ans;
    exit;
	}
	
	
	//Parent Middle and Last Name Validations 
	checkspecial($values[2],"Special Characters like *,#,$ found in Parent's Middle Name");
	reqd($values[3],"Parent's Last Name Required");
	checkspecial($values[3],"Special Characters like *,#,$ found in Parent's Last Name");
	
	//Relationship Selection
	reqd($values[4],"Please Choose your relationship to the child");
	
	//Address Validation
	reqd($values[5],"Address Field Required");
	checkspecial($values[5].$values[6],"Please enter a Valid Address. Special Characters like *,#,$ etc not allowed");
	
	//City Validation
	reqd($values[7],"City Field Required");
	if (!preg_match('/^[a-zA-Z\s]+$/', $values[7]))
	{
	$ans="Numbers and Special characters not allowed in City Field";
	echo "NV".$ans;
    exit;	
	}
	
	
	//State Code Validation
	$statearr =  array("AK","AL","AR","AS","CA","CO","DC","DE","FL","GA","GU","HI",
     "IA","ID","IL","IN","KS","KY","LA","MD","ME","MN","MO","MS","MT","NC","ND",
     "NE","NH","NM","NY","OH","OK","OR","PA","PR","RI","SC","SD","TN","TX","UT",
     "VA","VT","WA","WI","WV","WY");
	if (!in_array(strtoupper($values[8]),$statearr)) {
     $ans= "Please enter a Valid State Code";
	 echo "NV".$ans;
     exit;
     }
	
	
	
	//Zip Code Validation
	if(strlen($values[9]) != 5) {
    $ans= "The ZIP field must have exactly five digits";
	echo "NV".$ans;
    exit;
    } 
    
    if(!is_numeric($values[9])) {
    $ans= "The ZIP field must contain only numbers";
	echo "NV".$ans;
    exit;
    } 
	
	//Validating Home and Cell Phone of parent
	$phonestart=array(10,13);
	foreach($phonestart as $i)
	{
	phone3dig($values[$i],"Area Code is required and must contain exactly 3 numbers");
	phone3dig($values[$i+1],"Prefix Code is required and must contain exactly 3 numbers");
	phone4dig($values[$i+2],"Suffix Code is required and must contain exactly 4 numbers");
	}
	
	//Validating Email
	reqd($values[16],"Email id Required");
	
	if (!preg_match('/^[a-zA-Z]{1}/', $values[16]))
	{
	$ans="Valid Email id begins with a letter.";
	echo "NV".$ans;
    exit;	
	}
	$posat = strpos($values[16],"@");
	if($posat>=-1)
	{
	$str=substr($values[16],$posat);
	$posdot = strpos($str,".");
 
	if($posdot>=-1)
	{
	;
	}
	else
	{
	$ans="Enter email id in the following format username@domain.extension";
	echo "NV".$ans;
    exit;
	}
	}
	else
	{
	$ans="Enter email id in the following format username@domain.extension";
	echo "NV".$ans;
    exit;
	}
	
	
	//Child First ,Last ,Middle,Nick name verification
	reqd($values[17],"Child's First Name Required");
	checkspecial($values[17],"Special Characters like *,#,$ found in Child's First Name");
	checkspecial($values[18],"Special Characters like *,#,$ found in Child's Middle Name");
	reqd($values[19],"Child's Last Name Required");
	checkspecial($values[19],"Special Characters like *,#,$ found in Child's Last Name");
	reqd($values[20],"Child's Nick Name Required");
	checkspecial($values[20],"Special Characters like *,#,$ found in Child's Nick Name");
	
	
	//Gender Validation
	reqd($values[21],"Select Child's Gender");
	
	//Image Validation
	if(strlen($_POST['img'])<=0)
    {
	$ans= "Please Upload a Photo of your child";
	echo "NV".$ans;
    exit;
	}
	$pic=$_POST['img'];
	list($imgname, $ext) = split('[/.]', $pic);
	$extension=strtoupper($ext);
	if ($extension!=="PNG" && $extension!=="JPG" && $extension!=="GIF" && $extension!=="JPEG")
    {
	$ans= "The Photo must be only of the types : PNG,JPG,GIF or JPEG";
	echo "NV".$ans;
    exit;
	}
	
		
	
	//Date Validation
	reqd($values[22],"Month in D.O.B Required");
	reqd($values[23],"Date in D.O.B Required");
	reqd($values[24],"Year in D.O.B Required");
	if(!checkdate($values[22],$values[23],$values[24]))
	{
	$ans= "Not a Valid Date";
	echo "NV".$ans;
    exit;
	}
	else
	{
	$from = new DateTime(date("M-d-Y", mktime(0, 0, 0,$values[22],$values[23],$values[24])));
    $to   = new DateTime('06-01-2014');
	$age = $from->diff($to)->y;
	if($age<12||$age>18)
	{
	$ans= "Age should be between 12 to 18 years";
	echo "NV".$ans;
    exit;
	}
	}
	
	//Medical Conditions and Diet Field Validation
	checkspecial($values[25]," Avoid Special Characters like *,#,$ in Medical Conditions");
	checkspecial($values[26],"Avoid Special Characters like *,#,$ in Special Dietary Requirements");
	
	//Emergency Contact Validation- Name and Phone Number
	reqd($values[27],"Emergency contact's Name Required");
	checkspecial($values[27],"Special Characters like *,#,$ found in Emergency's Contact Name");
	phone3dig($values[28],"Area Code in Emergency Contact is required and must contain exactly 3 numbers");
	phone3dig($values[29],"Prefix Code in Emergency Contact is required and must contain exactly 3 numbers");
	phone4dig($values[30],"Suffix Code in Emergency Contact is required and must contain exactly 4 numbers");
	
   //Duplicate Recheck
	if(checkdup($_POST))
	{
	echo "DUP";
	exit;
	}

  $insertstatus=trim(pInsertion($_POST));
 
    if($insertstatus=="Success")
	{
	 include 'valuedisplay.php';
	 exit;
	}
	else
	{
	echo "DB".$insertstatus;
    exit;
	}
?>