<!DOCTYPE html>
<html>
<head>
	<title>REGISTER</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
     <form action="register.php" method="post">
     	<h2>REGISTER</h2>
     	<?php if (isset($_GET['error'])) { ?>
     		<p class="error"><?php echo $_GET['error']; ?></p>
     	<?php }else if (isset($_GET['info'])) { ?>
			<p class="info"><?php echo $_GET['info']; ?></p>
		<?php } ?>
		 <label>Full Name</label>
     	<input type="text" name="name" placeholder="Full Name"><br>

     	<label>User Name</label>
     	<input type="text" name="user_name" placeholder="User Name"><br>

     	<label>Password</label>
     	<input type="password" name="password" placeholder="Password"><br>

     	<button type="submit">Register</button>
     </form>
</body>
</html>
