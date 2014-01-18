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

//ETIQUETA ADMIN. ASOCIACIONES
$adminagrupa = new jqgrid();

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

// Asociaciones obtenidas dinamicamente
$resulta = mysql_query("SELECT * FROM instancia_permanencia");
$rowsa = array();
$asocText="";
while ($rowa = mysql_fetch_assoc($resulta))
        $rowsa[]=$rowa;
mysql_free_result($resulta);
for($i=0;$i<sizeof($rowsa);$i++)
        $asocText.=";".$rowsa[$i]['permanencia'].":".$rowsa[$i]['permanencia'];

// customizing columns
$col_aso = array();
$col_aso["title"] = "ID";
$col_aso["name"] = "id";
$col_aso["editable"] = false;
$col_aso["hidden"] = true;
$cols_aso[] = $col_aso;

$col_aso = array();
$col_aso["title"] = "PERSONA";
$col_aso["name"] = "persona_id";
$col_aso["editable"] = true;
$col_aso["edittype"] = "select"; // render as select
$col_aso["hidden"] = true;
$col_aso["editrules"] = array("required"=>true, "edithidden"=>true); // and is required
$col_aso["editoptions"] = array("value"=>substr($personasText, 1));
$cols_aso[] = $col_aso;

$col_aso = array();
$col_aso["title"] = "PERSONA";
$col_aso["name"] = "nombre";
$col_aso["editable"] = false;
$col_aso["edittype"] = "select"; // render as select
$col_aso["editoptions"] = array("value"=>substr($personasText, 1));
$cols_aso[] = $col_aso;

$col_aso = array();
$col_aso["title"] = "CENTRO APOSTÓLICO";
$col_aso["name"] = "centro_id";
$col_aso["editable"] = true;
$col_aso["edittype"] = "select"; // render as select
$col_aso["hidden"] = true;
$col_aso["editrules"] = array("required"=>true, "edithidden"=>true); // and is required
$col_aso["editoptions"] = array("value"=>substr($centrosText, 1));
$cols_aso[] = $col_aso;

$col_aso = array();
$col_aso["title"] = "CENTRO APOSTÓLICO";
$col_aso["name"] = "centro";
$col_aso["editable"] = false;
$col_aso["edittype"] = "select"; // render as select
$col_aso["editoptions"] = array("value"=>substr($centrosText, 1));
$cols_aso[] = $col_aso;        

$col_aso = array();
$col_aso["title"] = "ASOCIACIÓN";
$col_aso["name"] = "instancia";
$col_aso["editable"] = true;
$col_aso["edittype"] = "select"; // render as select
$col_aso["editoptions"] = array("value"=>substr($asocText, 1));
$cols_aso[] = $col_aso;

$col_aso = array();
$col_aso["title"] = "DESDE";
$col_aso["name"] = "fecha_creacion";
$col_aso["editable"] = true;
$col_aso["editoptions"] = array("size"=>20); // with default display of textbox with size 20
$col_aso["formatter"] = "date"; // format as date
$col_aso["align"] = "center";
$cols_aso[] = $col_aso;

$col_aso = array();
$col_aso["title"] = "HASTA";
$col_aso["name"] = "fecha_fin";
$col_aso["editable"] = true;
$col_aso["editoptions"] = array("size"=>20); // with default display of textbox with size 20
$col_aso["formatter"] = "date"; // format as date
$col_aso["align"] = "center";
$cols_aso[] = $col_aso;

$grid_aso["autowidth"] = true; // expand grid to screen width
$grid_aso["rowNum"] = 10;

$adminagrupa->set_options($grid_aso);

$adminagrupa->set_actions(array(        
                "add"=>true, // allow/disallow add
                "edit"=>true, // allow/disallow edit
                "delete"=>true, // allow/disallow delete
                "export"=>true, // show/hide export to excel option
                "rowactions"=>true, // show/hide row wise edit/del/save option
        ) 
);

// you can provide custom SQL query to display data
$adminagrupa->select_command = "SELECT * FROM (SELECT pcci.id, pcci.persona_id, p.nombre, pcci.centro_id, c.centro, pcci.instancia, pcci.fecha_creacion, pcci.fecha_fin FROM persona_centro_cargo_instancia pcci INNER JOIN persona p ON pcci.persona_id = p.id INNER JOIN centro c ON pcci.centro_id = c.id INNER JOIN instancia_permanencia pe ON pcci.instancia = pe.permanencia) o";

// this db table will be used for add,edit,delete
$adminagrupa->table = "persona_centro_cargo_instancia";

// pass the cooked columns to grid
$adminagrupa->set_columns($cols_aso);

// generate grid output, with unique grid name as 'list1'
$adminagrupaOut= $adminagrupa->render("adminagrupa");

echo $adminagrupaOut; //Display JQGrid $out
?>