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
	$result1 = mysql_query('SELECT pcci.id, pcci.centro_id, pcci.cargo_id, ca.nivel, pcci.fecha_creacion, pcci.fecha_fin FROM persona_centro_cargo_instancia pcci, cargo ca WHERE pcci.cargo_id = ca.id AND pcci.persona_id ='.$row['id']);
	$salida=0;
	while($row1 = mysql_fetch_assoc($result1)&&$salida==0){
		if($row1['nivel']==2||$row1['nivel']==3)
			$salida=1;
	}
	mysql_free_result($result1);
	if($salida==1){
		session_start();
		$_SESSION["centro_id"] = $row1['centro_id'];
		$_SESSION["cargo_id"] = $row1['cargo_id'];
		$_SESSION["nivel_id"] = $row1['nivel'];
		header('Location: ../asociaciones.php');
	}else{
		header('Location: ../index.php');
	}
}else{
	header('Location: ../index.php');
}
mysql_free_result($result);
?>