<?php
// Enable or disable error logging
$ee=false;
$path = $_SERVER['REQUEST_URI'];
$arr= explode('/', $path,-1);
// Print if error logging enabled
if($ee){
	//print_r($_GET); 
	echo "<pre>";
		print_r($arr);
	echo "</pre>";
}
$page='';
// Create the whole string for static html loading 
foreach ($arr as &$value) {
    $page.=$value."-";
}

// Removing the extra hyphens from start and end
$page = substr($page, 1, -1);

// Append html to the name
$page.='.html';

 
if (is_readable($page)) { 
	echo $page;
  include($page); 
} else {
  header("HTTP/1.0 404 Not Found");
  include("maintenance.html"); 
  exit;  
} 

?>