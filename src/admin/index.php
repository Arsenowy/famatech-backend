<?php include("includes/header.php");

if (!$session->is_signed_in()) redirect("login.php");

?>



<h1>Hello <?php echo $session->user_id ?></h1>


<?php include("./includes/footer.php"); ?>