<?php

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
	print "<li><a href='startForm.php'>Hat Picker</a></li>\n";
	print "<li><a class='active' href='rules.php'>Rules</a></li>\n";
	print "<li><a href='https://github.com/nwarr923'>Github</a></li>\n";
	print "</ul>";
	print "</nav>\n";
	print "</header>\n";

	// Body HTML
	print "<div class='content'>\n";
	print "<div id='content'>\n";
	print "<h3>Reverse Assassin is a casual multiplayer format that we created for the trading card game 
	Magic: the Gathering. Players are given a random name on a piece of paper, and should a player 
	defeat another player who has their name, they win.</h3>\n";
	print "<h3>Players are free to attack whomever 
	they want. However, victory is not determined solely by who the last player is, but by defeating 
	a player who has your name.</h3>\n";
	print "<h3>Players can only know the name on their piece of paper, otherwise 
	names are kept hidden. A player cannot have their own name. If they get their own name, a redrawing 
	of names must happen (this web app fixes that problem).</h3>\n";
	print "<h3>If a player defeats another player and 
	the defeated player did not have the name of the player who defeated them, the player who dealt the 
	final blow gets the second piece of paper. That player can look at their newly acquired name. Should 
	they be defeated by another player, the player that defeated them has two shots of winning.</h3>\n";
	print "<h3>If a 
	player forfeits or defeats themselves, there name will be kept secret and given to the next player 
	who defeats a player that is not themselves.</h3>\n";
	print "</div>\n";
	print "</div>\n";

	// Footer HTML
	print "<footer>\n";
	print "<p>MTG Custom Format by Noah Warren</p>\n";
	print "</footer>\n";
	print "</div>\n";
	print $page->getBottomSection();