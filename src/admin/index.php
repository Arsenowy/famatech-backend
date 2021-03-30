<?php include("includes/header.php");

if (!$session->is_signed_in()) redirect("login.php");
// currently logged in user
$user_id = $session->user_id;

$user = User::find_by_id($user_id);
//////////////////////////////
$notes = Note::find_notes_by_author($user_id);

?>
<div class="d-flex note__container ">
    <div class="col note__container">
        <h1 class="text-white note__heading">Hello <strong><?php echo $user->first_name ?>!</strong></h1>
        <h2 class="text-white note__subheading">What are you thinking about today? </h2>
        <a class="button button__add-note" href="add_note.php">Add note</a>
    </div>
    <div class="col note__menu d-flex justify-content-end">
        <a class="button button__logout" href="logout.php">Logout</a>
    </div>
</div>

<div class="row m-0 p-5">
    <?php foreach ($notes as $note) : ?>
        <div class="col-sm-5 col-md-4 col-xl-3 col-xxl-2 m-4 p-3 text-white note__element">
            <h3><?php echo $note->title; ?></h3>
            <p><?php echo $note->body; ?></p>
            <a class="note__delete" href="delete_note.php?id=<?php echo $note->id ?>"><i class="fas fa-times"></i></a>
        </div>
    <?php endforeach ?>
</div>

<script src="color_notes.js"></script>
<?php include("./includes/footer.php"); ?>