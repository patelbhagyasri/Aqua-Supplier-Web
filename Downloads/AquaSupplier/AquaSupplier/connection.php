<?php
	//error_reporting( E_ALL );
	error_reporting(E_PARSE);
	session_start();
	mysql_query("set names utf8");
	$connect = mysql_connect("localhost", "root", "") or die(mysql_error());
	mysql_select_db("aquasupplier", $connect) or die(mysql_error());
?>
