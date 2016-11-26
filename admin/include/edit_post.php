
<form action="" method="post" enctype="multipart/form-data">
<?php

select_and_update_post();


?>

              <div class="form-group">
                  <label for="title">Post Title</label>
                  <input value="<?php echo $post_title1; ?>" type="text" class="form-control" name="post_title">
              </div>

              <div class="form-group">
                  <label for="title">Post Category id</label>
                  <input value="<?php echo $post_category_id1; ?>" type="text" class="form-control" name="post_category_id">
              </div>

              <div class="form-group">
                  <label for="title">Post Author</label>
                  <input value="<?php echo $post_author1; ?>" type="text" class="form-control" name="post_author">
              </div>

              <div class="form-group">
                  <label for="title">Post Status</label>
                  <input value="<?php echo $post_status1; ?>" type="text" class="form-control" name="post_status">
              </div>

              <div class="form-group">
                  <label for="title">Post Image</label>
                  <input value="<?php echo $post_image1; ?>" type="file"  name="post_image">
              </div>


              <div class="form-group">
                  <label for="title">Post Tags</label>
                  <input value="<?php echo $post_tags1; ?>" type="text" class="form-control" name="post_tags">
              </div>

              <div class="form-group">
                  <label for="title">Post Content</label>
                    <textarea value="<?php echo $post_content1; ?>" class="form-control" id="" cols="30" rows="10"  name="post_content"></textarea>
              </div>


              <div class="form-group">

                  <input type="submit" class="btn-btn-primary" name="update" value="Submit">
              </div>

</form>
