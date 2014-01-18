<?php
/**
 * PHP Grid Component
 *
 * @author Abu Ghufran <gridphp@gmail.com> - http://www.phpgrid.org
 * @version 1.4.6
 * @license: see license.txt included in package
 */
 
// set up DB
$conn = mysql_connect("localhost:8888", "root", "root");
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
$centroOut = $centros->render("centro");

echo $centroOut; //Display JQGrid $out
?>