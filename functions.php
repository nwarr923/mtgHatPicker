<?php

	session_start();
	
	// Print radio buttons for each name in the playerNames array. Pass in what group radio button belongs to (either group1 or group2)
	function printRadioBtns($group) 
	{
		for ($i = 0; $i < sizeof($_SESSION['playerNames']); $i++) 
		{ 
			print "<label class='labelNames'>" . $_SESSION['playerNames'][$i] . "</label>\n";
			print "<input type='radio' value='" . $_SESSION['playerNames'][$i] . "' name='" . $group . "' /><br />\n";
		} 
	} // end function printRadioBtns
	
	// Compare two arrays to determine if someone wins. If their is no winner, replace defeated players name with the name of the player who defeated them.
	function checkIfVictory()
	{
		// Define two arrays that will hold indexs for each name match between playerWinCon array and group 2 value
		$defeatedPlayer = array();
		$killingBlowPlayer = array();
		
		// Loop through playerWinCon and check if values are equal to group1 or group2.
		// If group1 match, push value into killingBlowPlayer array. If group 2 match, push value into defeatedPlayer array.
		for ($i = 0; $i < sizeof($_SESSION['playerWinCon']); $i++) 
		{ 
			if (($_SESSION['playerWinCon'][$i]) == $_SESSION['group2'] or (($_SESSION['playerWinCon'][$i]) == $_SESSION['group2'] . "1")) // or conditional exists to ensure that killingBlowPlayer does not get advantage from defeating player if a win does not occur.
			{
				array_push($defeatedPlayer, $i);
				
			}
			if (($_SESSION['playerWinCon'][$i]) == $_SESSION['group1'])
			{
				array_push($killingBlowPlayer, $i);
			}
		}
		
		// Loop through playerNames array and check if values are equal to group2.
		// If they are equal, set the value to group1. This represents the killingBlowPlayer having two names now
		for ($i = 0; $i < sizeof($_SESSION['playerNames']); $i++) 
		{ 
			if (($_SESSION['playerNames'][$i]) == $_SESSION['group2'])
			{
				$_SESSION['playerNames'][$i] = $_SESSION['group1'];
				
			}
		}
		
		// Winners are determined by whether they have defeated the player who is next in the index of the playerWinCon array.
		// Ex. [0] -> john, [1] -> jane, [2] -> doe. John wins by defeating Jane, but not doe. The last player (doe) in the index wins by defeating the first player (john).
		// Loop through both defeatedPlayer and killingBlowPlayer arrays. If any values in defeatedPlayer are equal to a killingBlowPlayer value plus 1, then the game has been won.
		// Additionally, if a killingBlowPlayer value minus the length of playerNames array = defeatedPlayer, then the game is won as well.h
		for ($i = 0; $i < sizeof($defeatedPlayer); $i++) 
		{
			for ($c = 0; $c < sizeof($killingBlowPlayer); $c++) 
			{
				if ($defeatedPlayer[$i] == ($killingBlowPlayer[$c] + 1) or ($defeatedPlayer[$i] == ($killingBlowPlayer[$c] - (sizeof($_SESSION['playerNames']) - 1))))
				{
					$_SESSION['playerWins'] = true;
				}
				else
				{
					// If a winner is not declared, swap the defeated players name with the killing Blow Players name + 1.
					// The + 1 is used to make sure the player does not get the benefit of being able to defeat more than one player and win
					$_SESSION['playerWinCon'][$defeatedPlayer[$i]] = $_SESSION['group1'] . "1";
				}
			}
		}
	} // end function checkIfVictory