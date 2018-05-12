<?php

  require 'connect.php';
  if(isset($_SESSION['name'])){
    if(empty($_SESSION['name']))
      header('Location: Login.php');
  }else {
    header('Location: Login.php');
  }

  $Username = $_SESSION['name'];
  $UserID = $_SESSION['UserID'];
  $Lname = $_SESSION['Lname'];

  if((isset($_POST['blogname'])) && (isset($_POST['blogtag']))){
    if(!empty($_POST['blogname']) && !empty($_POST['blogtag'])){
      $Blogbackground = 'blog/woods.jpg';
      $blogname = $_POST['blogname'];
      $blogtag = $_POST['blogtag'];
      $LastUpdatedOn = date('Y-m-d');
      $WriterName = $Username.' '.$Lname;
      if (isset($_FILES['blogbackground']['name']) && !(empty($_FILES['blogbackground']['name']))) {
        $name = $_FILES['blogbackground']['name'];
        $size = $_FILES['blogbackground']['size'];
        $type = $_FILES['blogbackground']['type'];
        $tmp_name = $_FILES['blogbackground']['tmp_name'];
        $extension = substr($name, strlen($name)-4);
        $Blogbackground = 'blog/'.md5($name).$extension;
        move_uploaded_file($tmp_name, $Blogbackground);
      }
      $insert = $conn->query("INSERT INTO `blog`(`WriterId`, `WriterName`, `Title`, `ImageName`, `Tag`, `LastUpdatedOn`) VALUES ('{$UserID}','{$WriterName}','{$blogname}', '{$Blogbackground}', '{$blogtag}', '{$LastUpdatedOn}')");
    }
  }
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="CSS/w3.css">
    <link rel="stylesheet" type="text/css" href="CSS/Layout.css">
    <link rel="stylesheet" type="text/css" href="CSS/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">
    <style>
      h1,h2 {
        font-family: "Raleway", sans-serif;
      }
      hr {
        margin:0px;
      }
    </style>
    <title><?php echo $Username; ?> - Blog</title>
  </head>

  <body class="w3-light-grey">

    <!-- Header -->
  <header class="w3-container w3-center w3-padding-8">
    <h1 style="font-size: 30px;"><b>MY BLOG</b></h1>
    <p>Welcome to the blog of <span class="w3-tag">unknown</span></p>
  </header>

    <!-- NavBar -->
  <div>
    <nav>
      <ul class="w3-navbar w3-large w3-black w3-left-align">
        <li class="w3-hide-medium w3-hide-large w3-black w3-opennav w3-right">
            <a onclick="hide_show('demo')">&#9776;</a>
          </li>
          <li><a href="Account.php"><i class="fa fa-home"> </i> Home</a></li>
          <li class="w3-hide-small"><a href="Profile.php"><i class="fa fa-user"></i> <?php echo $Username.' '.$Lname ?></a></li>
        <li class="w3-hide-small"><a href="Projects.php"><i class="fa fa-file-text-o"></i> Projects</a></li>
        <li class="w3-hide-small"><a href="Events.php"><i class="fa fa-calendar-check-o"></i> Events</a></li>
        <li class="w3-hide-small"><a href="Pages.php?PageId=1"><i class="fa fa-newspaper-o"></i> IIITG - Herald</a></li>
        <li class="w3-hide-small"><a href="MyBlog.php"><i class="fa fa-file-text-o"></i> My Blog</a></li>
        <li class="w3-right w3-hide-small"><a href="LogOut.php">Logout</a></li>
        <div class="w3-right">
          <li id="menu-search" class="w3-hide-small"><input type="text" class="w3-input" placeholder="Search..." onkeyup="showHint(this.value)"></li>
          <li id="menu-button" class="w3-hide-small"><button class="w3-btn w3-green">Go</button></li>
          <div id="txtHint" class="w3-text-black w3-white w3-card-4" style="background-color:#eee; width: 100%;"></div>
        </div>
      </ul>
      <div id="demo" class="w3-hide w3-hide-large w3-hide-medium">
        <ul class="w3-navbar w3-left-align w3-large w3-black">
            <li><a href="Profile.php"><i class="fa fa-user"></i> <?php echo $Username.' '.$Lname ?></a></li>
          <li><a href="Projects.php"><i class="fa fa-file-text-o"></i> Projects</a></li>
          <li><a href="Events.php"><i class="fa fa-calendar-check-o"></i> Events</a></li>
          <li><a href="Pages.php?PageId=1"><i class="fa fa-newspaper-o"></i> IIITG - Herald</a></li>
          <li><a href="MyBlog.php"><i class="fa fa-file-text-o"></i> My Blog</a></li>
          <li><a href="LogOut.php">Logout</a></li>
          </ul>
      </div>
    </nav>
  </div>

  <!-- Page Container -->
  <div class="w3-container" style="max-width:1600px;">
    <!-- The Grid -->
    <div class="w3-row">
      <!-- Left Column -->
      <div class="w3-col l4 m4">

      <!-- Creating Blog -->
        <div class="w3-margin w3-padding-4 w3-center">

          <button class="w3-btn w3-blue" onclick="document.getElementById('createblog').style.display='block';">Create a Blog</button>
          <div id="createblog" class="w3-modal w3-animate-zoom">
            <div class="w3-modal-content">
              <div class="w3-container w3-white">
                <span onclick="document.getElementById('createblog').style.display='none'" class="w3-closebtn w3-hover-red w3-container">&times;</span>
                <form action="MyBlog.php" method="POST" enctype="multipart/form-data">
                  <br><br>
                  <h3 class="w3-text-teal">BLOG DETAILS</h3>
                  <h4>Title :</h4>
                  <input type="text" class="w3-input w3-border" name="blogname">
                  <h4>Related to ( Tags ) :</h4>
                  <input type="text" name="blogtag" class="w3-input w3-border">
                  <h4>Background :</h4>
                  <input type="file" class="w3-input w3-border w3-green" name="blogbackground">
                  <br><br>
                  <input type="submit" class="w3-btn w3-blue">
                  <br><br>
                </form>
              </div>
            </div>
          </div>

        </div>

        <!-- Popular Posts -->
        <div class="w3-card-8 w3-margin">
          <div class="w3-container w3-padding">
            <h4>Popular Posts</h4>
          </div>
          <ul class="w3-ul w3-hoverable w3-white">

            <?php
              $count = 0;
              $result = $conn->query("SELECT * FROM `blog` ORDER BY `id` desc");
              if($result){
                while($row = $result->fetch_assoc()){
                  $Title = $row['Title'];
                  $ImageName = 'blog/woods.jpg';
                  if(!empty($row['ImageName']))
                    $ImageName = $row['ImageName'];
                  $count = $count + 1;
                  echo '<a href="WriteBlog.php?bid='.$row['id'].'"><li class="w3-padding-16">';
                  echo '<img src="'.$ImageName.'" alt="Image" class="w3-left w3-margin-right" style="width:50px">';
                  if(strlen($Title) > 28)
                    $Title = substr($Title, 0, 28).' ...';
                  echo '<span class="w3-large">'.$Title.'</span><br>';
                  $content = $row['Content'];
                  if(strlen($content) > 55)
                    $content = substr($content, 0, 55).' ...';
                  echo '<span>'.htmlspecialchars_decode($content).'</span></li></a><hr>';
                  if($count == 4)
                    break;
                }
              }
            ?>

          </ul>
        </div>
      <!-- End Left Column -->
      </div>

      <!-- Main Column -->
      <div class="w3-col l7 m8 s12">

        <?php
          $count = 0;
          $result = $conn->query("SELECT * FROM `blog` ORDER BY `id` desc");
          // Count the total records
          $total_records = mysqli_num_rows($result);
          //Using ceil function to divide the total records on per page
          $total_pages = ceil($total_records / 5);
          $num_rec_per_page = 5;
          $page = 1;
          if (isset($_GET['page']) && !empty($_GET['page'])) {
            $page = $_GET['page'];
          }
          $start_from = ($page - 1) * $num_rec_per_page;
          $result = $conn->query("SELECT * FROM `blog` ORDER BY `id` desc LIMIT $start_from, $num_rec_per_page");
          if($result){
            while($row = $result->fetch_assoc()){
              $ImageName = $row['ImageName'];
              $count = $count + 1;
              echo '<div class="w3-card-4 w3-margin w3-white">
                    <div class="w3-center">
                    <img src="'.$ImageName.'" alt="Nature" style="max-height:25vh; width:100%;">';
              if($row['WriterId'] == $UserID){
                echo '<span class="w3-container w3-right w3-red" style="cursor:pointer;" onclick="deleteblogs(this, '.$row['id'].');">&times;</span>';
              }
              echo '</div>
                    <div class="w3-container">';
              echo '<h3 class="w3-text-teal"><b>'.$row['Title'].'</b></h3>';
              echo '<h5>Tag : <span class="w3-tag">'.$row['Tag'].'</span></h5>
                    <h5>Writer : <span class="w3-tag">'.$row['WriterName'].'</span></h5>
                    <h5>Last Updated On : <span class="w3-tag">'.$row['LastUpdatedOn'].'</span></h5>
                    </div><hr class="w3-clear">';
              echo '<div class="w3-container"';
              $content = $row['Content'];
              if(strlen($content) > 350){
                $content = substr($content, 0, 350).' ...';
              }
              echo '<p>'.htmlspecialchars_decode($content).'</p>
                    </div>';
              echo '<div class="w3-row w3-container">
                    <div class="w3-col m8 s12"><p><a href="WriteBlog.php?bid='.$row['id'].'"><button class="w3-btn w3-padding-large w3-white w3-border w3-hover-border-black"><b>READ MORE »</b></button></a></p>
                    </div>';
              echo '<div class="w3-col m4 w3-hide-small"><p><span class="w3-padding-large w3-right"><b>Comments  </b> <span class="w3-tag">0</span></span></p></div>
                    </div>
                    </div>';
            }
            if($count == 0)
              echo '<div class="w3-container w3-margin w3-card-4 w3-white"><h2>No Blog Yet </h2></div>';
          }
          echo '<div class="w3-center"><ul class="w3-pagination">';
          if($page > 1){
            echo '<li><a href="Account.php?page='.($page-1).'">&laquo;</a></li>';
          }

          echo '<li><a class="w3-purple">'.$page.'</a></li>';
          if($total_pages > $page){
            echo '<li><a href="Account.php?page='.($page+1).'">&raquo;</a></li>';
          }
          echo '</ul></div>';

        ?>
      <!-- End Main Column -->
      </div>

    <!-- End Grid -->
    </div>
  <!-- End Page Container -->
  </div>
  <br>

  <!-- Footer -->
  <div id="Footer" class="w3-container w3-teal">
    <h6>
      CopyRight.<br>
      This is Shikhar's Product.
    </h6>
  </div>

  <script type="text/javascript" src="js/jquery-3.1.1.min.js"></script>
  <script type="text/javascript" src="js/menuControlling.js"></script>

  </body>
</html>
