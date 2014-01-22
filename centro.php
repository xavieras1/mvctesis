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

//ETIQUETA CENTROS
// customizing columns
$centroCol = array();
$centroCol["title"] = "NOMBRE"; // caption of column
$centroCol["name"] = "centro"; // grid column name, must be exactly same as returned column-name from sql (tablefield or field-alias)
$centroCol["editable"] = true;
$centroCol["editrules"] = array("required"=>true);
$centroCols[] = $centroCol;		

$centroCol = array();
$centroCol["title"] = "DESCRIPCIÓN";
$centroCol["name"] = "descripcion";
$centroCol["editable"] = true;
$centroCol["edittype"] = "textarea"; // render as textarea on edit
$centroCols[] = $centroCol;

$centroCol = array();
$centroCol["title"] = "CREACIÓN";
$centroCol["name"] = "fecha_creacion";
$centroCol["editable"] = true;
$centroCol["editrules"] = array("required"=>true);
$centroCol["editoptions"] = array("size"=>20); // with default display of textbox with size 20
$centroCol["formatter"] = "date"; // format as date
$centroCol["align"] = "center";
$centroCols[] = $centroCol;

$centroCol = array();
$centroCol["title"] = "TELÉFONO";
$centroCol["name"] = "telefono";
$centroCol["editable"] = true;
$centroCol["editrules"] = array("required"=>false,"number"=>true);
$centroCol["align"] = "center";
$centroCols[] = $centroCol;

$centroCol = array();
$centroCol["title"] = "DIRECCIÓN";
$centroCol["name"] = "direccion";
$centroCol["width"] = "250";
$centroCol["editable"] = true;
$centroCol["edittype"] = "textarea"; // render as textarea on edit
$centroCols[] = $centroCol;

$centroCol = array();
$centroCol["title"] = "EMAIL";
$centroCol["name"] = "email";
$centroCol["editable"] = true;
$centroCol["editrules"] = array("required"=>false,"email"=>true);
$centroCols[] = $centroCol;

$centros = new jqgrid();

$centroGrid["autowidth"] = true; // expand grid to screen width
$centroGrid["rowNum"] = 10;
$centros->set_options($centroGrid);

$centros->set_actions(array(	
						"add"=>true, // allow/disallow add
						"edit"=>true, // allow/disallow edit
						"delete"=>true, // allow/disallow delete
						"export"=>true, // show/hide export to excel option
						"rowactions"=>true, // show/hide row wise edit/del/save option
					) 
				);

// you can provide custom SQL query to display data
$centros->select_command = "SELECT * FROM (SELECT c.centro, c.descripcion, c.fecha_creacion, c.telefono, c.direccion, c.email FROM centro c) o";

// this db table will be used for add,edit,delete
$centros->table = "centro";

// pass the cooked columns to grid
$centros->set_columns($centroCols);

// generate grid output, with unique grid name as 'list1'
$out = $centros->render("list1");?>
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