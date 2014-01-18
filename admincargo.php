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

// //ETIQUETA ADMIN. CARGOS
$admincargo = new jqgrid();

// Personas obtenidas dinamicamente
$resultp = mysql_query("SELECT * FROM persona");
$rowsp = array();
$personasText="";
while ($rowp = mysql_fetch_assoc($resultp))
        $rowsp[]=$rowp;
mysql_free_result($resultp);
for($i=0;$i<sizeof($rowsp);$i++)
        $personasText.=";".$rowsp[$i]['id'].":".$rowsp[$i]['nombre'];

// Centros Apostolicos obtenidas dinamicamente
$resultc = mysql_query("SELECT * FROM centro");
$rowsc = array();
$centrosText="";
while ($rowc = mysql_fetch_assoc($resultc))
        $rowsc[]=$rowc;
mysql_free_result($resultc);
for($i=0;$i<sizeof($rowsc);$i++)
        $centrosText.=";".$rowsc[$i]['id'].":".$rowsc[$i]['centro'];

// Cargos obtenidos dinamicamente
$resultca = mysql_query("SELECT * FROM cargo");
$rowsca = array();
$cargosText="";
while ($rowca = mysql_fetch_assoc($resultca))
        $rowsca[]=$rowca;
mysql_free_result($resultca);
for($i=0;$i<sizeof($rowsca);$i++)
        $cargosText.=";".$rowsca[$i]['id'].":".$rowsca[$i]['cargo'];

// customizing columns
$col_cargo = array();
$col_cargo["title"] = "ID";
$col_cargo["name"] = "id";
$col_cargo["editable"] = false;
$col_cargo["hidden"] = true;
$cols_cargo[] = $col_cargo;

$col_cargo = array();
$col_cargo["title"] = "PERSONA";
$col_cargo["name"] = "persona_id";
$col_cargo["editable"] = true;
$col_cargo["edittype"] = "select"; // render as select
$col_cargo["hidden"] = true;
$col_cargo["editrules"] = array("required"=>true, "edithidden"=>true); // and is required
$col_cargo["editoptions"] = array("value"=>substr($personasText, 1));
$cols_cargo[] = $col_cargo;

$col_cargo = array();
$col_cargo["title"] = "PERSONA";
$col_cargo["name"] = "nombre";
$col_cargo["editable"] = false;
$col_cargo["edittype"] = "select"; // render as select
$col_cargo["editoptions"] = array("value"=>substr($personasText, 1));
$cols_cargo[] = $col_cargo;

$col_cargo = array();
$col_cargo["title"] = "CENTRO APOSTÓLICO";
$col_cargo["name"] = "centro_id";
$col_cargo["editable"] = true;
$col_cargo["edittype"] = "select"; // render as select
$col_cargo["hidden"] = true;
$col_cargo["editrules"] = array("required"=>true, "edithidden"=>true); // and is required
$col_cargo["editoptions"] = array("value"=>substr($centrosText, 1));
$cols_cargo[] = $col_cargo;

$col_cargo = array();
$col_cargo["title"] = "CENTRO APOSTÓLICO";
$col_cargo["name"] = "centro";
$col_cargo["editable"] = false;
$col_cargo["edittype"] = "select"; // render as select
$col_cargo["editoptions"] = array("value"=>substr($centrosText, 1));
$cols_cargo[] = $col_cargo;

$col_cargo = array();
$col_cargo["title"] = "CARGO";
$col_cargo["name"] = "cargo_id";
$col_cargo["editable"] = true;
$col_cargo["edittype"] = "select"; // render as select
$col_cargo["hidden"] = true;
$col_cargo["editrules"] = array("required"=>true, "edithidden"=>true); // and is required
$col_cargo["editoptions"] = array("value"=>substr($cargosText, 1));
$cols_cargo[] = $col_cargo;

$col_cargo = array();
$col_cargo["title"] = "CARGO"; // caption of column
$col_cargo["name"] = "cargo"; // grid column name, must be exactly same as returned column-name from sql (tablefield or field-alias)
$col_cargo["editable"] = false;
$col_cargo["edittype"] = "select"; // render as select
$col_cargo["editoptions"] = array("value"=>substr($cargosText, 1));
$cols_cargo[] = $col_cargo;                

$col_cargo = array();
$col_cargo["title"] = "DESDE";
$col_cargo["name"] = "fecha_creacion";
$col_cargo["editable"] = true;
$col_cargo["editoptions"] = array("size"=>20); // with default display of textbox with size 20
$col_cargo["formatter"] = "date"; // format as date
$col_cargo["align"] = "center";
$cols_cargo[] = $col_cargo;

$col_cargo = array();
$col_cargo["title"] = "HASTA";
$col_cargo["name"] = "fecha_fin";
$col_cargo["editable"] = true;
$col_cargo["editoptions"] = array("size"=>20); // with default display of textbox with size 20
$col_cargo["formatter"] = "date"; // format as date
$col_cargo["align"] = "center";
$cols_cargo[] = $col_cargo;

$grid_cargo["autowidth"] = true; // expand grid to screen width
$grid_cargo["rowNum"] = 10;
// $grid["export"] = array("format"=>"pdf", "filename"=>"my-file", "sheetname"=>"test");
// $grid["export"]["paged"] = "1";

$admincargo->set_options($grid_cargo);

$admincargo->set_actions(array(        
                                                "add"=>true, // allow/disallow add
                                                "edit"=>true, // allow/disallow edit
                                                "delete"=>true, // allow/disallow delete
                                                "export"=>true, // show/hide export to excel option
                                                "rowactions"=>true, // show/hide row wise edit/del/save option
                                        ) 
                                );

// you can provide custom SQL query to display data
$admincargo->select_command = "SELECT * FROM (SELECT pcci.id, pcci.persona_id, p.nombre, pcci.centro_id, c.centro, pcci.cargo_id, ca.cargo, pcci.fecha_creacion, pcci.fecha_fin FROM persona_centro_cargo_instancia pcci INNER JOIN persona p ON pcci.persona_id = p.id INNER JOIN centro c ON pcci.centro_id = c.id INNER JOIN cargo ca ON pcci.cargo_id = ca.id) o";

// this db table will be used for add,edit,delete
$admincargo->table = "persona_centro_cargo_instancia";

// pass the cooked columns to grid
$admincargo->set_columns($cols_cargo);

// generate grid output, with unique grid name as 'list1'
$admincargoOut = $admincargo->render("admincargo");

echo $adminagrupaOut; //Display JQGrid $out
?>