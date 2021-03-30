<?php
include("includes/header.php");

if (!$session->is_signed_in()) redirect("login.php");

if (isset($_GET['id'])) {
    $note = Note::find_by_id($_GET['id']);
} else $note = new Note();

if (isset($_POST['create_note'])) {
    $title = trim(htmlentities($_POST['title']));
    $body = trim(htmlentities($_POST['body']));
    $category = $_POST['category'];

    if ($note) {
        $note->title = $title;
        $note->body = $body;
        $note->category = $category;
        $note->author = $session->user_id;
        $note->save();
        redirect('index.php');
    }
}
?>
<div class="form_container">
    <a class="button button__logout" href="logout.php">Logout</a>
    <a class="button button__back" href="index.php">Back</a>
    <div class="form_row">
        <form method="POST">
            <h1 class="form_title">Add new note</h1>
            <div class="form-group my-2">
                <input autocomplete="off" type="text" name="title" class="form-control form-input bg-color-dark form-blue" placeholder="Enter title" value="<?php $note->title ?>">
            </div>
            <div class="form-group my-2">
                <textarea type="text" name="body" maxlength="150" class="form-control form-input bg-color-dark form-blue form-big" placeholder="Enter your note"><?php echo $note->body ?></textarea>
            </div>

            <div class="form-group my-2 d-flex justify-content-center form-radio">
                <div class="form-check mx-3">
                    <input class="form-check-input" type="radio" name="category" id="todo-option" value="todo">
                    <label class="form-check-label" for="todo-option">
                        ToDo
                    </label>
                </div>
                <div class="form-check mx-3">
                    <input class="form-check-input" type="radio" name="category" id="cars-option" value="cars">
                    <label class="form-check-label" for="cars-option">
                        Cars
                    </label>
                </div>
                <div class="form-check mx-3">
                    <input class="form-check-input" type="radio" name="category" id="food-option" value="food">
                    <label class="form-check-label" for="food-option">
                        Food
                    </label>
                </div>
                <div class="form-check mx-3">
                    <input class="form-check-input" type="radio" name="category" id="other-option" value="other" checked>
                    <label class="form-check-label" for="other-option">
                        Other
                    </label>
                </div>


            </div>
            <button type="submit" name="create_note" class="form-control form-btn my-4 mt-5 form-blue">Create note</button>
        </form>
    </div>
</div>

<?php include("./includes/footer.php"); ?>