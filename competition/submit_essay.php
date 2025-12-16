<?php
session_start();
date_default_timezone_set('Asia/Karachi');

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
include "../auth/dbconnect.php";

if(!isset($_SESSION['user_id'])){
    die("Login required");
}

$user_id  = (int)$_SESSION['user_id'];
$event_id = (int)($_POST['event_id'] ?? 0);
$topic = trim($_POST['topic'] ?? '');
$essay_text = trim($_POST['essay_text'] ?? '');

if($event_id <= 0 || $topic=='' || $essay_text==''){
    die("Invalid data");
}

/* 🔥 FETCH EXISTING TIMER (DO NOT START AGAIN) */
$chk = $conn->prepare("
    SELECT end_time 
    FROM competition_entries 
    WHERE event_id=? AND user_id=? 
    LIMIT 1
");
$chk->bind_param("ii", $event_id, $user_id);
$chk->execute();
$res = $chk->get_result();

if($res->num_rows == 0){
    die("Session not started properly");
}

$row = $res->fetch_assoc();
$end_time = $row['end_time'];

/* ⏰ STRICT TIME CHECK */
if(time() > strtotime($end_time)){
    die("Time expire ho chuka hai");
}

/* WORD COUNT */
$plain = strip_tags($essay_text);
$word_count = str_word_count($plain);

/* EVENT MIN WORDS */
$ev = $conn->prepare("SELECT min_words FROM competition_events WHERE id=?");
$ev->bind_param("i",$event_id);
$ev->execute();
$min_words = (int)$ev->get_result()->fetch_assoc()['min_words'];

$status = ($word_count >= $min_words) ? 'qualified' : 'disqualified';

/* FINAL UPDATE */
$upd = $conn->prepare("
UPDATE competition_entries SET
topic=?,
essay_text=?,
word_count=?,
status=?,
submitted_at=NOW()
WHERE event_id=? AND user_id=?
");
$upd->bind_param(
    "ssissi",
    $topic,
    $essay_text,
    $word_count,
    $status,
    $event_id,
    $user_id
);
$upd->execute();

/* ✅ SUCCESS CARD */
echo '
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Submission Successful</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
</head>
<body class="bg-dark d-flex align-items-center justify-content-center vh-100">

<div class="card shadow-lg text-center p-4" style="max-width:520px;">
    <div class="card-body">
        <i class="bi bi-check-circle-fill text-success fs-1 mb-3"></i>

        <h4 class="mb-3">Thank You for Your Participation!</h4>

        <p class="text-muted">
            Your essay has been submitted successfully.<br>
            Please wait while the author reviews all submissions and announces the winner.
        </p>

        <p class="text-muted">
            Competition details are available on your dashboard.
        </p>

        <a href="../user/dashboard.php" class="btn btn-warning mt-3">
            Go to Dashboard
        </a>
    </div>
</div>

</body>
</html>
';
exit;
