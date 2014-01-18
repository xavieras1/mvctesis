<?php 
printf('<script type="text/javascript">$(".clickDespliegue a").click(function() {console.log($(this).attr("href").substring(11));$("#content").load("miembrosinstancia.php?nombre="+$(this).attr("href").substring(11));});</script>');
?>