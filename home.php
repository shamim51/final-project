<?php
include_once 'db_conn.php';
session_start();
$result = mysqli_query($conn,"SELECT * FROM reportedcrimes");
$markers = array();
while ($row = mysqli_fetch_array($result)) {
    $markers[] = array(
        'username' => $row['username'],
        'crimeTitle' => $row['crimeTitle'],
        'crimeDescription' => $row['crimeDescription'],
        'time'=>$row['time'],
        'latitude'=>$row['lat'],
        'longitude'=>$row['lng']
    );
}
$markersJson = json_encode($markers);
if (isset($_SESSION['id']) && isset($_SESSION['user_name'])) {
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script type="text/javascript" src="http://code.jquery.com/jquery-latest.min.js"></script>
    <title>Amar Dhaka</title>

    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.3/dist/leaflet.css"
    integrity="sha256-kLaT2GOSpHechhsozzB+flnD+zUyjE2LlfWPgU04xyI="
    crossorigin=""/>

        <!-- Make sure you put this AFTER Leaflet's CSS -->
    <script src="https://unpkg.com/leaflet@1.9.3/dist/leaflet.js"
    integrity="sha256-WBkoXOwTeyKclOHuWtc+i2uENFpDZ9YPdf5Hf+D7ewM="
    crossorigin=""></script>

    <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:ital,wght@0,200;0,400;0,700;1,400&display=swap"
        rel="stylesheet">
    
    <link rel="stylesheet" href="index.css">

   
    <link rel="stylesheet" href="./dist/MarkerCluster.css">
    <link rel="stylesheet" href="./dist/MarkerCluster.Default.css">

    <script src="area/statesUs.js"></script>
    <script src="area/dhanMondi.js"></script>
    <script src="area/kalabagan.js"></script>
    <script src="area/purbachal.js"></script>
    <script src="area/uttaraSector3.js"></script>
    <script src="area/bashundhara.js"></script>
    <script src="area/lalmatia.js"></script>
    <script src="area/shyamoli.js"></script>
    <script src="area/jigatola.js"></script>
    <script src="area/sherEbanglaNagar.js"></script>
    <script src="area/monipuripara.js"></script>
    <script src="area/tejgaon.js"></script>
    <script src="area/motijheel.js"></script>
    <script src="area/dhakaCityCorporation.js"></script>
    <script src="area/uttara.js"></script>
    <script src="area/crime.js"></script>
    <script src="cityCorporationCoordinates.js"></script>
    <script src="area/bangladesh.js"></script>
    <script src="area/ramna.js"></script>
    <script src="area/crimeList.js"></script>

    <script src="./dist/leaflet.markercluster.js"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;900&display=swap" rel="stylesheet">    
    
    <link rel="stylesheet" href="homeStyle.css">
</head>
<script>
  $(document).ready(function(){
      $("form").on("submit", function(event){
          event.preventDefault();
          alrm();
          // $("#alarmmsg").text("");
          var formValues= $(this).serialize();
          $.post("mapStory.php", formValues, function(data){
              // Display the returned data in browser
              $("#result").html(data);
          });
      });
  });
  function alrm(){
         document.getElementById("alarmmsg").innerHTML = "Complaint Submitted";
          setTimeout(function(){
              document.getElementById("alarmmsg").innerHTML = '';
              document.getElementById("longitude").value = '';
              document.getElementById("latitude").value = '';
              document.getElementById("title").value = '';
              document.getElementById("details").value = '';
          }, 3000);
  }
  const obj = JSON.parse('<?= $markersJson ; ?>');
  // console.log(obj);
</script>
<body>
    <div class="topnav">
        <div class="logout-container">
         <a href="logout.php">Logout</a>
        </div>
    </div>
    <div class="container">
        <div class="leftContainer">
            <div class="heading">
                 <h1 style="float:center;"> Logged in as : <strong style="color:red;"><?php echo $_SESSION['name']; ?></strong></h1>
                  <h1 style="font-family: 'Roboto', sans-serif;"><label for="details">Report Crime:</label></h1>
                   <fieldset style="color:black;background-color: bisque;">
                    <legend><strong>Enter Crime Description</strong></legend>
                    <form>
                      <input type="text" id="title" name="title" size="20" placeholder="       Enter title " required>
                      <textarea id="details" name="details" rows="4" cols="50" placeholder="Enter details of the crime" required></textarea>
                      <br><br>
                      <label>Click on the map to get co-ordinates:</label><br>
                      <input type="text" id="longitude" name="longitude"  placeholder=" longitude " required readonly>
                      <input type="text" id="latitude" name="latitude"  placeholder=" latitude " required readonly>
                      <br><br>
                      <input type="checkbox" id="postAnon" name="postAnon" value="postAnon">
                      <label for="postAnon">Post Anonymously</label><br><br>
                      <input class="glow-on-hover" type="submit" value="Map This Crime">
                    </form>
                    <p style="color:green;" id="alarmmsg"></p>
                    </fieldset>
            </div>
            
            <div>
                <h1 style="text-align:center;">Stories</h1>
                <ul class="list">
                    
                </ul>
            </div>
            
        </div>
        <div class="rightContainer" class="Div">
            <div class="Div">
                <table>
                    <tr>
                        <td>
                            <button onclick="showArea()">Show Area wise crime </button>
                        </td>
                        <td>
                            <button>show nearby parking</button>
                        </td>
                    </tr>
                </table>
            </div>
            <div id="map" class="Div"></div>
            
        </div>
    </div>
</body>
<script src="index.js"></script>
</html>
<?php 
}else{
     header("Location: index.php");
     exit();
}
 ?>