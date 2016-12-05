
<table class="table table-bordered table-hover">
      <thead>
          <tr>
            <th>Id</th>
            <th>Username</th>
            <th>User Firstname</th>
            <th>User Lastname</th>
            <th>User Email</th>
            <th>User Role</th>


          </tr>
      </thead>
      <tbody>
          <?php display_users(); ?>
          <?php delete_user(); ?>
          <?php update_user_role(); ?>
      </tbody>
</table>
