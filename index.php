<?php 
	$dbh = mysqli_connect('localhost', 'root', ''); 
	//connect to MySQL server 
	if (!$dbh)     
    	die("Unable to connect to MySQL: " . mysqli_error(dbh)); 
	//if connection failed output error message 
    
	if (!mysqli_select_db($dbh,'my_personal_contacts'))     
		die("Unable to select database: " . mysql_error(dbh)); 
	//if selection fails output error message 
    
	if($_POST){
		//$sql_stmt = "INSERT INTO `my_contacts` (`full_names`,`gender`,`contact_no`,`email`,`city`,`country`)"; 
		//$sql_stmt .= " VALUES('".$_POST['full_names']."', '".$_POST['gender']."', '".$_POST['contact_no']."', '".$_POST['email']."', '".$_POST['city']."', '".$_POST['country']."')"; 
		$sql_stmt = "INSERT INTO `my_contacts` (`full_names`,`gender`,`contact_no`,`email`,`city`,`country`)"; 
              $sql_stmt .= " VALUES ('".$_POST['full_names']."', '".$_POST['gender']."','".$_POST['contact_no']."', '".$_POST['email']."','".$_POST['city']."', '".$_POST['country']."')";
			
		//echo $sql_stmt;die;
		$result = mysqli_query($dbh,$sql_stmt); //execute SQL statement 
		    
		if (!$result)     
			die("Adding record failed: " . mysqli_error($dbh)); 
			//output error message if query execution failed echo "Poseidon has been successfully added to your contacts list";
			
		mysqli_close($dbh); //close the database connection 
	}
	else
	{?>
		<form action="index.php" method="post">
			<input type="text" name ="full_names" />
			<input type="text" name ="gender" />
			<input type="text" name ="contact_no" />
			<input type="text" name ="email" />
			<input type="text" name ="city" />
			<input type="text" name ="country" />
			<input type="submit" name="submit">
		</form>
	<?php }
	
?>