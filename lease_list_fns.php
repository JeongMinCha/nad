<?php
function num_devices (){
	$string = shell_exec('cat /tmp/dhcp.leases');
	$string = explode ("\n", $string);

	$num = sizeof($string)-1;
	return $num;
}

function get_ip($index){

	$string = shell_exec('cat /tmp/dhcp.leases');
	$string = explode ("\n", $string);
	
	for ($i=0; $i<num_devices(); $i++){
	
		if ($i == $index){
			$substring = explode (" ", $string[$i]);
			$ip = $substring['2'];
			return $ip;
		}
	}
}

//$num_dev = num_devices();
//echo $num_dev;
//$ip = get_ip('0');
//echo $ip;
?>
