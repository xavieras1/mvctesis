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
$cargoCol = array();
$cargoCol["title"] = "CARGO"; // caption of column
$cargoCol["name"] = "nombre"; // grid column name, must be exactly same as returned column-name from sql (tablefield or field-alias) 
$cargoCol["width"] = "60";
$cargoCol["editable"] = true;
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
$cargoGrid["rowNum"] = 10;
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
$cargos->select_command = "SELECT * FROM (SELECT c.nombre, c.descripcion, c.area_id, a.area FROM cargo c
						INNER JOIN area a ON c.area_id = a.id) o";

// this db table will be used for add,edit,delete
$cargos->table = "cargo";

// pass the cooked columns to grid
$cargos->set_columns($cargoCols);

// generate grid output, with unique grid name as 'list1'
$cargoOut = $cargos->render("cargo");

//ETIQUETA CENTROS
// customizing columns
$centroCol = array();
$centroCol["title"] = "NOMBRE"; // caption of column
$centroCol["name"] = "centro"; // grid column name, must be exactly same as returned column-name from sql (tablefield or field-alias)
$centroCol["editable"] = true;
$centroCols[] = $centroCol;		

$centroCol = array();
$centroCol["title"] = "DESCRIPCIÓN";
$centroCol["name"] = "descripcion";
$centroCol["editable"] = true;
$centroCol["edittype"] = "textarea"; // render as textarea on edit
$centroCols[] = $centroCol;

$centroCol = array();
$centroCol["title"] = "CREACIÓN";
$centroCol["name"] = "fecha_creacion";
$centroCol["editable"] = true;
$centroCol["editoptions"] = array("size"=>20); // with default display of textbox with size 20
$centroCol["formatter"] = "date"; // format as date
$centroCol["align"] = "center";
$centroCols[] = $centroCol;

$centroCol = array();
$centroCol["title"] = "TELÉFONO";
$centroCol["name"] = "telefono";
$centroCol["editable"] = true;
$centroCol["editrules"] = array("required"=>false,"number"=>true);
$centroCol["align"] = "center";
$centroCols[] = $centroCol;

$centroCol = array();
$centroCol["title"] = "DIRECCIÓN";
$centroCol["name"] = "direccion";
$centroCol["width"] = "250";
$centroCol["editable"] = true;
$centroCol["edittype"] = "textarea"; // render as textarea on edit
$centroCols[] = $centroCol;

$centroCol = array();
$centroCol["title"] = "EMAIL";
$centroCol["name"] = "email";
$centroCol["editable"] = true;
$centroCol["editrules"] = array("required"=>false,"email"=>true);
$centroCols[] = $centroCol;

$centros = new jqgrid();

$centroGrid["autowidth"] = true; // expand grid to screen width
$centroGrid["rowNum"] = 10;
$centros->set_options($centroGrid);

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
$centros->set_columns($centroCols);

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
$permanenciaCol["name"] = "nombre"; // grid column name, must be exactly same as returned column-name from sql (tablefield or field-alias)
$permanenciaCol["editable"] = true;
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
$permanecia->select_command = "SELECT * FROM (SELECT p.centro_id, c.centro, p.nombre, p.descripcion, p.fecha_creacion, p.fecha_fin FROM instancia_permanencia p
						INNER JOIN centro c ON p.centro_id = c.id) o";

// this db table will be used for add,edit,delete
$permanecia->table = "instancia_permanencia";

// pass the cooked columns to grid
$permanecia->set_columns($permanenciaCols);

// generate grid output, with unique grid name as 'list1'
$permanenciaOut = $permanecia->render("asociaciones");

// ETIQUETA MIEMBROS
// customizing columns
$miembrosCol = array();
$miembrosCol["title"] = "ID"; // caption of column
$miembrosCol["name"] = "id"; // grid column name, must be exactly same as returned column-name from sql (tablefield or field-alias) 
$miembrosCol["width"] = "70";
$miembrosCol["editable"] = false;
$miembrosCol["align"] = "center";
$miembrosCols[] = $miembrosCol;		

$miembrosCol = array();
$miembrosCol["title"] = "FOTO";
$miembrosCol["name"] = "foto";
$miembrosCol["editable"] = true;
$miembrosCol["align"] = "center";
$miembrosCol["formatter"] = "image"; // format as image -- if data is image url e.g. http://<domain>/test.jpg
$miembrosCol["formatoptions"] = array("width"=>'80',"height"=>'100'); // image width / height etc
$miembrosCol["edittype"] = "file"; // render as file
$miembrosCol["upload_dir"] = "temp"; // upload here
$miembrosCols[] = $miembrosCol;

$miembrosCol = array();
$miembrosCol["title"] = "NOMBRE";
$miembrosCol["name"] = "nombre";
$miembrosCol["editable"] = true;
$miembrosCol["width"] = "130";
$miembrosCol["align"] = "center";
$miembrosCol["editrules"] = array("required"=>true, "edithidden"=>true); // and is required
$miembrosCols[] = $miembrosCol;

$miembrosCol = array();
$miembrosCol["title"] = "APELLIDO";
$miembrosCol["name"] = "apellido";
$miembrosCol["editable"] = true;
$miembrosCol["width"] = "130";
$miembrosCol["align"] = "center";
$miembrosCol["editrules"] = array("required"=>true, "edithidden"=>true); // and is required
$miembrosCols[] = $miembrosCol;

$miembrosCol = array();
$miembrosCol["title"] = "CIUDAD";
$miembrosCol["name"] = "ciudad";
$miembrosCol["editable"] = true;
$miembrosCol["edittype"] = "select"; // render as select
$miembrosCol["editoptions"] = array("value"=>'Santiago de Guayaquil:Santiago de Guayaquil;San Pablo de Manta:San Pablo de Manta;San Francisco de Quito:San Francisco de Quito');
$miembrosCol["align"] = "center";
$miembrosCol["editrules"] = array("required"=>true, "edithidden"=>true); // and is required
$miembrosCols[] = $miembrosCol;

$miembrosCol = array();
$miembrosCol["title"] = "SEXO";
$miembrosCol["name"] = "sexo";
$miembrosCol["editable"] = true;
$miembrosCol["align"] = "center";
$miembrosCol["edittype"] = "select"; // render as select
$miembrosCol["editoptions"] = array("value"=>'hombre:hombre;mujer:mujer');
$miembrosCol["hidden"] = true;
$miembrosCol["editrules"] = array("required"=>true, "edithidden"=>true); // and is required
$miembrosCols[] = $miembrosCol;

$miembrosCol = array();
$miembrosCol["title"] = "EDAD";
$miembrosCol["name"] = "edad";
$miembrosCol["align"] = "center";
$miembrosCol["editable"] = true;
$miembrosCol["editrules"] = array("number"=>true);
$miembrosCols[] = $miembrosCol;

$miembrosCol = array();
$miembrosCol["title"] = "CUMPLEAÑOS";
$miembrosCol["name"] = "fecha_nacimiento";
$miembrosCol["editable"] = true;
$miembrosCol["width"] = "190";
$miembrosCol["editoptions"] = array("size"=>20); // with default display of textbox with size 20
$miembrosCol["formatter"] = "date"; // format as date
$miembrosCol["align"] = "center";
$miembrosCols[] = $miembrosCol;

$miembrosCol = array();
$miembrosCol["title"] = "DOMICILIO";
$miembrosCol["name"] = "domicilio";
$miembrosCol["width"] = "250";
$miembrosCol["editable"] = true;
$miembrosCol["edittype"] = "textarea"; // render as textarea on edit
$miembrosCol["align"] = "center";
$miembrosCols[] = $miembrosCol;

$miembrosCol = array();
$miembrosCol["title"] = "NIVEL DE ESTUDIO";
$miembrosCol["name"] = "nivel_estudio";
$miembrosCol["editable"] = true;
$miembrosCol["edittype"] = "select"; // render as select
$miembrosCol["align"] = "center";
$miembrosCol["editoptions"] = array("value"=>'primaria:primaria;secundaria:secundaria;universitario:universitario;profesional:profesional');
$miembrosCols[] = $miembrosCol;

$miembrosCol = array();
$miembrosCol["title"] = "INSTITUCIÓN";
$miembrosCol["name"] = "institucion";
$miembrosCol["editable"] = true;
$miembrosCol["align"] = "center";
$miembrosCols[] = $miembrosCol;

$miembrosCol = array();
$miembrosCol["title"] = "TELÉFONO";
$miembrosCol["name"] = "telefono";
$miembrosCol["editable"] = true;
$miembrosCol["align"] = "center";
$miembrosCol["editrules"] = array("number"=>true);
$miembrosCols[] = $miembrosCol;

$miembrosCol = array();
$miembrosCol["title"] = "CELL CLARO";
$miembrosCol["name"] = "celular_claro";
$miembrosCol["editable"] = true;
$miembrosCol["align"] = "center";
$miembrosCol["editrules"] = array("number"=>true);
$miembrosCols[] = $miembrosCol;

$miembrosCol = array();
$miembrosCol["title"] = "CELL MOVISTAR";
$miembrosCol["name"] = "celular_movistar";
$miembrosCol["editable"] = true;
$miembrosCol["align"] = "center";
$miembrosCol["editrules"] = array("number"=>true);
$miembrosCols[] = $miembrosCol;

$miembrosCol = array();
$miembrosCol["title"] = "EMAIL";
$miembrosCol["name"] = "email";
$miembrosCol["editable"] = true;
$miembrosCol["align"] = "center";
$miembrosCol["editrules"] = array("email"=>true); 
$miembrosCols[] = $miembrosCol;

$miembrosCol = array();
$miembrosCol["title"] = "FACEBOOK";
$miembrosCol["name"] = "facebook";
$miembrosCol["editable"] = true;
$miembrosCol["align"] = "center";
$miembrosCols[] = $miembrosCol;

$miembrosCol = array();
$miembrosCol["title"] = "TWITTER";
$miembrosCol["name"] = "twitter";
$miembrosCol["editable"] = true;
$miembrosCol["align"] = "center";
$miembrosCols[] = $miembrosCol;

$miembrosCol = array();
$miembrosCol["title"] = "RELACIÓN";
$miembrosCol["name"] = "relacion";
$miembrosCol["editable"] = true;
$miembrosCol["edittype"] = "select"; // render as select
$miembrosCol["editoptions"] = array("value"=>'agrupado:agrupado;visitante:visitante');
$miembrosCol["align"] = "center";
$miembrosCols[] = $miembrosCol;

$miembrosCol = array();
$miembrosCol["title"] = "ESTADO";
$miembrosCol["name"] = "estado";
$miembrosCol["editable"] = true;
$miembrosCol["edittype"] = "select"; // render as select
$miembrosCol["editoptions"] = array("value"=>'activo:activo;pasivo:pasivo');
$miembrosCol["align"] = "center";
$miembrosCols[] = $miembrosCol;

$miembrosCol = array();
$miembrosCol["title"] = "FECHA DE REGISTRO";
$miembrosCol["name"] = "fecha_registro";
$miembrosCol["editable"] = true;
$miembrosCol["editoptions"] = array("size"=>20); // with default display of textbox with size 20
$miembrosCol["formatter"] = "date"; // format as date
$miembrosCol["align"] = "center";
$miembrosCols[] = $miembrosCol;

$miembrosCol = array();
$miembrosCol["title"] = "USUARIO";
$miembrosCol["name"] = "usuario";
$miembrosCol["editable"] = true;
$miembrosCol["align"] = "center";
$miembrosCols[] = $miembrosCol;

$miembrosCol = array();
$miembrosCol["title"] = "CONTRASEÑA";
$miembrosCol["name"] = "contrasena";
$miembrosCol["editable"] = true;
$miembrosCol["formatter"] = "password";
$miembrosCol["align"] = "center";
$miembrosCols[] = $miembrosCol;

$miembros = new jqgrid();

$miembrosGrid["autowidth"] = true; // expand grid to screen width
$miembrosGrid["rowNum"] = 10;
$miembros->set_options($miembrosGrid);

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
$miembros->set_columns($miembrosCols);

// generate grid output, with unique grid name as 'list1'
$miembrosOut = $miembros->render("miembros");

// ETIQUETA INSTANCIAS DESPLIEGUE
// customizing columns
$despliegueCol = array();
$despliegueCol["title"] = "CENTRO APOSTÓLICO";
$despliegueCol["name"] = "centro_id";
$despliegueCol["editable"] = true;
$despliegueCol["edittype"] = "select"; // render as select
$despliegueCol["hidden"] = true;
$despliegueCol["editrules"] = array("required"=>true, "edithidden"=>true); // and is required
$despliegueCol["editoptions"] = array("value"=>'1:Virgen del Pilar;2:Nuestra Señora de la Reconciliación;3:Sagrada Familia;4:Madre del Peregrinar;5:Santa María de los Ríos;6:Madre de los Apóstoles');
$despliegueCols[] = $despliegueCol;

$despliegueCol = array();
$despliegueCol["title"] = "CENTRO APOSTÓLICO";
$despliegueCol["name"] = "centro";
$despliegueCol["editable"] = false;
$despliegueCol["edittype"] = "select"; // render as select
$despliegueCol["editoptions"] = array("value"=>'1:Virgen del Pilar;2:Nuestra Señora de la Reconciliación;3:Sagrada Familia;4:Madre del Peregrinar;5:Santa María de los Ríos;6:Madre de los Apóstoles');
$despliegueCols[] = $despliegueCol;

$despliegueCol = array();
$despliegueCol["title"] = "INSTANCIA"; // caption of column
$despliegueCol["name"] = "nombre"; // grid column name, must be exactly same as returned column-name from sql (tablefield or field-alias)
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
$despliegue->select_command = "SELECT * FROM (SELECT d.centro_id, c.centro, d.nombre, d.descripcion, d.fecha_creacion, d.fecha_fin, d.horario, d.lugar, d.colaboracion, d.numero_taller, d.categoria, d.contenidos, d.observaciones, d.lista_recursos FROM instancia_despliegue d
						INNER JOIN centro c ON d.centro_id = c.id) o";

// this db table will be used for add,edit,delete
$despliegue->table = "instancia_despliegue";

// pass the cooked columns to grid
$despliegue->set_columns($despliegueCols);

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