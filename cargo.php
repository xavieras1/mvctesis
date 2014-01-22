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

$out = $cargos->render("list1");?>
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
