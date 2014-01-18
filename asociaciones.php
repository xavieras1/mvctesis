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

//ETIQUETA ASOCIACIONES
$permanecia = new jqgrid();

// Centros Apostolicos obtenidas dinamicamente
$result = mysql_query("SELECT * FROM centro");
$rows = array();
$centrosText="";
while ($row = mysql_fetch_assoc($result))
	$rows[]=$row;
mysql_free_result($result);
for($i=0;$i<sizeof($rows);$i++)
	$centrosText.=";".$rows[$i]['id'].":".$rows[$i]['centro'];

// customizing columns
$permanenciaCol = array();
$permanenciaCol["title"] = "CENTRO APOSTÓLICO";
$permanenciaCol["name"] = "centro_id";
$permanenciaCol["editable"] = true;
$permanenciaCol["edittype"] = "select"; // render as select
$permanenciaCol["hidden"] = true;
$permanenciaCol["editrules"] = array("required"=>true, "edithidden"=>true); // and is required
$permanenciaCol["editoptions"] = array("value"=>substr($centrosText, 1));
$permanenciaCols[] = $permanenciaCol;

$permanenciaCol = array();
$permanenciaCol["title"] = "CENTRO APOSTÓLICO";
$permanenciaCol["name"] = "centro";
$permanenciaCol["editable"] = false;
$permanenciaCol["edittype"] = "select"; // render as select
$permanenciaCol["editoptions"] = array("value"=>substr($centrosText, 1));
$permanenciaCols[] = $permanenciaCol;

$permanenciaCol = array();
$permanenciaCol["title"] = "AGRUPACIÓN"; // caption of column
$permanenciaCol["name"] = "nombre"; // grid column name, must be exactly same as returned column-name from sql (tablefield or field-alias)
$permanenciaCol["editable"] = true;
$permanenciaCols[] = $permanenciaCol;		

$permanenciaCol = array();
$permanenciaCol["title"] = "DESCRIPCIÓN";
$permanenciaCol["name"] = "descripcion";
$permanenciaCol["editable"] = true;
$permanenciaCol["edittype"] = "textarea"; // render as textarea on edit
$permanenciaCols[] = $permanenciaCol;

$permanenciaCol = array();
$permanenciaCol["title"] = "DESDE";
$permanenciaCol["name"] = "fecha_creacion";
$permanenciaCol["editable"] = true;
$permanenciaCol["editoptions"] = array("size"=>20); // with default display of textbox with size 20
$permanenciaCol["formatter"] = "date"; // format as date
$permanenciaCol["align"] = "center";
$permanenciaCols[] = $permanenciaCol;

$permanenciaCol = array();
$permanenciaCol["title"] = "HASTA";
$permanenciaCol["name"] = "fecha_fin";
$permanenciaCol["editable"] = true;
$permanenciaCol["editoptions"] = array("size"=>20); // with default display of textbox with size 20
$permanenciaCol["formatter"] = "date"; // format as date
$permanenciaCol["align"] = "center";
$permanenciaCols[] = $permanenciaCol;

$permanenciaGrid["autowidth"] = true; // expand grid to screen width
$permanenciaGrid["rowNum"] = 10;
// $grid["export"] = array("format"=>"pdf", "filename"=>"my-file", "sheetname"=>"test");
// $grid["export"]["paged"] = "1";

$permanecia->set_options($permanenciaGrid);

$permanecia->set_actions(array(	
						"add"=>true, // allow/disallow add
						"edit"=>true, // allow/disallow edit
						"delete"=>true, // allow/disallow delete
						"export"=>true, // show/hide export to excel option
						"rowactions"=>true, // show/hide row wise edit/del/save option
					) 
				);

// you can provide custom SQL query to display data
$permanecia->select_command = "SELECT * FROM (SELECT p.centro_id, c.centro, p.nombre, p.descripcion, p.fecha_creacion, p.fecha_fin FROM instancia_permanencia p
						INNER JOIN centro c ON p.centro_id = c.id) o";

// this db table will be used for add,edit,delete
$permanecia->table = "instancia_permanencia";

// pass the cooked columns to grid
$permanecia->set_columns($permanenciaCols);

// generate grid output, with unique grid name as 'list1'
$permanenciaOut = $permanecia->render("asociaciones");

echo $permanenciaOut; //Display JQGrid $out
?>