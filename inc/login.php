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
$result = mysql_query('SELECT * FROM persona WHERE usuario=\''.mysql_real_escape_string($_POST["user"]).'\' AND contrasena=\''.mysql_real_escape_string($_POST["contrasena"]).'\'')
	or die(mysql_error());
if($row = mysql_fetch_assoc($result)){
	$result1 = mysql_query('SELECT pcci.id, pcci.centro_id, pcci.cargo_id, ca.nivel, pcci.fecha_creacion, pcci.fecha_fin FROM persona_centro_cargo_instancia pcci, cargo ca WHERE pcci.cargo_id = ca.id AND pcci.persona_id ='.$row['id']);
	$rows=array();
	while($row1 = mysql_fetch_assoc($result1)){
		$rows[]=$row1;
	}
	mysql_free_result($result1);
	for ($i=0; $i < sizeof($rows); $i++) { 
		// echo $rows[$i]['nivel'];
		if( $rows[$i]['nivel'] == 2 || $rows[$i]['nivel'] == 3 ){
			session_start();
			$_SESSION["centro_id"] = $rows[$i]['centro_id'];
			$_SESSION["cargo_id"] = $rows[$i]['cargo_id'];
			$_SESSION["nivel_id"] = $rows[$i]['nivel'];
			header('Location: ../asociaciones.php');
		}
	}
	// header('Location: ../index.php');
}else{
	header('Location: ../index.php');
}
mysql_free_result($result);
?>