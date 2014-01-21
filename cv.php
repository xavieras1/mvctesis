<?php 
/**
 * PHP Grid Component
 *
 * @author Abu Ghufran <gridphp@gmail.com> - http://www.phpgrid.org
 * @version 1.4.6
 * @license: see license.txt included in package
 */
 
$conn = mysql_connect("localhost", "root", "root");
mysql_select_db("mvc");

// set your db encoding -- for ascent chars (if required)
mysql_query("SET NAMES 'utf8'");

include("inc/jqgrid_dist.php");

$cvpersona = new jqgrid();

$col_cv = array();
$col_cv["title"] = "Id"; // caption of column
$col_cv["name"] = "id"; 
$col_cv["width"] = "10";
$col_cv["editable"] = false;
$col_cv["hidden"] = true;
$cols_cv[] = $col_cv;		
		
$col_cv = array();
$col_cv["title"] = "NOMBRE";
$col_cv["name"] = "nombre";
$col_cv["search"] = true;
$col_cv["editable"] = false;
$col_cv["export"] = false; // this column will not be exported
$col_cv["link"] = "cvdatos.php?idpersona={id}"; 
$cols_cv[] = $col_cv;

$col_cv = array();
$col_cv["title"] = "APELLIDO";
$col_cv["name"] = "apellido";
$col_cv["search"] = true;
$col_cv["editable"] = false;
$cols_cv[] = $col_cv;		

$col_cv = array();
$col_cv["title"] = "CUMPLEAÑOS";
$col_cv["name"] = "fecha_nacimiento";
$col_cv["search"] = false;
$col_cv["editable"] = false;
$cols_cv[] = $col_cv;		

$col_cv = array();
$col_cv["title"] = "RELACIÓN";
$col_cv["name"] = "relacion";
$col_cv["search"] = true;
$col_cv["editable"] = false;
$cols_cv[] = $col_cv;	

$col_cv = array();
$col_cv["title"] = "ESTADO";
$col_cv["name"] = "estado";
$col_cv["search"] = true;
$col_cv["editable"] = false;
$cols_cv[] = $col_cv;	

$col_cv = array();
$col_cv["title"] = "FECHA DE REGISTRO";
$col_cv["name"] = "fecha_registro";
$col_cv["search"] = false;
$col_cv["editable"] = false;
$cols_cv[] = $col_cv;	

$grid["sortname"] = 'nombre'; // by default sort grid by this field
$grid["sortorder"] = "asc"; // ASC or DESC
$grid["autowidth"] = true; // expand grid to screen width
$grid["multiselect"] = false; // allow you to multi-select through checkboxes

// export XLS file
// export to excel parameters - range could be "all" or "filtered"
$grid["export"] = array("format"=>"xlsx", "filename"=>"my-file", "sheetname"=>"test");


// export PDF file
// export to excel parameters
$grid["export"] = array("format"=>"pdf", "filename"=>"my-file", "heading"=>"Invoice Details", "orientation"=>"landscape");

// export filtered data or all data
$grid["export"]["range"] = "filtered"; // or "all"

$cvpersona->set_options($grid);

$cvpersona->set_actions(array(	
						"add"=>false, // allow/disallow add
						"edit"=>false, // allow/disallow edit
						"delete"=>false, // allow/disallow delete
						"rowactions"=>true, // show/hide row wise edit/del/save option
						"export"=>true, // show/hide export to excel option
						"autofilter" => true, // show/hide autofilter for search
						"search" => "advance" // show single/multi field search condition (e.g. simple or advance)
					) 
				);

// you can provide custom SQL query to display data
$cvpersona->select_command = "SELECT * FROM (SELECT p.id, p.nombre, p.apellido, p.fecha_nacimiento, p.relacion, p.estado, p.fecha_registro FROM persona p) o";

// this db table will be used for add,edit,delete
$cvpersona->table = "persona";

// pass the cooked columns to grid
$cvpersona->set_columns($cols_cv);

// generate grid output, with unique grid name as 'list1'
$cvOut = $cvpersona->render("persona");

echo $cvOut; //Display JQGrid $out
?>