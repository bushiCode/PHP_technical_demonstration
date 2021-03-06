<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Ip filtering</title>
	</head>

	<body>
		
		<?php

			$db_list = array(
				range(ip2long("192.168.1.0"),ip2long("192.168.1.255")),
				"192.168.0.1",
				"192.168.0.1/32",
		  		"192.168.0.1/26",
		  		"192.168.0.1/24",
				"192.168.0.1/16",
				"127.0.0.1/24",
				"10.0.0.1/32",
				"10.0.0.1/24"
			);			

			find_ip("10.0.0.42", $db_list);
			find_ip("192.168.1.255", $db_list);
			find_ip("10.0.0.1", $db_list);
			find_ip("127.0.0.1", $db_list);

			// Input an ip and a list of ip's. Run through the list and check whether the ip is CIDR, array containing range, or a single ip.
			// Compare input ip against those within list, and return the ip if found.
			function find_ip($ip, $db_list) {
				foreach($db_list as $db_list) {
			    	if(is_string($db_list) && strpos($db_list, '/') == true) {
			    		if(cidr_match($ip, $db_list)) {
			      			echo nl2br("IP {$ip} found in list\n");
			      			break;
			    		} 
			    	} else if(is_array($db_list) && in_array(ip2long($ip), $db_list)) {
		    			echo nl2br("IP {$ip} found in list\n");
			      		break;
			    	} else if(is_string($db_list) && strpos($db_list, '/') == false) {
			    		if($ip == $db_list) {
			    			echo nl2br("IP {$ip} found in list\n");
			    			break;
			    		}
			    	}
			  	}  
			}

			// If ip is CIDR notation, this function expands the range of ip's into a list, to find whether the ip exists within the CIDR range.
			function cidr_match($ip, $db_list) {
			    list ($subnet, $bits) = explode('/', $db_list);
			    $ip = ip2long($ip);
			    $subnet = ip2long($subnet);
			    $mask = -1 << (32 - $bits);
			    $subnet &= $mask;
			    return ($ip & $mask) == $subnet;
			}
		?> 
		
	</body>
</html>