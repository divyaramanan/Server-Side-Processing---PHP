<?php
require 'dbhelpers.php';




if(checkdup($_GET))
	echo "DUP";
else
    echo 'OK';


   

?>