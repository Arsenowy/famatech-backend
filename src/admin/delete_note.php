<?php
include("includes/header.php");

if (!$session->is_signed_in()) redirect("login.php");

$note = Note::find_by_id($_GET['id']);

$note->delete();
redirect("index.php");
