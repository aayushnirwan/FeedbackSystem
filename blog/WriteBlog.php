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

  if(isset($_GET['bid'])){
    if(!empty($_GET['bid'])){
      $bid = htmlentities($_GET['bid']);
      $result = $conn->query("SELECT * FROM `blog` WHERE `id`='{$bid}'");
        if($row = $result->fetch_assoc());
        else
          header('Location: MyBlog.php');
    } else
      header('Location: MyBlog.php');
  } else
    header('Location: MyBlog.php');
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
    </style>
    <title><?php echo $Username; ?> - Blog</title>
  </head>

  <body class="w3-light-grey">

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
    <div class="w3-row" style="margin-top: 1vh;">
      <!-- Main Column -->
      <div class="w3-col l8">
        <?php
          $result = $conn->query("SELECT * FROM `blog` WHERE `id`='{$bid}'");
              if($result){
                if($row = $result->fetch_assoc()){
                  $WriterName = $row['WriterName'];
                  $Title = $row['Title'];
                  $Content = $row['Content'];
                  echo '<div class="w3-card-4 w3-white">';
                  $ImageName = $row['ImageName'];
                  echo '<img src="'.$ImageName.'" style="width:100%; max-height:75vh;">';
                  if($row['WriterId'] == $UserID){
                    echo '<span class="w3-container w3-right w3-red" style="cursor:pointer;" onclick="deleteblogs(this, '.$row['id'].');">&times;</span>';
                  }
                  echo '<div class="w3-container"><h3 class="w3-text-teal"><b>'.$row['Title'].'</b></h3>';
                  echo '<h6>Tag : <span class="w3-tag">'.$row['Tag'].'</span></h6>
                        <h6>WriterName : <span class="w3-tag">'.$row['WriterName'].'</span></h6>
                        <h6>Last Updated On : <span class="w3-tag">'.$row['LastUpdatedOn'].'</span></h6>
                        </div><hr class="w3-clear">';
                  echo '<div class="w3-container w3-padding-8" id="BlogContent"><p>'.htmlspecialchars_decode($Content).'</p></div>';
                  if($row['WriterId'] == $UserID){
                    echo '<div class="w3-margin w3-padding-8 w3-center" id="insertblog">
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
                                <button class="w3-btn w3-blue" id="BlogUpdate" onclick="updateblog('.$bid.');" style="width:24%; height: 60px;">Update</button>
                              </div>
                              <div id="blogimagediv" class="w3-container w3-margin w3-padding-8">
                                <form method="POST" action="updateblog.php?bid='.$bid.'" enctype="multipart/form-data">
                                  <input type="file" class="w3-input w3-border w3-green" name="blogimage" id="blogimage" style="display:block;"><br>
                                  <input type="submit" class="w3-btn w3-blue" style="width:24%; height: 60px;" value="Add Image">
                                </form>
                              </div>
                              <div id="blogcodesnippetdiv">
                                <form method="POST" action="updateblog.php?bid='.$bid.'">
                                  <textarea class="w3-input w3-border" id="writingcontent" name="blogcodesnippet" placeholder="Write Here.." style="width:100%; display: inline; vertical-align: middle; height:150px;"></textarea><br><br>
                                  <input type="submit" class="w3-btn w3-blue" style="width:24%; height: 60px;" value="Add this Code">
                                </form>
                              </div>
                              <div id="blogquotediv">
                                <form method="POST" action="updateblog.php?bid='.$bid.'">
                                  <textarea class="w3-input w3-border" id="writingcontent" name="blogquote" placeholder="Write Here.." style="width:100%; display: inline; vertical-align: middle; height:60px;"></textarea><br><br>
                                  <input type="submit" class="w3-btn w3-blue" style="width:24%; height: 60px;" value="Add this Quote">
                                </form>
                              </div>
                              <div id="bloglinkdiv">
                                <form method="POST" action="updateblog.php?bid='.$bid.'">
                                  <h4>Add a Title to Link :</h4>
                                  <input class="w3-input w3-border" id="writingcontent" name="bloglinktitle" placeholder="Write Here.." style="display: inline; vertical-align: middle;">
                                  <h4>Link :</h4>
                                  <input class="w3-input w3-border" id="writingcontent" name="bloglink" placeholder="Write Here.." style="display: inline; vertical-align: middle;"><br><br>
                                  <input type="submit" class="w3-btn w3-blue" style="width:45%; height: 60px;" value="Add this Link in your Blog">
                                </form>
                              </div>
                            </div>
                          </div>';
                    }       
                  echo '</div>';

            }
          }
        ?>
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