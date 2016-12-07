<!-- HELPER FUNCTIONS -->
 <?php session_start(); ?>

<?php

function clean($string){

  return htmlentities($string);
}

function redirect($location){

  return header("location: {$location}");
}


/* CATEGORY TABLE */

function display_cat_table() {
  global $con;

  $query = "SELECT * FROM category";
  $show_query = mysqli_query($con,$query);

  confirm($show_query); //confirm mysqli query

  while($row = mysqli_fetch_assoc($show_query)){ //While a row of data exists, put that row in $row as an associative array

        $category_title = $row['category_title'];
        echo "<li><a href='#'>{$category_title}</a></li>";
  }

}

/******************** POST TABLE AND DISPLAY RESULT ***************/

function display_post(){
  global $con;

  $query= "SELECT * FROM post ORDER BY post_view DESC";
  $result = mysqli_query($con,$query);
  confirm($result);

  while($row = mysqli_fetch_assoc($result)){
      $post_title = $row['post_title'];
      $post_id = $row['post_id'];
      $post_author = $row['post_author'];
      $post_date = $row['post_date'];
      $post_image = $row['post_image'];
      $post_content = $row['post_content'];
      $post_view = $row['post_view'];


?>
        <h2>
            <a href="post.php?post_id=<?php echo $post_id; ?> "><?php echo $post_title ?></a>
        </h2>
        <p class="lead">
            by <a href="index.php"><?php echo $post_author ?></a>
        </p>
        <p><span class="glyphicon glyphicon-time"></span> Posted on <?php echo $post_date ?></p>
        <p><span class="glyphicon glyphicon-eye-open"></span> Post View <?php  echo $post_view ?> </p>
        <hr>
        <img class="img-responsive" src="images/<?php echo $post_image ?>" alt="">
        <hr>
        <p><?php echo $post_content ?></p>

<?php } }?>
<?php


/********************** SEARCH ENGINE ********************/

 function search_engine(){
      global $con;


      if(isset($_GET['submit'])){

          $search =  clean($_GET['search']);
          $query = "SELECT * FROM post WHERE post_tags LIKE '%$search%' ";
          $search_query = mysqli_query($con,$query);

          $result =  mysqli_num_rows($search_query);
              if($result > 0) {

                  while($row = mysqli_fetch_assoc($search_query)){

                        $post_title = $row['post_title'];
                        $post_author = $row['post_author'];
                        $post_date = $row['post_date'];
                        $post_image = $row['post_image'];
                        $post_content = $row['post_content'];

                        echo "
                        <h2>
                            <a href='#'>{$post_title}</a>
                        </h2>
                        <p class='lead'>
                            by <a href='index.php'>{$post_author}</a>
                        </p>
                        <p><span class='glyphicon glyphicon-time'></span> Posted on {$post_date}</p>
                        <hr>
                        <img class='img-responsive' src='images/{$post_image} ' alt=''>
                        <hr>
                        <p>{$post_content}</p>
                        ";

                        }

                      }else {

                            echo "<h1>No Results</h1>";

                      }

                  }

          }


/********************** SIDERBAR CATEGORIES ********************/

function blog_categories_well(){
  global $con;

  $query = "SELECT * FROM category";
  $result = mysqli_query($con,$query);

        while($row = mysqli_fetch_assoc($result)){
              $category_title = $row['category_title'];
              $category_id = $row['category_id'];

                echo "<ul class='list-unstyled'><li><a href='category.php?category={$category_id}'>{$category_title}</a></li></ul>";

             }
      }

      function display_category_post(){
        global $con;
        if(isset($_GET['category'])){
            $cat_id = $_GET['category'];
        }

        $query = "SELECT * FROM post WHERE post_category_id = {$cat_id} ";
        $category_query = mysqli_query($con,$query);

            while($row = mysqli_fetch_array($category_query)){
              $post_id = $row['post_id'];
              $post_title = $row['post_title'];
              $post_author = $row['post_author'];
              $post_date = $row['post_date'];
              $post_image = $row['post_image'];
              $post_content = $row['post_content'];

                echo "
                      <h1 class='page-header'>
                       Page Heading
                       <small>Secondary Text</small>
                   </h1>

                   <!-- Second Blog Post -->
                   <h2>
                       <a href='#'>$post_title</a>
                   </h2>
                   <p class='lead'>
                       by <a href=''>$post_author</a>
                   </p>
                   <p><span class='glyphicon glyphicon-time'></span> $post_date </p>
                   <hr>
                   <img class='img-responsive' src='images/ $post_image ' alt=''>
                   <hr>
                   <p>$post_content</p>
                   <a class='btn btn-primary' href='#'>Read More <span class='glyphicon glyphicon-chevron-right'></span></a>

                   <hr>
                ";
            }
      }


/********************** ADMIN CATEGORIES ********************/


  function admin_category(){
    global $con;

      $query="SELECT * FROM category";
      $sql_query = mysqli_query($con,$query);

        while($row = mysqli_fetch_array($sql_query)){

              $category_title = $row['category_title'];
              $category_id = $row['category_id'];

        echo "<tr>
                <th>$category_id</th>
                <th>$category_title</th>
                <th><a href='category.php?delete={$category_id}'>Delete</a></th>
                <th><a href='category.php?edit={$category_title}'>Edit</a></th>
              </tr>";
        }
  }
    function admin_category2(){
      global $con;

        $query="SELECT * FROM category";
        $sql_query = mysqli_query($con,$query);

          while($row = mysqli_fetch_array($sql_query)){

                $category_title = $row['category_title'];
                $category_id = $row['category_id'];

                    echo "
                              <option value='$category_id'>$category_title</option>
                    ";
          }
    }

  function insert_category(){
    global $con;

    if(isset($_POST['submit'])){
      $category_title = clean($_POST['category_title']);
          if($category_title == "" || empty($category_title)){
               echo "<h4 align='center'>Your are forbidden confirm a blank space</h4>";
          }else{

              $query = "INSERT INTO category(category_title) VALUE('{$category_title}' ) ";
              $sql_query = mysqli_query($con,$query);
                if(!$sql_query){
                  die('Query Failed' . mysqli_error($con));
              }
          }
      }
  }

  function delete_category(){
    global $con;

        if(isset($_GET['delete'])){

            $delete_id =$_GET['delete'];

            $query = "DELETE FROM category WHERE category_id = {$delete_id }";
            $sql_query = mysqli_query($con,$query);
               header("Location: category.php");

        }
  }
  function edit_category(){

    global $con;

      if(isset($_GET['edit'])){

          $update = clean($_GET['edit']);

          $query = "SELECT * FROM category WHERE category_title = '{$update}' ";
          $sql_query = mysqli_query($con,$query);

              while($row = mysqli_fetch_array($sql_query)){
                    $category_id = $row['category_id'];
                    $category_title = $row['category_title'];

?>

<form  action="" method="post">
<label for="title">Edit Categories</label>
<input value=" <?php if(isset($update)){ echo $update; } ?>  " name="category_title" type="text" class="form-control" placeholder="Edit Categories">
<input name="update_category" type="submit" class="btn btn-primary" value="Edit Category">
</form>
<?php
          }
      }


        if(isset($_POST['update_category'])){

            $update_category_title = clean($_POST['category_title']);

              if($update_category_title == "" || empty($update_category_title)){

                  echo "<h4>Your are forbidden to leave blank space!</h4>";

              }else{

                  $query = "UPDATE category SET category_title = '{$update_category_title}' WHERE category_id = {$category_id} ";

                  $update_query = mysqli_query($con,$query);
                  header("Location: category.php");

            }
        }
    }



/********************** ADMIN POSTS ********************/


  function show_posts(){
    global $con;

    $query = "SELECT * FROM post";
    $show_posts_query = mysqli_query($con,$query);
    confirm($show_posts_query);

    while($row = mysqli_fetch_array($show_posts_query)){

          $post_id1 = $row['post_id'];
          $post_category_id1 = $row['post_category_id'];
          $post_title1 = $row['post_title'];
          $post_author1 = $row['post_author'];
          $post_image1 = $row['post_image'];
          $post_status1 = $row['post_status'];
          $post_tags1 = $row['post_tags'];
          $post_comments1 = $row['post_comment_count'];
          $post_view1 = $row['post_view'];
          $post_date1 = $row['post_date'];

            echo "<tr>";
            echo "<td>{$post_id1}</td>";
            echo "<td>{$post_author1}</td>";
            echo "<td>{$post_title1}</td>";

            $category_query = "SELECT * FROM category WHERE category_id = {$post_category_id1} ";
            $select_query = mysqli_query($con,$category_query);
              while($row = mysqli_fetch_assoc($select_query)){
                      $category_title = $row['category_title'];
                      $category_id = $row['category_id'];
                      echo "<td>{$category_title}</td>";
              }





            echo "<td>{$post_status1}</td>";
            echo "<td><img class='img-responsive' width='120px' src='../images/{$post_image1}' ></td>";
            echo "<td>{$post_tags1}</td>";
            echo "<td>{$post_comments1}</td>";
            echo "<td>{$post_view1}</td>";
            echo "<td>{$post_date1}</td>";
            echo "<td><a href='posts.php?source=edit_post&p_id={$post_id1}'>Edit</a></td>";
            echo "<td><a href='posts.php?delete={$post_id1}'>Delete</a></td>";
        echo "</tr>";
    }
  }

  function post_view(){
  global $con;
      if(isset($_GET['post_id'])){
        $the_post_id = $_GET['post_id'];

              $view_query = "UPDATE post SET post_view = post_view +1 WHERE post_id = $the_post_id ";
              $view_post_query = mysqli_query($con,$view_query);
        }else{
          echo "Post view error";
        }
      }

  function show_post_link(){
    global $con;

    if(isset($_GET['post_id'])){

          $post_id = $_GET['post_id'];

    }

      $query = "SELECT * FROM post WHERE post_id = $post_id ";
      $select_query = mysqli_query($con,$query);


        while($row = mysqli_fetch_array($select_query)){
                $post_id = $row['post_id'];
                $post_title = $row['post_title'];
                $post_author = $row['post_author'];
                $post_date = $row['post_date'];
                $post_image = $row['post_image'];
                $post_content = $row['post_content'];

                  echo "
                        <h1 class='page-header'>
                         Page Heading
                         <small>Secondary Text</small>
                     </h1>

                     <!-- Second Blog Post -->
                     <h2>
                         <a href='#'>$post_title</a>
                     </h2>
                     <p class='lead'>
                         by <a href=''>$post_author</a>
                     </p>
                     <p><span class='glyphicon glyphicon-time'></span> $post_date </p>
                     <hr>
                     <img class='img-responsive' src='images/ $post_image ' alt=''>
                     <hr>
                     <p>$post_content</p>
                     <a class='btn btn-primary' href='#'>Read More <span class='glyphicon glyphicon-chevron-right'></span></a>

                     <hr>
                  ";
        }
  }



  function add_post(){
    global $con;


      if(isset($_POST['submit'])){

              $post_title1 = clean($_POST['post_title']);
              $post_category_id1 = clean($_POST['post_category_id']);
              $post_author1 = clean($_POST['post_author']);
              $post_status1 = clean($_POST['post_status']);
              $image_name1 = $_FILES['post_image']['name'];
              $image_tmp_name1 = $_FILES['post_image']['tmp_name'];
              $post_tags1 = $_POST['post_tags'];
              $post_content1= $_POST['post_content'];
              $post_date1 = date('d-m-y');
              $extension = substr($image_name1,strpos($image_name1, '.') + 1);

              if(isset($image_name1)){
                if($extension == "jpg" || $extension == "png" || $extension == "jpeg"){
                        move_uploaded_file($image_tmp_name1,"../images/$image_name1");
                }else{
                  echo "Only jpg,jpeg,png extensions allowed";
                }
              }

              if($post_title1 == "" || empty($post_title1)){
                  echo "<h3>I was wrong</h3>";
              }elseif($post_author1 == "" || empty($post_author1)){
                  echo "<h3>I was wrong</h3>";
              }else{
                $query = "INSERT INTO post(post_category_id,post_title,post_author,post_date,post_image,post_content,post_tags,post_status) ";
                $query .= "VALUES('{$post_category_id1}','{$post_title1}','{$post_author1}',now(),'{$image_name1}','{$post_content1}','{$post_tags1}','{$post_status1}' )";
                $insert_query = mysqli_query($con,$query);


              }
      }
}

  function delete_post(){
      global $con;

      if(isset($_GET['delete'])){

          $delete_id = $_GET['delete'];
          $query = "DELETE FROM post WHERE post_id = {$delete_id}";
          $delete_query = mysqli_query($con,$query);
          confirm($delete_query);
          redirect("posts.php");

      }
  }

  function select_and_update_post(){
    global $con;
    global $post_title1,$post_category_id1,$post_author1,
    $post_status1,$post_image1,$post_tags1,$post_content1;

// Fetching previous data in the database

      if(isset($_GET['p_id'])){
          $edit_post_id = $_GET['p_id'];
       }

          $query = "SELECT * FROM post WHERE post_id = {$edit_post_id} ";
          $select_query = mysqli_query($con,$query);

            while($row = mysqli_fetch_array($select_query)){

                  $post_id1 = $row['post_id'];
                  $post_title1 = $row['post_title'];
                  $post_category_id1 = $row['post_category_id'];
                  $post_author1 = $row['post_author'];
                  $post_status1 = $row['post_status'];
                  $post_image1 = $row['post_image'];
                  $post_tags1 = $row['post_tags'];
                  $post_content1 = $row['post_content'];
          }
// Updating those data

      if(isset($_POST['update'])){

          $post_title1 = $_POST['post_title'];
          $post_category_id1 = $_POST['post_category_id'];
          $post_author1 = $_POST['post_author'];
          $post_status1 = $_POST['post_status'];
          $post_image1 = $_FILES ['post_image'] ['name'];
          $post_image_temp1 = $_FILES ['post_image'] ['tmp_name'];
          $post_tags1 = $_POST['post_tags'];
          $post_content1 = $_POST['post_content'];

          $location = "../images/ ";
          $extension = substr($post_image1,strpos($post_image1, ".") + 1);

            if(isset($post_image1)){
                  if($extension == "jpg" || $extension == "jpeg" || $extension == "png"){
                      move_uploaded_file($post_image_temp1,$location.$post_image1);
                  }else{
                      echo "Only jpg,jpeg,png file extensions are allowed";
                  }
            }
            if(empty($_FILES ['post_image'] ['name'])){
                $query = "SELECT post_image FROM post WHERE post_id = {$edit_post_id} ";
                $image_query = mysqli_query($con,$query);
                  while($row = mysqli_fetch_array($image_query)){
                          $post_image1 = $row['post_image'];
                  }
            }
            if($post_title1 == "" || empty($post_title1) || $post_author1 == "" || empty($post_author1)){
                  echo "<h2>Post could not be updated to empty field</h2>";
            }else{
                $query  = "UPDATE post SET ";
                $query .= "post_title = '{$post_title1}', ";
                $query .= "post_category_id = {$post_category_id1}, ";
                $query .= "post_date = now(), ";
                $query .= "post_status = '{$post_status1}', ";
                $query .= "post_content = '{$post_content1}', ";
                $query .= "post_image = '{$post_image1}' ";
                $query .= "WHERE post_id = {$edit_post_id} ";

                $update_query = mysqli_query($con,$query);
                confirm($update_query);
          }
      }else{
        echo "";
      }
  }

  /********************** ADMIN COMMENTS ********************/

  function show_comments(){
    global $con;

    $query = "SELECT * FROM comments ";
    $show_comment_query = mysqli_query($con,$query);
    confirm($show_comment_query);

    while($row = mysqli_fetch_assoc($show_comment_query)){

          $comment_id = $row['comment_id'];
          $comment_post_id = $row['comment_post_id'];
          $comment_author = $row['comment_author'];
          $comment_email = $row['comment_email'];
          $comment_status = $row['comment_status'];
          $comment_content = $row['comment_content'];
          $comment_date = $row['comment_date'];

          echo "<tr>";
          echo  "<td>$comment_id</td>";
          echo  "<td>$comment_post_id</td>";
          echo  "<td>$comment_author</td>";
          echo  "<td>$comment_email</td>";
            $query = "SELECT * FROM post WHERE post_id =  $comment_post_id ";
            $sql_query = mysqli_query($con,$query);
              while($row = mysqli_fetch_assoc($sql_query)){
                    $post_id = $row['post_id'];
                    $post_title = $row['post_title'];

                      echo "<td><a href='../post.php?post_id=$post_id'>$post_title</a></td>";
              }
          echo  "<td>$comment_status</td>";
          echo  "<td>$comment_content</td>";
          echo  "<td>$comment_date</td>";
          echo  "<td><a href='comments.php?approve={$comment_id}'>Approve</a></td>";
          echo  "<td><a href='comments.php?unapprove={$comment_id}'>Unapprove</a></td>";
          echo  "<td><a href='comments.php?delete={$comment_id}'>Delete</a></td>";
          echo  "</tr>";
    }
  }

  function add_comment(){
    global $con;

    if(isset($_POST['add_comment'])){

        $the_post_id = $_GET['post_id'];
        $comment_author = clean($_POST['comment_author']);
        $comment_email = clean($_POST['comment_email']);
        $comment_content = clean($_POST['comment_content']);

        $query = "INSERT INTO comments(comment_post_id,comment_author,comment_email,comment_content,comment_date,comment_status) ";
        $query .= "VALUES( {$the_post_id},'{$comment_author}','{$comment_email}','{$comment_content}',now() , 'unapproved' ) ";
        $add_comment_query = mysqli_query($con,$query);
        confirm($add_comment_query);

        $view_query = "UPDATE post SET post_comment_count = post_comment_count + 1 WHERE post_id = $the_post_id ";
        $view_comment_count_query = mysqli_query($con,$view_query);
    }
  }

  function delete_comment(){
        global $con;

        if(isset($_GET['delete'])){

          $delete_post_id = $_GET['delete'];

          $query = "DELETE FROM comments WHERE comment_id = $delete_post_id ";
          $delete_comment_query = mysqli_query($con,$query);
          confirm($delete_comment_query);
          redirect("comments.php");
        }

  }

  function approve_post(){
    global $con;

    if(isset($_GET['approve'])){
        $approve_comment_id = $_GET['approve'];

        $query = "UPDATE comments SET comment_status = 'approved' WHERE comment_id = $approve_comment_id ";
        $update_query = mysqli_query($con,$query);
        confirm($update_query);
        redirect("comments.php");
    }
  }
  function unapprove_post(){
    global $con;

    if(isset($_GET['unapprove'])){
        $unapprove_comment_id = $_GET['unapprove'];

        $query = "UPDATE comments SET comment_status = 'unapproved' WHERE comment_id = $unapprove_comment_id";
        $update_query = mysqli_query($con,$query);
        confirm($update_query);
        redirect("comments.php");
    }
  }

  function show_comment_based_on_approval(){
      global $con,$comment_author,$comment_content,$comment_date;
            if(isset($_GET['post_id'])){
                  $the_post_id = $_GET['post_id'];
            }
      $query = "SELECT * FROM comments WHERE comment_post_id = {$the_post_id} AND comment_status = 'approved' ORDER BY comment_id DESC";
      $comment_query  = mysqli_query($con,$query);
        while($row = mysqli_fetch_assoc($comment_query)){
              $comment_id = $row['comment_id'];
              $comment_author = $row['comment_author'];
              $comment_content = $row['comment_content'];
              $comment_date = $row['comment_date'];


        ?>
        <a class="pull-left" href="#">
            <img class="media-object" src="http://placehold.it/64x64" alt="">
        </a>
        <div class="media-body">
            <h4 class="media-heading"><?php echo $comment_author ?>
                <small><?php echo $comment_date ?></small>
            </h4>
            <?php echo $comment_content ?>
            <!-- Nested Comment -->
            <div class="media">
                <a class="pull-left" href="#">
                    <img class="media-object" src="http://placehold.it/64x64" alt="">
                </a>
                <div class="media-body">
                    <h4 class="media-heading">Nested Start Bootstrap
                        <small>August 25, 2014 at 9:30 PM</small>
                    </h4>
                    Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin commodo. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.
                </div>
            </div>
            <!-- End Nested Comment -->
        </div>
        <?php
   }
  }




/********************** ADMIN POSTS ********************/


function display_users(){
   global $con;

   $query = "SELECT * FROM users ";
   $display_users_query = mysqli_query($con,$query);

     confirm($display_users_query);
       while($row = mysqli_fetch_array($display_users_query)){
             $user_id = $row['user_id'];
             $user_name = $row['user_name'];
             $user_firstname = $row['user_firstname'];
             $user_lastname = $row['user_lastname'];
             $user_email = $row['user_email'];
             $user_role = $row['user_role'];

             echo " <tr> ";
             echo "<td>{$user_id}</td>";
             echo "<td>{$user_name}</td>";
             echo "<td>{$user_firstname}</td>";
             echo "<td>{$user_lastname}</td>";
             echo "<td>{$user_email}</td>";
             echo "<td>{$user_role}</td>";
             echo "<td><a href='users.php?admin={$user_id}'>Admin</a></td>";
             echo "<td><a href='users.php?user={$user_id}'>User</a></td>";
             echo "<td><a href='users.php?source=edit_user&edit_user_id={$user_id}'>Edit</a></td>";
             echo "<td><a href='users.php?delete={$user_id}'>Delete</a></td>";
             echo "</tr>";
       }
}


  function add_user(){
        global $con;

        if(isset($_POST['submit'])){
          $user_name       = clean($_POST['user_name']);
          $user_role       = clean($_POST['user_role']);
          $user_firstname  = clean($_POST['user_firstname']);
          $user_lastname   = clean($_POST['user_lastname']);
          $user_email      = clean($_POST['user_email']);
          $user_password   = clean($_POST['user_password']);

            $query = "INSERT INTO users (user_name,user_role,user_firstname,user_lastname,user_email,user_password) ";
            $query .= "VALUES('{$user_name}' , '{$user_role}' , '{$user_firstname}' , '{$user_lastname}' , '{$user_email}' , '{$user_password}') ";
            $add_user_query = mysqli_query($con,$query);
              if($add_user_query){
                redirect("users.php?source=view_all_users");
              }else{
                  echo "<h2>The Have Been Issue</h2>";
              }
        }

  }

    function delete_user(){
      global $con;

      if(isset($_GET['delete'])){
        $delete_post_id = $_GET['delete'];

          $query = "DELETE FROM users WHERE user_id = $delete_post_id ";
          $delete_user_query = mysqli_query($con,$query);
          redirect("users.php");
      }
    }

    function update_user_role(){
      global $con;
      if(isset($_GET['admin'])){
        $user_role_admin_id = $_GET['admin'];
        $query = "UPDATE users SET user_role = 'Admin' WHERE user_id = $user_role_admin_id ";

        $update_user_role_admin = mysqli_query($con,$query);
        redirect("users.php");
      }

      if(isset($_GET['user'])){
        $user_role_user_id = $_GET['user'];

        $query = "UPDATE users SET user_role = 'User' WHERE user_id = $user_role_user_id";
        $update_user_role_user = mysqli_query($con,$query);
        redirect("users.php");
      }
    }

    function fetch_user_data_and_update_data(){
      global $con,$user_name,$user_role,$user_firstname,$user_lastname,$user_email,$user_password;
        if(isset($_GET['edit_user_id'])){
            $edit_user_id = $_GET['edit_user_id'];
        }
        $query = "SELECT * FROM users WHERE user_id = $edit_user_id ";
        $select_user_id = mysqli_query($con,$query);

        while($row = mysqli_fetch_array($select_user_id)){
              $user_name = $row['user_name'];
              $user_role = $row['user_role'];
              $user_firstname = $row['user_firstname'];
              $user_lastname = $row['user_lastname'];
              $user_email = $row['user_email'];
              $user_password = $row['user_password'];
        }

// Updating those data

    if(isset($_POST['submit'])){

      $user_name = clean($_POST['user_name']);
      $user_role = clean($_POST['user_role']);
      $user_firstname = clean($_POST['user_firstname']);
      $user_lastname= clean($_POST['user_lastname']);
      $user_email = clean($_POST['user_email']);
      $user_password = clean($_POST['user_password']);

        $query = "UPDATE users SET ";
        $query .= "user_name = '{$user_name}', ";
        $query .= "user_role = '{$user_role}', ";
        $query .= "user_firstname = '{$user_lastname}', ";
        $query .= "user_lastname = '{$user_lastname}', ";
        $query .= "user_email = '{$user_email}', ";
        $query .= "user_password = '{$user_password}' ";
        $query .= "WHERE user_id = {$edit_user_id} ";

        $update_user_date = mysqli_query($con,$query);
    }
  }
/********************** Login and Registration ********************/

function login(){
  global $con;
  if(isset($_POST['login'])){

    $user_name = $_POST['user_name'];
    $user_password = $_POST['user_password'];
    $username = mysqli_real_escape_string($con,$user_name);
    $user_password = mysqli_real_escape_string($con,$user_password);

    $query = "SELECT * FROM users WHERE user_name = '{$username}'  ";
    $select_query = mysqli_query($con,$query);

      while($row = mysqli_fetch_array($select_query)){
        $db_username = $row['user_name'];
        $db_user_role = $row['user_role'];
        $db_password = $row['user_password'];
      }
          $user_password = crypt($user_password,$db_password);
      if($username === $db_username && $user_password === $db_password){
        $_SESSION['user_name'] = $db_username;
        $_SESSION['user_role'] = $db_user_role;
          redirect("../admin");
      }else{
        redirect("../index.php");
      }

  }
}

function user_restriction(){
  if(!isset($_SESSION['user_role'])){
    redirect("../index.php");
  }elseif(isset($_SESSION['user_role']) && ($_SESSION['user_role'] === 'Admin')===FALSE) {
      redirect("../index.php");
    }
}


function profile(){
  global $con,$user_name,$user_role,$user_firstname,$user_lastname,$user_email,$user_password;
  if(isset($_SESSION['user_name'])){
    $session_user_name  = $_SESSION['user_name'];
    $query = "SELECT * FROM users WHERE user_name = '{$session_user_name}' ";
    $select_query = mysqli_query($con,$query);
      while($row = mysqli_fetch_array($select_query)){
            $user_name = $row['user_name'];
            $user_role = $row['user_role'];
            $user_firstname = $row['user_firstname'];
            $user_lastname = $row['user_lastname'];
            $user_email = $row['user_email'];
            $user_password = $row['user_password'];

      }
  }
}
  function register_user(){
    global $con,$message;

      if(isset($_POST['submit'])){
        $username = clean($_POST['username']);
        $user_email = clean($_POST['email']);
        $user_password = clean($_POST['password']);

        $username = mysqli_real_escape_string($con,$username);
        $user_email = mysqli_real_escape_string($con,$user_email);
        $user_password = mysqli_real_escape_string($con,$user_password);
            if(!empty($username) || !empty($user_email ) || !empty($user_password)){
              $rand_query = "SELECT randSalt FROM users ";
              $fetch_query = mysqli_query($con,$rand_query);

                $row = mysqli_fetch_array($fetch_query);
                $salt = $row['randSalt'];
                $user_password = crypt($user_password,$salt);

                $query = "INSERT INTO users(user_name,user_email,user_password,user_role) ";
                $query .= "VALUES ('{$username}' , '{$user_email}','{$user_password}','User') ";
                $register_user_query = mysqli_query($con,$query);

                $message = "User Succesfully Registered";
            }else{
                $message = "Fail";
            }
      }else{
        $message = "";
      }
  }
?>
