<?php

	session_start();

	// get the data from the form
	if ( empty($_SESSION["playerNumber"]))
	{
		$playerNumber = $_POST['playerNumber'];
	} 
	else 
	{
		$playerNumber = $_SESSION["playerNumber"];
	} 

    // validate playerNumber
    if ( empty($playerNumber) ) 
	{
        $error_message = 'Please enter a search.';         
    }
	else 
	{
        $error_message = ''; // There are no errors
    }

    // if an error message exists, go to the startForm page
    if ($error_message != '') 
	{
        include('startForm.php');
        exit();
    }
	
	// convert playerNumber to integer and store in session
	$playerNumber = (int)$playerNumber;
	$_SESSION["playerNumber"] = $playerNumber;
	
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

	// Body html
	print "<div class='content'>\n";
	print "<div id='content'>\n";
	print "<h1>Enter the names of players.</h1>\n";

	// print error message if error exists
	if (!empty($error_message2)) 
	{
		print "<p class='error'>\n";
		print $error_message2;
		print "</p>";
	} 

	print "<form action='victoryCheck.php' method='post'>\n";
	print "<fieldset>\n";
	print "<legend>Players</legend>\n";
	print "<div id='data'><br>\n";

	// print form inputs
	for ($i = 1; $i <= $playerNumber; $i++) 
	{ 
		print "<label class='labelNumbers'>" . $i . "</label>\n";
		print "<input name='player" . $i . "' type='text' id='player" . $i . "' /><br />";
	}

	print "</div>\n";
	print "</fieldset>\n";
	print "<div id='buttons'>\n";
	print "<label>&nbsp;</label>\n";
	print "<input type='submit' value='Submit'/><br />\n";
	print "</div>\n";
	print "</form>\n";
	print "</div>\n";
	print "</div>\n";

	// Footer html
	print "<footer>\n";
	print "<p>MTG Custom Format by Noah Warren</p>\n";
	print "</footer>\n";
	print "</div>\n";
	print $page->getBottomSection();