<?php
  require 'connect.php';
  if(isset($_GET['sid'])){
    if(!empty($_GET['sid'])){
      $sid = htmlentities($_GET['sid']);
      $result = $conn->query("SELECT * FROM `herald` WHERE `sid`='{$sid}'");
        if($row = $result->fetch_assoc()) {
              $WriterName = $row['writerID'];
              $Title = $row['Title'];
              $Content = $row['Content'];
              $ImageName = $row['Image'];
              $storyAdded = $row['storyAdded'];
        }
        else
            header('Location: hearld.php');
    } else
      header('Location: hearld.php');
  } else
    header('Location: hearld.php');
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">
    <style>
      h1,h2 {
        font-family: "Raleway", sans-serif;
      }
      #insertblog div div {
        display: inline;
      }
      #insertblog #contentwritingdiv div{
        display: none;
      }
      input[type="file"]{
        display: none;
      }
      label {
        cursor: pointer;
      }
      a {
          text-decoration: none;
      }
    </style>
    <title><?php echo $Title; ?></title>
  </head>

  <body class="w3-light-grey">
      <!-- Navbar -->
      <div class="">
       <div class="w3-bar w3-white w3-left-align w3-large">
        <a class="w3-bar-item w3-button w3-hide-medium w3-hide-large w3-right w3-padding-large w3-hover-white w3-large w3-theme-d2" href="javascript:void(0);" onclick="openNav()"><i class="fa fa-bars"></i></a>
        <a href="http://localhost/FeedbackSystem/index.php" class="w3-bar-item w3-button"><img src="http://localhost/FeedbackSystem/assets/header.svg" style="width:100%; height: auto;"></img></a>
        <a href="http://localhost/FeedbackSystem/LogOut.php" id="logout" class="w3-bar-item w3-button w3-padding-large w3-right">Logout</a>
       </div>
      </div>
      <!-- Navbar on small screens -->
      <div id="navDemo" class="w3-bar-block w3-theme-d2 w3-hide w3-hide-large w3-hide-medium w3-large">
        <a href="#" class="w3-bar-item w3-button w3-padding-large">Link 1</a>
        <a href="#" class="w3-bar-item w3-button w3-padding-large">Link 2</a>
        <a href="#" class="w3-bar-item w3-button w3-padding-large">Link 3</a>
        <a href="#" class="w3-bar-item w3-button w3-padding-large">My Profile</a>
      </div>

  <!-- Page Container -->
  <div class="w3-container" style="max-width:auto; min-height: 80vh;">
    <!-- The Grid -->
    <div class="w3-row" style="margin-top: 1vh;">
      <!-- Main Column -->
      <div class="w3-col l8">
        <div class="w3-card-4 w3-white">
                <img src="<?php echo $ImageName; ?>" style="width:100%; max-height:75vh;">
                <?php
                    if(isset($_SESSION['roll_no'])) {
                        if($WriterName == $_SESSION['roll_no']) {
                ?>
                <span class="w3-container w3-right w3-red" style="cursor:pointer;" onclick="deleteblogs();">&times;</span>
                <?php
                        }
                    }
                 ?>
                <div class="w3-container">
                    <h3 class="w3-text-teal"><b><?php echo $Title; ?></b></h3>
                    <h6>WriterName : <span class="w3-tag"><?php echo $WriterName; ?></span></h6>
                    <h6>Story Added : <span class="w3-tag"><?php echo $storyAdded; ?></span></h6>
                </div>
                <hr class="w3-clear">
                <div class="w3-container w3-padding-8" id="BlogContent">
                    <p>
                        <?php echo htmlspecialchars_decode($Content); ?>
                    </p>
                </div>
                <?php
                    if(isset($_SESSION['roll_no'])) {
                        if($WriterName == $_SESSION['roll_no']) {
                ?>
                <div class="w3-margin w3-padding-8 w3-center" id="insertblog" style="padding-bottom: 15px;">
                    <div class="w3-container" id="contentwritingheaderdiv">
                        <div><label onclick="showthisthing(this, \'blogtextdiv\');">Add Text </label></div> |
                        <div><label onclick="showthisthing(this, \'blogimagediv\');">Add Image </label></div> |
                        <div><label onclick="showthisthing(this, \'blogcodesnippetdiv\');">Add Code Snippet </label></div> |
                        <div><label onclick="showthisthing(this, \'blogquotediv\');">Add Quotes </label></div> |
                        <div><label onclick="showthisthing(this, \'bloglinkdiv\');">Add Links </label></div>
                    </div>
                    <div class="w3-container" id="contentwritingdiv">
                        <div id="blogtextdiv" style="display:block;">
                            <textarea class="w3-input w3-border" id="writingcontent" name="writingcontent" placeholder="Write Here.." style="width:100%; display: inline; vertical-align: middle; height:150px;"></textarea>
                            <br><br>
                            <button class="w3-btn w3-blue" id="BlogUpdate" onclick="updateblog('.$sid.');" style="width:24%; height: 60px;">Update</button>
                        </div>
                        <div id="blogimagediv" class="w3-container w3-margin w3-padding-8">
                            <form method="POST" action="updateblog.php?bid='.$sid.'" enctype="multipart/form-data">
                                <input type="file" class="w3-input w3-border w3-green" name="blogimage" id="blogimage" style="display:block;"><br>
                                <input type="submit" class="w3-btn w3-blue" style="width:24%; height: 60px;" value="Add Image">
                            </form>
                        </div>
                        <div id="blogcodesnippetdiv">
                            <form method="POST" action="updateblog.php?bid='.$sid.'">
                                <textarea class="w3-input w3-border" id="writingcontent" name="blogcodesnippet" placeholder="Write Here.." style="width:100%; display: inline; vertical-align: middle; height:150px;"></textarea><br><br>
                                <input type="submit" class="w3-btn w3-blue" style="width:24%; height: 60px;" value="Add this Code">
                            </form>
                        </div>
                        <div id="blogquotediv">
                            <form method="POST" action="updateblog.php?bid='.$sid.'">
                                <textarea class="w3-input w3-border" id="writingcontent" name="blogquote" placeholder="Write Here.." style="width:100%; display: inline; vertical-align: middle; height:60px;"></textarea><br><br>
                                <input type="submit" class="w3-btn w3-blue" style="width:24%; height: 60px;" value="Add this Quote">
                            </form>
                        </div>
                        <div id="bloglinkdiv">
                            <form method="POST" action="updateblog.php?bid='.$sid.'">
                                <h4>Add a Title to Link :</h4>
                                <input class="w3-input w3-border" id="writingcontent" name="bloglinktitle" placeholder="Write Here.." style="display: inline; vertical-align: middle;">
                                <h4>Link :</h4>
                                <input class="w3-input w3-border" id="writingcontent" name="bloglink" placeholder="Write Here.." style="display: inline; vertical-align: middle;"><br><br>
                                <input type="submit" class="w3-btn w3-blue" style="width:45%; height: 60px;" value="Add this Link in your Blog">
                            </form>
                        </div>
                    </div>
                </div>
                <?php
                        }
                    }
                 ?>
            </div>
      <!-- End Main Column -->
      </div>

      <!-- Right Column -->
      <div class="w3-col l4">

      <div class="w3-card-4 w3-margin w3-padding-8 w3-white"></div>

      <!-- End Right Column -->
      </div>

    <!-- End Grid -->
    </div>
  <!-- End Page Container -->
  </div>
  <br>

  <!-- Footer -->
  <footer class="w3-container w3-dark-grey w3-padding-32 w3-margin-top">
    <p class="w3-center">Powered by <a href="" target="_blank">IIITG Herald</p>
  </footer>

  <script type="text/javascript" src="js/jquery-3.1.1.min.js"></script>
  <script type="text/javascript" src="js/menuControlling.js"></script>

  </body>
</html>
