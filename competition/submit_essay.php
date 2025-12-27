<?php
session_start();
date_default_timezone_set('Asia/Karachi');

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
include "../auth/dbconnect.php";

if(!isset($_SESSION['userid'])){
    echo "<script>alert('Only registered customer will participate in competitions '); window.location='login.php';</script>";
    exit;
}
$user_id = intval($_SESSION['userid']);
$event_id = (int)($_POST['event_id'] ?? 0);
$topic = trim($_POST['topic'] ?? '');
$essay_text = trim($_POST['essay_text'] ?? '');

if($event_id <= 0 || $topic=='' || $essay_text==''){
    die("Invalid data");
}

/* 🔥 USER START TIME (DB BASED) */
$chkStart = $conn->prepare("
    SELECT start_time, end_time 
    FROM competition_entries 
    WHERE event_id=? AND user_id=? 
    LIMIT 1
");
$chkStart->bind_param("ii",$event_id,$user_id);
$chkStart->execute();
$startRes = $chkStart->get_result();

/* Agar pehle se start nahi hua */
if($startRes->num_rows == 0){

    $start_time = date('Y-m-d H:i:s');
    $end_time   = date('Y-m-d H:i:s', strtotime('+1 minute'));

    $init = $conn->prepare("
        INSERT INTO competition_entries
        (event_id,user_id,start_time,end_time,status)
        VALUES (?,?,?,?, 'started')
    ");
    $init->bind_param("iiss",$event_id,$user_id,$start_time,$end_time);
    $init->execute();

}else{
    $row = $startRes->fetch_assoc();
    $start_time = $row['start_time'];
    $end_time   = $row['end_time'];
}

/* ⏰ TIME CHECK (STRICT) */
if(time() > strtotime($end_time)){
    die("Time expire ho chuka hai");
}

/* Word count */
$plain = strip_tags($essay_text);
$word_count = str_word_count($plain);

/* Event min words */
$ev = $conn->prepare("SELECT min_words FROM competition_events WHERE id=?");
$ev->bind_param("i",$event_id);
$ev->execute();
$min_words = (int)$ev->get_result()->fetch_assoc()['min_words'];

$status = ($word_count >= $min_words) ? 'qualified' : 'disqualified';

/* FINAL UPDATE (submit) */
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

header('location: user_dashboard.php');
exit;
?>
