<?php include("includes/header.php");

if ($session->is_signed_in()) {
    redirect('index.php');
}
$user = new User();

$the_message = "";
$username = "";
$password = "";
$first_name = "";

if (isset($_POST['create'])) {
    $username = trim(htmlentities($_POST['username']));
    $password = trim(htmlentities($_POST['password']));
    $first_name = trim(htmlentities($_POST['first_name']));

    $user->username = $username;
    $user->password = $password;
    $user->first_name = $first_name;


    if ($user->check_availability()) {
        if ($user->save()) {
            $the_message = "";
            redirect('login-after-register.php');
        } else $the_message = "Something went wrong";
    } else {
        $the_message = "This username is not available";
    }
}

?>

<div class="form_container">
    <a class="button button__back" href="login.php">Back to login</a>
    <div class="form_row">
        <form method="POST">
            <h1 class="form_title">Register</h1>
            <p class="form_message"><?php echo $the_message ?></p>
            <div class="form-group my-2">
                <input required pattern=".{5,32}" autocomplete="off" type="text" name="username" id="register-username" class="form-control form-input bg-color-dark form-yellow" placeholder="Enter username" value="<?php echo htmlentities($username) ?>" title="Username must have at least 5 characters.">
            </div>
            <div class="form-group my-2">
                <input required pattern=".{8,32}" type="password" name="password" id="register-password" class="form-control form-input bg-color-dark form-yellow" placeholder="Enter your password" value="<?php echo htmlentities($password) ?>" title="Password must have at least 8 characters.">
            </div>
            <div class="form-group my-2">
                <input required pattern="[A-Za-z]{2,32}" autocomplete="off" type="text" name="first_name" id="register-name" class="form-control form-input bg-color-dark form-yellow" placeholder="Enter your name" value="<?php echo htmlentities($first_name) ?>" title="Name must have at least 2 characters. Only letters are allowed.">
            </div>
            <button id="register-button" type="submit" name="create" class="form-control form-btn my-5 form-yellow">Submit</button>
            <div class="form-group text-center">
                <a class="form-link" href="#">At the time of registration, you accept the EULA</a>
            </div>
        </form>
    </div>
</div>

<?php if ($the_message == "This username is not available") {
    echo "<script language='javascript'>
            var username = document.querySelector('#register-username');
            username.style.borderColor = '#b81515';
            username.addEventListener('click', el => {
                if (username.style.borderColor) username.style.borderColor = '#d4bc35';
            })
            </script>";
            }?>
<?php include("./includes/footer.php"); ?>