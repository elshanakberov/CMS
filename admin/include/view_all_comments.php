
<table class="table table-bordered table-hover">
      <thead>
          <tr>
            <th>Id</th>
            <th>Post id</th>
            <th>Author</th>
            <th>Email</th>
            <th>Related With</th>
            <th>Status</th>
            <th>Content</th>
            <th>Date</th>
            <th>Apptove</th>
            <th>Unapprove</th>

          </tr>
      </thead>
      <tbody>
          <?php show_comments(); ?>
          <?php  delete_comment();  ?>
          <?php  approve_post();  ?>
          <?php  unapprove_post();  ?>
      </tbody>
</table>
