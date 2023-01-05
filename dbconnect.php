<?php
@$dbcnx = new mysqli('localhost','root','','sglocal');
// @ to ignore error message display //
if ($dbcnx->connect_error){
	echo "Database is not online"; 
	exit;
	// above 2 statments same as die() //
	}
/*	else
	echo "Congratulations...  MySql is working..";
*/
if (!$dbcnx->select_db ("sglocal"))
	exit("<p>Unable to locate the sglocal database</p>");
?>	