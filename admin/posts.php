
	<?php
    include "include/include_header.php";

 ?>
<body>

    <div id="wrapper">

        <!-- Navigation -->
        <?php
              include "include/include_navbar.php";
         ?>
        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Blank Page
                            <small>Subheading</small>
                        </h1>

                    </div>
                </div>

                <div class="col-lg-12">

<?php

      if(isset($_GET['source'])){
          $source = $_GET['source'];
      }else {
        $source = "";
      }

    switch($source){

      case "add_post";
        include "include/add_post.php";
      break;
      case "edit_post";
        include "include/edit_post.php";
      break;

      default:
        include "include/view_all_posts.php";
      break;

    }
?>

                </div>

                <!-- /.row -->
              </div>

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->




    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

</body>

</html>
