<?php
/**
 * PHP Grid Component
 *
 * @author Abu Ghufran <gridphp@gmail.com> - http://www.phpgrid.org
 * @version 1.4.6
 * @license: see license.txt included in package
 */
 
// set up DB
$conn = mysql_connect("localhost", "root", "");
mysql_select_db("mvc");

// set your db encoding -- for ascent chars (if required)
mysql_query("SET NAMES 'utf8'");

// include and create object
include("inc/jqgrid_dist.php");

//ETIQUETA CARGOS POR AREAS
$cargos = new jqgrid();

// Areas obtenidas dinamicamente
$result = mysql_query("SELECT * FROM area");
$rows = array();
$areasText="";
while ($row = mysql_fetch_assoc($result))
	$rows[]=$row;
mysql_free_result($result);
for($i=0;$i<sizeof($rows);$i++)
	$areasText.=";".$rows[$i]['id'].":".$rows[$i]['area'];

// customizing columns
$cargoCol = array();
$cargoCol["title"] = "CARGO"; // caption of column
$cargoCol["name"] = "cargo"; // grid column name, must be exactly same as returned column-name from sql (tablefield or field-alias) 
$cargoCol["width"] = "60";
$cargoCol["editable"] = true;
$cargoCol["editrules"] = array("required"=>true);
$cargoCols[] = $cargoCol;		

$cargoCol = array();
$cargoCol["title"] = "DESCRIPCIÓN";
$cargoCol["name"] = "descripcion";
$cargoCol["editable"] = true;
$cargoCol["width"] = "100";
$cargoCol["edittype"] = "textarea"; // render as textarea on edit
$cargoCols[] = $cargoCol;

$cargoCol = array();
$cargoCol["title"] = "ÁREA";
$cargoCol["name"] = "area_id";
$cargoCol["editable"] = true;
$cargoCol["edittype"] = "select"; // render as select
$cargoCol["hidden"] = true;
$cargoCol["editrules"] = array("required"=>true, "edithidden"=>true); // and is required
$cargoCol["editoptions"] = array("value"=>substr($areasText, 1));
$cargoCols[] = $cargoCol;

$cargoCol = array();
$cargoCol["title"] = "ÁREA";
$cargoCol["name"] = "area";
$cargoCol["editable"] = false;
$cargoCol["edittype"] = "select"; // render as select
$cargoCol["editoptions"] = array("value"=>substr($areasText, 1));
$cargoCols[] = $cargoCol;

$cargoGrid["autowidth"] = true; // expand grid to screen width
$cargoGrid["rowNum"] = 20;
// export PDF file
// export to excel parameters
//$grid["export"] = array("format"=>"pdf", "filename"=>"my-file", "heading"=>"Cargos por Area", "orientation"=>"landscape");

$cargos->set_options($cargoGrid);

$cargos->set_actions(array(	
						"add"=>true, // allow/disallow add
						"edit"=>true, // allow/disallow edit
						"delete"=>true, // allow/disallow delete
						"export"=>true, // show/hide export to excel option
						"rowactions"=>true, // show/hide row wise edit/del/save option
					) 
				);

// you can provide custom SQL query to display data
$cargos->select_command = "SELECT * FROM (SELECT c.cargo, c.descripcion, c.area_id, a.area FROM cargo c
						INNER JOIN area a ON c.area_id = a.id) o";

// this db table will be used for add,edit,delete
$cargos->table = "cargo";

// pass the cooked columns to grid
$cargos->set_columns($cargoCols);

// generate grid output, with unique grid name as 'list1'
$cargoOut = $cargos->render("cargo");

echo $cargoOut;  //Display JQGrid $out
?>