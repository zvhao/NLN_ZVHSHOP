<?php

function getRatingStar($rating)
{
	
	for ($i = 0; $i < $rating; $i++) {
		echo "<i class='icon-detail text-color-main fa-solid fa-star'></i>";
	}
	for ($i = 0; $i < 5 - $rating; $i++) {
		echo "<i class='icon-detail text-color-main fa-regular fa-star'></i>";
	}
	
}

function getRatingStarRound($rating)
{
	$ratingRound = round($rating);
	for ($i = 0; $i < $ratingRound; $i++) {
		echo "<i class='icon text-color-main fa-solid fa-star'></i>";
	}
	for ($i = 0; $i < 5 - $ratingRound; $i++) {
		echo "<i class='icon text-color-main fa-regular fa-star'></i>";
	}
	
}

function evaluate() {
	for ($i=1; $i <= 5; $i++) {
		if($i == 5) $check = 'checked';
		else $check = '';
		echo "<label> <input type='radio' name='stars' class='d-none' value='$i' $check />";
		for ($j=1; $j <= $i; $j++) { 
			echo "<i class='icon fa-solid fa-star'></i>";
		}
		echo "</label>";
	}
}

							
                                

                            
