<!DOCTYPE html>
<html>
<title>IIITG Hearld</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">
<style>
body,h1,h2,h3,h4,h5 {font-family: "Raleway", sans-serif}
a {
    text-decoration: none;
}
</style>
<body class="w3-light-grey">
    <div class="w3-content" style="max-width:1400px">

    <!-- Header -->
    <header class="w3-container w3-center w3-padding-32">
        <h1><b>IIITG Hearld</b></h1>
        <p>Welcome to the world of <span class="w3-tag"><a href="http://localhost/FeedbackSystem/">IIITG</a></span></p>
    </header>

    <!-- Grid -->
    <div class="w3-row">
        <!-- Introduction menu -->
        <div class="w3-col l4">
          <!-- About Card -->
          <div class="w3-margin w3-padding-4 w3-center">
              <button class="w3-btn w3-blue" onclick="document.getElementById('createblog').style.display='block';">Create a new Story</button>
              <div id="createblog" class="w3-modal w3-animate-zoom">
                <div class="w3-modal-content">
                  <span onclick="document.getElementById('createblog').style.display='none'" class="w3-closebtn w3-hover-red w3-container w3-xlarge w3-right">&times;</span>
                  <div class="w3-container w3-white">
                    <form action="#" method="POST" enctype="multipart/form-data">
                      <br>
                      <h3 class="w3-text-teal">STORY DETAILS</h3>
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
          <hr>

          <!-- Posts -->
          <div class="w3-card w3-margin">
            <div class="w3-container w3-padding">
              <h4>Popular Posts</h4>
            </div>
            <ul class="w3-ul w3-hoverable w3-white">
              <li class="w3-padding-16">
                <img src="/w3images/workshop.jpg" alt="Image" class="w3-left w3-margin-right" style="width:50px">
                <span class="w3-large">Lorem</span><br>
                <span>Sed mattis nunc</span>
              </li>
            </ul>
          </div>
          <hr>

        <!-- END Introduction Menu -->
        </div>



        <!-- Blog entries -->
        <div class="w3-col l8 s12">
          <!-- Blog entry -->
          <?php
              require 'connect.php';
              $result = $conn->query("SELECT * FROM `herald`");
              while($row = $result->fetch_assoc()) {
                  $sid = $row['sid'];
                  $WriterName = $row['writerID'];
                  $Title = $row['Title'];
                  $Content = $row['Content'];
                  $ImageName = $row['Image'];
                  $storyAdded = $row['storyAdded'];

           ?>
          <div class="w3-card-4 w3-margin w3-white">
            <img src="<?php echo $ImageName; ?>" alt="Nature" style="width:100%">
            <div class="w3-container">
              <h3><b><?php echo $Title; ?></b></h3>
              <h5>Title description, <span class="w3-opacity"><?php echo $storyAdded; ?></span></h5>
            </div>

            <div class="w3-container">
              <p>
                  <?php echo htmlspecialchars_decode($Content); ?>
              </p>
              <div class="w3-row">
                <div class="w3-col m8 s12">
                  <p><a href="story.php?sid=<?php echo $sid; ?>">
                      <button class="w3-button w3-padding-large w3-white w3-border">
                          <b>READ MORE »</b>
                      </button>
                  </a></p>
                </div>
                <div class="w3-col m4 w3-hide-small">
                  <p><span class="w3-padding-large w3-right">
                      <b>Comments  </b>
                      <span class="w3-tag">0</span>
                  </span></p>
                </div>
              </div>
            </div>
          </div>
          <?php
            }
           ?>
          <hr>

    <!-- END BLOG ENTRIES -->
    </div>

<!-- END GRID -->
</div><br>

<!-- END w3-content -->
</div>

    <!-- Footer -->
    <footer class="w3-container w3-dark-grey w3-padding-32 w3-margin-top w3-center">
      <!-- <button class="w3-button w3-black w3-disabled w3-padding-large w3-margin-bottom">Previous</button>
      <button class="w3-button w3-black w3-padding-large w3-margin-bottom">Next »</button> -->
      <p>Powered by <a href="http://iiitg.ac.in" target="_blank">IIITG</a></p>
    </footer>

</body>
</html>
