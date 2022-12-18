<?php
session_start(); 
    $title = $_POST['title'];
    $details = $_POST['details'];
    $isAnonymous = $_POST['postAnon'];
    $lat = $_POST['latitude'];
    $lng = $_POST['longitude'];
    $username = $isAnonymous? "Anonymous" : $_SESSION['name'];
    date_default_timezone_set('Asia/Dhaka');
    $date = date('d-m-y h:i:s');
    $link = mysqli_connect("localhost", "root", "", "testdb");
    if($link == false){
        die("ERROR: Could not connect. ". mysqli_connect_error());
    }
    
    $sql = "INSERT INTO reportedcrimes(username,crimeTitle,crimeDescription,time,lat,lng) Values('$username','$title','$details', '$date','$lat', '$lng')"; 
    if(mysqli_query($link, $sql)){
        echo "Records added successfully.";
    }
    else{
        echo "ERROR: Could not able to excute $sql";
    }

    mysqli_close($link);

    echo 'hello';

?>