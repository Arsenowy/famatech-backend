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
                <div class="form-group my-2">
                    <label for="first_name">First name</label>
                    <input type="text" name="first_name" class="form-control" placeholder="Enter your name" value="<?php echo htmlentities($password) ?>">
                </div>
                <button type="submit" name="create" class="btn btn-primary my-2">Register</button>
            </form>
        </div>
    </div>
</div>

<?php include("./includes/footer.php"); ?>