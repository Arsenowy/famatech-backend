<?php include("includes/header.php");

if ($session->is_signed_in()) {
    redirect('index.php');
}
$user = new User();

if (isset($_POST['create'])) {
    $username = trim(htmlentities($_POST['username']));
    $password = trim(htmlentities($_POST['password']));
    $first_name = trim(htmlentities($_POST['first_name']));

    $user->username = $username;
    $user->password = $password;
    $user->first_name = $first_name;

    if ($user->save()) {
        redirect('index.php');
    } else $the_message = "Something went wrong";

} else {
    $the_message = "";
    $username = "";
    $password = "";
    $first_name = "";
}

?>

<div class="form_container">
<a class="button button__back" href="login.php">Back to login</a>
	<div class="form_row">
		<form method="POST">
			<h1 class="form_title">Register</h1>
			<div class="form-group my-2">
				<input required  autocomplete="off" type="text" name="username" class="form-control form-input bg-color-dark form-yellow" placeholder="Enter username" value="<?php echo htmlentities($username) ?>">
			</div>
			<div class="form-group my-2">
				<input  required type="password" name="password" class="form-control form-input bg-color-dark form-yellow" placeholder="Enter your password" value="<?php echo htmlentities($password) ?>">
			</div>
            <div class="form-group my-2">
                <input required  autocomplete="off" type="text" name="first_name" class="form-control form-input bg-color-dark form-yellow" placeholder="Enter your name" value="<?php echo htmlentities($first_name) ?>">
			</div>
			<button type="submit" name="create" class="form-control form-btn my-5 form-yellow">Submit</button>
            <div class="form-group text-center">
				<a class="form-link" href="register.php">At the time of registration, you accept the EULA</a>
			</div>
		</form>
	</div>
</div>

<?php include("./includes/footer.php"); ?>