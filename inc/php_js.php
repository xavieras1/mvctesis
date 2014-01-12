<?php //var_dump($_SESSION["current_cargo"]);?>
<?php //var_dump($_SESSION["current_cargo"]["data"]["permisos"]["info"]);?>
<script type="text/javascript">
//var data = eval('(' + JSON.stringify(<?php print json_encode($_SESSION["current_cargo"]);?>) + ')');

function set_table(current){
  //$(".agregar").show();
  //$('.div_niveles').remove();

  // var $data=eval('('+JSON.stringify(data.data)+')')[current];
  // var table='<tr class="table_title">';
  if(current==="cargos"){
    $('#content').show();
    
  }else if(current==="instancias"){
    $('#content').hide();
    console.log("Instancias de permanencia y despliegue");
    
  }else if(current==="miembros"){
    $('#content').hide();
    console.log("Miembros");

  }else if(current==="reportes"){    
    $('#content').hide();
    console.log("Reportes");
  }else{
    
  }
}

$(document).ready(function(){
  
  /*************************************MENU**************************************/
  $('#menu_bar').each(function(){
    // For each set of tabs, we want to keep track of
    // which tab is active and it's associated content
    var $active, $content, $links = $(this).find('a.father');
    $links.push($('#btn_ver_perfil')[0]);
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