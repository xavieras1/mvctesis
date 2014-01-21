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

// ETIQUETA INSTANCIAS DESPLIEGUE
// Centros Apostolicos obtenidas dinamicamente
$resultc = mysql_query("SELECT * FROM centro");
$rowsc = array();
$centrosText="";
while ($rowc = mysql_fetch_assoc($resultc))
        $rowsc[]=$rowc;
mysql_free_result($resultc);
for($i=0;$i<sizeof($rowsc);$i++)
        $centrosText.=";".$rowsc[$i]['id'].":".$rowsc[$i]['centro'];

// customizing columns
$despliegueCol = array();
$despliegueCol["title"] = "ID";
$despliegueCol["name"] = "id";
$despliegueCol["editable"] = false;
$despliegueCol["hidden"] = true;
$despliegueCols[] = $despliegueCol;

$despliegueCol = array();
$despliegueCol["title"] = "CENTRO APOSTÓLICO";
$despliegueCol["name"] = "centro_id";
$despliegueCol["editable"] = true;
$despliegueCol["edittype"] = "select"; // render as select
$despliegueCol["hidden"] = true;
$despliegueCol["editrules"] = array("required"=>true, "edithidden"=>true); // and is required
$despliegueCol["editoptions"] = array("value"=>substr($centrosText, 1));
$despliegueCols[] = $despliegueCol;

$despliegueCol = array();
$despliegueCol["title"] = "CENTRO APOSTÓLICO";
$despliegueCol["name"] = "centro";
$despliegueCol["search"] = false;
$despliegueCol["hidden"] = true;
$despliegueCol["editable"] = false;
$despliegueCol["edittype"] = "select"; // render as select
$despliegueCol["editoptions"] = array("value"=>substr($centrosText, 1));
$despliegueCols[] = $despliegueCol;

$despliegueCol = array();
$despliegueCol["title"] = "INSTANCIA"; // caption of column
$despliegueCol["name"] = "despliegue"; // grid column name, must be exactly same as returned column-name from sql (tablefield or field-alias)
$despliegueCol["editrules"] = array("required"=>true);
$despliegueCol["search"] = false;
//$despliegueCol["value"] = "balance";
$despliegueCols[] = $despliegueCol;		

$despliegueCol = array();
$despliegueCol["title"] = "DESCRIPCIÓN";
$despliegueCol["name"] = "descripcion";
$despliegueCol["search"] = true;
$despliegueCol["editable"] = true;
$despliegueCol["edittype"] = "textarea"; // render as textarea on edit
$despliegueCols[] = $despliegueCol;

$despliegueCol = array();
$despliegueCol["title"] = "FECHA";
$despliegueCol["name"] = "fecha_creacion";
$despliegueCol["editrules"] = array("required"=>true);
$despliegueCol["editable"] = true;
$despliegueCol["search"] = true;
$despliegueCol["editoptions"] = array("size"=>20); // with default display of textbox with size 20
$despliegueCol["formatter"] = "date"; // format as date
$despliegueCol["align"] = "center";
$despliegueCols[] = $despliegueCol;


$despliegueCol = array();
$despliegueCol["title"] = "INGRESO"; // caption of column
$despliegueCol["name"] = "ingreso"; // grid column name, must be exactly same as returned column-name from sql (tablefield or field-alias)
$despliegueCol["editable"] = true;
$despliegueCol["summaryType"] = "sum";
$despliegueCol["summaryTpl"] = '<b>INGRESOS: ${0}</b>';
$despliegueCol["sorttype"] = "float";
$despliegueCol["formatter"] = "number";
$despliegueCols[] = $despliegueCol;

$despliegueCol = array();
$despliegueCol["title"] = "EGRESO"; // caption of column
$despliegueCol["name"] = "egreso"; // grid column name, must be exactly same as returned column-name from sql (tablefield or field-alias)
$despliegueCol["editable"] = true;
$despliegueCol["summaryType"] = "sum";
$despliegueCol["summaryTpl"] = '<b>EGRESOS: ${0}</b>';
$despliegueCol["sorttype"] = "float";
$despliegueCol["formatter"] = "number";
$despliegueCols[] = $despliegueCol;

$despliegue = new jqgrid();

$despliegueGrid["autowidth"] = true; // expand grid to screen width
$despliegueGrid["rowNum"] = 10;
// $grid["export"] = array("format"=>"pdf", "filename"=>"my-file", "sheetname"=>"test");
// $grid["export"]["paged"] = "1";
$despliegueGrid["grouping"] = true; // 
$despliegueGrid["groupingView"] = array();
$despliegueGrid["groupingView"]["groupField"] = array("centro"); // specify column name to group listing
$despliegueGrid["groupingView"]["groupColumnShow"] = array(false); // either show grouped column in list or not (default: true)
//$despliegueGrid["groupingView"]["groupText"] = array("<b>{0} - {1} Item(s)</b>"); // {0} is grouped value, {1} is count in group
$despliegueGrid["groupingView"]["groupOrder"] = array("asc"); // show group in asc or desc order
$despliegueGrid["groupingView"]["groupSummary"] = array(true); // work with summaryType, summaryTpl, see column: $col["name"] = "total";

$despliegue->set_options($despliegueGrid);

$despliegue->set_actions(array(	
						"add"=>true, // allow/disallow add
						"edit"=>true, // allow/disallow edit
						"delete"=>true, // allow/disallow delete
						"export"=>true, // show/hide export to excel option
						"rowactions"=>true, // show/hide row wise edit/del/save option
					) 
				);

// you can provide custom SQL query to display data
$despliegue->select_command = "SELECT * FROM (SELECT d.id, d.centro_id, c.centro, d.despliegue, d.descripcion, d.fecha_creacion, d.ingreso, d.egreso FROM instancia_despliegue d INNER JOIN centro c ON d.centro_id = c.id AND d.despliegue = 'balance') o";

// this db table will be used for add,edit,delete
$despliegue->table = "instancia_despliegue";

// pass the cooked columns to grid
$despliegue->set_columns($despliegueCols);

// generate grid output, with unique grid name as 'list1'
$balanceOut = $despliegue->render("despliegue");

echo $balanceOut;
?>