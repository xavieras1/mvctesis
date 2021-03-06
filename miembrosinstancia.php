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
$col_des["title"] = "APELLIDO";
$col_des["name"] = "apellido";
$col_des["editable"] = true;
$col_des["width"] = "130";
$col_des["editrules"] = array("required"=>true, "edithidden"=>true); // and is required
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
$col_des["title"] = "DESDE";
$col_des["name"] = "fecha_creacion";
$col_des["editable"] = true;
$col_des["editoptions"] = array("size"=>20); // with default display of textbox with size 20
$col_des["formatter"] = "date"; // format as date
$col_des["align"] = "center";
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
            "add"=>false, // allow/disallow add
            "edit"=>false, // allow/disallow edit
            "delete"=>false, // allow/disallow delete
            "export"=>false, // show/hide export to excel option
            "rowactions"=>false, // show/hide row wise edit/del/save option
          ) 
        );

// you can provide custom SQL query to display data
$admindesp->select_command = "SELECT * FROM (SELECT DISTINCT pcci.id, pcci.persona_id, p.nombre, p.apellido, pcci.centro_id, c.centro, pcci.instancia, pcci.fecha_creacion, pcci.fecha_fin FROM persona_centro_cargo_instancia pcci INNER JOIN persona p ON pcci.persona_id = p.id INNER JOIN centro c ON pcci.centro_id = c.id INNER JOIN instancia_despliegue d ON pcci.instancia = '".$_GET["nombre"]."') o";

// this db table will be used for add,edit,delete
$admindesp->table = "persona_centro_cargo_instancia";

// pass the cooked columns to grid
$admindesp->set_columns($cols_des);

// generate grid output, with unique grid name as 'list1'
$out = $admindesp->render("list1");?>
?>
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
          //}
        ?>
      </div>
  <div id="main">
        <div id="content_header">
          <span id="content_title">LISTA DE PARTICIPANTES</span>
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
