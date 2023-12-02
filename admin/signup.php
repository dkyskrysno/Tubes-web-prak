<?php 

	include("../inc/koneksi.php");
	global $connect;

if (isset($_POST['tambahuser'])) {

	$email = $_POST['email'];
	$nama = $_POST['nama'];
	$username = $_POST['username'];
	$password = $_POST['password'];

	$query = "SELECT * FROM administrator WHERE username = '$username' OR email = '$email'";

	$result = mysqli_query($connect, $query);
	$row = mysqli_num_rows($result);

	if ($row > 0) {
		$error = "<div class='alert alert-danger' role='alert'>
  					Username Atau Email Sudah Pernah DIBUATKAN!
				  </div>";
		echo $error;
	} else {
		$sql = mysqli_query($connect, "INSERT INTO administrator VALUES ('', '$email', '$nama', '$username', '$password')");
		echo "<script> alert('Data Admin Berhasil Ditambahkan'); </script>";
	}
}

if (isset($_POST['edituser'])) {

	$email = $_POST['email'];
	$nama = $_POST['nama'];
	$username = $_POST['username'];
	$password = $_POST['password'];
	$id = $_GET['id'];

	$query = "UPDATE administrator SET email= '$email', Nama= '$nama', username= '$username' WHERE ID = '$id'";
	$sql = mysqli_query($connect, $query);

	echo "<script> 
			alert('Data Berhasil Diubah'); 
			document.location.href = '?mod=useradmin';
		  </script>";
}

if (isset($_GET['act']) && $_GET['act'] =='edit') {

	$id = $_GET['id'];
	$query = "SELECT * FROM administrator WHERE ID = '$id'";
	$sql = mysqli_query($connect,$query);
	$hasil = mysqli_fetch_assoc($sql);
	$email = $hasil['email'];
	$nama = $hasil['Nama'];
	$username = $hasil['username'];
	$password = $hasil['password'];

}

if (isset($_GET['act']) && $_GET['act'] =='hapus') {

	$id = $_GET['id'];
	$query = "DELETE FROM administrator WHERE ID = '$id'";
	$sql = mysqli_query($connect,$query);
	$error = "	<script> 
				alert('Data Berhasil Dihapus'); 
				document.location.href = '?mod=useradmin';
		  		</script>";
	echo $error;
}


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    <link rel="stylesheet" href="../assets/signup.css">
</head>
<body>
<form class="text-left" action="" method="POST">
	<input type="hidden" name="userid" value="<?php if (isset($_GET['act']) && $_GET['act'] =='edit') { echo $id; } ?>">
	<fieldset class="border p-2">
		<legend  class="w-auto">SIGN UP</legend>
	<div class="form-group">
    <label>Email</label>
    <input type="text" value="<?php if (isset($_GET['act']) && $_GET['act'] =='edit') { echo $email; } ?>" name="email" class="form-control col-6" placeholder="Email Address" required>
    <label>Nama User</label>
    <input type="text" value="<?php if (isset($_GET['act']) && $_GET['act'] =='edit') { echo $nama; } ?>" name="nama" class="form-control col-6" placeholder="Nama Lengkap" required>
    <label>Username</label>
    <input type="text" value="<?php if (isset($_GET['act']) && $_GET['act'] =='edit') { echo $username; } ?>" name="username" class="form-control col-6" placeholder="Username" required>
    <label>Password</label>
    <input type="text" value="<?php if (isset($_GET['act']) && $_GET['act'] =='edit') { echo $password; } ?>" name="password" class="form-control col-6" placeholder="Password" required>

    <button class="btn btn-lg btn-primary btn-block text-uppercase mt-4 col-2" type="submit"
    name="<?=(isset($id) ? 'edituser' : 'tambahuser')?>"> <?=(isset($id) ? 'EDIT' : 'TAMBAH')?> </button>

    <br><p class="btn">Sudah Punya Akun? <a href="ceklogin.php">Login</a></p>

  	</div>
  	</fieldset>
</form>
</body>
</html>