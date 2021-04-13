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
        <div class="note__buttons d-flex">
            <a class="button button__add-note" href="save_note.php">Add note</a>
            <a class="button button__logout" href="logout.php">Logout</a>
        </div>
    </div>
</div>

<div class="row m-0 justify-content-center justify-content-xl-start note__notes <?php if (count($notes) > 3) echo "justify-content-center" ?>">
    <?php foreach ($notes as $note) : ?>
        <div class="col-xs-7 col-sm-8 col-md-4 col-xl-3 col-xxl-2 m-4 p-4 text-white note__element">
            <h3><?php echo $note->title; ?></h3>
            <p><?php echo $note->body; ?></p>
            <a class="note__delete" href="delete_note.php?id=<?php echo $note->id ?>"><i class="fas fa-times"></i></a>
            <a class="note__edit" href="save_note.php?id=<?php echo $note->id ?>">Edit note...</a>
        </div>
    <?php endforeach ?>
</div>

<script src="color_notes.js"></script>
<?php include("./includes/footer.php"); ?>