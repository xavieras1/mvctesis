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
    $("#content").load($active.attr('href').substring(1)+".php");

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
      $importa = $(this).attr('href');

      // Make the tab active.
      $active.addClass('active');
      // $content.show();
      $("#content").load($(this).attr('href').substring(1)+".php");

      $('#content_title').text($active.first().text());

      if($(this)==$('#btn_ver_perfil')){
        $('ul.roles').hide();
        $('#saludo').css('background-color','#005597');
      }

      // Prevent the anchor's default click action
      e.preventDefault();
    });

  });
  $('#content').change(function(){
    console.log($active.attr('href'));
    if($active.attr('href')=="despliegue")
      console.log($( ".clickDespliegue" ).find( "a" ));
      // $(".clickDespliegue a").click(function() {
      //   console.log($(this).attr("href").substring(11));
      //   // $("#content").load("miembrosinstancia.php?nombre="+$(this).attr("href").substring(11));
      // });
  });
});
</script>