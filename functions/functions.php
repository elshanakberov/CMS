<!-- HELPER FUNCTIONS -->
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

  $query= "SELECT * FROM post";
  $result = mysqli_query($con,$query);
  confirm($result);

  while($row = mysqli_fetch_assoc($result)){
      $post_title = $row['post_title'];
      $post_author = $row['post_author'];
      $post_date = $row['post_date'];
      $post_image = $row['post_image'];
      $post_content = $row['post_content'];


?>
        <h2>
            <a href="#"><?php echo $post_title ?></a>
        </h2>
        <p class="lead">
            by <a href="index.php"><?php echo $post_author ?></a>
        </p>
        <p><span class="glyphicon glyphicon-time"></span> Posted on <?php echo $post_date ?></p>
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

                echo "<ul class='list-unstyled'><li><a href='#'>{$category_title}</a></li></ul>";

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

    $query = "SELECT * FROM post ";
    $show_posts_query = mysqli_query($con,$query);
    confirm($show_posts_query);

    while($row = mysqli_fetch_array($show_posts_query)){

          $post_id = $row['post_id'];
          $post_category_id = $row['post_category_id'];
          $post_title = $row['post_title'];
          $post_author = $row['post_author'];
          $post_image = $row['post_image'];
          $post_status = $row['post_status'];
          $post_tags = $row['post_tags'];
          $post_comments = $row['post_comment_count'];
          $post_date = $row['post_date'];

        echo "<tr>";
            echo "<td>{$post_id}</td>";
            echo "<td>{$post_category_id}</td>";
            echo "<td>{$post_author}</td>";
            echo "<td>{$post_title}</td>";
            echo "<td>{$post_status}</td>";
            echo "<td><img class='img-responsive' width='120px' src='../images/{$post_image}' ></td>";
            echo "<td>{$post_tags}</td>";
            echo "<td>{$post_comments}</td>";
            echo "<td>{$post_date}</td>";
        echo "</tr>";
    }
  }


  function add_post(){
    global $con;

      if(isset($_POST['submit'])){

              $post_title = clean($_POST['post_title']);
              $post_category_id = clean($_POST['post_category_id']);
              $post_author = clean($_POST['post_author']);
              $post_status = clean($_POST['post_status']);
              $image_name = $_FILES['post_image']['name'];
              $image_tmp_name = $_FILES['post_image']['tmp_name'];
              $post_tags = $_POST['post_tags'];
              $post_content= $_POST['post_content'];
              $post_date = date('d-m-y');
              $post_comment_count = 4;
              $extension = substr($image_name,strpos($image_name, '.') + 1);

              if(isset($image_name)){
                if($extension == "jpg" || $extension == "png" || $extension == "jpeg"){
                        move_uploaded_file($image_tmp_name,"../images/$image_name");
                }else{
                  echo "Error ay cindir";
                }
              }

              if($post_title == "" || empty($post_title)){
                  echo "<h3>I was wrong</h3>";
              }elseif($post_author == "" || empty($post_author)){
                  echo "<h3>I was wrong</h3>";
              }else{
                $query = "INSERT INTO post(post_category_id,post_title,post_author,post_date,post_image,post_content,post_tags,post_comment_count,post_status) ";
                $query .= "VALUES('{$post_category_id}','{$post_title}','{$post_author}',now(),'{$image_name}','{$post_content}','{$post_tags}','{$post_comment_count}','{$post_status}' )";
                $insert_query = mysqli_query($con,$query);
              }



      }

}
?>
