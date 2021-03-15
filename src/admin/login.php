<?php include("includes/header.php");

if ($session->is_signed_in()) {
	redirect('index.php');
}

if (isset($_POST['submit'])) {
	$username = trim(htmlentities($_POST['username']));
	$password = trim(htmlentities($_POST['password']));

	//verify user
	$user_found->id = 2;

	$session->login($user_found);
	redirect('index.php');
}
?>

<div class="container">
	<div class="row d-flex justify-content-center my-5">
		<div class="col-6">
			<form method="POST">
				<div class="form-group my-2">
					<label for="username">Username</label>
                    <input type="text" name="username" class="form-control" placeholder="Enter username">
				</div>
				<div class="form-group my-2">
					<label for="password">Password</label>
                    <input type="password" name="password" class="form-control" placeholder="Enter password">
				</div>
				<div class="form-group">
					<a href="register.php">Don't you have an account yet? Register now!</a>
				</div>
				<button type="submit" name="submit" class="btn btn-primary my-2">Submit</button>
			</form>
		</div>
	</div>
</div>

<?php include("./includes/footer.php"); ?>



