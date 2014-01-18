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
$despliegueCol["title"] = "CENTRO APOSTÓLICO";
$despliegueCol["name"] = "id";
$despliegueCol["editable"] = false;
$despliegueCol["hidden"] = false;
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
$despliegueCol["classes"] = "clickDespliegue";
$despliegueCol["editable"] = true;
$despliegueCols[] = $despliegueCol;		

$despliegueCol = array();
$despliegueCol["title"] = "DESCRIPCIÓN";
$despliegueCol["name"] = "descripcion";
$despliegueCol["editable"] = true;
$despliegueCol["edittype"] = "textarea"; // render as textarea on edit
$despliegueCols[] = $despliegueCol;

$despliegueCol = array();
$despliegueCol["title"] = "DESDE";
$despliegueCol["name"] = "fecha_creacion";
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
$despliegueCols[] = $despliegueCol;

$despliegueCol = array();
$despliegueCol["title"] = "COLABORACIÓN"; // caption of column
$despliegueCol["name"] = "colaboracion"; // grid column name, must be exactly same as returned column-name from sql (tablefield or field-alias)
$despliegueCol["editable"] = true;
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
$despliegueCol["editable"] = true;
$despliegueCols[] = $despliegueCol;

$despliegueCol = array();
$despliegueCol["title"] = "OBSERVACIONES"; // caption of column
$despliegueCol["name"] = "observaciones"; // grid column name, must be exactly same as returned column-name from sql (tablefield or field-alias)
$despliegueCol["edittype"] = "textarea";
$despliegueCol["editable"] = true;
$despliegueCols[] = $despliegueCol;

$despliegueCol = array();
$despliegueCol["title"] = "LISTA DE RECURSOS"; // caption of column
$despliegueCol["name"] = "lista_recursos"; // grid column name, must be exactly same as returned column-name from sql (tablefield or field-alias)
$despliegueCol["edittype"] = "textarea";
$despliegueCol["editable"] = true;
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
						INNER JOIN centro c ON d.centro_id = c.id) o";

// this db table will be used for add,edit,delete
$despliegue->table = "instancia_despliegue";

// pass the cooked columns to grid
$despliegue->set_columns($despliegueCols);

// generate grid output, with unique grid name as 'list1'
$despliegueOut = $despliegue->render("despliegue");

echo $despliegueOut;
?>