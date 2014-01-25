<?php
if(session_id() == '') {
  header('Location: ../index.php');
}
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