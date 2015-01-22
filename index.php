<html>
<head></head>
<body>

	<img class="logo" src="img/nbalogo.png" alt="Logo">
	<h2>Search</h2>
	<form name="search" method="post" action="index.php">
		Enter player's name: <input type="text" name="find" />
		<input type="hidden" name="searching" value="yes" />
		<input type="submit" name="search" value="Search" />
	</form>
	<?php
		//only if form is submitted 
		if (isset($_POST['find'])) { 
			$find = $_POST['find'];

			echo "<h2>Results</h2><p>";

			//We remind them what they searched for  
			echo "<b>You searched:</b> " . $find . "<br><br>";

			//Asks to enter search if submission was empty 
			if ($find == "")  {  
				echo "Please enter a search item";  
				exit;  
			} 

			//Connect to playerstats Database  
			mysql_connect('info344chris.c8gojx28zfth.us-west-2.rds.amazonaws.com', 'info344chris', 'info344chris') or die(mysql_error()); 
			mysql_select_db('info344chris') or die(mysql_error()); 

			//Filter searched word
			$find = strtoupper($find);  
			$find = strip_tags($find);  
			$find = trim ($find);

			//Searches for input in the database  
			$data = mysql_query("SELECT * FROM playerstats WHERE upper(PlayerName) LIKE'%$find%'"); 

			//If match found, print the results 
			while($result = mysql_fetch_array($data))  {
			  echo $result['PlayerName'];  
			  echo "<br>";  
			  echo "GP: " . $result['GP'];  
			  echo "<br>";  
			  echo "FGP: " . $result['FGP'];  
			  echo "<br>";
			  echo "TPP: " . $result['TPP'];  
			  echo "<br>"; 
			  echo "FTP: " . $result['FTP'];  
			  echo "<br>"; 
			  echo "PPG: " . $result['PPG'];  
			  echo "<br>";
			  echo "<br>"; 
			} 

			//Let the user know if there is no match.
			$anymatches = mysql_num_rows($data);  
			if ($anymatches == 0)  {  
				echo "Sorry, there are no players of that name.";  
			}
		 
		}  
	?>

</body>
</html>