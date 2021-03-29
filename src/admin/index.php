<?php include("includes/header.php");

if (!$session->is_signed_in()) redirect("login.php");
// currently logged in user
$user_id = $session->user_id;

$user = User::find_by_id($user_id);
//////////////////////////////
$notes = Note::find_notes_by_author($user_id);

?>
<a class="btn btn-danger" href="logout.php">Logout</a>
<div class="row d-flex justify-content-center my-5">
    <div class="col-6">
        <h1>Hello <?php echo $user->first_name ?></h1>
        <a class="btn btn-dark" href="add_note.php">Add note</a>
    </div>
</div>
<div class="row d-flex justify-content-left">
    <?php foreach ($notes as $note) : ?>
    <div class="col-3 m-5 p-4 bg-success text-white">
        <h3><?php echo $note->title; ?></h3>
        <p><?php echo $note->body; ?></p>
        <a href="delete_note.php?id=<?php echo $note->id ?>">X</a>
    </div>
    <?php endforeach ?>
</div>


<?php include("./includes/footer.php"); ?>
