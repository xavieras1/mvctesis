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
$despliegueCol["editable"] = false;
$despliegueCol["edittype"] = "select"; // render as select
$despliegueCol["editoptions"] = array("value"=>substr($centrosText, 1));
$despliegueCols[] = $despliegueCol;

$despliegueCol = array();
$despliegueCol["title"] = "INSTANCIA"; // caption of column
$despliegueCol["name"] = "despliegue"; // grid column name, must be exactly same as returned column-name from sql (tablefield or field-alias)
$despliegueCol["link"] = "miembrosinstancia.php?nombre={despliegue}";
$despliegueCols[] = $despliegueCol;		

$despliegueCol = array();
$despliegueCol["title"] = "INSTANCIA"; // caption of column
$despliegueCol["name"] = "despliegue"; // grid column name, must be exactly same as returned column-name from sql (tablefield or field-alias)
$despliegueCol["editrules"] = array("required"=>true, "edithidden"=>true); // and is required
$despliegueCol["hidden"] = true;
$despliegueCol["editable"] = true;
$despliegueCols[] = $despliegueCol;   

$despliegueCol = array();
$despliegueCol["title"] = "DESCRIPCIÓN";
$despliegueCol["name"] = "descripcion";
$despliegueCol["editable"] = true;
$despliegueCol["search"] = false;
$despliegueCol["edittype"] = "textarea"; // render as textarea on edit
$despliegueCols[] = $despliegueCol;

$despliegueCol = array();
$despliegueCol["title"] = "DESDE";
$despliegueCol["name"] = "fecha_creacion";
$despliegueCol["editrules"] = array("required"=>true);
$despliegueCol["editable"] = true;
$despliegueCol["editoptions"] = array("size"=>20); // with default display of textbox with size 20
$despliegueCol["formatter"] = "date"; // format as date
$despliegueCol["align"] = "center";
$despliegueCols[] = $despliegueCol;

$despliegueCol = array();
$despliegueCol["title"] = "HASTA";
$despliegueCol["name"] = "fecha_fin";
$despliegueCol["editable"] = true;
$despliegueCol["editoptions"] = array("size"=>20); // with default display of textbox with size 20
$despliegueCol["formatter"] = "date"; // format as date
$despliegueCol["align"] = "center";
$despliegueCols[] = $despliegueCol;

$despliegueCol = array();
$despliegueCol["title"] = "HORARIO"; // caption of column
$despliegueCol["name"] = "horario"; // grid column name, must be exactly same as returned column-name from sql (tablefield or field-alias)
$despliegueCol["editable"] = true;
$despliegueCols[] = $despliegueCol;

$despliegueCol = array();
$despliegueCol["title"] = "LUGAR"; // caption of column
$despliegueCol["name"] = "lugar"; // grid column name, must be exactly same as returned column-name from sql (tablefield or field-alias)
$despliegueCol["editable"] = true;
$despliegueCol["search"] = false;
$despliegueCols[] = $despliegueCol;

$despliegueCol = array();
$despliegueCol["title"] = "COLABORACIÓN"; // caption of column
$despliegueCol["name"] = "colaboracion"; // grid column name, must be exactly same as returned column-name from sql (tablefield or field-alias)
$despliegueCol["editable"] = true;
$despliegueCol["sorttype"] = "float";
$despliegueCol["search"] = false;
$despliegueCols[] = $despliegueCol;

$despliegueCol = array();
$despliegueCol["title"] = "# TALLERES"; // caption of column
$despliegueCol["name"] = "numero_taller"; // grid column name, must be exactly same as returned column-name from sql (tablefield or field-alias)
$despliegueCol["editable"] = true;
$despliegueCols[] = $despliegueCol;

$despliegueCol = array();
$despliegueCol["title"] = "CATEGORÍA"; // caption of column
$despliegueCol["name"] = "categoria"; // grid column name, must be exactly same as returned column-name from sql (tablefield or field-alias)
$despliegueCol["editable"] = true;
$despliegueCols[] = $despliegueCol;

$despliegueCol = array();
$despliegueCol["title"] = "CONTENIDOS"; // caption of column
$despliegueCol["name"] = "contenidos"; // grid column name, must be exactly same as returned column-name from sql (tablefield or field-alias)
$despliegueCol["edittype"] = "textarea";
$despliegueCol["search"] = false;
$despliegueCol["editable"] = true;
$despliegueCols[] = $despliegueCol;

$despliegueCol = array();
$despliegueCol["title"] = "OBSERVACIONES"; // caption of column
$despliegueCol["name"] = "observaciones"; // grid column name, must be exactly same as returned column-name from sql (tablefield or field-alias)
$despliegueCol["edittype"] = "textarea";
$despliegueCol["editable"] = true;
$despliegueCol["search"] = false;
$despliegueCols[] = $despliegueCol;

$despliegueCol = array();
$despliegueCol["title"] = "LISTA DE RECURSOS"; // caption of column
$despliegueCol["name"] = "lista_recursos"; // grid column name, must be exactly same as returned column-name from sql (tablefield or field-alias)
$despliegueCol["edittype"] = "textarea";
$despliegueCol["editable"] = true;
$despliegueCol["search"] = false;
$despliegueCols[] = $despliegueCol;

$despliegue = new jqgrid();

$despliegueGrid["autowidth"] = true; // expand grid to screen width
$despliegueGrid["rowNum"] = 10;
// $grid["export"] = array("format"=>"pdf", "filename"=>"my-file", "sheetname"=>"test");
// $grid["export"]["paged"] = "1";

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
$despliegue->select_command = "SELECT * FROM (SELECT d.id, d.centro_id, c.centro, d.despliegue, d.descripcion, d.fecha_creacion, d.fecha_fin, d.horario, d.lugar, d.colaboracion, d.numero_taller, d.categoria, d.contenidos, d.observaciones, d.lista_recursos FROM instancia_despliegue d
						INNER JOIN centro c ON d.centro_id = c.id AND d.despliegue != 'balance') o";

// this db table will be used for add,edit,delete
$despliegue->table = "instancia_despliegue";

// pass the cooked columns to grid
$despliegue->set_columns($despliegueCols);

$out = $despliegue->render("list1");?>
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
          <span id="content_title">INSTANCIAS</span>
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