<?php
	
	session_start();
	require_once("functions.php");
	
	// Check if user has been to this page before during current session.
	if (!isset($_SESSION["firstVisit"]))
	{
		$_SESSION["firstVisit"] = true;
	}
	
	// if this is the users fist visit, get and validate data from text inputs containing names
	if ($_SESSION["firstVisit"] == true)
	{	
		// get the data from the form
		for ($i = 0; $i < $_SESSION["playerNumber"]; $i++) 
		{ 
			$playerNames[$i] = $_POST['player' . ($i + 1)]; // playerNames is used to show the end user who remains in the game
			$playerWinCon[$i] = $_POST['player' . ($i + 1)]; // playerWinCOn is used behind the scenes to determine when a player wins
			
			// validate playerNames
			if ( empty($playerNames[$i]) ) 
			{
				$error_message2 = 'Please enter a name into each space below.';         
			} 
			else 
			{
				$error_message2 = ''; // There are no errors
			}

			// if an error message exists, go to the enterNamesForm page
			if ($error_message2 != '') 
			{
				include('enterNamesForm.php');
				exit();
			}
		} 
		
		shuffle($playerWinCon); // Used to make it so user does not know where names are indexed in array
		$_SESSION['playerNames'] = $playerNames;
		$_SESSION['playerWinCon'] = $playerWinCon;
		
	} 
	else // if not first visit, get and validate data from radio buttons.
	{
		// validate group 1 and group 2
		if (empty($_POST['group1']) or empty($_POST['group2']))
		{
			$error_message2 = 'Please select players.';         
		} 
		else if (($_POST['group1']) == $_POST['group2'])
		{
			$error_message2 = 'Please select two different players.';  
		}
		else 
		{
			$error_message2 = ''; // There are no errors
			$_SESSION['group1'] = $_POST['group1'];
			$_SESSION['group2'] = $_POST['group2'];
			checkIfVictory();
		} 
	}
	
	require_once("Template.php");

	$page = new Template("enterNamesForm.php");
	$page->setHeadSection("<link rel='stylesheet' type='text/css' href='headerStyles.css'/>");
	$page->setHeadSection("<link rel='stylesheet' type='text/css' href='formStyles.css'/>");
	$page->setTopSection();
	$page->setBottomSection();

	// Header html
	print $page->getTopSection();
	print "<div class='size-wrapper'>\n";
	print "<header>\n";
	print "<a id='siteTitle' href='startForm.php'>MTG Custom Format</a>\n";
	print "<nav>\n";
	print "<ul class='navbar'>\n";
	print "<li><a class='active' href='startForm.php'>Hat Picker</a></li>\n";
	print "<li><a href='rules.php'>Rules</a></li>\n";
	print "<li><a href='https://github.com/nwarr923'>Github</a></li>\n";
	print "</ul>";
	print "</nav>\n";
	print "</header>\n";

	// Body Html
	print "<div class='content'>\n";
	print "<div id='content'>\n";

	// Print win statement if win condition is true
	if (isset($_SESSION['playerWins']) and ($_SESSION['playerWins'] == true))
	{
		print "<h1>" . $_SESSION['group1'] ." wins the game!</h1>\n";
		print "<a href='startForm.php'>Click here to play again.</a>\n";
	}
	else // print the normal html along with the game continues statement.
	{
		if ($_SESSION['firstVisit'] == false)
		{
			print "<h1>The game continues!</h1>\n";
		}
		
		// Print error message if one exists
		if (!empty($error_message2)) 
		{
			print "<p class='error'>\n";
			print $error_message2;
			print "</p>";
		} 
		
		print "<form action='victoryCheck.php' method='post'>\n";
		print "<fieldset>\n";
		print "<legend>Select Combatants</legend>\n";
		print "<div id='data'><br>\n";
		print "<fieldset id='group1'>\n";
		print "<h2>Select the Player who dealt the final blow.</h2>\n";
		
		// Print radio buttons
		printRadioBtns("group1");
		
		print "</fieldset>\n";
		print "<fieldset id='group1'>\n";
		print "<h2>Select the Player who was defeated.</h2>\n";
		
		// Print radio buttons
		printRadioBtns("group2");
		
		print "</fieldset>\n";
		print "</div>\n";
		print "</fieldset>\n";
		print "<div id='buttons'>\n";
		print "<label>&nbsp;</label>\n";
		print "<input type='submit' value='Submit'/><br />\n";
		print "</div>\n";
		print "</form>\n";
		print "</div>\n";
		print "</div>\n";
	}

	// Footer Html
	print "<footer>\n";
	print "<p>MTG Custom Format by Noah Warren</p>\n";
	print "</footer>\n";
	print "</div>\n";
	print $page->getBottomSection();

	// Ensure next time user comes to this page, it will not be first time.
	$_SESSION['firstVisit'] = false; 