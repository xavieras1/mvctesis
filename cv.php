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

$out = $cvpersona->render("list1");?>
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
          if ($_SESSION['nivel_id']==3) {//por ahora animador
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
