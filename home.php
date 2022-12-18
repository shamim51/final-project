<?php 
session_start();

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
  
</script>
<body>
    <style>
        body {
          font-family: Arial, sans-serif;
        }
        header, footer {
          display: flex;
          flex-direction: row;
        }
        header .profile-thumbnail {
          width: 50px;
          height: 50px;
          border-radius: 4px;
        }
        header .profile-name {
          display: flex;
          flex-direction: column;
          justify-content: center;
          margin-left: 10px;
        }
        header .follow-btn {
          display: flex;
      
          margin: 0 0 0 auto;
        }
        header .follow-btn button {
          border: 0;
          border-radius: 3px;
          padding: 5px;
        }
        header h3, header h4 {
          display: flex;
          margin: 0;
        }
        #inner p {
          margin-bottom: 10px;
          font-size: 20px;
        }
        #inner hr {
          margin: 20px 0;
          border-style: solid;
          opacity: 0.1;
        }
        footer .stats {
          display: flex;
          font-size: 15px;
        }
        footer .stats strong {
          font-size: 18px;
        }
        footer .stats .likes {
          margin-left: 10px;
        }
        footer .cta {
          margin-left: auto;
        }
        footer .cta button {
          border: 0;
          background: transparent;
        }
        .btn{

           background-color: rgb(0, 255, 213);

        }
        .btn:active{

           background-color: rgb(123, 180, 17);
 
        }
        .topnav {
          overflow: hidden;
          background-color: #333;
        }
        .topnav a {
          float: left;
          color: #f2f2f2;
          text-align: center;
          padding: 14px 16px;
          text-decoration: none;
          font-size: 17px;
        }

        .topnav a:hover {
          background-color: #ddd;
          color: black;
        }

        .topnav a.active {
          background-color: #04AA6D;
          color: white;
        }
        .button {
        background-color: #4CAF50;
        border: none;
        color: white;
        padding: 15px 32px;
        text-align: center;
        text-decoration: none;
        display: inline-block;
        font-size: 16px;
        margin: 4px 2px;
        cursor: pointer;
      }
      .logout-container {
        float: right;
        padding: 6px 10px;
        margin-top: 8px;
        margin-right: 16px;
        background-color: #555;
        color: white;
        font-size: 17px;
        border: none;
        cursor: pointer;
      }
      .topnav button {
        float: right;
        padding: 6px 10px;
        margin-top: 8px;
        margin-right: 16px;
        background-color: #555;
        color: white;
        font-size: 17px;
        border: none;
        cursor: pointer;
      }

       .topnav .logout-container button:hover {
        background-color: green;
      }
      legend {
        margin:0 auto;
      }
      .glow-on-hover {
        width: 220px;
          height: 50px;
          border: none;
          outline: none;
          color: #fff;
          background: #111;
          cursor: pointer;
          position: relative;
          z-index: 0;
          border-radius: 10px;
      }

      .glow-on-hover:before {
          content: '';
          background: linear-gradient(45deg, #ff0000, #ff7300, #fffb00, #48ff00, #00ffd5, #002bff, #7a00ff, #ff00c8, #ff0000);
          position: absolute;
          top: -2px;
          left:-2px;
          background-size: 400%;
          z-index: -1;
          filter: blur(5px);
          width: calc(100% + 4px);
          height: calc(100% + 4px);
          animation: glowing 20s linear infinite;
          opacity: 0;
          transition: opacity .3s ease-in-out;
          border-radius: 10px;
      }

      .glow-on-hover:active {
          color: #000
      }

      .glow-on-hover:active:after {
          background: transparent;
      }

      .glow-on-hover:hover:before {
          opacity: 1;
      }

      .glow-on-hover:after {
          z-index: -1;
          content: '';
          position: absolute;
          width: 100%;
          height: 100%;
          background: #111;
          left: 0;
          top: 0;
          border-radius: 10px;
      }

      @keyframes glowing {
          0% { background-position: 0 0; }
          50% { background-position: 400% 0; }
          100% { background-position: 0 0; }
      }
      </style>
      
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