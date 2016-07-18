<?php
require_once('login_fns.php');
function get_server_num (){

	$db = new MyDB();
	
	$stmt = $db->prepare ('SELECT * FROM ftpinfo');
	$result = $stmt->execute();
	
	$num = 0;
	while ($row = $result->fetchArray()){
		//var_dump($row);
		$num++;
	}
	return $num;	
}

function add_server ($name, $id, $pw, $ip, $port){
	
	$db = new MyDB();
	
	$stmt = $db->prepare ('INSERT INTO ftpinfo VALUES (?, ?, ?, ?, ?);');
	$stmt->bindValue (1, $name);
	$stmt->bindValue (2, $id);
	$stmt->bindValue (3, $pw);
	$stmt->bindValue (4, $ip);
	$stmt->bindValue (5, $port);
	$result = $stmt->execute();

	/* parse the lease list. */
	$output = shell_exec("cat /tmp/dhcp.leases");
	$output = explode("\n", $output);

	$num = sizeof($string)-1;
	$ip_array = array($num);
	for($i=0; $i<$num; $i++){
		$substring = explode(" ", $string[$i]);
		$ip = $substring['2']; // IP Address at each line.
		$ip_array[$i] = $ip;
	}

	/* compare given IP to each IP in lease list. */
	$find = 0;
	for($i=0; $i<$num; $i++){
		if ($ip_array[$i] === $ip){
			$find = 1;
		}
	}

	if ($find === 1){
		return true;
	} else {
		return false;
	}
}

function get_server_name ($index){

	$db = new MyDB();
	
	$stmt = $db->prepare ('SELECT * FROM ftpinfo');
	$result = $stmt->execute();

	$i=0;	
	while ($row = $result->fetchArray()){
		if($i === $index){
			return $row['ftpname'].PHP_EOL;
		}
		$i ++;
	}
}

function get_server_username ($index){
	$db = new MyDB();
	
	$stmt = $db->prepare ('SELECT * FROM ftpinfo');
	$result = $stmt->execute();
	
	$i=0;
	while ($row = $result->fetchArray()){
		if($i === $index){
			return $row['username'].PHP_EOL;
		}
		$i ++;
	}
}

function get_server_password ($index) {
	$db = new MyDB();
	
	$stmt = $db->prepare ('SELECT * FROM ftpinfo');
	$result = $stmt->execute();
	
	$i=0;
	while ($row = $result->fetchArray()){
		if($i === $index){
			return $row['password'].PHP_EOL;
		}
		$i ++;
	}
}

function get_server_ip ($index) {
	$db = new MyDB();
	
	$stmt = $db->prepare ('SELECT * FROM ftpinfo');
	$result = $stmt->execute();
	
	$i=0;
	while ($row = $result->fetchArray()){
		if($i === $index){
			return $row['ip'].PHP_EOL;
		}
		$i ++;
	}
}
function get_server_port ($index) {
	$db = new MyDB();
	$stmt = $db->prepare ('SELECT * FROM ftpinfo');
	$result = $stmt->execute();
	$i=0;
	while ($row = $result->fetchArray()){
		if($i === $index){
			return $row['port'].PHP_EOL;
		}
		$i ++;
	}
}
//add_server ('note2', 'francis', 'francis', '192.168.1.234', '2221');
//add_server ('123', '123', '123', '123', '123');
//echo get_server_num();
//echo get_server_name (0);
?>
