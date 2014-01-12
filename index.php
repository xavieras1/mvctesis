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
$col = array();
$col["title"] = "CARGO"; // caption of column
$col["name"] = "nombre"; // grid column name, must be exactly same as returned column-name from sql (tablefield or field-alias) 
$col["width"] = "60";
$col["editable"] = true;
$cols[] = $col;		

$col = array();
$col["title"] = "DESCRIPCIÓN";
$col["name"] = "descripcion";
$col["editable"] = true;
$col["width"] = "100";
$col["edittype"] = "textarea"; // render as textarea on edit
$cols[] = $col;

$col = array();
$col["title"] = "ÁREA";
$col["name"] = "area_id";
$col["editable"] = true;
$col["edittype"] = "select"; // render as select
$col["hidden"] = true;
$col["editrules"] = array("required"=>true, "edithidden"=>true); // and is required
$col["editoptions"] = array("value"=>substr($areasText, 1));

$cols[] = $col;
$col = array();
$col["title"] = "ÁREA";
$col["name"] = "area";
$col["editable"] = false;
$col["edittype"] = "select"; // render as select
$col["editoptions"] = array("value"=>substr($areasText, 1));
$cols[] = $col;



$grid["autowidth"] = true; // expand grid to screen width
$grid["rowNum"] = 10;
// export PDF file
// export to excel parameters
//$grid["export"] = array("format"=>"pdf", "filename"=>"my-file", "heading"=>"Cargos por Area", "orientation"=>"landscape");

$cargos->set_options($grid);

$cargos->set_actions(array(	
						"add"=>true, // allow/disallow add
						"edit"=>true, // allow/disallow edit
						"delete"=>true, // allow/disallow delete
						"export"=>true, // show/hide export to excel option
						"rowactions"=>true, // show/hide row wise edit/del/save option
					) 
				);

// you can provide custom SQL query to display data
$cargos->select_command = "SELECT * FROM (SELECT c.nombre, c.descripcion, c.area_id, a.area FROM cargo c
						INNER JOIN area a ON c.area_id = a.id) o";

// this db table will be used for add,edit,delete
$cargos->table = "cargo";

// pass the cooked columns to grid
$cargos->set_columns($cols);

// generate grid output, with unique grid name as 'list1'
$cargoOut = $cargos->render("cargo");

//ETIQUETA CENTROS
// customizing columns
$col = array();
$col["title"] = "NOMBRE"; // caption of column
$col["name"] = "centro"; // grid column name, must be exactly same as returned column-name from sql (tablefield or field-alias)
$col["editable"] = true;
$cols[] = $col;		

$col = array();
$col["title"] = "DESCRIPCIÓN";
$col["name"] = "descripcion";
$col["editable"] = true;
$col["edittype"] = "textarea"; // render as textarea on edit
$cols[] = $col;

$col = array();
$col["title"] = "CREACIÓN";
$col["name"] = "fecha_creacion";
$col["editable"] = true;
$col["editoptions"] = array("size"=>20); // with default display of textbox with size 20
$col["formatter"] = "date"; // format as date
$col["align"] = "center";
$cols[] = $col;

$col = array();
$col["title"] = "TELÉFONO";
$col["name"] = "telefono";
$col["editable"] = true;
$col["editrules"] = array("required"=>false,"number"=>true);
$col["align"] = "center";
$cols[] = $col;

$col = array();
$col["title"] = "DIRECCIÓN";
$col["name"] = "direccion";
$col["width"] = "250";
$col["editable"] = true;
$col["edittype"] = "textarea"; // render as textarea on edit
$cols[] = $col;

$col = array();
$col["title"] = "EMAIL";
$col["name"] = "email";
$col["editable"] = true;
$col["editrules"] = array("required"=>false,"email"=>true);
$cols[] = $col;

$centros = new jqgrid();

$grid["autowidth"] = true; // expand grid to screen width
$grid["rowNum"] = 10;
$centros->set_options($grid);

$centros->set_actions(array(	
						"add"=>true, // allow/disallow add
						"edit"=>true, // allow/disallow edit
						"delete"=>true, // allow/disallow delete
						"export"=>true, // show/hide export to excel option
						"rowactions"=>true, // show/hide row wise edit/del/save option
					) 
				);

// you can provide custom SQL query to display data
$centros->select_command = "SELECT * FROM (SELECT c.centro, c.descripcion, c.fecha_creacion, c.telefono, c.direccion, c.email FROM centro c) o";

// this db table will be used for add,edit,delete
$centros->table = "centro";

// pass the cooked columns to grid
$centros->set_columns($cols);

// generate grid output, with unique grid name as 'list1'
$centroOut = $centros->render("centro");

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
$col = array();
$col["title"] = "CENTRO APOSTÓLICO";
$col["name"] = "centro_id";
$col["editable"] = true;
$col["edittype"] = "select"; // render as select
$col["hidden"] = true;
$col["editrules"] = array("required"=>true, "edithidden"=>true); // and is required
$col["editoptions"] = array("value"=>substr($centrosText, 1));
$cols[] = $col;

$col = array();
$col["title"] = "CENTRO APOSTÓLICO";
$col["name"] = "centro";
$col["editable"] = false;
$col["edittype"] = "select"; // render as select
$col["editoptions"] = array("value"=>substr($centrosText, 1));
$cols[] = $col;

$col = array();
$col["title"] = "AGRUPACIÓN"; // caption of column
$col["name"] = "nombre"; // grid column name, must be exactly same as returned column-name from sql (tablefield or field-alias)
$col["editable"] = true;
$cols[] = $col;		

$col = array();
$col["title"] = "DESCRIPCIÓN";
$col["name"] = "descripcion";
$col["editable"] = true;
$col["edittype"] = "textarea"; // render as textarea on edit
$cols[] = $col;

$col = array();
$col["title"] = "DESDE";
$col["name"] = "fecha_creacion";
$col["editable"] = true;
$col["editoptions"] = array("size"=>20); // with default display of textbox with size 20
$col["formatter"] = "date"; // format as date
$col["align"] = "center";
$cols[] = $col;

$col = array();
$col["title"] = "HASTA";
$col["name"] = "fecha_fin";
$col["editable"] = true;
$col["editoptions"] = array("size"=>20); // with default display of textbox with size 20
$col["formatter"] = "date"; // format as date
$col["align"] = "center";
$cols[] = $col;

$grid["autowidth"] = true; // expand grid to screen width
$grid["rowNum"] = 10;
// $grid["export"] = array("format"=>"pdf", "filename"=>"my-file", "sheetname"=>"test");
// $grid["export"]["paged"] = "1";

$permanecia->set_options($grid);

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
$permanecia->set_columns($cols);

// generate grid output, with unique grid name as 'list1'
$permanenciaOut = $permanecia->render("asociaciones");

// ETIQUETA MIEMBROS
// customizing columns
$col = array();
$col["title"] = "ID"; // caption of column
$col["name"] = "id"; // grid column name, must be exactly same as returned column-name from sql (tablefield or field-alias) 
$col["width"] = "70";
$col["editable"] = false;
$col["align"] = "center";
$cols[] = $col;		

$col = array();
$col["title"] = "FOTO";
$col["name"] = "foto";
$col["editable"] = true;
$col["align"] = "center";
$col["formatter"] = "image"; // format as image -- if data is image url e.g. http://<domain>/test.jpg
$col["formatoptions"] = array("width"=>'80',"height"=>'100'); // image width / height etc
$col["edittype"] = "file"; // render as file
$col["upload_dir"] = "temp"; // upload here
$cols[] = $col;

$col = array();
$col["title"] = "NOMBRE";
$col["name"] = "nombre";
$col["editable"] = true;
$col["width"] = "130";
$col["align"] = "center";
$col["editrules"] = array("required"=>true, "edithidden"=>true); // and is required
$cols[] = $col;

$col = array();
$col["title"] = "APELLIDO";
$col["name"] = "apellido";
$col["editable"] = true;
$col["width"] = "130";
$col["align"] = "center";
$col["editrules"] = array("required"=>true, "edithidden"=>true); // and is required
$cols[] = $col;

$col = array();
$col["title"] = "CIUDAD";
$col["name"] = "ciudad";
$col["editable"] = true;
$col["edittype"] = "select"; // render as select
$col["editoptions"] = array("value"=>'Santiago de Guayaquil:Santiago de Guayaquil;San Pablo de Manta:San Pablo de Manta;San Francisco de Quito:San Francisco de Quito');
$col["align"] = "center";
$col["editrules"] = array("required"=>true, "edithidden"=>true); // and is required
$cols[] = $col;

$col = array();
$col["title"] = "SEXO";
$col["name"] = "sexo";
$col["editable"] = true;
$col["align"] = "center";
$col["edittype"] = "select"; // render as select
$col["editoptions"] = array("value"=>'hombre:hombre;mujer:mujer');
$col["hidden"] = true;
$col["editrules"] = array("required"=>true, "edithidden"=>true); // and is required
$cols[] = $col;

$col = array();
$col["title"] = "EDAD";
$col["name"] = "edad";
$col["align"] = "center";
$col["editable"] = true;
$col["editrules"] = array("number"=>true);
$cols[] = $col;

$col = array();
$col["title"] = "CUMPLEAÑOS";
$col["name"] = "fecha_nacimiento";
$col["editable"] = true;
$col["width"] = "190";
$col["editoptions"] = array("size"=>20); // with default display of textbox with size 20
$col["formatter"] = "date"; // format as date
$col["align"] = "center";
$cols[] = $col;

$col = array();
$col["title"] = "DOMICILIO";
$col["name"] = "domicilio";
$col["width"] = "250";
$col["editable"] = true;
$col["edittype"] = "textarea"; // render as textarea on edit
$col["align"] = "center";
$cols[] = $col;

$col = array();
$col["title"] = "NIVEL DE ESTUDIO";
$col["name"] = "nivel_estudio";
$col["editable"] = true;
$col["edittype"] = "select"; // render as select
$col["align"] = "center";
$col["editoptions"] = array("value"=>'primaria:primaria;secundaria:secundaria;universitario:universitario;profesional:profesional');
$cols[] = $col;

$col = array();
$col["title"] = "INSTITUCIÓN";
$col["name"] = "institucion";
$col["editable"] = true;
$col["align"] = "center";
$cols[] = $col;

$col = array();
$col["title"] = "TELÉFONO";
$col["name"] = "telefono";
$col["editable"] = true;
$col["align"] = "center";
$col["editrules"] = array("number"=>true);
$cols[] = $col;

$col = array();
$col["title"] = "CELL CLARO";
$col["name"] = "celular_claro";
$col["editable"] = true;
$col["align"] = "center";
$col["editrules"] = array("number"=>true);
$cols[] = $col;

$col = array();
$col["title"] = "CELL MOVISTAR";
$col["name"] = "celular_movistar";
$col["editable"] = true;
$col["align"] = "center";
$col["editrules"] = array("number"=>true);
$cols[] = $col;

$col = array();
$col["title"] = "EMAIL";
$col["name"] = "email";
$col["editable"] = true;
$col["align"] = "center";
$col["editrules"] = array("email"=>true); 
$cols[] = $col;

$col = array();
$col["title"] = "FACEBOOK";
$col["name"] = "facebook";
$col["editable"] = true;
$col["align"] = "center";
$cols[] = $col;

$col = array();
$col["title"] = "TWITTER";
$col["name"] = "twitter";
$col["editable"] = true;
$col["align"] = "center";
$cols[] = $col;

$col = array();
$col["title"] = "RELACIÓN";
$col["name"] = "relacion";
$col["editable"] = true;
$col["edittype"] = "select"; // render as select
$col["editoptions"] = array("value"=>'agrupado:agrupado;visitante:visitante');
$col["align"] = "center";
$cols[] = $col;

$col = array();
$col["title"] = "ESTADO";
$col["name"] = "estado";
$col["editable"] = true;
$col["edittype"] = "select"; // render as select
$col["editoptions"] = array("value"=>'activo:activo;pasivo:pasivo');
$col["align"] = "center";
$cols[] = $col;

$col = array();
$col["title"] = "FECHA DE REGISTRO";
$col["name"] = "fecha_registro";
$col["editable"] = true;
$col["editoptions"] = array("size"=>20); // with default display of textbox with size 20
$col["formatter"] = "date"; // format as date
$col["align"] = "center";
$cols[] = $col;

$col = array();
$col["title"] = "USUARIO";
$col["name"] = "usuario";
$col["editable"] = true;
$col["align"] = "center";
$cols[] = $col;

$col = array();
$col["title"] = "CONTRASEÑA";
$col["name"] = "contrasena";
$col["editable"] = true;
$col["formatter"] = "password";
$col["align"] = "center";
$cols[] = $col;

$miembros = new jqgrid();

$grid["autowidth"] = true; // expand grid to screen width
$grid["rowNum"] = 10;
$miembros->set_options($grid);

$miembros->set_actions(array(	
						"add"=>true, // allow/disallow add
						"edit"=>true, // allow/disallow edit
						"delete"=>true, // allow/disallow delete
						"rowactions"=>true, // show/hide row wise edit/del/save option
					) 
				);

// you can provide custom SQL query to display data
$miembros->select_command = "SELECT * FROM (SELECT p.id, p.foto, p.nombre, p.apellido, p.ciudad, p.sexo, p.edad, p.fecha_nacimiento, p.domicilio, p.nivel_estudio, p.institucion, p.telefono, p.celular_claro, p.celular_movistar, p.email, p.facebook, p.twitter, p.relacion, p.estado, p.fecha_registro, p.usuario, p.contrasena FROM persona p) o";

// this db table will be used for add,edit,delete
$miembros->table = "persona";

// pass the cooked columns to grid
$miembros->set_columns($cols);

// generate grid output, with unique grid name as 'list1'
$miembrosOut = $miembros->render("miembros");

// ETIQUETA INSTANCIAS DESPLIEGUE
// customizing columns
$col = array();
$col["title"] = "CENTRO APOSTÓLICO";
$col["name"] = "centro_id";
$col["editable"] = true;
$col["edittype"] = "select"; // render as select
$col["hidden"] = true;
$col["editrules"] = array("required"=>true, "edithidden"=>true); // and is required
$col["editoptions"] = array("value"=>'1:Virgen del Pilar;2:Nuestra Señora de la Reconciliación;3:Sagrada Familia;4:Madre del Peregrinar;5:Santa María de los Ríos;6:Madre de los Apóstoles');
$cols[] = $col;

$col = array();
$col["title"] = "CENTRO APOSTÓLICO";
$col["name"] = "centro";
$col["editable"] = false;
$col["edittype"] = "select"; // render as select
$col["editoptions"] = array("value"=>'1:Virgen del Pilar;2:Nuestra Señora de la Reconciliación;3:Sagrada Familia;4:Madre del Peregrinar;5:Santa María de los Ríos;6:Madre de los Apóstoles');
$cols[] = $col;

$col = array();
$col["title"] = "INSTANCIA"; // caption of column
$col["name"] = "nombre"; // grid column name, must be exactly same as returned column-name from sql (tablefield or field-alias)
$col["editable"] = true;
$cols[] = $col;		

$col = array();
$col["title"] = "DESCRIPCIÓN";
$col["name"] = "descripcion";
$col["editable"] = true;
$col["edittype"] = "textarea"; // render as textarea on edit
$cols[] = $col;

$col = array();
$col["title"] = "DESDE";
$col["name"] = "fecha_creacion";
$col["editable"] = true;
$col["editoptions"] = array("size"=>20); // with default display of textbox with size 20
$col["formatter"] = "date"; // format as date
$col["align"] = "center";
$cols[] = $col;

$col = array();
$col["title"] = "HASTA";
$col["name"] = "fecha_fin";
$col["editable"] = true;
$col["editoptions"] = array("size"=>20); // with default display of textbox with size 20
$col["formatter"] = "date"; // format as date
$col["align"] = "center";
$cols[] = $col;

$col = array();
$col["title"] = "HORARIO"; // caption of column
$col["name"] = "horario"; // grid column name, must be exactly same as returned column-name from sql (tablefield or field-alias)
$col["editable"] = true;
$cols[] = $col;

$col = array();
$col["title"] = "LUGAR"; // caption of column
$col["name"] = "lugar"; // grid column name, must be exactly same as returned column-name from sql (tablefield or field-alias)
$col["editable"] = true;
$cols[] = $col;

$col = array();
$col["title"] = "COLABORACIÓN"; // caption of column
$col["name"] = "colaboracion"; // grid column name, must be exactly same as returned column-name from sql (tablefield or field-alias)
$col["editable"] = true;
$cols[] = $col;

$col = array();
$col["title"] = "# TALLERES"; // caption of column
$col["name"] = "numero_taller"; // grid column name, must be exactly same as returned column-name from sql (tablefield or field-alias)
$col["editable"] = true;
$cols[] = $col;

$col = array();
$col["title"] = "CATEGORÍA"; // caption of column
$col["name"] = "categoria"; // grid column name, must be exactly same as returned column-name from sql (tablefield or field-alias)
$col["editable"] = true;
$cols[] = $col;

$col = array();
$col["title"] = "CONTENIDOS"; // caption of column
$col["name"] = "contenidos"; // grid column name, must be exactly same as returned column-name from sql (tablefield or field-alias)
$col["edittype"] = "textarea";
$col["editable"] = true;
$cols[] = $col;

$col = array();
$col["title"] = "OBSERVACIONES"; // caption of column
$col["name"] = "observaciones"; // grid column name, must be exactly same as returned column-name from sql (tablefield or field-alias)
$col["edittype"] = "textarea";
$col["editable"] = true;
$cols[] = $col;

$col = array();
$col["title"] = "LISTA DE RECURSOS"; // caption of column
$col["name"] = "lista_recursos"; // grid column name, must be exactly same as returned column-name from sql (tablefield or field-alias)
$col["edittype"] = "textarea";
$col["editable"] = true;
$cols[] = $col;

$despliegue = new jqgrid();

$grid["autowidth"] = true; // expand grid to screen width
$grid["rowNum"] = 10;
// $grid["export"] = array("format"=>"pdf", "filename"=>"my-file", "sheetname"=>"test");
// $grid["export"]["paged"] = "1";

$despliegue->set_options($grid);

$despliegue->set_actions(array(	
						"add"=>true, // allow/disallow add
						"edit"=>true, // allow/disallow edit
						"delete"=>true, // allow/disallow delete
						"export"=>true, // show/hide export to excel option
						"rowactions"=>true, // show/hide row wise edit/del/save option
					) 
				);

// you can provide custom SQL query to display data
$despliegue->select_command = "SELECT * FROM (SELECT d.centro_id, c.centro, d.nombre, d.descripcion, d.fecha_creacion, d.fecha_fin, d.horario, d.lugar, d.colaboracion, d.numero_taller, d.categoria, d.contenidos, d.observaciones, d.lista_recursos FROM instancia_despliegue d
						INNER JOIN centro c ON d.centro_id = c.id) o";

// this db table will be used for add,edit,delete
$despliegue->table = "instancia_despliegue";

// pass the cooked columns to grid
$despliegue->set_columns($cols);

// generate grid output, with unique grid name as 'list1'
$despliegueOut = $despliegue->render("despliegue");


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
          <span id="content_title"></span>
        </div>
        <div id="content">
          <?php echo $cargoOut?> <!--Display JQGrid $out-->
          <?php echo $centroOut?> <!--Display JQGrid $out-->
          <?php echo $permanenciaOut?> <!--Display JQGrid $out-->
          <?php echo $miembrosOut?> <!--Display JQGrid $out-->
          <?php echo $despliegueOut?> <!--Display JQGrid $out-->
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
<script type="text/javascript">

function set_table(current){

  if(current==="cargos"){
    console.log("cargos");

  }else if(current==="centros"){
    $('#content').hide();
    
  }else if(current==="asociaciones"){
    $('#content').hide();

  }else if(current==="miembros"){    
    $('#content').hide();

  }else if(current==="despliegue"){    
    $('#content').hide();

  }else if(current==="adminagrupa"){    
    $('#content').hide();

  }else if(current==="admindesp"){    
    $('#content').hide();

  }else if(current==="admincargo"){    
    $('#content').hide();
      
  }else{// #reportes
    
  }
}

$(document).ready(function(){
  
  /*************************************MENU**************************************/
  $('#menu_bar').each(function(){
    // For each set of tabs, we want to keep track of
    // which tab is active and it's associated content
    var $active, $content, $links = $(this).find('a.father');
    //$links.push($('#btn_ver_perfil')[0]);
    // If the location.hash matches one of the links, use that as the active tab.
    // If no match is found, use the first link as the initial active tab.
    $active = $($links.filter('[href="'+location.hash+'"]')[0] ||$links[0]);
    $active.addClass('active');
    $content = $($active.attr('href'));

    $('#content_title').text($active.first().text());
    set_table($active.attr('href').substring(1));

    // Hide the remaining content
    $links.not($active).each(function () {
      $($(this).attr('href')).hide();
    });

    // Bind the click event handler
    $(this).delegate('a.father,a#btn_ver_perfil', 'click', function(e){
      // Make the old tab inactive.
      $active.removeClass('active');
      $content.hide();
      //$('#main_table tbody').empty();
      //$(".agregar").removeAttr("disabled");

      // Update the variables with the new link and content
      $active = $(this);
      $content = $($(this).attr('href'));

      // Make the tab active.
      $active.addClass('active');
      $content.show();

      $('#content_title').text($active.first().text());
      set_table($active.attr('href').substring(1));

      if($(this)==$('#btn_ver_perfil')){
        $('ul.roles').hide();
        $('#saludo').css('background-color','#005597');
      }

      // Prevent the anchor's default click action
      e.preventDefault();
    });

  });
});
</script>