<?php fetch_user_data_and_update_data(); ?>
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
