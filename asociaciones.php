<?php
session_start();
if(is_null($_SESSION["nivel_id"])) {
  header('Location: index.php');
}

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
$permanenciaCol["name"] = "permanencia"; // grid column name, must be exactly same as returned column-name from sql (tablefield or field-alias)
$permanenciaCol["editable"] = true;
$permanenciaCol["editrules"] = array("required"=>true);
$permanenciaCol["link"] = "miembrosaso.php?idaso={id}"; 
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
$permanecia->select_command = "SELECT * FROM (SELECT p.centro_id, c.centro, p.permanencia, p.descripcion, p.fecha_creacion, p.fecha_fin FROM instancia_permanencia p
						INNER JOIN centro c ON p.centro_id = c.id) o";

// this db table will be used for add,edit,delete
$permanecia->table = "instancia_permanencia";

// pass the cooked columns to grid
$permanecia->set_columns($permanenciaCols);

// generate grid output, with unique grid name as 'list1'
$out = $permanecia->render("list1");?>
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
          if ($_SESSION['nivel_id']==3) {//por ahora superadmin
            include 'inc/menuanimador.php';
          }else if($_SESSION['nivel_id']==2){
            include 'inc/menuareas.php';
          }
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
