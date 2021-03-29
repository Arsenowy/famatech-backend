<?php
include("includes/header.php");

if (!$session->is_signed_in()) redirect("login.php");

$note = new Note();

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
<div class="container">
    <div class="row d-flex justify-content-center my-5">
        <div class="col-6">
            <form method="POST">
                <div class="form-group my-2">
                    <label for="title">Title</label>
                    <input required type="text" name="title" class="form-control" placeholder="Enter title">
                </div>
                <div class="form-group my-2">
                    <label for="body">Note</label>
                    <input required type="body" name="body" class="form-control pb-5" placeholder="Enter your note">
                </div>
                <div class="form-group my-2">
                    <label for="category">Category</label>
                    <select name="category" class="form-control">
                        <option value="cars">Cars</option>
                        <option value="food">Food</option>
                        <option value="other">Other</option>
                    </select>
                </div>
                <button type="submit" name="create_note" class="btn btn-primary my-2">Create note</button>
            </form>
        </div>
    </div>
</div>

<?php include("./includes/footer.php"); ?>
