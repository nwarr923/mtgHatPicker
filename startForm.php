<?php
	// Clear session
	session_start();
	session_destroy();
	require_once("Template.php");

	$page = new Template("startForm.php");
	$page->setHeadSection("<link rel='stylesheet' type='text/css' href='headerStyles.css'/>");
	$page->setHeadSection("<link rel='stylesheet' type='text/css' href='formStyles.css'/>");
	$page->setTopSection();
	$page->setBottomSection();

	// Header HTML
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

	// Body HTML
	print "<div class='content'>\n";
	print "<div id='content'>\n";
	print "<h1>Enter the amount of players.</h1>\n";

	// Print Error message if it exists
	if (!empty($error_message)) 
	{
		print "<p class='error'>\n";
		print $error_message;
		print "</p>";
	} 
	
	print "<form action='enterNamesForm.php' method='post'>\n";
	print "<fieldset>\n";
	print "<div id='data'><br>\n";
	print "<label>Number of Players (Please enter a number)</label><br>\n";
	print "<br><input type='text' name='playerNumber' pattern='[3-8]'/><br>\n";
	print "</div>\n";
	print "</fieldset>\n";
	print "<div id='buttons'>\n";
	print "<label>&nbsp;</label>\n";
	print "<input type='submit' value='Submit'/><br />\n";
	print "</div>\n";
	print "</form>\n";
	print "</div>\n";
	print "</div>\n";

	// Footer HTML
	print "<footer>\n";
	print "<p>MTG Custom Format by Noah Warren</p>\n";
	print "</footer>\n";
	print "</div>\n";
	print $page->getBottomSection();