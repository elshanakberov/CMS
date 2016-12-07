<?php  include "include/include_header.php"; ?>

<?php
profile();
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

                <form action="" method="post" enctype="multipart/form-data">

                                  <div class="form-group">
                                      <label for="title">Username</label>
                                      <input value="<?php echo $user_name ?>" type="text" class="form-control" name="user_name" required>
                                  </div>


                                  <div class="form-group">
                                    <label for="">User Role</label><br>
                                        <select class="" name="user_role" required>

                                                <option value="<?php echo $user_role ?>"><?php echo $user_role ?></option>
                                                <?php
                                                    if($user_role == 'Admin'){
                                                      echo "<option value='User'>User</option>";
                                                    }else{
                                                      echo "<option value='Admin'>Admin</option>";
                                                    }
                                                ?>
                                        </select>
                                  </div>

                                  <div class="form-group">
                                      <label for="title">Firstname</label>
                                      <input value="<?php echo $user_firstname ?>" type="text" class="form-control" name="user_firstname" required>
                                  </div>

                                  <div class="form-group">
                                      <label for="title">Lastname</label>
                                      <input value="<?php echo $user_lastname ?>" type="text" class="form-control" name="user_lastname" required>
                                  </div>

                                  <div class="form-group">
                                      <label for="title">Email</label>
                                      <input value="<?php echo $user_email ?>" type="email"  name="user_email" class="form-control" required>
                                  </div>

                                  <div class="form-group">
                                      <label for="title">Password</label>
                                      <input value="<?php echo $user_password ?>" type="password"  name="user_password" class="form-control" required>
                                  </div>

                                  <div class="form-group">
                                      <input type="submit" class="btn-btn-primary" name="submit" value="Submit">
                                  </div>

              </form>

                    </div>
                </div>

                <div class="col-lg-12">


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
