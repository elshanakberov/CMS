<!-- HELPER FUNCTIONS -->
<?php

function clean($string){

  return htmlentities($string);
}

function redirect($location){

  return header("location: {$location}");
}




?>
