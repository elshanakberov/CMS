<?php add_user(); ?>
      <form action="" method="post" enctype="multipart/form-data">

                        <div class="form-group">
                            <label for="title">Username</label>
                            <input  type="text" class="form-control" name="user_name" required>
                        </div>


                        <div class="form-group">
                          <label for="">User Role</label><br>
                              <select class="" name="user_role" required>
                                      <option value="User">Select Role</option>
                                      <option value="Admin">Admin</option>
                                      <option value="User">User</option>
                              </select>
                        </div>

                        <div class="form-group">
                            <label for="title">Firstname</label>
                            <input type="text" class="form-control" name="user_firstname" required>
                        </div>

                        <div class="form-group">
                            <label for="title">Lastname</label>
                            <input type="text" class="form-control" name="user_lastname" required>
                        </div>

                        <div class="form-group">
                            <label for="title">Email</label>
                            <input type="email"  name="user_email" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label for="title">Password</label>
                            <input type="password"  name="user_password" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <input type="submit" class="btn-btn-primary" name="submit" value="Submit">
                        </div>

    </form>
