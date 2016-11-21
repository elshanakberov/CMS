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


?>
