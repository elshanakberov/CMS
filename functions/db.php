<?php
    $server = "127.0.0.1";
    $db_user = "root";
    $db_password = "";
    $db_name = "cms2";

    $con = mysqli_connect( $server,$db_user,$db_password,$db_name);

  function escape($string){
    global $con;
    return  mysqli_real_escape_string($con,$string);
  }

  function confirm($result) {
      global $con;
      if(!$result) {
        die("Query Failed" . mysqli_error($con));
      }
  }

?>
