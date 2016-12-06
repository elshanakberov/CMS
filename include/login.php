<?php include "../functions/db.php"; ?>
<?php include "../functions/functions.php"; ?>
<?php login(); ?>

<?php
if(isset($_SESSION['user_role']) && $_SESSION['user_role'] === "Admin"){
  header("Location:../admin/index.php");
}else{
  redirect("../index.php");
}
?>
