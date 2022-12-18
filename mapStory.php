<?php
    $title = $_POST['title'];
    $details = $_POST['details'];
    
    $lat = $_POST['latitude'];
    $lng = $_POST['longitude'];
    date_default_timezone_set('Asia/Dhaka');
    $date = date('d-m-y h:i:s');
    $link = mysqli_connect("localhost", "root", "", "testdb");

    if($link == false){
        die("ERROR: Could not connect. ". mysqli_connect_error());
    }

    $sql = "INSERT INTO reportedcrimes(username,crimeTitle,crimeDescription,time,lat,lng) Values('luna','$title','$details', '$date','$lat', '$lng')"; 
    if(mysqli_query($link, $sql)){
        echo "Records added successfully.";
    }
    else{
        echo "ERROR: Could not able to excute $sql";
    }

    mysqli_close($link);

    echo 'hello';

?>