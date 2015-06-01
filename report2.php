<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
   "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

    <!--    Rajagopal,Divya    Account:jadrn039
            CS545, Fall 2014
            Project #2
    -->   
    
    <head>
       <title>Student and Parent Info Report</title>
	<meta http-equiv="content-type" 
		content="text/html;charset=utf-8" />
    
    <link rel="stylesheet" type="text/css" href="mycss.css" /> 
    </head>
    <body id="rep2body">
   <div class="heading">
          <a href="index.html">   <img src="logo2.png" alt="flag" /></a>
        <ul>
            <li><a href="index.html#pgm">OUR PROGRAMS</a></li>
            <li><a href="enroll.html">ENROLL</a></li>
			<li><a href="login.html">LOGOUT</a></li>
        </ul>
        <p><a href="index.html">Speak Spanish</a></p>
        <div class="subheading">
            <p><a href="index.html">The SDSU study abroad program for spanish</a></p>
        </div>
        </div>
        <div class="listing">
		<h3>Details of Registration sorted by Student's Last Name</h3>
		
		
		<?php
		require 'dbhelpers.php';
		$db = get_db_connection();
		$pgmnames=array("Beginning Spanish","Advanced Spanish","Conversational Spanish","Advanced Conversational Spanish","Grammar and Composition","Cultural Treasures of Mexico");
		$index=array_search($pname, $pgmnames)+1; 
		$sqljoin2 = "select p.first_name,p.middle_name,p.last_name,c.relation,p.address1,p.address2,p.city,p.state,p.zip,p.primary_phone,p.secondary_phone,p.email,
		c.first_name,c.middle_name,c.last_name,c.nickname,e.program_id,c.gender,c.birthdate,c.conditions,c.diet,c.emergency_name,c.emergency_phone,c.image_filename
		from child c JOIN parent p ON c.parent_id=p.id JOIN enrollment e ON c.id=e.child_id ORDER BY c.last_name;";
        $resultjoin2=mysqli_query($db,$sqljoin2);
		
				
		echo '<span>'.$pname.'</span><br/>';
		echo '<table class="jointable joinbigwidth">';
		echo '<tr>
		<th>Parent Information</th>
		<th>Child Information</th>
		<th>Medical Information</th>
		<th>Child Photo</th>
		</tr>';
        
		
		while($row = mysqli_fetch_array($resultjoin2))
		{
		
		if(trim($row[17])== "M")
		$row[17] = "Male";
		if(trim($row[17])== "F")
		$row[17] = "Female";
		 echo '<tr>';
		 
		 //The Parent Info Column
		$pstring='<td width="20%">';
		$pstring.=$row[0]."\t".$row[1]."\t".$row[2].'<br/>'."Relation:".$row[3].'<br/>';
		$pstring.=$row[4].'<br/>';
		if (strlen(trim($row[5]))!= 0)
		{$pstring.=$row[5].'<br/>';}
        $pstring.= $row[6]."\t".strtoupper($row[7])."\t".$row[8].'<br/>';
		$pstring.="Home:".$row[9].'<br/>'."Mobile:".$row[10].'<br/>';
      	$pstring.=$row[11].'<br/>';
		$pstring.='</td>';
		echo $pstring;
		
		//The Child Info Column
		$cstring='<td>';
		$cstring.=$row[12]."\t".$row[13]."\t".$row[14]."\t"."(a)".$row[15].'<br/>';
		$cstring.="Program:\t".$pgmnames[$row[16]-1].'<br/>';
		$cstring.=$row[17].",\t"."Birth Date:".$row[18].'<br/>';
		$cstring.= "Emergency Contact:"."\t".$row[21].'<br/>'."Phone:".$row[22];
		$cstring.='</td>';
		echo $cstring;
		
		//Medical and Diet Info 
		$mstring='<td width="30%">';
		$mstring.= "Medical Conditions:\t";
		if (strlen(trim($row[19]))!= 0)
		$mstring.=$row[19].'<br/><br/>';
		else
		$mstring.="Normal".'<br/>';
		$mstring.= "Diet:\t";
		if (strlen(trim($row[20]))!= 0)
		$mstring.=$row[20].'<br/>';
		else
		$mstring.="Normal".'<br/>';
		$mstring.='</td>';
		echo $mstring;
		
		
		//Child Photo
		$phostring='<td width="150px">';
		$phostring.='<img src="clickz/'.trim($row[23]).'"alt="Child Photo">';
		$phostring.='</td>';
		echo $phostring;
		echo '</tr>';	
		}
		
		
		echo '</table>';
		
		?>
		
		</div>
    </body>
</html>
