<?php
    $title = $_POST['title'];
    $details = $_POST['details'];
    
    $lat = $_POST['latitude'];
    $lng = $_POST['longitude'];

   
    $link = mysqli_connect("localhost", "root", "", "testdb");

    if($link == false){
        die("ERROR: Could not connect. ". mysqli_connect_error());
    }

    $sql = "INSERT INTO story(title, details, lat, lng) Values('$title', '$details', '$lat', '$lng')";
    if(mysqli_query($link, $sql)){
        echo "Records added successfully.";
    }
    else{
        echo "ERROR: Could not able to excute $sql". mysql_error($link);

    }

    mysqli_close($link);

    echo 'hello';

?>