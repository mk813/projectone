<?php

$dbh = mysqli_connect('localhost', 'root', ''); 
	//connect to MySQL server 
	if (!$dbh)     
    	die("Unable to connect to MySQL: " . mysqli_error($dbh)); 
	//if connection failed output error message 
    
	if (!mysqli_select_db($dbh,'projectone'))     
		die("Unable to select database: " . mysqli_error($dbh));
	//if selection fails output error message
?>