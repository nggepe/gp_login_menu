<?php 


	function spaceToUnderscore($string) {
	    $splited = explode(" ", $string);
	    $result = "";
	    foreach ($splited as $key => $value) {
	    	$result.=$value."_";
	    }
	    $result=rtrim($result, "_");

	    return $result;
	}

	function underscoreToSpace($string){
		$splited = explode("_", $string);
	    $result = "";
	    foreach ($splited as $key => $value) {
	    	$result.=$value." ";
	    }
	    $result=rtrim($result, " ");

	    return $result;
	}


?>