<?php
session_start();

require "koneksi.php";

?>

<!DOCTYPE html>
<html>
<head>
	<title>Login</title>
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<link href="https://fonts.googleapis.com/css?family=Poppins:600&display=swap" rel="stylesheet">
	<script src="https://kit.fontawesome.com/a81368914c.js"></script>
	<meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
	<div class="container">
		<center><div class="img">
			<img src="img/orang3.png">
		</div></center>
		<div class="login-content">
			<form action=""method="post">
				<h2 class="title">Welcome</h2>
           		<div class="input-div one">
           		   <div class="i">
           		   		<i class="fas fa-user"></i>
           		   </div>
           		   <div class="div">
           		   		<h5>Username</h5>
           		   		<input name="username" type="text" class="input">
           		   </div>
           		</div>
           		<div class="input-div pass">
           		   <div class="i"> 
           		    	<i class="fas fa-lock"></i>
           		   </div>
           		   <div class="div">
           		    	<h5>Password</h5>
           		    	<input name="password" type="password" class="input">
            	   </div>
            	</div>
            	<a href="#">Forgot Password?</a>
            	<input name="Login" type="submit" class="btn" value="Login">
            </form>
        </div>
    </div>
    <script type="text/javascript" src="js/main.js"></script>
</body>

</html>

<?php
if (isset($_POST['Login'])) {
    $sql = "SELECT * from login WHERE username = '$_POST[username]' AND password = '$_POST[password]'";
    $result = mysqli_query($koneksi, $sql);
    $row = $result->fetch_assoc();

    $cek = mysqli_num_rows($result);
    if ($cek > 0) {
        if ($row['role'] == 'Admin') {
            $_SESSION['username'] = $_POST['username'];
            $_SESSION['id'] = $row['id'];
            ?>
                <script type="text/javascript">
                    window.location.assign('admin/home.php');
                </script>
            <?php
        }
        else {
            $_SESSION['username'] = $_POST['username'];
            $_SESSION['id'] = $row['id'];
            ?>
                <script type="text/javascript">
                    window.location.assign('user/Landing.php');
                </script>
            <?php
        }
    } else { ?>
        <script>
            alert('Username atau Password Salah!');
            window.location.assign('login.php');
        </script>
<?php
        echo "<meta http-equiv=refresh content=2; URL='login.php'>";
    }
}
?>