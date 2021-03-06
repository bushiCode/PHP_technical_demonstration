<!DOCTYPE html>
<html lang="en">

	<head>
		<title>Anagram</title>
	</head>
	
	<body>

		<?php 
			//Count and compare occurance of each charcter in two words, and return true if they match. 
		    function check_anagram($word_1, $word_2)  {
		    	if(strlen($word_1) != strlen($word_2)) {
		    		return "false";
		    	}

		    	if (count_chars(mb_strtolower($word_1), 1) == count_chars(mb_strtolower($word_2), 1) && $word_1 != $word_2) {
	    	       return "true";
	    	    } else {
	    	        return "false";
	    	    }
		    }

			echo check_anagram('hello', 'hello');
		    echo "<br>";
		    echo check_anagram('hello', 'Olleh');
		    echo "<br>";
		    echo check_anagram('seven', 'six');
		?> 
		
	</body>
</html> 