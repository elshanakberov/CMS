<?php add_post(); ?>
      <form action="" method="post" enctype="multipart/form-data">

                        <div class="form-group">
                            <label for="title">Post Title</label>
                            <input  type="text" class="form-control" name="post_title">
                        </div>

                        <div class="form-group">
                            <label for="title">Post Category id</label>
                            <input type="text" class="form-control" name="post_category_id">
                        </div>

                        <div class="form-group">
                            <label for="title">Post Author</label>
                            <input type="text" class="form-control" name="post_author">
                        </div>

                        <div class="form-group">
                            <label for="title">Post Status</label>
                            <input type="text" class="form-control" name="post_status">
                        </div>

                        <div class="form-group">
                            <label for="title">Post Image</label>
                            <input type="file"  name="post_image">
                        </div>


                        <div class="form-group">
                            <label for="title">Post Tags</label>
                            <input type="text" class="form-control" name="post_tags">
                        </div>

                        <div class="form-group">
                            <label for="title">Post Content</label>
                              <textarea  class="form-control" id="" cols="30" rows="10"  name="post_content"></textarea>
                        </div>


                        <div class="form-group">

                            <input type="submit" class="btn-btn-primary" name="submit" value="Submit">
                        </div>

    </form>
