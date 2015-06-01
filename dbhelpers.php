<?php

function get_db_connection() {
   
	$server = 'opatija.sdsu.edu:3306';
	$user = 'jadrn039';
	$password = 'console';
	$database = 'jadrn039';  	
	
	if(!($db = mysqli_connect($server, $user, $password, $database))) {
    		write_error_page(mysqli_error($db));
		exit;
		}
    return $db;
	}
	
function do_insertion($query) {      
	$db = get_db_connection();
        if(!($result = mysqli_query($db, $query))) {
		    write_error_page(mysqli_error($db));
		exit;
          } 		  
	}

function write_error_page($message){
return $message;
}	

function checkdup($arr){
$values = array();
foreach($arr as $item) {
    $item = trim($item);   
    $values [] = $item;
    }
$cfname=$values[16];
$clname=$values[18];
$homephone=$values[9].$values[10].$values[11];
$emailid=$values[15];

$db = get_db_connection();

//Getting parentid from parent that has the email or phone number match with the enterd values. If match found,child table is check. Else its not a duplicate.
$sql1 = "SELECT id FROM parent where primary_phone='$homephone' OR email='$emailid';";
$result1=mysqli_query($db,$sql1);
$phone="";
$email="";
	if($result1->num_rows>=1)
	{
	
		while($row = mysqli_fetch_array($result1))
		{
			$parent_id=trim($row[0]);
		
      
		//Fetching the details of child for the parent_id got from above query and matched child first and last names. 
		$sql2 = "SELECT * FROM child WHERE parent_id='$parent_id' AND first_name='$cfname' AND last_name='$clname';";
		$result2=mysqli_query($db,$sql2);

		if($result2->num_rows>=1)
		{
			//If matches then it a duplicate parent and duplicate child.
			$status=true;
		}
		else
		{
			//If no match, it means that he/she is a another child of the same parent. Duplicate parent but not duplicate child.
			$status=false;	
		}
		}
	}
	else
	{
	  //No parent duplicate. No child duplicate.
		$status=false;		
	}
mysqli_close($db);
return $status;

}

function pInsertion($arr)
  {
  
  //Getting elements of array
  $values = array();
foreach($arr as $item) {
    $item = trim($item);   
    $values [] = $item;
    }
	
	//Creating phone numbers from area ,prefix and suffix code
  $phonestat=array(10,13,28);
  foreach($phonestat as $j)
  $values[$j]=$values[$j].$values[$j+1].$values[$j+2];
  
  //Creating D.O.B
  $values[22] = $values[24]."-".$values[22]."-".$values[23];
  
  //Defining program id
  if($_POST['psel']=="Beginning Spanish") $progid=1;
  if($_POST['psel']=="Advanced Spanish") $progid=2;
  if($_POST['psel']=="Conversational Spanish") $progid=3;
  if($_POST['psel']=="Advanced Conversational Spanish") $progid=4;
  if($_POST['psel']=="Grammar and Composition") $progid=5;
  if($_POST['psel']=="Cultural Treasures of Mexico") $progid=6;
	
  
  //Connecting to Database
  $db = get_db_connection();
  
  // Check if parent is already in our database. If so we do not insert. Else we insert.
		$sql5 = "SELECT id FROM parent WHERE primary_phone='$values[10]' OR  email='$values[16]';";
		$result3=mysqli_query($db,$sql5);
		if($result3->num_rows>=1)
		{
		while($idrow = mysqli_fetch_array($result3))
		{
			$pid=trim($idrow[0]);
		}
		
		
		}
		else
		{
		
		//Generating parent id
		$parentidsql="SELECT MAX(id)FROM parent;";
		$resultpid=mysqli_query($db,$parentidsql);
		while($idrow = mysqli_fetch_array($resultpid))
		{
			if($idrow==null)
			$pid=1;
			else
			$pid=trim($idrow[0])+1;
		}
         
        		 
		$psql1="INSERT INTO parent VALUES('$pid'";
        $pindex=array(1,2,3,5,6,7,8,9,10,13,16);
        foreach($pindex as $i)
        $psql2.=",'".$values[$i]."'";
        $psql2.=");";
        do_insertion($psql1.$psql2);
		
		}
	
	//Generating child id
		$childidsql="SELECT MAX(id)FROM child;";
		$resultcid=mysqli_query($db,$childidsql);
		while($cidrow = mysqli_fetch_array($resultcid))
		{
			if($cidrow==null)
			$cid=1;
			else
			$cid=trim($cidrow[0])+1;
		}
         
        		
       $csql1="INSERT INTO child VALUES('$cid','$pid'";
	   $cindex=array(4,17,18,19,20,31,21,22,25,26,27,28);
	   foreach($cindex as $k)
        $csql2.=",'".$values[$k]."'";
        $csql2.=");";
        do_insertion($csql1.$csql2);
		$esql="INSERT INTO enrollment VALUES('$progid','$cid');";
		do_insertion($esql);
		return "Success";
		
  }



/*
//Funtion for generating child id and inserting child info into child table
function sqlforcinsertion(){
$program_id,$child_id;
$program;

//Generating child id
$childidsql="SELECT MAX(id)FROM child;";
$resultcid=mysqli_query($db,$childidsql);
while($row = mysqli_fetch_array($resultcid))
{
    if($row==null)
	 $child_id=1;
	else
	$child_id=trim($row[0])+1;
}		

 $sql4= "INSERT INTO child(id,parent_id,relation,first_name,middle_name,last_name,nickname,image_filename,gender,birthdate,conditions,
 diet,emergency_name,emergency_phone) values('$child_id',1,'mother','john','s','smith','js','baby.jpg','M','11-11-1999','no','no','henry',7878999999);";
 do_insertion(sql4);
 
 $sql6 = "SELECT id FROM program where description='$program';";
 $result4=mysqli_query($db,$sql6);
 while($row = mysqli_fetch_array($result4))
		{
			$program_id=trim($row[0]);
		}
 $sql7="INSERT INTO enrollment(program_id,child_id) values('$program_id','$child_id');";
$result5=mysqli_query($db,$sql7);

}
*/	
?>