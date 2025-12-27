<?php
include '../auth/dbconnect.php';
include '../auth/check.php';

$entry_id = intval($_GET['id']);
$entry = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM competition_entries WHERE id=$entry_id"));
?>
<h3><?= htmlspecialchars($entry['topic']) ?></h3>
<p><?= nl2br(htmlspecialchars($entry['essay_text'])) ?></p>
<a href="competition.php" class="btn btn-secondary mt-3">Back to Entries</a>