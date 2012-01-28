<?php
function filled_out($form_vars) {
	//test each variable has a value
	foreach ($form_vars as $keiy => $value) {		//////////////////////
		if (!isset($key) || ($value == '')) {
			return false;
		}
	}
	return true;
}

function clean($string) {
	$string = trim($string);
	$string = htmlentities($string);		//////////////////////////
	$string = strip_tags($string);		//////////////////////
	return $string;
}

function clean_all($form_vars) {
	foreach($form_vars as $key => $value) {
		$form_vars[$key] = clean($value);		//////////////////////////
	}
	return $form_vars;
}

?>