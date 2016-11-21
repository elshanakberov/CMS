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
                        <ol class="breadcrumb">
                            <li>
                                <i class="fa fa-dashboard"></i>  <a href="../index.php">Home</a>
                            </li>
                            <li class="active">
                                <i class="fa fa-file"></i> Blank Page
                            </li>
                        </ol>
                    </div>
                </div>

                <div class="col-xs-6">
                    <?php insert_category(); ?>
                    <form  action="" method="post">

                            <div class="form-group">
                                <label for="category_title">Add Category</label>
                                <input name="category_title" type="text"  class="form-control" >
                            </div>

                            <div class="form-group">
                                <input name="submit" class="btn btn-primary" type="submit"  value="Submit">
                            </div>

                    </form>

                </div>
                <div class="col-xs-6">
                  <table class="table table-bordered table-hover">
                    <thead>
                      <tr>
                        <td>İd</td>
                        <td>Category title</td>

                      </tr>
                    </thead>
                    <tbody>

                      <?php admin_category();  ?>
                      <?php delete_category(); ?>
                      <?php edit_category(); ?>

                    </tbody>
                  </table>
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
