<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
   "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<!--    Rajagopal,Divya    Account:jadrn039
            CS545, Fall 2014
            Project #2
    -->   
<head>
	<title>Application Submitted</title>
	<meta http-equiv="content-type" 
		content="text/html;charset=utf-8" />

    <link rel="stylesheet" type="text/css" href="mycss.css" />
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script type="text/javascript" src="confirmeffects.js"></script>

</head>
    <body id="submitbody">
	<? php
       $values = array();
	foreach($_GET as $item) {
			$item = trim($item);   
			$values [] = $item;
							}	
		$cfname=$values[16];
		$clname=$values[18];
		$txt="hello";
	?>
        <div id="centerbody">
            <div id="error">
                <h1>Sorry,<?php echo $cfname; ?>&nbsp;<?php echo $clname; ?></h1><br/>
        <h3>Looks like there is an error in registering to  the Summer Abroad Spanish Program of SDSU..</h3>
            </div>
            <div id="errorshow">
                <h3>Error:&nbsp;<?php echo $txt;?></h3>
            </div>
            
       <div class="reportlogin">Click to Login to the Report</div>
        </div>
    </body>
</html>