<?php
/**
 * PHP Grid Component
 *
 * @author Abu Ghufran <gridphp@gmail.com> - http://www.phpgrid.org
 * @version 1.4.6
 * @license: see license.txt included in package
 */
// set up DB
$conn = mysql_connect("localhost", "root", "root");
mysql_select_db("mvc");

// set your db encoding -- for ascent chars (if required)
mysql_query("SET NAMES 'utf8'");

$result = mysql_query('SELECT * FROM persona WHERE usuario=\''.mysql_real_escape_string($_POST["user"]).'\' AND contrasena=\''.mysql_real_escape_string($_POST["contrasena"]).'\'');
$row = mysql_fetch_assoc($result);
if($row!=""){
	session_start();
	header('Location: ../main.php');
}else{
	header('Location: ../index.php');
}
mysql_free_result($result);
?>