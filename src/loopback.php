<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
header('Content-Type: application/json');
//echo json_encode($data);
	$arr = array();
    switch($_SERVER['REQUEST_METHOD'])//from a comment in http://php.net/manual/en/reserved.variables.request.php
	{
	case 'GET': 
		$Type = &$_GET;
		foreach ($_REQUEST as $key => $value) {//from http://stackoverflow.com/questions/8140915/how-to-handle-unknown-number-of-items-from-a-form-in-php

    		if (isset($key) && $value == "") {
    			$value = "undefined";
    		}
    		$arr[$key] = $value;
       	}
    	if ( $arr == null ){
    		$arr = "null";
    		$keyType = "Type";
       		$arrType[$keyType] = "GET";
       		$parameter = "parameter";
       		$arrType[$parameter] = $arr;
		}
		else {
       		$keyType = "Type";
       		$arrType[$keyType] = "GET";
       		$parameter = "parameter";
       		$arrType[$parameter] = $arr;
    	}
	break;

	case 'POST': 
		$Type = &$_POST;
		foreach ($_REQUEST as $key => $value) {//from http://stackoverflow.com/questions/8140915/how-to-handle-unknown-number-of-items-from-a-form-in-php

    		if (isset($key) && $value == "") {
    			$value = "undefined";
    		}
    		$arr[$key] = $value;
       	}
    	if ( $arr == null ){
    		$arr = "null";
    		$keyType = "Type";
       		$arrType[$keyType] = "POST";
       		$parameter = "parameter";
       		$arrType[$parameter] = $arr;
		}
		else {
       		$keyType = "Type";
       		$arrType[$keyType] = "POST";
       		$parameter = "parameter";
       		$arrType[$parameter] = $arr;
    	}
	break;

	default:
		echo "You didn't perform a GET or a POST.";
	}
	echo json_encode($arrType);
?>