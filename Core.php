<?php

function real_string($str)
{
	// This function is for allowing apostrophe in input fild
	
	if (get_magic_quotes_gpc()) $str=stripslashes($str);

	if (function_exists('mysql_real_escape_string')) 
	{
		return mysql_real_escape_string($str);
	} else {
		return addslashes($str);
	}
}

function SetTitle($title)
{
	// echo "<script>
	// var elements = document.getElementsByTagName('title')
	// while (elements[0]) elements[0].parentNode.removeChild(elements[0])
	// </script>";
	echo"<title>$title | CRM System</title>";
}

?> 