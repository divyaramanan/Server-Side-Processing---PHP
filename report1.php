<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
   "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

    <!--    Rajagopal,Divya    Account:jadrn039
            CS545, Fall 2014
            Project #2
    -->   
    
    <head>
       <title>Registered Participants of each Program</title>
	<meta http-equiv="content-type" 
		content="text/html;charset=utf-8" />
    
    <link rel="stylesheet" type="text/css" href="mycss.css" /> 
    
    </head>
    <body id="rep1body">
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
		<h3>Listing of Registered Participants in Each Program</h3>
		
		
		<?php
		require 'dbhelpers.php';
		$db = get_db_connection();
		$pgmnames=array("Beginning Spanish","Advanced Spanish","Conversational Spanish","Advanced Conversational Spanish","Grammar and Composition","Cultural Treasures of Mexico");
		
		foreach($pgmnames as $pname)
		{
		$index=array_search($pname, $pgmnames)+1; 
		$sqljoin1 = "select first_name,last_name,nickname,birthdate from child,enrollment where child.id=enrollment.child_id AND program_id='$index';";
        $resultjoin1=mysqli_query($db,$sqljoin1);
		
		if($resultjoin1->num_rows>=1)
	    {		
		echo '<span>'.$pname.'</span><br/>';
		echo '<table class="jointable">';
		echo '<tr>
		<th>First Name</th>
		<th>Last Name </th>
		<th>Nick Name</th>
		<th>Age</th>
		</tr>';

		while($row = mysqli_fetch_array($resultjoin1))
		{
		    echo '<tr>';
			$cfname=trim($row[0]);
			$clname=trim($row[1]);
			$cname=trim($row[2]);
			$bday=trim($row[3]);
			$bday=new DateTime($bday);
			$to   = new DateTime('2014-06-01');
	        $age = $bday->diff($to)->y;
			echo '<td>'.$cfname.'</td>';
			echo '<td>'.$clname.'</td>';
			echo '<td>'.$cname.'</td>';
			echo '<td>'.$age.'</td>';
			echo '</tr>';
		}
		echo '</table>';
		
		}}
		?>
		
		</div>
    </body>
</html>
