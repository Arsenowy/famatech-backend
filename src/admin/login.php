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

<div class="form_container">
	<div class="form_row">
		<form method="POST">
			<h1 class="form_title">login</h1>
			<div class="form-group my-2">
				<input autocomplete="off" type="text" name="username" class="form-control form-input bg-color-dark form-blue" placeholder="Enter username" value="<?php echo htmlentities($username) ?>">
			</div>
			<div class="form-group my-2">
				<input type="password" name="password" class="form-control form-input bg-color-dark form-blue" placeholder="Enter password" value="<?php echo htmlentities($password) ?>">
			</div>
			<button type="submit" name="submit" class="form-control form-btn my-4 mt-5 form-blue">Submit</button>
			<div class="form-group text-center">
				<a class="form-link" href="register.php">Don't you have an account yet? Register now!</a>
			</div>
		</form>
	</div>
</div>

<?php include("./includes/footer.php"); ?>