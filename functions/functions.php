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

          $search =  $_GET['search'];
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

?>
