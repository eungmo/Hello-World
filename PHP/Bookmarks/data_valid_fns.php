<?php
	function filled_out($form_vars) {
		//Check variable has value.
		foreach($form_vars as $key => $value) {
			if((!isset($key)) || ($value == '')) {
				return false;
			}
		}
		return true;
	}
	
	function valid_email($address) {
		//Check EmailAdress is valid
		if (ereg('^[a-zA-Z0-9_\.\-]+@[a-zA-Z0-9\-]+\.[a-zA-Z0-9\-\.]+$', $address))
			return true;
		else {
			return false;
		}
	}
?>