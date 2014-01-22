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

// include and create object
include("inc/jqgrid_dist.php");

// ETIQUETA MIEMBROS
// customizing columns
$miembrosCol = array();
$miembrosCol["title"] = "ID"; // caption of column
$miembrosCol["name"] = "id"; // grid column name, must be exactly same as returned column-name from sql (tablefield or field-alias) 
$miembrosCol["width"] = "70";
$miembrosCol["editable"] = false;
$miembrosCol["hidden"] = true;
$miembrosCol["align"] = "center";
$miembrosCols[] = $miembrosCol;		

$miembrosCol = array();
$miembrosCol["title"] = "FOTO";
$miembrosCol["name"] = "foto";
$miembrosCol["editable"] = true;
$miembrosCol["hidden"] = true;
$miembrosCol["align"] = "center";
$miembrosCol["formatter"] = "image"; // format as image -- if data is image url e.g. http://<domain>/test.jpg
$miembrosCol["formatoptions"] = array("width"=>'80',"height"=>'100'); // image width / height etc
$miembrosCol["edittype"] = "file"; // render as file
$miembrosCol["upload_dir"] = "temp"; // upload here
$miembrosCols[] = $miembrosCol;

$miembrosCol = array();
$miembrosCol["title"] = "NOMBRE";
$miembrosCol["name"] = "nombre";
$miembrosCol["editable"] = true;
$miembrosCol["width"] = "130";
$miembrosCol["align"] = "center";
$miembrosCol["editrules"] = array("required"=>true, "edithidden"=>true); // and is required
$miembrosCols[] = $miembrosCol;

$miembrosCol = array();
$miembrosCol["title"] = "APELLIDO";
$miembrosCol["name"] = "apellido";
$miembrosCol["editable"] = true;
$miembrosCol["width"] = "130";
$miembrosCol["align"] = "center";
$miembrosCol["editrules"] = array("required"=>true, "edithidden"=>true); // and is required
$miembrosCols[] = $miembrosCol;

$miembrosCol = array();
$miembrosCol["title"] = "CIUDAD";
$miembrosCol["name"] = "ciudad";
$miembrosCol["editable"] = true;
$miembrosCol["edittype"] = "select"; // render as select
$miembrosCol["editoptions"] = array("value"=>'Santiago de Guayaquil:Santiago de Guayaquil;San Pablo de Manta:San Pablo de Manta;San Francisco de Quito:San Francisco de Quito');
$miembrosCol["align"] = "center";
$miembrosCol["editrules"] = array("required"=>true, "edithidden"=>true); // and is required
$miembrosCols[] = $miembrosCol;

$miembrosCol = array();
$miembrosCol["title"] = "SEXO";
$miembrosCol["name"] = "sexo";
$miembrosCol["editable"] = true;
$miembrosCol["align"] = "center";
$miembrosCol["edittype"] = "select"; // render as select
$miembrosCol["editoptions"] = array("value"=>'hombre:hombre;mujer:mujer');
$miembrosCol["editrules"] = array("required"=>true, "edithidden"=>true); // and is required
$miembrosCols[] = $miembrosCol;

$miembrosCol = array();
$miembrosCol["title"] = "EDAD";
$miembrosCol["name"] = "edad";
$miembrosCol["align"] = "center";
$miembrosCol["editable"] = true;
$miembrosCol["editrules"] = array("number"=>true);
$miembrosCols[] = $miembrosCol;

$miembrosCol = array();
$miembrosCol["title"] = "CUMPLEAÑOS";
$miembrosCol["name"] = "fecha_nacimiento";
$miembrosCol["editable"] = true;
$miembrosCol["width"] = "190";
$miembrosCol["editoptions"] = array("size"=>20); // with default display of textbox with size 20
$miembrosCol["formatter"] = "date"; // format as date
$miembrosCol["align"] = "center";
$miembrosCols[] = $miembrosCol;

$miembrosCol = array();
$miembrosCol["title"] = "DOMICILIO";
$miembrosCol["name"] = "domicilio";
$miembrosCol["width"] = "250";
$miembrosCol["editable"] = true;
$miembrosCol["edittype"] = "textarea"; // render as textarea on edit
$miembrosCol["align"] = "center";
$miembrosCols[] = $miembrosCol;

$miembrosCol = array();
$miembrosCol["title"] = "NIVEL DE ESTUDIO";
$miembrosCol["name"] = "nivel_estudio";
$miembrosCol["editable"] = true;
$miembrosCol["edittype"] = "select"; // render as select
$miembrosCol["align"] = "center";
$miembrosCol["editoptions"] = array("value"=>'primaria:primaria;secundaria:secundaria;universitario:universitario;profesional:profesional');
$miembrosCols[] = $miembrosCol;

$miembrosCol = array();
$miembrosCol["title"] = "INSTITUCIÓN";
$miembrosCol["name"] = "institucion";
$miembrosCol["editable"] = true;
$miembrosCol["align"] = "center";
$miembrosCols[] = $miembrosCol;

$miembrosCol = array();
$miembrosCol["title"] = "TELÉFONO";
$miembrosCol["name"] = "telefono";
$miembrosCol["editable"] = true;
$miembrosCol["align"] = "center";
$miembrosCol["editrules"] = array("number"=>true);
$miembrosCols[] = $miembrosCol;

$miembrosCol = array();
$miembrosCol["title"] = "CELL CLARO";
$miembrosCol["name"] = "celular_claro";
$miembrosCol["editable"] = true;
$miembrosCol["align"] = "center";
$miembrosCol["editrules"] = array("number"=>true);
$miembrosCols[] = $miembrosCol;

$miembrosCol = array();
$miembrosCol["title"] = "CELL MOVISTAR";
$miembrosCol["name"] = "celular_movistar";
$miembrosCol["editable"] = true;
$miembrosCol["align"] = "center";
$miembrosCol["editrules"] = array("number"=>true);
$miembrosCols[] = $miembrosCol;

$miembrosCol = array();
$miembrosCol["title"] = "EMAIL";
$miembrosCol["name"] = "email";
$miembrosCol["editable"] = true;
$miembrosCol["align"] = "center";
$miembrosCol["editrules"] = array("email"=>true); 
$miembrosCols[] = $miembrosCol;

$miembrosCol = array();
$miembrosCol["title"] = "FACEBOOK";
$miembrosCol["name"] = "facebook";
$miembrosCol["editable"] = true;
$miembrosCol["align"] = "center";
$miembrosCols[] = $miembrosCol;

$miembrosCol = array();
$miembrosCol["title"] = "TWITTER";
$miembrosCol["name"] = "twitter";
$miembrosCol["editable"] = true;
$miembrosCol["align"] = "center";
$miembrosCols[] = $miembrosCol;

$miembrosCol = array();
$miembrosCol["title"] = "RELACIÓN";
$miembrosCol["name"] = "relacion";
$miembrosCol["editable"] = true;
$miembrosCol["edittype"] = "select"; // render as select
$miembrosCol["editoptions"] = array("value"=>'agrupado:agrupado;visitante:visitante');
$miembrosCol["align"] = "center";
$miembrosCols[] = $miembrosCol;

$miembrosCol = array();
$miembrosCol["title"] = "ESTADO";
$miembrosCol["name"] = "estado";
$miembrosCol["editable"] = true;
$miembrosCol["edittype"] = "select"; // render as select
$miembrosCol["editoptions"] = array("value"=>'activo:activo;pasivo:pasivo');
$miembrosCol["align"] = "center";
$miembrosCols[] = $miembrosCol;

$miembrosCol = array();
$miembrosCol["title"] = "FECHA DE REGISTRO";
$miembrosCol["name"] = "fecha_registro";
$miembrosCol["editable"] = true;
$miembrosCol["editoptions"] = array("size"=>20); // with default display of textbox with size 20
$miembrosCol["formatter"] = "date"; // format as date
$miembrosCol["align"] = "center";
$miembrosCols[] = $miembrosCol;

$miembrosCol = array();
$miembrosCol["title"] = "USUARIO";
$miembrosCol["name"] = "usuario";
$miembrosCol["editable"] = true;
$miembrosCol["align"] = "center";
$miembrosCols[] = $miembrosCol;

$miembrosCol = array();
$miembrosCol["title"] = "CONTRASEÑA";
$miembrosCol["name"] = "contrasena";
$miembrosCol["editable"] = true;
$miembrosCol["formatter"] = "password";
$miembrosCol["align"] = "center";
$miembrosCols[] = $miembrosCol;

$miembros = new jqgrid();

$miembrosGrid["autowidth"] = true; // expand grid to screen width
$miembrosGrid["rowNum"] = 10;
$miembros->set_options($miembrosGrid);

$miembros->set_actions(array(	
						"add"=>true, // allow/disallow add
						"edit"=>true, // allow/disallow edit
						"delete"=>true, // allow/disallow delete
						"rowactions"=>true, // show/hide row wise edit/del/save option
					) 
				);

// you can provide custom SQL query to display data
$miembros->select_command = "SELECT * FROM (SELECT p.id, p.foto, p.nombre, p.apellido, p.ciudad, p.sexo, p.edad, p.fecha_nacimiento, p.domicilio, p.nivel_estudio, p.institucion, p.telefono, p.celular_claro, p.celular_movistar, p.email, p.facebook, p.twitter, p.relacion, p.estado, p.fecha_registro, p.usuario, p.contrasena FROM persona p) o";

// this db table will be used for add,edit,delete
$miembros->table = "persona";

// pass the cooked columns to grid
$miembros->set_columns($miembrosCols);

$out = $miembros->render("list1");?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html>
<head>
	<link rel="stylesheet" type="text/css" media="screen" href="js/themes/redmond/jquery-ui.custom.css"></link>	
	<link rel="stylesheet" type="text/css" media="screen" href="js/jqgrid/css/ui.jqgrid.css"></link>	
	
	<script src="js/jquery.min.js" type="text/javascript"></script>
	<script src="js/jqgrid/js/grid.locale-es.js" type="text/javascript"></script>
	<script src="js/jqgrid/js/jquery.jqGrid.min.js" type="text/javascript"></script>	
	<script src="js/themes/jquery-ui.custom.min.js" type="text/javascript"></script>

	<link rel='stylesheet' href='css/mvc.css' />

	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>

</head>
<body>
	<div id="header">
      <?php include 'inc/header.php';?>
    </div>
    <div id="wrapper">
      <div id="menu_bar">
         <?php 
          //if ($_SESSION["current_cargo"]['info']['cargo_id']==5) {//por ahora superadmin
            include 'inc/menu.php';
          
        ?>
      </div>
	<div id="main">
        <div id="content_header">
          <span id="content_title"></span>
        </div>
        <div id="content">
          <?php echo $out; //Display JQGrid $out?>
        </div>
      </div>
    </div>
    <div id="footer">
      <span>MVC-SYSTEM</span></br>
      <span>MOVIMIENTO DE VIDA CRISTIANA ECUADOR</span></br>
      <span>(C) SAC 2013</span></br>
    </div>
</body>
</html>
