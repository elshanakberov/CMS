
<table class="table table-bordered table-hover">
      <thead>
          <tr>
            <th>Id</th>
            <th>Category</th>
            <th>Author</th>
            <th>Title</th>
            <th>Status</th>
            <th>Image</th>
            <th>Tags</th>
            <th>Comments</th>
            <th>Date</th>

          </tr>
      </thead>
      <tbody>
          <?php show_posts(); ?>
          <?php delete_post(); ?>
      </tbody>
</table>
