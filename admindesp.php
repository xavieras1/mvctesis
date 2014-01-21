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

//ETIQUETA ADMIN. INSTANCIAS
$admindesp = new jqgrid();

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

// Instancias obtenidas dinamicamente
$result_desp = mysql_query("SELECT * FROM instancia_despliegue");
$rows_desp = array();
$despText="";
while ($row_desp = mysql_fetch_assoc($result_desp))
        $rows_desp[]=$row_desp;
mysql_free_result($result_desp);
for($i=0;$i<sizeof($rows_desp);$i++)
        $despText.=";".$rows_desp[$i]['despliegue'].":".$rows_desp[$i]['despliegue'];

// customizing columns
$col_des = array();
$col_des["title"] = "ID";
$col_des["name"] = "id";
$col_des["editable"] = false;
$col_des["hidden"] = true;
$cols_des[] = $col_des;

$col_des = array();
$col_des["title"] = "PERSONA";
$col_des["name"] = "persona_id";
$col_des["editable"] = true;
$col_des["edittype"] = "select"; // render as select
$col_des["hidden"] = true;
$col_des["editrules"] = array("required"=>true, "edithidden"=>true); // and is required
$col_des["editoptions"] = array("value"=>substr($personasText, 1));
$cols_des[] = $col_des;

$col_des = array();
$col_des["title"] = "PERSONA";
$col_des["name"] = "nombre";
$col_des["editable"] = false;
$col_des["edittype"] = "select"; // render as select
$col_des["editoptions"] = array("value"=>substr($personasText, 1));
$cols_des[] = $col_des;

$col_des = array();
$col_des["title"] = "CENTRO APOSTÓLICO";
$col_des["name"] = "centro_id";
$col_des["editable"] = true;
$col_des["edittype"] = "select"; // render as select
$col_des["hidden"] = true;
$col_des["editrules"] = array("required"=>true, "edithidden"=>true); // and is required
$col_des["editoptions"] = array("value"=>substr($centrosText, 1));
$cols_des[] = $col_des;

$col_des = array();
$col_des["title"] = "CENTRO APOSTÓLICO";
$col_des["name"] = "centro";
$col_des["editable"] = false;
$col_des["edittype"] = "select"; // render as select
$col_des["editoptions"] = array("value"=>substr($centrosText, 1));
$cols_des[] = $col_des;        

$col_des = array();
$col_des["title"] = "INSTANCIA";
$col_des["name"] = "instancia";
$col_des["editable"] = true;
$col_des["edittype"] = "select"; // render as select
$col_des["editoptions"] = array("value"=>substr($despText, 1));
$cols_des[] = $col_des;

$col_des = array();
$col_des["title"] = "DESDE";
$col_des["name"] = "fecha_creacion";
$col_des["editable"] = true;
$col_des["editoptions"] = array("size"=>20); // with default display of textbox with size 20
$col_des["formatter"] = "date"; // format as date
$col_des["align"] = "center";
$col_des["editrules"] = array("required"=>true);
$cols_des[] = $col_des;

$col_des = array();
$col_des["title"] = "HASTA";
$col_des["name"] = "fecha_fin";
$col_des["editable"] = true;
$col_des["editoptions"] = array("size"=>20); // with default display of textbox with size 20
$col_des["formatter"] = "date"; // format as date
$col_des["align"] = "center";
$cols_des[] = $col_des;

$grid_des["autowidth"] = true; // expand grid to screen width
$grid_des["rowNum"] = 10;

$admindesp->set_options($grid_des);

$admindesp->set_actions(array(        
                                                "add"=>true, // allow/disallow add
                                                "edit"=>true, // allow/disallow edit
                                                "delete"=>true, // allow/disallow delete
                                                "export"=>true, // show/hide export to excel option
                                                "rowactions"=>true, // show/hide row wise edit/del/save option
                                        ) 
                                );

// you can provide custom SQL query to display data
$admindesp->select_command = "SELECT * FROM (SELECT pcci.id, pcci.persona_id, p.nombre, pcci.centro_id, c.centro, pcci.instancia, pcci.fecha_creacion, pcci.fecha_fin FROM persona_centro_cargo_instancia pcci INNER JOIN persona p ON pcci.persona_id = p.id INNER JOIN centro c ON pcci.centro_id = c.id INNER JOIN instancia_despliegue d ON pcci.instancia = d.despliegue) o";

// this db table will be used for add,edit,delete
$admindesp->table = "persona_centro_cargo_instancia";

// pass the cooked columns to grid
$admindesp->set_columns($cols_des);

// generate grid output, with unique grid name as 'list1'
$admindespOut= $admindesp->render("admindesp");

echo $admindespOut; //Display JQGrid $out
?>