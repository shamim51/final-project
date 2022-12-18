<?php
include "db_conn.php";

if (isset($_POST['name']) && isset($_POST['user_name']) && isset($_POST['password'])) {
    function validate($data){
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
     }
 
     $name = validate($_POST['name']);
     $user_name = validate($_POST['user_name']);
     $password = validate($_POST['password']);

     if (empty($name)) {
		header("Location: index_register.php?error=Full Name is required");
	    exit();
	}else if(empty($user_name)){
        header("Location: index_register.php?error=User Name is required");
        exit();
    }else if(empty($password)){
        header("Location: index_register.php?error=Password is required");
	    exit();
	}else {
        $check_existing_sql = "SELECT * FROM users WHERE user_name='$user_name'";
        $register_sql = "INSERT INTO users(user_name, password, name) VALUES('$user_name', '$password', '$name')";

        $result = mysqli_query($conn, $check_existing_sql);

        if(mysqli_num_rows($result) >= 1) {
            header("Location: index_register.php?error=User Name already exists");
            exit();
        }else {
            $rows = mysqli_query($conn, $register_sql);
            if($rows) {
                header("Location: index.php?info=Registration Successful. Try logging in");
                exit();
            }else {
                header("Location: index_register.php?error=Error while registration. Please try again");
                exit();
            }
        }
    }
}
else {
    header("Location: index_register.php");
    exit();
}