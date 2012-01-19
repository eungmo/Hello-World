function filled_out($form_vars) {
	//모든 변수가 값을 가지고 있는지 확인한다.
	foreach($form_vars as $key => $value) {
		if((!isset($key)) || ($value == '')) {
			return false;
		}
	}
	return true;
}
