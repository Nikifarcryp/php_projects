<?php
 
function myhash($input, $method = 'sha256') {
		if($method == 'md5')
		{
			$result = md5($input.MY_SALT);
		}
		elseif($method == 'sha256')
		{
			$result  = hash('sha256', $input.MY_SALT);
		}
		if($result)
			return $result;
		else
			return false;
};

function authenticate($log, $password) {
	if (MY_USERS[$log]) {
		if (MY_USERS[$log] == $password) {
			return true;
		}
		else {
			return false;
		}
	}
	else {
		return false;
	}
}

define ('MY_SALT', '9b7f8a4f65198d20aaddb1ed0cfb6569');
    define('MY_USERS', array(
                            'Michał'=>'64e5625faf934f23186d315b310cc361ea52addefb798c05cd8ee7673843fec9',
                            'Adrian'=>'91356cc3fcc81f0d4111038606967a322f9e53351a859fd577667571f0322a6f',
                            'Anna'=>'1e8eb7cf8cb6357eb0e83d0bd46442743f8cac52c680b7ba45732c8cdba731b2'
                            ));
 
?>