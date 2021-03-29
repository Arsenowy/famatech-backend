<?php include("includes/header.php");

if ($session->is_signed_in()) {
	redirect('index.php');
}

if (isset($_POST['submit'])) {
	$username = trim(htmlentities($_POST['username']));
	$password = trim(htmlentities($_POST['password']));

	//verify user
	$user_found = User::verify_user($username, $password);

	if ($user_found) {
		$session->login($user_found);
		redirect('index.php');
	} else $the_message = "Your password or username are incorrect";
} else {
	$the_message = "";
	$username = "";
	$password = "";
}

?>

<div class="container">
	<div class="row d-flex justify-content-center my-5">
		<div class="col-6">
			<form method="POST">
			<h4 class="bg-danger"><?php echo $the_message ?></h4>
				<div class="form-group my-2">
					<label for="username">Username</label>
					<input type="text" name="username" class="form-control" placeholder="Enter username" value="<?php echo htmlentities($username) ?>">
				</div>
				<div class="form-group my-2">
					<label for="password">Password</label>
					<input type="password" name="password" class="form-control" placeholder="Enter password" value="<?php echo htmlentities($password) ?>">
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