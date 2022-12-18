<!DOCTYPE html>
<html>
<head>
	<title>LOGIN</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<script type="text/javascript">
    document.getElementById("myButton").onclick = function () {
        location.href = "index_register.php";
    };
</script>

<body>
     <form action="login.php" method="post">
     	<h2>LOGIN</h2>
     	<?php if (isset($_GET['error'])) { ?>
             <p class="error"><?php echo $_GET['error']; ?></p>
         <?php }else if (isset($_GET['info'])) { ?>
            <p class="info"><?php echo $_GET['info']; ?></p>
        <?php } ?>
     	<label>User Name</label>
     	<input type="text" name="uname" placeholder="User Name"><br>

     	<label>Password</label>
     	<input type="password" name="password" placeholder="Password"><br>
		<!-- <button type="submit">Register</button> -->
		<button action="index_register.php" method="get"><a style="text-decoration: none" href="index_register.php">Register</button></a>
     	<button type="submit">Login</button>
     </form>
</body>
</html>